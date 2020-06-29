<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracing extends Model
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
        'municipality_id' => 'integer',
        'productionline_id' => 'integer',
        'user_id' => 'integer',
    ];


    public function municipality()
    {
        return $this->belongsTo(\App\Municipality::class);
    }

    public function productionline()
    {
        return $this->belongsTo(\App\Productionline::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
