<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ipackage extends Model
{
    protected $fillable = [
        'packageid','packagename','ingredientid','unit','quantity'
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
