<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    use HasFactory;
    // TODO: add email fot gyms or use contact information
    protected $fillable = [
        'name',
        'slogan',
        'description',
        'logo_url',
        'contact_information'
    ];
}
