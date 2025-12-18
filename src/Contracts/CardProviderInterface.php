<?php

namespace CardDetective\CardProviderDetector\Contracts;

interface CardProviderInterface
{
    public function getName(): string;

    public function getType(): string;

    public function getValidLengths(): array;

    public function hasSecurityCode(): bool;

    public function getSecurityCodeLength(): int;

    public function getFeatures(): array;

    public function matches(string $cardNumber): bool;

    public function validateLength(string $cardNumber): bool;
}
