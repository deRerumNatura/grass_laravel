<?php

namespace App\Models;

use App\Traits\Selectable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use SoftDeletes, Selectable;

    protected $fillable = ['name', 'surname', 'email', 'created_by'];

    public function bunch () {
        return $this->belongsTo(Bunch::class);
    }

    public function scopeOwned($query) {
        return $query;
    }

//    public function showOneSubs()

//    public function set_bunch_id($bunch_id)   {
//        $this->set_attribute('bunch_id', $bunch_id);
//    }
}
