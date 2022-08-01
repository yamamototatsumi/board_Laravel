<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreUser extends Model
{
    use HasFactory;
    protected $fillable = ['token','email','created_at'];

    public function insert(string $userId, string $email) {
      PreUser::create(['token' => $userId,
                                  'email' =>$email,
                                  'created_at' =>now()]);
    }

    public function check($email){
      $user = PreUser::where('email', $email)->first('email');
      return $user;
    }

    public function getEmail(string $id) {
      $email = PreUser::where('token', $id)->first('email');
      return $email;
    }

    public function getId(string $email) {
      $id = PreUser::where('email',"$email")->first('id');
      return $id;
    }
}

