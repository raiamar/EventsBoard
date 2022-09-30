<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'guardian_name', 'age', 'gender', 'guardian_number', 'email', 'height', 'weight',
        'pp_image', 'full_image', 'contact', 'p_address', 't_address', 'details', 'payment_method',
        'qrcode_payment', 'payment_reg', 'payment_conformation', 'facebook', 'instagram', 'tiktok',
        'reference', 'conformation'
    ];
}
