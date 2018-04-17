<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accumulation extends Model
{
  protected $table = "accumulations";

  protected $guarded = [];

  protected $casts = ['payment' => 'array'];

  public function client()
  {
    return $this->belongsTo('App\User');
  }
}
