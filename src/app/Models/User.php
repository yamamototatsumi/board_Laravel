<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  use HasFactory;

  protected $fillable = ['user_id', 'email', 'pass', 'name','created_at'];

  public function insert($userId,$email,$pass,$name){
    User::create(['user_id'=>$userId,
                    'email'=>$email,
                    'pass'=>$pass,
                    'name'=>$name,
                    'created_at'=>now(),]);
  }
  
  public function check($email){
    $user = User::where('email', $email)->first('email');
    return $user;
  }
}
