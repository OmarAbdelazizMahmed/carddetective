<?php

namespace CardDetective\CardProviderDetector\Providers;

class DiscoverProvider extends AbstractCardProvider
{
    public function __construct()
    {
        parent::__construct(
            name: 'Discover',
            type: 'Credit',
            validLengths: [16],
            hasSecurityCode: true,
            securityCodeLength: 3,
            features: ['chip', 'contactless', 'cashback'],
            regexPattern: '/^(6011|65|64[4-9]|62212[6-9]|6221[3-9]|622[2-8]|6229[01]|62292[0-5])[0-9]{0,}$/'
        );
    }
}
