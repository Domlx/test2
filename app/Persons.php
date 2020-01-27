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

    protected $with = 'requests';

    /**
     * Get all requests belongs to the person.
     */
    public function requests()
    {
        return $this->hasMany(Requests::class, 'person_id', 'id');
    }
}
