<?php

namespace CardDetective\CardProviderDetector\ServiceProviders;

use CardDetective\CardProviderDetector\CardDetection\CardDetective;
use CardDetective\CardProviderDetector\Contracts\CardDetectorInterface;
use CardDetective\CardProviderDetector\Factories\CardInfoFactory;
use CardDetective\CardProviderDetector\Repositories\CardProviderRepository;
use CardDetective\CardProviderDetector\Services\CardValidationService;
use Illuminate\Support\ServiceProvider;

class CardDetectiveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register the main CardDetective service
        $this->app->singleton(CardDetectorInterface::class, CardDetective::class);
        $this->app->alias(CardDetectorInterface::class, 'carddetective');

        // Register dependencies
        $this->app->singleton(CardProviderRepository::class);
        $this->app->singleton(CardValidationService::class);
        $this->app->singleton(CardInfoFactory::class, function ($app) {
            return new CardInfoFactory($app->make(CardValidationService::class));
        });
    }

    public function boot(): void
    {
        // Publish configuration if needed
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/carddetective.php' => config_path('carddetective.php'),
            ], 'config');
        }
    }
}
