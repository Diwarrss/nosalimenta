<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevelopedActivitie extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'developed_activities';

    protected $fillable = [
      'date_performed',
      'phytosanitary_limitation',
      'employees',
      'dose',
      'dose_type',
      'product',
      'quantity',
      'measure_type',
      'description',
      'images',
      'metod',
      'tracing_id',
      'activity_id'
    ];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /* protected $casts = [
        'id' => 'integer',
        'quantity' => 'decimal',
        'tracing_id' => 'integer',
        'activity_id' => 'integer',
    ]; */


    public function tracing()
    {
        return $this->belongsTo(\App\Tracing::class)->with('productionLine');
    }

    public function activity()
    {
        return $this->belongsTo(\App\Activity::class);
    }
}
