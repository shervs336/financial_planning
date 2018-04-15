<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
