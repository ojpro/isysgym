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

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function membership(){
        return $this->belongsToMany(Membership::class,'subscriptions');
    }

}
