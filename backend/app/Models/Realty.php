<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realty extends Model
{
    protected $table = 'realty';
    protected $primaryKey = 'id';

    protected $hidden = ['created_at', 'updated_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'price',
        'bedrooms',
        'bathrooms',
        'storeys',
        'garages',
    ];
}
