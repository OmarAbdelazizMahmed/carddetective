<?php

namespace CardDetective\CardProviderDetector\Contracts;

use CardDetective\CardProviderDetector\DTO\CardInfo;

interface CardDetectorInterface
{
    public function detectCardProvider(string $cardNumber): string;

    public function getCardInfo(string $cardNumber): CardInfo;

    public function isCardNumberValid(string $cardNumber): bool;

    public function maskCardNumber(string $cardNumber, string $maskChar = '*'): string;

    public function formatCardNumber(string $cardNumber, string $separator = ' '): string;

    public function isValidSecurityCode(string $cardNumber, string $securityCode): bool;

    public function isValidExpiryDate(string $month, string $year): bool;

    public function getSupportedProviders(): array;

    public function isProviderSupported(string $providerName): bool;
}
