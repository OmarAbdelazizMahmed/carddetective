# Card Detective - Advanced Card Detection & Validation Package

The `card-provider-detector` package is a comprehensive PHP library for detecting card providers, validating card numbers, and providing detailed card information. The package uses the first six digits of the card number (BIN) along with advanced validation algorithms to accurately detect and validate various card types.

## ✨ Features

- **🔍 Card Provider Detection**: Supports 12+ major card providers including Visa, MasterCard, American Express, and regional cards
- **✅ Luhn Algorithm Validation**: Built-in validation using the industry-standard Luhn algorithm
- **🎭 Card Number Masking**: Secure masking of card numbers for display purposes
- **📝 Card Number Formatting**: Format card numbers with custom separators
- **🔒 Security Features**: CVV/CVC validation and expiry date checking
- **📊 Detailed Card Information**: Comprehensive card data including type, length, and features
- **🌍 Regional Support**: Support for regional card networks (RuPay, UnionPay, Mir, Elo, etc.)
- **⚙️ Configurable**: Customizable settings and provider configurations
- **🛡️ Exception Handling**: Proper error handling with custom exceptions
- **🧪 Comprehensive Testing**: Extensive test coverage with 50+ test cases
- **📱 Laravel Integration**: Seamless Laravel integration with facade and service provider

## 🚀 Installation

Install the package via Composer:

```bash
composer require carddetective/card-provider-detector
```

## 📋 Requirements

- PHP 8.1 or higher
- Laravel 5.5+ (for Laravel integration)

## 🎯 Supported Card Providers

| Provider | Type | Length | Security Code |
|----------|------|--------|---------------|
| Visa | Credit/Debit | 13, 16, 19 | 3 digits |
| MasterCard | Credit/Debit | 16 | 3 digits |
| American Express | Credit | 15 | 4 digits |
| Diners Club | Credit | 14 | 3 digits |
| JCB | Credit | 15, 16 | 3 digits |
| Discover | Credit | 16 | 3 digits |
| RuPay | Credit/Debit | 16 | 3 digits |
| UnionPay | Credit/Debit | 16-19 | 3 digits |
| Maestro | Debit | 12-19 | None |
| Elo | Credit | 16 | 3 digits |
| Mir | Credit/Debit | 16 | 3 digits |
| Hipercard | Credit | 13, 16 | 3 digits |

## 📖 Usage

### Basic Usage

```php
use CardDetective\CardProviderDetector\CardDetection\CardDetective;

$detector = new CardDetective();

// Detect card provider
$provider = $detector->detectCardProvider('4111111111111111');
echo $provider; // "Visa"

// Validate card number
$isValid = $detector->isCardNumberValid('4111111111111111');
echo $isValid ? 'Valid' : 'Invalid'; // "Valid"

// Mask card number
$masked = $detector->maskCardNumber('4111111111111111');
echo $masked; // "4111********1111"

// Format card number
$formatted = $detector->formatCardNumber('4111111111111111');
echo $formatted; // "4111 1111 1111 1111"
```

### Advanced Usage - Card Information

```php
use CardDetective\CardProviderDetector\CardDetection\CardDetective;

$detector = new CardDetective();
$cardInfo = $detector->getCardInfo('4111111111111111');

// Access card information
echo $cardInfo->provider;           // "Visa"
echo $cardInfo->type;               // "Credit/Debit"
echo $cardInfo->length;             // 16
echo $cardInfo->validLengths;      // [13, 16, 19]
echo $cardInfo->hasSecurityCode;    // true
echo $cardInfo->securityCodeLength; // 3
echo $cardInfo->isValid;           // true
echo $cardInfo->maskedNumber;      // "4111********1111"
echo $cardInfo->formattedNumber;   // "4111 1111 1111 1111"
echo $cardInfo->features;          // ["chip", "contactless", "online_payments"]

// Convert to array or JSON
$array = $cardInfo->toArray();
$json = $cardInfo->toJson();
```

### Security Features

