<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = date('d-M-Y', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = date('d-M-Y', strtotime($value));
    }
}
