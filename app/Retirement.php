<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retirement extends Model
{
    protected $primaryKey = null;
    public $incrementing = false;

    protected $guarded = [];

    public function client()
    {
      return $this->belongsTo('App\User');
    }
}
