<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accumulation extends Model
{
  protected $table = "accumulations";

  protected $guarded = [];

  public function client()
  {
    return $this->belongsTo('App\User');
  }
}
