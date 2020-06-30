<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'provinces';

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

  public function provinMuni()
  {
    return $this->hasMany('App\Municipality','province_id');
  }
}
