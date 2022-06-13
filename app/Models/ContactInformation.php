<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone_number',
        'facebook',
        'instagram',
        'twitter',
        'whatsapp',
        'website'
    ];
}
