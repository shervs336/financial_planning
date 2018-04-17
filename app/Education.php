<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = "educations";

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = ['payment' => 'array'];

    public function client()
    {
      return $this->belongsTo('App\User');
    }
}
