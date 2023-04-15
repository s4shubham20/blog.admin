<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return $this->attributes['created_at'] = date('d-M-Y', strtotime($date));
    }

    public function getUpdatedAtAttribute($date)
    {
        return $this->attributes['updated_at'] = date('d-M-Y', strtotime($date));
    }
}
