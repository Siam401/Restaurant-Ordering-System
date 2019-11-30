<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tamp extends Model
{
    protected $fillable = [
        'title', 'price', 'quantity','itemid','setitemid'
    ];
}
