<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'price'
    ];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $this->numericMaskRemove($value);
    }

    public function getPriceAttribute($value)
    {
        return $value/100;
    }

    public function getPriceFormatedAttribute()
    {
        return number_format($this->price, 2, ',', '.');
    }

    private function numericMaskRemove($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}
