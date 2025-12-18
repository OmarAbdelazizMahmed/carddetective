<?php

namespace CardDetective\CardProviderDetector\CardDetection;

use CardDetective\CardProviderDetector\Contracts\CardDetectorInterface;
use CardDetective\CardProviderDetector\DTO\CardInfo;
use CardDetective\CardProviderDetector\Exceptions\InvalidCardNumberException;
use CardDetective\CardProviderDetector\Factories\CardInfoFactory;
use CardDetective\CardProviderDetector\Repositories\CardProviderRepository;
use CardDetective\CardProviderDetector\Services\CardValidationService;

class CardDetective implements CardDetectorInterface
{
    private CardProviderRepository $providerRepository;

    private CardInfoFactory $cardInfoFactory;

    private CardValidationService $validationService;

    public function __construct(
        ?CardProviderRepository $providerRepository = null,
        ?CardInfoFactory $cardInfoFactory = null,
        ?CardValidationService $validationService = null
    ) {
        $this->providerRepository = $providerRepository ?? new CardProviderRepository;
        $this->validationService = $validationService ?? new CardValidationService;
        $this->cardInfoFactory = $cardInfoFactory ?? new CardInfoFactory($this->validationService);
    }

    public function detectCardProvider(string $cardNumber): string
    {
        $this->validateCardNumber($cardNumber);

        $provider = $this->providerRepository->findProviderByCardNumber($cardNumber);

        return $provider ? $provider->getName() : 'Unknown';
    }

    public function getCardInfo(string $cardNumber): CardInfo
    {
        $this->validateCardNumber($cardNumber);

        $provider = $this->providerRepository->findProviderByCardNumber($cardNumber);

        if ($provider) {
            return $this->cardInfoFactory->createFromProvider($provider, $cardNumber);
        }

        return $this->cardInfoFactory->createUnknownCard($cardNumber);
    }

    public function isCardNumberValid(string $cardNumber): bool
    {
        return $this->validationService->validate($cardNumber);
    }

    public function maskCardNumber(string $cardNumber, string $maskChar = '*'): string
    {
        $this->validateCardNumber($cardNumber);

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

    public function formatCardNumber(string $cardNumber, string $separator = ' '): string
    {
        $this->validateCardNumber($cardNumber);

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

    public function isValidSecurityCode(string $cardNumber, string $securityCode): bool
    {
        $this->validateCardNumber($cardNumber);

        return $this->validationService->validateSecurityCode($cardNumber, $securityCode);
    }

    public function isValidExpiryDate(string $month, string $year): bool
    {
        return $this->validationService->validateExpiryDate($month, $year);
    }

    public function getSupportedProviders(): array
    {
        return $this->providerRepository->getProviderNames();
    }

    public function isProviderSupported(string $providerName): bool
    {
        return $this->providerRepository->isProviderSupported($providerName);
    }

    private function validateCardNumber(string $cardNumber): void
    {
        if (empty($cardNumber)) {
            throw new InvalidCardNumberException('Card number cannot be empty');
        }

        $cleanedNumber = preg_replace('/\D/', '', $cardNumber);
        if (strlen($cleanedNumber) < 4) {
            throw new InvalidCardNumberException('Card number is too short');
        }
    }
}
