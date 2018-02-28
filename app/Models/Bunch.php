<?php

namespace App\Models;

use App\Traits\Selectable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Bunch extends Model
{
    use SoftDeletes, Selectable;

    protected $fillable = ['title', 'description', 'created_by'];

    public function subscribers () {
        return $this->hasMany(Subscriber::class);
    }

    public function camaigns () {
        return $this->hasMany(Campaign::class);
    }

    public function scopeOwned($query) {
        return $query->where('created_by', Auth::user()->id);
    }
}
