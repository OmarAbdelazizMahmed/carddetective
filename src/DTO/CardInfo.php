<?php

namespace CardDetective\CardProviderDetector\DTO;

class CardInfo
{
    public function __construct(
        public readonly string $provider,
        public readonly string $type,
        public readonly int $length,
        public readonly array $validLengths,
        public readonly bool $hasSecurityCode,
        public readonly int $securityCodeLength,
        public readonly bool $isValid,
        public readonly string $maskedNumber,
        public readonly string $formattedNumber,
        public readonly array $features = []
    ) {}

    public function toArray(): array
    {
        return [
            'provider' => $this->provider,
            'type' => $this->type,
            'length' => $this->length,
            'valid_lengths' => $this->validLengths,
            'has_security_code' => $this->hasSecurityCode,
            'security_code_length' => $this->securityCodeLength,
            'is_valid' => $this->isValid,
            'masked_number' => $this->maskedNumber,
            'formatted_number' => $this->formattedNumber,
            'features' => $this->features,
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }
}
