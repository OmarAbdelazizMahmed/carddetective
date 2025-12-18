<?php

namespace CardDetective\CardProviderDetector\Providers;

class MaestroProvider extends AbstractCardProvider
{
    public function __construct()
    {
        parent::__construct(
            name: 'Maestro',
            type: 'Debit',
            validLengths: [12, 13, 14, 15, 16, 17, 18, 19],
            hasSecurityCode: false,
            securityCodeLength: 0,
            features: ['chip', 'online_payments'],
            regexPattern: '/^(5[06789]|6)[0-9]{0,}$/'
        );
    }
}
