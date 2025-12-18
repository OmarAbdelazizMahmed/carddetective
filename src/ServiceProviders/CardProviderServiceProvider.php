<?php

namespace CardDetective\CardProviderDetector\ServiceProviders;

use CardDetective\CardProviderDetector\Contracts\CardProviderInterface;
use CardDetective\CardProviderDetector\Repositories\CardProviderRepository;
use Illuminate\Support\ServiceProvider;

class CardProviderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CardProviderRepository::class, function ($app) {
            return new CardProviderRepository;
        });

        // Register individual card providers
        $this->app->bind(CardProviderInterface::class.'.visa', \CardDetective\CardProviderDetector\Providers\VisaProvider::class);
        $this->app->bind(CardProviderInterface::class.'.mastercard', \CardDetective\CardProviderDetector\Providers\MasterCardProvider::class);
        $this->app->bind(CardProviderInterface::class.'.amex', \CardDetective\CardProviderDetector\Providers\AmericanExpressProvider::class);
        $this->app->bind(CardProviderInterface::class.'.diners', \CardDetective\CardProviderDetector\Providers\DinersClubProvider::class);
        $this->app->bind(CardProviderInterface::class.'.jcb', \CardDetective\CardProviderDetector\Providers\JCBProvider::class);
        $this->app->bind(CardProviderInterface::class.'.discover', \CardDetective\CardProviderDetector\Providers\DiscoverProvider::class);
        $this->app->bind(CardProviderInterface::class.'.rupay', \CardDetective\CardProviderDetector\Providers\RuPayProvider::class);
        $this->app->bind(CardProviderInterface::class.'.unionpay', \CardDetective\CardProviderDetector\Providers\UnionPayProvider::class);
        $this->app->bind(CardProviderInterface::class.'.maestro', \CardDetective\CardProviderDetector\Providers\MaestroProvider::class);
        $this->app->bind(CardProviderInterface::class.'.elo', \CardDetective\CardProviderDetector\Providers\EloProvider::class);
        $this->app->bind(CardProviderInterface::class.'.mir', \CardDetective\CardProviderDetector\Providers\MirProvider::class);
        $this->app->bind(CardProviderInterface::class.'.hipercard', \CardDetective\CardProviderDetector\Providers\HipercardProvider::class);
    }

    public function boot(): void
    {
        // Boot logic for card providers if needed
    }
}
