<?php

namespace CardDetective\CardProviderDetector\Providers;

class HipercardProvider extends AbstractCardProvider
{
    public function __construct()
    {
        parent::__construct(
            name: 'Hipercard',
            type: 'Credit',
            validLengths: [16],
            hasSecurityCode: true,
            securityCodeLength: 3,
            features: ['chip', 'contactless', 'brazil_focused'],
            regexPattern: '/^(606282|3841)[0-9]{0,}$/'
        );
    }
}
