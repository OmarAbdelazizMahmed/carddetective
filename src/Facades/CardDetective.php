<?php

namespace CardDetective\CardProviderDetector\Facades;

use CardDetective\CardProviderDetector\DTO\CardInfo;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string detectCardProvider(string $cardNumber)
 * @method static CardInfo getCardInfo(string $cardNumber)
 * @method static bool isCardNumberValid(string $cardNumber)
 * @method static string maskCardNumber(string $cardNumber, string $maskChar = '*')
 * @method static string formatCardNumber(string $cardNumber, string $separator = ' ')
 * @method static bool isValidSecurityCode(string $cardNumber, string $securityCode)
 * @method static bool isValidExpiryDate(string $month, string $year)
 * @method static array getSupportedProviders()
 * @method static bool isProviderSupported(string $providerName)
 */
class CardDetective extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'carddetective';
    }
}
