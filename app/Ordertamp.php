<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordertamp extends Model
{
    protected $fillable = [
        'itemname','setname','quantity','price','itemid','setitemid','status'
    ];
}
