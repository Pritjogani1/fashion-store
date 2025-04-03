<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class useraddress extends Model
{
    use HasFactory;
    protected $table = 'useraddress';

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 

}
