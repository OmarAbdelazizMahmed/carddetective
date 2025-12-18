<?php

namespace CardDetective\CardProviderDetector\Providers;

class VisaProvider extends AbstractCardProvider
{
    public function __construct()
    {
        parent::__construct(
            name: 'Visa',
            type: 'Credit/Debit',
            validLengths: [13, 16, 19],
            hasSecurityCode: true,
            securityCodeLength: 3,
            features: ['chip', 'contactless', 'online_payments'],
            regexPattern: '/^4[0-9]{0,}$/'
        );
    }
}
