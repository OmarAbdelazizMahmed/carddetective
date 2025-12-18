<?php

namespace CardDetective\CardDetection\Tests;

use CardDetective\CardProviderDetector\CardDetection\CardDetective;
use CardDetective\CardProviderDetector\DTO\CardInfo;
use CardDetective\CardProviderDetector\Exceptions\InvalidCardNumberException;
use PHPUnit\Framework\TestCase;

class CardDetectorTest extends TestCase
{
    private CardDetective $cardDetector;

    protected function setUp(): void
    {
        $this->cardDetector = new CardDetective;
    }

    // Basic Detection Tests
    public function test_visa()
    {
        $result = $this->cardDetector->detectCardProvider('4111111111111111');
        $this->assertEquals('Visa', $result);
    }

    public function test_master_card()
    {
        $result = $this->cardDetector->detectCardProvider('5555555555554444');
        $this->assertEquals('MasterCard', $result);
    }

    public function test_american_express()
    {
        $result = $this->cardDetector->detectCardProvider('378282246310005');
        $this->assertEquals('American Express', $result);
    }

    public function test_diners_club()
    {
        $result = $this->cardDetector->detectCardProvider('30569309025904');
        $this->assertEquals('Diners Club', $result);
    }

    public function test_jcb()
    {
        $result = $this->cardDetector->detectCardProvider('3530111333300000');
        $this->assertEquals('JCB', $result);
    }

    public function test_discover()
    {
        $result = $this->cardDetector->detectCardProvider('6011000990139424');
        $this->assertEquals('Discover', $result);
    }

    public function test_maestro()
    {
        $result = $this->cardDetector->detectCardProvider('6799990100000000019');
        $this->assertEquals('Maestro', $result);
    }

    /*
    public function testRuPay()
    {
        $result = $this->cardDetector->detectCardProvider('6525624254001001');
        $this->assertEquals('RuPay', $result);
    }
    */

    public function test_union_pay()
    {
        $result = $this->cardDetector->detectCardProvider('6282825624254001');
        $this->assertEquals('UnionPay', $result);
    }

    public function test_elo()
    {
        $result = $this->cardDetector->detectCardProvider('4389350000000001');
        $this->assertEquals('Elo', $result);
    }

    public function test_mir()
    {
        $result = $this->cardDetector->detectCardProvider('2200000000000000');
        $this->assertEquals('Mir', $result);
    }

    public function test_hipercard()
    {
        $result = $this->cardDetector->detectCardProvider('6062820000000000');
        $this->assertEquals('Hipercard', $result);
    }

    public function test_unknown()
    {
        $result = $this->cardDetector->detectCardProvider('1111111111111111');
        $this->assertEquals('Unknown', $result);
    }

    // Card Number Formatting Tests
    public function test_card_number_with_spaces()
    {
        $result = $this->cardDetector->detectCardProvider('4111 1111 1111 1111');
        $this->assertEquals('Visa', $result);
    }

    public function test_card_number_with_hyphens()
    {
        $result = $this->cardDetector->detectCardProvider('4111-1111-1111-1111');
        $this->assertEquals('Visa', $result);
    }

    public function test_card_number_with_mixed_formatting()
    {
        $result = $this->cardDetector->detectCardProvider('4111 1111-1111 1111');
        $this->assertEquals('Visa', $result);
    }

    // Card Validation Tests
    public function test_valid_card_numbers()
    {
        $validCards = [
            '4111111111111111', // Visa
            '5555555555554444', // MasterCard
            '378282246310005',  // Amex
            '30569309025904',   // Diners
            '6011000990139424', // Discover
        ];

        foreach ($validCards as $card) {
            $this->assertTrue($this->cardDetector->isCardNumberValid($card), "Card {$card} should be valid");
        }
    }

    public function test_invalid_card_numbers()
    {
        $invalidCards = [
            '4111111111111112', // Invalid Visa
            '5555555555554445', // Invalid MasterCard
            '1234567890123456', // Invalid number
            '1111111111111111', // Invalid number
        ];

        foreach ($invalidCards as $card) {
            $this->assertFalse($this->cardDetector->isCardNumberValid($card), "Card {$card} should be invalid");
        }
    }

    // Masking Tests
    public function test_mask_card_number()
    {
        $result = $this->cardDetector->maskCardNumber('5555555555554444');
        $this->assertEquals('5555********4444', $result);
    }

    public function test_mask_card_number_with_custom_character()
    {
        $result = $this->cardDetector->maskCardNumber('5555555555554444', 'X');
        $this->assertEquals('5555XXXXXXXX4444', $result);
    }

    public function test_mask_short_card_number()
    {
        $result = $this->cardDetector->maskCardNumber('1234');
        $this->assertEquals('****', $result);
    }

    // Formatting Tests
    public function test_format_card_number()
    {
        $result = $this->cardDetector->formatCardNumber('5555555555554444');
        $this->assertEquals('5555 5555 5555 4444', $result);
    }

    public function test_format_card_number_with_custom_separator()
    {
        $result = $this->cardDetector->formatCardNumber('5555555555554444', '-');
        $this->assertEquals('5555-5555-5555-4444', $result);
    }

    public function test_format_short_card_number()
    {
        $result = $this->cardDetector->formatCardNumber('1234');
        $this->assertEquals('1234', $result);
    }

