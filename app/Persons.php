<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'infix', 'street',
        'house_number', 'zip_code', 'city', 'country',
    ];
}
