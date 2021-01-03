<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{

    protected $fillable = [
        'name', 'email', 'phone'
    ];
}
