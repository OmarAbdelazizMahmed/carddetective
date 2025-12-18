<?php

namespace CardDetective\CardProviderDetector\Providers;

class AmericanExpressProvider extends AbstractCardProvider
{
    public function __construct()
    {
        parent::__construct(
            name: 'American Express',
            type: 'Credit',
            validLengths: [15],
            hasSecurityCode: true,
            securityCodeLength: 4,
            features: ['chip', 'contactless', 'premium_benefits'],
            regexPattern: '/^3[47][0-9]{0,}$/'
        );
    }
}
