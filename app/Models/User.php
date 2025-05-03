<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // // 暗号化
    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = Crypt::encryptString($value);
    // }
    // // 復号
    // public function getNameAttribute($value)
    // {
    //     return Crypt::decryptString($value);
    // }
}
