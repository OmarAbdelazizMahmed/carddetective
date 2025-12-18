<?php

namespace CardDetective\CardProviderDetector\Providers;

class UnionPayProvider extends AbstractCardProvider
{
    public function __construct()
    {
        parent::__construct(
            name: 'UnionPay',
            type: 'Credit/Debit',
            validLengths: [16, 17, 18, 19],
            hasSecurityCode: true,
            securityCodeLength: 3,
            features: ['chip', 'contactless', 'china_focused'],
            regexPattern: '/^(62|88)(?=[0-9]{4})(?:[0-9]{0,})$/'
        );
    }
}
