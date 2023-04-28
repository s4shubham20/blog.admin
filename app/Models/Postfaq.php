<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postfaq extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','question','answer'];
}
