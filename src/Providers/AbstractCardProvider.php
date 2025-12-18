<?php

namespace CardDetective\CardProviderDetector\Providers;

use CardDetective\CardProviderDetector\Contracts\CardProviderInterface;

abstract class AbstractCardProvider implements CardProviderInterface
{
    protected string $name;

    protected string $type;

    protected array $validLengths;

    protected bool $hasSecurityCode;

    protected int $securityCodeLength;

    protected array $features;

    protected string $regexPattern;

    public function __construct(
        string $name,
        string $type,
        array $validLengths,
        bool $hasSecurityCode,
        int $securityCodeLength,
        array $features,
        string $regexPattern
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->validLengths = $validLengths;
        $this->hasSecurityCode = $hasSecurityCode;
        $this->securityCodeLength = $securityCodeLength;
        $this->features = $features;
        $this->regexPattern = $regexPattern;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValidLengths(): array
    {
        return $this->validLengths;
    }

    public function hasSecurityCode(): bool
    {
        return $this->hasSecurityCode;
    }

    public function getSecurityCodeLength(): int
    {
        return $this->securityCodeLength;
    }

    public function getFeatures(): array
    {
        return $this->features;
    }

    public function matches(string $cardNumber): bool
    {
        return preg_match($this->regexPattern, $cardNumber) === 1;
    }

    public function validateLength(string $cardNumber): bool
    {
        $length = strlen($cardNumber);

        return in_array($length, $this->validLengths, true);
    }
}
