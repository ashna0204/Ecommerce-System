<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
     protected $fillable = ['name', 'email', 'password', 'role'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
