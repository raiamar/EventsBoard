<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use App\Models\User;
use App\Models\Event;
use App\Models\BookingCustomerDetails;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $softCascade = ['organizer_id', 'event_id'];


    protected $fillable = [
        'organizer_id', 'event_id', 'customer_details', 'total_price', 'total_ticket', 'payment_method', 'paid', 'ticket_code'
    ];


    protected $casts = [
        'customer_details'=>'array',
    ];


    public function events_details(){
        return $this->belongsTo(Event::class);
    }

    public function booking_customer_details(){
        return $this->hasMany(BookingCustomerDetails::class);
    }
}
