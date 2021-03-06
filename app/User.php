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
        'firstname', 'middlename', 'lastname', 'username', 'password', 'role', 'image', 'email_address', 'contact_number', 'birthdate'
    ];

    protected $dates = [
      'created_at', 'updated_at', 'birthdate'
    ];

    protected $casts = [
      'birthdate' => "date"
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
      return $this->hasMany('App\Education');
    }

    public function retirement()
    {
      return $this->hasOne('App\Retirement');
    }

    public function accumulation()
    {
      return $this->hasOne('App\Accumulation');
    }

    public function emergency_fund()
    {
      return $this->hasOne('App\EmergencyFund');
    }
}
