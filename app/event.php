<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    protected $fillable = ['title', 'description', 'color', 'textColor', 'start', 'end'];
}
