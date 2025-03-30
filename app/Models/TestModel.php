<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'test_value_1',
        'test_value_2',
        'test_value_3'
    ];

    protected $dates = ['deleted_at']; // ソフトデリート用のカラム
}
