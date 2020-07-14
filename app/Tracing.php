<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracing extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tracings';

    protected $fillable = [
      'zone',
      'producer',
      'identification',
      'phone',
      'latitude',
      'longitude',
      'altitude',
      'municipality_id',
      'production_line_id',
      'user_id'
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
    protected $casts = [
        'id' => 'integer',
        'municipality_id' => 'integer',
        'production_line_id' => 'integer',
        'user_id' => 'integer',
    ];


    public function municipality()
    {
        return $this->belongsTo(\App\Municipality::class)->with('province');
    }

    public function productionLine()
    {
        return $this->belongsTo(\App\ProductionLine::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function developedActivities()
    {
        return $this->hasMany(\App\DevelopedActivitie::class, 'tracing_id', 'id')->with('activity', 'activityImage');
    }
}
