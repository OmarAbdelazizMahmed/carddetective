<?php

namespace CardDetective\CardProviderDetector\Repositories;

use CardDetective\CardProviderDetector\Contracts\CardProviderInterface;
use CardDetective\CardProviderDetector\Providers\AmericanExpressProvider;
use CardDetective\CardProviderDetector\Providers\DinersClubProvider;
use CardDetective\CardProviderDetector\Providers\DiscoverProvider;
use CardDetective\CardProviderDetector\Providers\EloProvider;
use CardDetective\CardProviderDetector\Providers\HipercardProvider;
use CardDetective\CardProviderDetector\Providers\JCBProvider;
use CardDetective\CardProviderDetector\Providers\MaestroProvider;
use CardDetective\CardProviderDetector\Providers\MasterCardProvider;
use CardDetective\CardProviderDetector\Providers\MirProvider;
use CardDetective\CardProviderDetector\Providers\RuPayProvider;
use CardDetective\CardProviderDetector\Providers\UnionPayProvider;
use CardDetective\CardProviderDetector\Providers\VisaProvider;

class CardProviderRepository
{
    private array $providers = [];

    public function __construct()
    {
        $this->registerDefaultProviders();
    }

    private function registerDefaultProviders(): void
    {
        $this->providers = [
            new EloProvider,
            new HipercardProvider,
            new AmericanExpressProvider,
            new DinersClubProvider,
            new JCBProvider,
            new DiscoverProvider,
            new RuPayProvider,
            new UnionPayProvider,
            new MaestroProvider,
            new MirProvider,
            new MasterCardProvider,
            new VisaProvider,
        ];
    }

    public function findProviderByCardNumber(string $cardNumber): ?CardProviderInterface
    {
        $cleanedNumber = preg_replace('/\D/', '', $cardNumber);

        foreach ($this->providers as $provider) {
            if ($provider->matches($cleanedNumber)) {
                return $provider;
            }
        }

        return null;
    }

    public function getAllProviders(): array
    {
        return $this->providers;
    }

    public function getProviderNames(): array
    {
        return array_map(fn (CardProviderInterface $provider) => $provider->getName(), $this->providers);
    }

    public function isProviderSupported(string $providerName): bool
    {
        return in_array($providerName, $this->getProviderNames(), true);
    }

    public function addProvider(CardProviderInterface $provider): void
    {
        $this->providers[] = $provider;
    }

    public function removeProvider(string $providerName): bool
    {
        foreach ($this->providers as $index => $provider) {
            if ($provider->getName() === $providerName) {
                unset($this->providers[$index]);
                $this->providers = array_values($this->providers);

                return true;
            }
        }

        return false;
    }
}
