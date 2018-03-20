<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = ['title', 'desc', 'status', 'user_id'];
}
