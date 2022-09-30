<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Event;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'orginizer_id',
        'category_title',
        'status'
    ];


    public function events_details(){
      return $this->belongsTo(Event::class);
    }
}
