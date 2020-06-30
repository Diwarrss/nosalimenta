<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'municipalities';

    protected $fillable = [
      'name',
      'province_id',
      'phase_id'
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
