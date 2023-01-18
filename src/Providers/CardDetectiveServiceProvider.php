<?php

namespace CardDetective\CardProviderDetector\Providers;

use CardDetective\CardProviderDetector\CardDetection\CardDetector;

use Illuminate\Support\ServiceProvider;

class CardDetectiveServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('card-detective', function () {
            return new CardDetector();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/path/to/config/carddetective.php' => config_path('carddetective.php'),
        ], 'config');
    }
}
