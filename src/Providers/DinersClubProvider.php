<?php

namespace CardDetective\CardProviderDetector\Providers;

class DinersClubProvider extends AbstractCardProvider
{
    public function __construct()
    {
        parent::__construct(
            name: 'Diners Club',
            type: 'Credit',
            validLengths: [14],
            hasSecurityCode: true,
            securityCodeLength: 3,
            features: ['chip', 'travel_benefits'],
            regexPattern: '/^3(?:0[0-59]{1}|[689])[0-9]{0,}$/'
        );
    }
}
