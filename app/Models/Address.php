<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'address_line', 'city', 'state', 'country', 'postal_code', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
