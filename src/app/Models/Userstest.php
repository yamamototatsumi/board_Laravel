<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userstest extends Model
{
    use HasFactory;

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

    public function insertRows($row){
      Userstest::insert(['name' => $row[1], 'email' => $row[2], 'user_id' => $row[3], 'email_verified_at' => $row[5],'password' => $row[6],
                        'created_at' => $row[8],'updated_at' => $row[9]]);
    }

    
}
