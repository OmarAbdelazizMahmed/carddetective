<?php

namespace CardDetective\CardProviderDetector\Contracts;

interface CardValidationInterface
{
    public function validate(string $cardNumber): bool;

    public function validateSecurityCode(string $cardNumber, string $securityCode): bool;

    public function validateExpiryDate(string $month, string $year): bool;
}
