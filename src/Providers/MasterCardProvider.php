<?php

namespace CardDetective\CardProviderDetector\Providers;

class MasterCardProvider extends AbstractCardProvider
{
    public function __construct()
    {
        parent::__construct(
            name: 'MasterCard',
            type: 'Credit/Debit',
            validLengths: [16],
            hasSecurityCode: true,
            securityCodeLength: 3,
            features: ['chip', 'contactless', 'online_payments', 'worldwide'],
            regexPattern: '/^(5[1-5]|222[1-9]|22[3-9]|2[3-6]|27[01]|2720)[0-9]{0,}$/'
        );
    }
}
