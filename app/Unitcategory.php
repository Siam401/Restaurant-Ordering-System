<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unitcategory extends Model
{
    protected $fillable = [
        'unitcategoryname'
    ];

    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
