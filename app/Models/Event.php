<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use App\Models\User;
use App\Models\Category;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $softCascade = ['user_id'];

    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'info', 'thumbnail', 'start_date', 'end_date',
        'status',  'form_fee', 'qr_code', 'payment_types', 'category', 'pre_booking',
        'ticket_price', 'address'
    ];


    public function user_details(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    protected $casts = [
        'category_id'=>'array',
    ];


    // public function child_category(){
    //     return $this->hasMany(Category::class, 'category_id', 'id');
    // }
}
