<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
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
        'province_id' => 'integer',
        'phase_id' => 'integer',
    ];


    public function province()
    {
        return $this->belongsTo(\App\Province::class);
    }

    public function phase()
    {
        return $this->belongsTo(\App\Phase::class);
    }
}
