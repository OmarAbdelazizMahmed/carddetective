<?php

namespace CardDetective\CardProviderDetector\Providers;

use CardDetective\CardProviderDetector\CardDetection\CardDetective;

use Illuminate\Support\ServiceProvider;

class CardDetectiveServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('carddetective', function () {
            return new CardDetective();
        });
    }
}