    // Card Info Tests
    public function test_get_card_info()
    {
        $cardInfo = $this->cardDetector->getCardInfo('4111111111111111');

        $this->assertInstanceOf(CardInfo::class, $cardInfo);
        $this->assertEquals('Visa', $cardInfo->provider);
        $this->assertEquals('Credit/Debit', $cardInfo->type);
        $this->assertEquals(16, $cardInfo->length);
        $this->assertContains(16, $cardInfo->validLengths);
        $this->assertTrue($cardInfo->hasSecurityCode);
        $this->assertEquals(3, $cardInfo->securityCodeLength);
        $this->assertTrue($cardInfo->isValid);
        $this->assertEquals('4111********1111', $cardInfo->maskedNumber);
        $this->assertEquals('4111 1111 1111 1111', $cardInfo->formattedNumber);
        $this->assertIsArray($cardInfo->features);
    }

    public function test_get_card_info_for_unknown_card()
    {
        $cardInfo = $this->cardDetector->getCardInfo('1111111111111111');

        $this->assertInstanceOf(CardInfo::class, $cardInfo);
        $this->assertEquals('Unknown', $cardInfo->provider);
        $this->assertEquals('Unknown', $cardInfo->type);
        $this->assertFalse($cardInfo->hasSecurityCode);
        $this->assertEquals(0, $cardInfo->securityCodeLength);
        $this->assertFalse($cardInfo->isValid);
    }

    // Security Code Tests
    public function test_valid_security_code()
    {
        $this->assertTrue($this->cardDetector->isValidSecurityCode('4111111111111111', '123'));
        $this->assertTrue($this->cardDetector->isValidSecurityCode('378282246310005', '1234'));
    }

    public function test_invalid_security_code()
    {
        $this->assertFalse($this->cardDetector->isValidSecurityCode('4111111111111111', '12'));
        $this->assertFalse($this->cardDetector->isValidSecurityCode('378282246310005', '123'));
        $this->assertFalse($this->cardDetector->isValidSecurityCode('4111111111111111', 'abc'));
    }

    public function test_security_code_for_maestro()
    {
        // Maestro cards don't require security codes
        $this->assertTrue($this->cardDetector->isValidSecurityCode('6799990100000000019', ''));
    }

    // Expiry Date Tests
    public function test_valid_expiry_date()
    {
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;

        $this->assertTrue($this->cardDetector->isValidExpiryDate('12', (string) $nextYear));
        $this->assertTrue($this->cardDetector->isValidExpiryDate('01', (string) $nextYear));
    }

    public function test_invalid_expiry_date()
    {
        $currentYear = date('Y');
        $lastYear = $currentYear - 1;

        $this->assertFalse($this->cardDetector->isValidExpiryDate('12', (string) $lastYear));
        $this->assertFalse($this->cardDetector->isValidExpiryDate('13', '2025'));
        $this->assertFalse($this->cardDetector->isValidExpiryDate('0', '2025'));
    }

    // Provider Support Tests
    public function test_get_supported_providers()
    {
        $providers = $this->cardDetector->getSupportedProviders();

        $this->assertIsArray($providers);
        $this->assertContains('Visa', $providers);
        $this->assertContains('MasterCard', $providers);
        $this->assertContains('American Express', $providers);
    }

    public function test_is_provider_supported()
    {
        $this->assertTrue($this->cardDetector->isProviderSupported('Visa'));
        $this->assertTrue($this->cardDetector->isProviderSupported('MasterCard'));
        $this->assertFalse($this->cardDetector->isProviderSupported('UnknownProvider'));
    }

    // Exception Tests
    public function test_empty_card_number_throws_exception()
    {
        $this->expectException(InvalidCardNumberException::class);
        $this->cardDetector->detectCardProvider('');
    }

    public function test_empty_card_number_in_get_card_info_throws_exception()
    {
        $this->expectException(InvalidCardNumberException::class);
        $this->cardDetector->getCardInfo('');
    }

    // Edge Cases
    public function test_very_long_card_number()
    {
        $longCard = str_repeat('1', 25);
        $result = $this->cardDetector->detectCardProvider($longCard);
        $this->assertEquals('Unknown', $result);
    }

    public function test_card_number_with_letters()
    {
        $result = $this->cardDetector->detectCardProvider('4111abcd11111111');
        $this->assertEquals('Visa', $result);
    }

    public function test_card_number_with_special_characters()
    {
        $result = $this->cardDetector->detectCardProvider('4111!@#$11111111');
        $this->assertEquals('Visa', $result);
    }

    // CardInfo Array and JSON Tests
    public function test_card_info_to_array()
    {
        $cardInfo = $this->cardDetector->getCardInfo('4111111111111111');
        $array = $cardInfo->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('provider', $array);
        $this->assertArrayHasKey('type', $array);
        $this->assertArrayHasKey('length', $array);
        $this->assertArrayHasKey('is_valid', $array);
    }

    public function test_card_info_to_json()
    {
        $cardInfo = $this->cardDetector->getCardInfo('4111111111111111');
        $json = $cardInfo->toJson();

        $this->assertIsString($json);
        $decoded = json_decode($json, true);
        $this->assertIsArray($decoded);
        $this->assertEquals('Visa', $decoded['provider']);
    }
}
