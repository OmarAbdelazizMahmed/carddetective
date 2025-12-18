<?php

namespace CardDetective\CardProviderDetector\Services;

use CardDetective\CardProviderDetector\Contracts\CardValidationInterface;

class CardValidationService implements CardValidationInterface
{
    public function validate(string $cardNumber): bool
    {
        $cleanedNumber = preg_replace('/\D/', '', $cardNumber);

        if (empty($cleanedNumber) || strlen($cleanedNumber) < 13) {
            return false;
        }

        return $this->validateLuhnAlgorithm($cleanedNumber);
    }

    public function validateSecurityCode(string $cardNumber, string $securityCode): bool
    {
        $cleanedSecurityCode = preg_replace('/\D/', '', $securityCode);

        // If security code is empty after cleaning, it's invalid unless the original was empty
        if (empty($cleanedSecurityCode)) {
            return empty($securityCode); // Only valid if originally empty (for cards like Maestro)
        }

        // Basic length validation - actual validation would depend on card provider
        $length = strlen($cleanedSecurityCode);

        // American Express cards require 4-digit security codes
        if (preg_match('/^3[47]/', $cardNumber)) {
            return $length === 4;
        }

        // Other cards typically require 3-digit security codes
        return $length === 3;
    }

    public function validateExpiryDate(string $month, string $year): bool
    {
        $month = (int) $month;
        $year = (int) $year;

        if ($month < 1 || $month > 12) {
            return false;
        }

        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');

        if ($year < $currentYear) {
            return false;
        }

        if ($year === $currentYear && $month < $currentMonth) {
            return false;
        }

        return true;
    }

    private function validateLuhnAlgorithm(string $cardNumber): bool
    {
        $sum = 0;
        $length = strlen($cardNumber);
        $isEven = false;

        // Process digits from right to left
        for ($i = $length - 1; $i >= 0; $i--) {
            $digit = (int) $cardNumber[$i];

            if ($isEven) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
            $isEven = ! $isEven;
        }

        return $sum % 10 === 0;
    }
}
