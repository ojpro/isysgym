<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'gym_id',
        'price',
        'number_of_attendances',
        'icon'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function members()
    {
        //LEARNED: relations types
        return $this->belongsToMany(Member::class, 'subscriptions');

//        return $this->hasManyThrough(Member::class, Subscription::class, 'membership_id', 'id', 'id', 'member_id');
    }
}
