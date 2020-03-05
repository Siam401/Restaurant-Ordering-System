<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itemingredient extends Model
{
    protected $fillable = [
        'itemid','ingredientid','ingredientidunit','ingredientidquantity','packageid','packagequantity'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
