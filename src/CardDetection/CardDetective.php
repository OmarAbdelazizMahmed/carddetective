<?php

namespace CardDetective\CardProviderDetector\CardDetection;

class CardDetective
{
    private $providers;

    /**
     * CardDetector constructor.
     */
    public function __construct()
    {
        $this->providers = [
            ['regex' => '/^4[0-9]{0,}$/', 'name' => 'Visa'],
            ['regex' => '/^(5[1-5]|222[1-9]|22[3-9]|2[3-6]|27[01]|2720)[0-9]{0,}$/', 'name' => 'MasterCard'],
            ['regex' => '/^3[47][0-9]{0,}$/', 'name' => 'American Express'],
            ['regex' => '/^3(?:0[0-59]{1}|[689])[0-9]{0,}$/', 'name' => 'Diners Club'],
            ['regex' => '/^(?:2131|1800|35)[0-9]{0,}$/', 'name' => 'JCB'],
            ['regex' => '/^(6011|65|64[4-9]|62212[6-9]|6221[3-9]|622[2-8]|6229[01]|62292[0-5])[0-9]{0,}$/', 'name' => 'Discover'],
            ['regex' => '/^(5[06789]|6)[0-9]{0,}$/', 'name' => 'Maestro'],
            
        ];
    }

    public function detectCardProvider(string $cardNumber): string
    {
        $firstSixDigits = substr($cardNumber, 0, 6);
        $cardProvider = 'Unknown';
        foreach ($this->providers as $provider) {
            if (preg_match($provider['regex'], $firstSixDigits)) {
                $cardProvider = $provider['name'];
                break;
            }
        }
        return $cardProvider;
    }

    public function isCardNumberValid(string $cardNumber): bool
    {
        $sum = 0;
        $length = strlen($cardNumber);
        $parity = $length % 2;
        for ($i = 0; $i < $length; $i++) {
            $digit = $cardNumber[$i];
            if ($i % 2 == $parity) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $sum += $digit;
        }
        return ($sum % 10) == 0;
    }
        
}
