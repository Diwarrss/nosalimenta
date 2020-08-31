<?php

namespace App\Http\Controllers;

use App\ActivityImage;
use App\DevelopedActivitie;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DevelopActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

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
      //return $request;
      if (!$request->ajax()) return redirect('/');

      $images = $request->images;

      try {
        //usaremos transacciones por si surge un error durante el proceso
        DB::beginTransaction();

          $data = $request->all();
          $develop = DevelopedActivitie::create([
            'date_performed' => $request->date_performed,
            'phytosanitary_limitation' => $request->phytosanitary_limitation ? $request->phytosanitary_limitation : null,
            'employees' => $request->employees,
            'dose' => $request->dose,
            'dose_type' => $request->dose_type ? $request->dose_type :null,
            'product' => $request->product ? $request->product :null,
            'quantity' => $request->quantity,
            'measure_type' => $request->measure_type ? $request->measure_type :null,
            'description' => $request->description,
            'metod' => $request->metod ? $request->metod :null,
            'technical_visit' => $request->technical_visit,
            'tracing_id' => $request->tracing_id,
            'activity_id' => $request->activity_id,
            'land_tenure' => $request->land_tenure ? $request->land_tenure : null,
            'total_area' => $request->total_area ? $request->total_area : null,
            'condition' => $request->condition ? $request->condition : null,
            'score' => $request->score ? $request->score : null,
            'family_nucleus' => $request->family_nucleus ? $request->family_nucleus : null,
            'approximate_date' => $request->approximate_date ? $request->approximate_date : null,
            'projected_amount' => $request->projected_amount ? $request->projected_amount : null,
            'potential_buyers' => $request->potential_buyers ? $request->potential_buyers : null,
            'sown_area' => $request->sown_area,
            'costs' => $request->costs ? $request->costs : null,
          ]);

          if ($images) {
            //validamos las imagenes antes de guardar
            $request->validate([
              'images.*' => 'image|mimes:jpeg,png,jpg|max:4092'
            ]);
            /*Agregar Imagenes a DevelopedActivitie*/
            foreach ($images as $image) {
              $imagePath =  Storage::disk('uploads')->put('/imageActivity/' . $develop->id, $image);
              ActivityImage::create([
                'image_path' => $imagePath,
                'image_caption' => $develop->activity_id,
                'developed_activity_id' => $develop->id
              ]);
            }
          }
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
    public function update($id, Request $request)
    {
      try {
        DB::beginTransaction();

        /* $data = $request->all(); */
        $activity = DevelopedActivitie::find($id);

        $activity->date_performed = $request->date_performed;
        $activity->phytosanitary_limitation = $request->phytosanitary_limitation;
        $activity->employees = $request->employees;
        $activity->dose = $request->dose;
        $activity->dose_type = $request->dose_type;
        $activity->product = $request->product;
        $activity->quantity = $request->quantity;
        $activity->measure_type = $request->measure_type;
        $activity->description = $request->description;
        $activity->metod = $request->metod;
        $activity->technical_visit = $request->technical_visit;
        $activity->description = $request->description;
        $activity->land_tenure = $request->land_tenure;
        $activity->total_area = $request->total_area;
        $activity->condition = $request->condition;
        $activity->score = $request->score;
        $activity->family_nucleus = $request->family_nucleus;
        $activity->approximate_date = $request->approximate_date;
        $activity->projected_amount = $request->projected_amount;
        $activity->potential_buyers = $request->potential_buyers;
        $activity->sown_area = $request->sown_area;
        $activity->costs = $request->costs;
        $activity->save();
        DB::commit(); //commit de la transaccion

        if ($activity) {
          return response()->json([
            'type' => 'success',
            'message' => 'Actualizado con éxito',
            'data' => $activity
          ], 202);
        }else{
          return response()->json([
            'type' => 'error',
            'message' => 'Error al actualizar',
            'data' => []
          ], 204);
        }

      } catch (Exception $e) {
        return response()->json([
          'type' => 'error',
          'message' => 'Error al actualizar',
          'data' => []
        ], 204);
        DB::rollBack(); //si hay error no ejecute la transaccion
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        DB::beginTransaction();

        $develop = DevelopedActivitie::find($id);
        $develop->delete();
        DB::commit();

        if ($develop) {
          return response()->json([
            'type' => 'success',
            'message' => 'Registro eliminado',
            'data' => $develop
          ], 202);
        }else{
          return response()->json([
            'type' => 'error',
            'message' => 'Error al eliminar',
            'data' => []
          ], 204);
        }
      } catch (Exception $e) {
        return response()->json([
          'type' => 'error',
          'message' => 'Error al eliminar',
          'data' => []
        ], 204);
        DB::rollBack(); //si hay error no ejecute la transaccion
      }
    }
}
