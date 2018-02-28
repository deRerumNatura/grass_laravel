<?php

namespace App\Models;

//use App\Models\Campaign;
use App\Traits\Selectable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Template extends Model
{
    use SoftDeletes, Selectable;

    protected $fillable = ['name', 'content' , 'created_by'];

    public function campaigns () {
        return $this->hasOne(Campaign::class);
    }

    public function scopeOwned($query) {
//        dd($query->where('created_by', Auth::user()->id));
        return $query->where('created_by', Auth::user()->id);
    }

}
