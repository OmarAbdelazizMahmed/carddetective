<?php

namespace CardDetective\CardProviderDetector\Factories;

use CardDetective\CardProviderDetector\Contracts\CardProviderInterface;
use CardDetective\CardProviderDetector\DTO\CardInfo;
use CardDetective\CardProviderDetector\Services\CardValidationService;

class CardInfoFactory
{
    private CardValidationService $validationService;

    public function __construct(CardValidationService $validationService)
    {
        $this->validationService = $validationService;
    }

    public function createFromProvider(
        CardProviderInterface $provider,
        string $cardNumber
    ): CardInfo {
        $isValid = $this->validationService->validate($cardNumber);
        $maskedNumber = $this->maskCardNumber($cardNumber);
        $formattedNumber = $this->formatCardNumber($cardNumber);

        return new CardInfo(
            provider: $provider->getName(),
            type: $provider->getType(),
            length: strlen($cardNumber),
            validLengths: $provider->getValidLengths(),
            hasSecurityCode: $provider->hasSecurityCode(),
            securityCodeLength: $provider->getSecurityCodeLength(),
            isValid: $isValid,
            maskedNumber: $maskedNumber,
            formattedNumber: $formattedNumber,
            features: $provider->getFeatures()
        );
    }

    public function createUnknownCard(string $cardNumber): CardInfo
    {
        $isValid = $this->validationService->validate($cardNumber);
        $maskedNumber = $this->maskCardNumber($cardNumber);
        $formattedNumber = $this->formatCardNumber($cardNumber);

        return new CardInfo(
            provider: 'Unknown',
            type: 'Unknown',
            length: strlen($cardNumber),
            validLengths: [],
            hasSecurityCode: false,
            securityCodeLength: 0,
            isValid: $isValid,
            maskedNumber: $maskedNumber,
            formattedNumber: $formattedNumber,
            features: []
        );
    }

    private function maskCardNumber(string $cardNumber, string $maskChar = '*'): string
    {
        $cleanedNumber = preg_replace('/\D/', '', $cardNumber);
        $length = strlen($cleanedNumber);

        if ($length <= 8) {
            return str_repeat($maskChar, $length);
        }

        $firstFour = substr($cleanedNumber, 0, 4);
        $lastFour = substr($cleanedNumber, -4);
        $middleMasked = str_repeat($maskChar, $length - 8);

        return $firstFour.$middleMasked.$lastFour;
    }

    private function formatCardNumber(string $cardNumber, string $separator = ' '): string
    {
        $cleaned = preg_replace('/\D/', '', $cardNumber);
        $length = strlen($cleaned);

        if ($length <= 4) {
            return $cleaned;
        }

        $formatted = '';
        for ($i = 0; $i < $length; $i += 4) {
            $chunk = substr($cleaned, $i, 4);
            if ($i > 0) {
                $formatted .= $separator;
            }
            $formatted .= $chunk;
        }

        return $formatted;
    }
}
