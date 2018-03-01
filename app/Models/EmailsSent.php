<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailsSent extends Model
{
    protected $fillable = ['amount', 'date'];
}
