<?php

namespace CardDetective\CardProviderDetector\Providers;

class JCBProvider extends AbstractCardProvider
{
    public function __construct()
    {
        parent::__construct(
            name: 'JCB',
            type: 'Credit',
            validLengths: [15, 16],
            hasSecurityCode: true,
            securityCodeLength: 3,
            features: ['chip', 'contactless', 'asia_pacific'],
            regexPattern: '/^(?:2131|1800|35)[0-9]{0,}$/'
        );
    }
}