```php
// Validate CVV/CVC code
$isValidCvv = $detector->isValidSecurityCode('4111111111111111', '123');
echo $isValidCvv ? 'Valid CVV' : 'Invalid CVV';

// Validate expiry date
$isValidExpiry = $detector->isValidExpiryDate('12', '2025');
echo $isValidExpiry ? 'Valid expiry' : 'Invalid expiry';

// Check if provider is supported
$isSupported = $detector->isProviderSupported('Visa');
echo $isSupported ? 'Supported' : 'Not supported';

// Get all supported providers
$providers = $detector->getSupportedProviders();
print_r($providers); // Array of all supported provider names
```

### Custom Formatting

```php
// Custom mask character
$masked = $detector->maskCardNumber('4111111111111111', 'X');
echo $masked; // "4111XXXXXXXX1111"

// Custom separator for formatting
$formatted = $detector->formatCardNumber('4111111111111111', '-');
echo $formatted; // "4111-1111-1111-1111"
```

## 🏗️ Laravel Integration

### Service Provider Registration

Register the service provider in `config/app.php`:

```php
'providers' => [
    // ...
    CardDetective\CardProviderDetector\Providers\CardDetectiveServiceProvider::class,
],

'aliases' => [
    // ...
    'CardDetective' => CardDetective\CardProviderDetector\Facades\CardDetective::class,
],
```

### Using the Facade

```php
use CardDetective;

// Detect card provider
$provider = CardDetective::detectCardProvider('4111111111111111');

// Get comprehensive card info
$cardInfo = CardDetective::getCardInfo('4111111111111111');

// Validate card
$isValid = CardDetective::isCardNumberValid('4111111111111111');

// Mask card number
$masked = CardDetective::maskCardNumber('4111111111111111');

// Format card number
$formatted = CardDetective::formatCardNumber('4111111111111111');

// Security validation
$isValidCvv = CardDetective::isValidSecurityCode('4111111111111111', '123');
$isValidExpiry = CardDetective::isValidExpiryDate('12', '2025');
```

### Dependency Injection

```php
use CardDetective\CardProviderDetector\CardDetection\CardDetective;

class PaymentController extends Controller
{
    public function processPayment(CardDetective $detector)
    {
        $cardInfo = $detector->getCardInfo(request('card_number'));
        
        if (!$cardInfo->isValid) {
            return response()->json(['error' => 'Invalid card number'], 400);
        }
        
        // Process payment...
    }
}
```

## ⚙️ Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="CardDetective\CardProviderDetector\Providers\CardDetectiveServiceProvider" --tag="carddetective-config"
```

### Configuration Options

```php
// config/carddetective.php
return [
    // Default mask character
    'mask_character' => '*',
    
    // Default card number separator
    'card_number_separator' => ' ',
    
    // Enable strict validation
    'strict_validation' => true,
    
    // Enabled card providers
    'enabled_providers' => [
        'visa', 'mastercard', 'amex', 'diners', 'jcb', 'discover',
        'rupay', 'unionpay', 'maestro', 'elo', 'mir', 'hipercard',
    ],
    
    // Custom providers
    'custom_providers' => [
        'my_custom_provider' => [
            'regex' => '/^1234[0-9]{0,}$/',
            'name' => 'My Custom Provider',
            'type' => 'Credit',
            'valid_lengths' => [16],
            'has_security_code' => true,
            'security_code_length' => 3,
            'features' => ['chip', 'contactless'],
        ],
    ],
    
    // Security settings
    'security' => [
        'validate_security_code' => true,
        'validate_expiry_date' => true,
        'expiry_buffer_months' => 0,
    ],
    
    // Logging settings
    'logging' => [
        'enabled' => false,
        'level' => 'info',
        'channel' => 'default',
    ],
];
```

## 🧪 Testing

Run the comprehensive test suite:

```bash
./vendor/bin/phpunit
```

The package includes 50+ test cases covering:
- All supported card providers
- Card validation scenarios
- Masking and formatting
- Security features
- Edge cases and error handling
- Laravel integration

## 🛡️ Exception Handling

The package includes custom exceptions for better error handling:

```php
use CardDetective\CardProviderDetector\Exceptions\InvalidCardNumberException;
use CardDetective\CardProviderDetector\Exceptions\UnsupportedCardTypeException;

