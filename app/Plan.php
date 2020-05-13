<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'code',
        'name',
        'amount',
        'days',
        'trial_days',
        'payment_methods',
        'status',
        'benefits'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $this->numericMaskRemove($value);
    }

    public function getAmountAttribute($value)
    {
        return $value/100;
    }

    public function getAmountFormatedAttribute()
    {
        return number_format($this->amount, 2, ',', '.');
    }

    public function getPaymentMethodsNameAttribute($value)
    {
        $type = [
            1 => 'Boleto',
            2 => 'Cartão de Crédito',
            3 => 'Boleto e Cartão de Crédito'
        ];

        return $type[$this->payment_methods];
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == '1' ? 1 : 0);
    }

    public function getArrayBenefitsAttribute()
    {
        return explode(',', $this->benefits);
    }

    private function numericMaskRemove($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}
