<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'ingredientname','quantity','price','unitid'
    ];

    public function ipackages()
    {
        return $this->hasMany(Ipackage::class);
    }

    public function unit()
    {
        return $this->belongsTo(unit::class);
    }
}
