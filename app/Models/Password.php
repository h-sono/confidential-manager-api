<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Password extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'site',
        'username',
        'password', // 暗号化されたパスワードが入る
    ];

    protected $dates = ['deleted_at']; // ソフトデリート用のカラム

    /**
     * ユーザーとのリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
