<?php

namespace App\Models;

//use App\Models\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Campaign extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'created_by', 'template_id', 'bunch_id'];

    public function template () {
        return $this->belongsTo(Template::class);
    }

    public function bunch () {
        return $this->belongsTo(Bunch::class);
    }

    public function scopeOwned($query) {
        return $query->where('created_by', Auth::user()->id);
    }
}
