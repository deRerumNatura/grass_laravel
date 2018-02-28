<?php
/**
 * Created by PhpStorm.
 * User: марк
 * Date: 22.02.2018
 * Time: 12:16
 */

namespace App\Observers;

use App\Models\Bunch;
use Illuminate\Support\Facades\Auth;

class BunchObserver
{
    public function saving(Bunch $bunch)
    {
        return $bunch->created_by = Auth::user()->id;
    }
}