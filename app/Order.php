<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'invoice','tableno','item','quantity','price','status','billcomplete'
    ];
}
