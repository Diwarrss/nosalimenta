<?php

namespace App\Http\Controllers;

use App\DevelopedActivitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevelopActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
          $develop = DevelopedActivitie::create($data);

          /* $develop = new DevelopedActivitie;
          $develop->date_performed = $request->date_performed;
          $develop->phytosanitary_limitation = $request->phytosanitary_limitation ? $request->phytosanitary_limitation : null;
          $develop->employees = $request->employees;
          $develop->dose = $request->dose;
          $develop->dose_type = $request->dose_type ? $request->dose_type :null;
          $develop->product = $request->product ? $request->product :null;
          $develop->quantity = $request->quantity;
          $develop->measure_type = $request->measure_type ? $request->measure_type :null;
          $develop->description = $request->description;
          $develop->images = $request->images ? $request->images :null;
          $develop->metod = $request->metod ? $request->metod :null;
          $develop->tracing_id = $request->tracing_id;
          $develop->activity_id = $request->activity_id;
          $develop->save(); */

          DB::commit(); //commit de la transaccion

          return response()->json([
            'message' => 'Actividad agregada con éxito',
            'data' => $develop
          ], 201);

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
}
