<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;


    protected $fillable = [
        'event_id', 'orginizer_id', 'category', 'name', 'participant_details', 'gender', 'participant_gaurdian',
        'pp_image', 'full_image', 'details', 'payment_method',
        'qrcode_payment', 'payment_reg', 'payment_conformation', 'social_media',
        'reference', 'conformation', 'extra',

        'age','height','weight','phone_no','permanent_address','temporary_address','optional_number','email'
    ];


    // protected $casts = [
    //     'participant_details'=> 'array',
    //     'participant_gaurdian'=> 'array',
    //     'social_media'=> 'array',
    //     'extra'=>'array',
    // ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
