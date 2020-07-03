<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityImage extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $fillable = [
      'image_path',
      'image_caption',
      'developed_activity_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'activity_id' => 'integer',
    ];

    public function developActivity()
    {
      return $this->belongsTo(\App\DevelopedActivitie::class);
    }
}
