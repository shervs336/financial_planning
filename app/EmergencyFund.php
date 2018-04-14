<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyFund extends Model
{
    protected $table = "emergency_funds";

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    public function client()
    {
      return $this->belongsTo('App\User');
    }
}
