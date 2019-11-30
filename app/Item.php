<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'categoryid','itemname','ingredient','price','portion','quantity'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
