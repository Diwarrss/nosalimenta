<?php

namespace App\Http\Controllers;

use App\Municipality;
use App\Province;
use App\Tracing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TracingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $paginate = $request->paginate;
      $per_page = $request->per_page;

      if($request->id){
        return Tracing::with('developedActivities', 'productionLine', 'municipality')->where('id', $request->id)->get();
      }else if (Auth::user()->rol_id === 1) {
        if ($paginate == 'true') {
          //realizar busqueda
          if ($request->filter) {
            $query = Tracing::query();

            foreach ($request->filter as $filter => $value) {
              $query->where($filter, 'LIKE', "%{$value}%");
            }
            return $query->with('developedActivities', 'productionLine', 'municipality')->paginate($per_page);
          } else {
            return Tracing::with('user', 'developedActivities', 'productionLine', 'municipality')->paginate($per_page);
          }
        }else{
          return Tracing::with('user', 'developedActivities', 'productionLine', 'municipality')->latest()->take($per_page)->get();
        }
      }else{
        return Tracing::where('user_id', Auth::user()->id)->get();
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (!$request->ajax()) return redirect('/');

      try {
        //usaremos transacciones por si surge un error durante el proceso
        DB::beginTransaction();

          $data = $request->all();
          $data['user_id'] = Auth::user()->id;
          $tracing = Tracing::create($data);
          DB::commit(); //commit de la transaccion

          if ($tracing) {
            return response()->json([
              'type' => 'success',
              'message' => 'Seguimiento creado con éxito',
              'data' => $tracing
            ], 201);
          }else{
            return response()->json([
              'type' => 'error',
              'message' => 'Error al guardar',
              'data' => []
            ], 204);
          }
          /* return response()->json([
            'message' => 'Seguimiento creado con éxito',
            'data' => $tracing
          ], 201); */
        } catch (Exception $e) {
          DB::rollBack(); //si hay error no ejecute la transaccion
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //download XLSX
    public function export()
    {
      if (Auth::user()->rol_id === 1) {
        return Tracing::Join ('municipalities', 'tracings.municipality_id', '=', 'municipalities.id')
                      ->Join ('users', 'tracings.user_id', '=', 'users.id')
                      ->Join ('provinces', 'municipalities.province_id', '=', 'provinces.id')
                      ->select('tracings.id as ID', 'users.name as Encargado', 'provinces.name as Provincia', 'municipalities.name as Municipio', 'tracings.zone as Vereda', 'tracings.producer as Productor', 'tracings.identification as Cedula', 'tracings.phone as Celular')
                      ->get();
      }
      return Tracing::Join ('municipalities', 'tracings.municipality_id', '=', 'municipalities.id')
                    ->Join ('users', 'tracings.user_id', '=', 'users.id')
                    ->select('tracings.id as ID', 'users.name as Encargado', 'provinces.name as Provincia', 'municipalities.name as Municipio', 'tracings.zone as Vereda', 'tracings.producer as Productor', 'tracings.identification as Cedula', 'tracings.phone as Celular')
                    ->where('user_id', Auth::user()->id)
                    ->get();
      /* return EntryFiling::with(
        'dependences',
        'People:id,names'
        )
        ->where('state', 1)
        ->whereBetween('created_at', [$request->fromDate, $request->toDate]); */
    }
}
