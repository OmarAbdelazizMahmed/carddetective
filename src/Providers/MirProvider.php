<?php

namespace CardDetective\CardProviderDetector\Providers;

class MirProvider extends AbstractCardProvider
{
    public function __construct()
    {
        parent::__construct(
            name: 'Mir',
            type: 'Credit/Debit',
            validLengths: [16],
            hasSecurityCode: true,
            securityCodeLength: 3,
            features: ['chip', 'contactless', 'russia_focused'],
            regexPattern: '/^220[0-4][0-9]{0,}$/'
        );
    }
}
