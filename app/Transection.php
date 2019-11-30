<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    protected $fillable = [
        'invoice','tableno','item','quantity','price','status','billcomplete'
    ];
}
