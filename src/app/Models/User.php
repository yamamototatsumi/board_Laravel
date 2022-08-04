<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    

    public function insert($userId,$email,$pass,$name){
      var_dump($userId);
      return User::create(['user_id'=>$userId,'email'=>$email,'password'=>$pass,'name'=>$name,]);
    }
    
    public function check($email){
      $user = User::where('email', $email)->first('email');
      return $user;
    }
  
    public function passCheck($email){
      $user = User::where('email',$email)->first();
      return $user;
    }
  
    public function adminCheck($user_id) {
      $user = User::where('user_id',$user_id)->first();
      return $user;
    }
  
    public function selectName(string $id) {
      $user = User::where('user_id',$id)->first('name');
      return $user->name;
    }
    
    public function selectUserNameWithPass(string $id) :object{
      $user = User::where('user_id',$id)->first();
      return $user;
    }
  
    public function put(string $id,string $name,string $pass){
      User::where('user_id', $id)
            ->update(['name' => $name,'password'=>$pass]);
      // $this->trans($sql,$stmt);
    }
}
