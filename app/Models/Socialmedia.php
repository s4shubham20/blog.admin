<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Socialmedia extends Model
{
    use HasFactory;

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = Str::lower($value);
    }

    public function getNameAttribute($value)
    {
        return $this->name = Str::headline($value);
    }
}
