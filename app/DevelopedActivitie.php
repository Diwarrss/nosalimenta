<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevelopedActivitie extends Model
{
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
        'quantity' => 'decimal',
        'tracing_id' => 'integer',
        'activity_id' => 'integer',
    ];


    public function tracing()
    {
        return $this->belongsTo(\App\Tracing::class);
    }

    public function activity()
    {
        return $this->belongsTo(\App\Activity::class);
    }
}
