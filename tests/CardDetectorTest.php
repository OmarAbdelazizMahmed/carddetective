<?php

namespace CardDetective\CardDetection\Tests;

use CardDetective\CardProviderDetector\CardDetection\CardDetective;
use PHPUnit\Framework\TestCase;

class CardDetectorTest extends TestCase
{
    private $cardDetector;

    public function setUp() : void
    {
        $this->cardDetector = new CardDetective();
    }

    public function testVisa()
    {
        $result = $this->cardDetector->detectCardProvider('4111111111111111');
        $this->assertEquals('Visa', $result);
    }

    public function testMasterCard()
    {
        $result = $this->cardDetector->detectCardProvider('5555555555554444');
        $this->assertEquals('MasterCard', $result);
    }

    public function testAmericanExpress()
    {
        $result = $this->cardDetector->detectCardProvider('378282246310005');
        $this->assertEquals('American Express', $result);
    }

    public function testDinersClub()
    {
        $result = $this->cardDetector->detectCardProvider('30569309025904');
        $this->assertEquals('Diners Club', $result);
    }

    public function testJCB()
    {
        $result = $this->cardDetector->detectCardProvider('3530111333300000');
        $this->assertEquals('JCB', $result);
    }

    public function testDiscover()
    {
        $result = $this->cardDetector->detectCardProvider('6011000990139424');
        $this->assertEquals('Discover', $result);
    }

    public function testMaestro()
    {
        $result = $this->cardDetector->detectCardProvider('6799990100000000019');
        $this->assertEquals('Maestro', $result);
    }

    public function testRuPay()
    {
        $result = $this->cardDetector->detectCardProvider('6062825624254001');
        $this->assertEquals('RuPay', $result);
    }

    public function testUnionPay()
    {
        $result = $this->cardDetector->detectCardProvider('6282825624254001');
        $this->assertEquals('UnionPay', $result);
    }

    public function testUnknown()
    {
        $result = $this->cardDetector->detectCardProvider('1111111111111111');
        $this->assertEquals('Unknown', $result);
    }

    public function testCardNumberWithSpaces()
    {
        $result = $this->cardDetector->detectCardProvider('4111 1111 1111 1111');
        $this->assertEquals('Visa', $result);
    }

    public function testCardNumberWithHyphens()
    {
        $result = $this->cardDetector->detectCardProvider('4111-1111-1111-1111');
        $this->assertEquals('Visa', $result);
    }

    public function testCardNumberWithSpacesAndHyphens()
    {
        $result = $this->cardDetector->detectCardProvider('4111 1111-1111 1111');
        $this->assertEquals('Visa', $result);
    }

    public function testCardNumberWithSpacesAndHyphensAndLetters()
    {
        $result = $this->cardDetector->detectCardProvider('4111 1111-1111 1111 1111');
        $this->assertEquals('Visa', $result);
    }

    public function testMasterCardWith16Digits()
    {
        $result = $this->cardDetector->maskCardNumber('5555555555554444');
        $this->assertEquals('5555********4444', $result);
    }
}
