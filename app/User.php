<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules = [
      'name' => 'required|string',
      'username' => 'required|string|unique:users',
      'password' => 'required|string|confirmed'
    ];

    public function education()
    {
      return $this->hasOne('App\Education');
    }

    public function retirement()
    {
      return $this->hasOne('App\Retirement');
    }

    public function accumulation()
    {
      return $this->hasOne('App\Accumulation');
    }
}
