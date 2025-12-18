<?php

namespace CardDetective\CardProviderDetector\Providers;

class RuPayProvider extends AbstractCardProvider
{
    public function __construct()
    {
        parent::__construct(
            name: 'RuPay',
            type: 'Credit/Debit',
            validLengths: [16],
            hasSecurityCode: true,
            securityCodeLength: 3,
            features: ['chip', 'contactless', 'india_focused'],
            regexPattern: '/^(60[0-9]{4}|65[0-9]{4})[0-9]{0,}$/'
        );
    }
}
