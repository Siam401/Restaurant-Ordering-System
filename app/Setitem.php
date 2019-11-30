<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setitem extends Model
{
    protected $fillable = [
        'setname','fixeditem','selecteditem','price','quantity'
    ];
}
