<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retirement extends Model
{
    protected $table = "retirements";

    protected $guarded = [];

    public function client()
    {
      return $this->belongsTo('App\User');
    }
}
