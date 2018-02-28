<?php

namespace App\Providers;

use App\Models\Bunch;
use App\Models\Campaign;
use App\Models\Template;
use App\Observers\BunchObserver;
use App\Observers\CampaignObserver;
use App\Observers\TemplateObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Template::observe(TemplateObserver::class);
        Bunch::observe(BunchObserver::class);
        Campaign::observe(CampaignObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
