<?php

namespace App;

use DateTime;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'genre',
        'rg',
        'cpf',
        'birth_date',
        'genre',
        'phone',
        'cell',
        'cover',
        'street',
        'number',
        'complement',
        'zip_code',
        'district',
        'city',
        'state',
        'country',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setIsAdminAttribute($value)
    {
        
        $this->attributes['is_admin'] = ($value === true || $value === 'on' ? 1 : 0);
    }

    public function setPasswordAttribute($value)
    {
        if (is_null($value)) {
            unset($this->attributes['password']);
            return;
        }

        $this->attributes['password'] = bcrypt($value);
    }

    public function setCpfAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['cpf'] = $this->numericMaskRemove($value);
        }
    }

    public function setRgAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['rg'] = $this->numericMaskRemove($value);
        }
    }

    public function setCellAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['cell'] = $this->numericMaskRemove($value);
        }
    }

    public function setPhoneAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['phone'] = $this->numericMaskRemove($value);
        }
    }

    public function setZipCodeAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['zip_code'] = $this->numericMaskRemove($value);
        }
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $this->convertStringToDate($value);
    }

    public function getBirthDateAttribute($value)
    {
        if (!is_null($value)) {
            return date('d/m/Y', strtotime($value));
        }
        return null;
    }

    private function convertStringToDate(?string $param)
    {
        if (empty($param)){
            return null;
        }

        list($day, $month, $year) = explode('/', $param);

        return (new DateTime($year .'-'. $month .'-'. $day))->format('Y-m-d');
    }

    private function numericMaskRemove($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}
