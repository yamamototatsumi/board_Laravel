<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'name', 'email', 'password','api_token'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime'
    ];



    public function insert(string $name, string $email, string $pass, string $userId) :object{
      $user = User::create(['user_id'=>$userId,'email'=>$email,'password'=>$pass,'name'=>$name,]);
      return $user;
    }
  
    public function put($request){
        DB::transaction(function () use ($request) {
          User::where('user_id', $request->id)
          ->update(['name' => $request->name,'password'=>Hash::make($request->pass)]);
      });
    }
          
    public function scopeMonth($query,$date) {
      return $query->whereYear('created_at', $date);
    }

    public function indexAdmin() :object{
      $data = User::get();
      return $data;
    }

}