try {
    $provider = $detector->detectCardProvider('');
} catch (InvalidCardNumberException $e) {
    // Handle invalid card number
    echo $e->getMessage(); // "Card number cannot be empty"
}
```

## 🔧 Advanced Features

### Custom Card Providers

Add support for custom card providers:

```php
// In your configuration
'custom_providers' => [
    'my_bank' => [
        'regex' => '/^1234[0-9]{0,}$/',
        'name' => 'My Bank Card',
        'type' => 'Debit',
        'valid_lengths' => [16],
        'has_security_code' => true,
        'security_code_length' => 3,
        'features' => ['chip', 'online_payments'],
    ],
],
```

### Batch Processing

Process multiple cards efficiently:

```php
$cards = ['4111111111111111', '5555555555554444', '378282246310005'];
$results = [];

foreach ($cards as $card) {
    $results[] = $detector->getCardInfo($card);
}
```

### API Integration

Perfect for payment gateway integrations:

```php
public function validatePaymentCard($cardNumber, $cvv, $expiryMonth, $expiryYear)
{
    $detector = new CardDetective();
    
    // Validate card number
    if (!$detector->isCardNumberValid($cardNumber)) {
        throw new InvalidCardException('Invalid card number');
    }
    
    // Validate CVV
    if (!$detector->isValidSecurityCode($cardNumber, $cvv)) {
        throw new InvalidCardException('Invalid CVV');
    }
    
    // Validate expiry date
    if (!$detector->isValidExpiryDate($expiryMonth, $expiryYear)) {
        throw new InvalidCardException('Card expired');
    }
    
    // Get card information
    $cardInfo = $detector->getCardInfo($cardNumber);
    
    return [
        'provider' => $cardInfo->provider,
        'type' => $cardInfo->type,
        'masked_number' => $cardInfo->maskedNumber,
        'features' => $cardInfo->features,
    ];
}
```

## 🌟 Use Cases

- **E-commerce Platforms**: Validate customer payment cards
- **Payment Gateways**: Detect card types for processing
- **Financial Applications**: Secure card number handling
- **CRM Systems**: Store masked card information
- **Analytics**: Track payment method usage
- **Security Audits**: Validate card data integrity

## 📊 Performance

- **Fast Detection**: Optimized regex patterns for quick provider detection
- **Memory Efficient**: Minimal memory footprint
- **Cached Results**: Built-in caching for repeated operations
- **Scalable**: Handles high-volume card processing

## 🔒 Security Considerations

- **No Card Storage**: Package doesn't store card numbers
- **PCI Compliance**: Designed with PCI DSS guidelines in mind
- **Secure Masking**: Proper card number masking for display
- **Input Sanitization**: Automatic sanitization of card inputs
- **Exception Safety**: Secure error handling without data leakage

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## 👨‍💻 Author

- [Omar Abdelaziz](https://github.com/OmarAbdelazizMahmed)

## 🆕 Changelog

### Version 2.0.0
- ✨ Added comprehensive card information (CardInfo DTO)
- 🔒 Added CVV/CVC validation
- 📅 Added expiry date validation
- 🎭 Enhanced card masking with custom characters
- 📝 Added card number formatting utilities
- 🌍 Added support for regional cards (Elo, Mir, Hipercard)
- ⚙️ Added configuration system
- 🛡️ Added proper exception handling
- 🧪 Expanded test coverage (50+ tests)
- 📚 Updated documentation

### Version 1.0.0
- 🎯 Basic card provider detection
- ✅ Luhn algorithm validation
- 🎭 Basic card masking
- 🏗️ Laravel integration

---

**⚠️ Disclaimer**: This package is for educational and development purposes. Always follow PCI DSS guidelines and security best practices when handling card data in production environments.
