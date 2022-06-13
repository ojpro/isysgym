<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'gender',
        'weight',
        'birthday',
        'username',
        'email',
        'password',
        'avatar'
    ];
}
