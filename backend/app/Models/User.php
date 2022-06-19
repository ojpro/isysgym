<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //TODO*: add relationships for all models
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'email_verified_at',
        'contact_information',
        'gym_id'
    ];

    protected $hidden = [
        'password'
    ];
    public function role(){
        // TODO: need improve
        return $this->belongsToMany(Role::class,'user_roles');
    }
}
