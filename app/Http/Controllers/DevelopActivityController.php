<?php

namespace App\Http\Controllers;

use App\ActivityImage;
use App\DevelopedActivitie;
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
            'activity_id' => $request->activity_id
          ]);

          if ($images) {
            //validamos las imagenes antes de guardar
            $request->validate([
              'images.*' => 'image|mimes:jpeg,png,jpg|max:1024'
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