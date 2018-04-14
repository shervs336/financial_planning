<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
  protected $table = "educations";

  protected $guarded = [];

  public function client()
  {
    return $this->belongsTo('App\User');
  }
}
