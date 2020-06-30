<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'phases';

    protected $fillable = [
      'name'
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
    ];
}
