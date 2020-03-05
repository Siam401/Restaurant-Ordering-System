<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'unitcategoryid','unitname','factor','rounding'
    ];

    public function category()
    {
        return $this->belongsTo(Unitcategory::class);
    }
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
    public function ipackages()
    {
        return $this->hasMany(Ipackage::class);
    }
}
