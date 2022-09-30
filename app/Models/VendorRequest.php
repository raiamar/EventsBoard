<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class VendorRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id','orginazation','address','contact'];

    public function user_details(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

