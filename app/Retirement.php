<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retirement extends Model
{
    protected $table = "retirements";

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    public function client()
    {
      return $this->belongsTo('App\User');
    }
}
