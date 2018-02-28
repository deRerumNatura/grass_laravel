<?php

namespace App\Observers;

use App\Models\Template;
use Illuminate\Support\Facades\Auth;

class TemplateObserver
{

    public function saving(Template $template)
    {
        return $template->created_by = Auth::user()->id;
    }


}