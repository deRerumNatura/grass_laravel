<?php
/**
 * Created by PhpStorm.
 * User: марк
 * Date: 22.02.2018
 * Time: 17:40
 */

namespace App\Observers;

use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;

class CampaignObserver
{
    public function saving(Campaign $campaign)
    {
//        dd('dsds');
        return $campaign->created_by = Auth::user()->id;
    }
}