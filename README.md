# card-provider-detector

The `card-provider-detector` package allows developers to quickly and easily determine the card provider for a given card number. The package uses the first six digits of the card number, also known as the "bin," to determine the card provider.

The package uses a combination of bin ranges and regular expressions to accurately detect the card provider. It currently supports detection of Visa, MasterCard, American Express, Diners Club, Discover, and JCB card types.

## Installation

Installing the package is simple and can be done via composer by requiring `carddetective/card-provider-detector` in your project. 


````
composer require carddetective/card-provider-detector
````

## Usage

Once installed, the package can be used as a facade or as a direct object. The package can be used to detect the card provider by passing the card number to the `detect` method. 

the code snippet below shows how to use the package as a facade in php
````
use CardDetective\CardProviderDetector\CardDetection\CardDetector;

$cardNumber = '4111111111111111';
$cardDetector = new CardDetector();
$cardProvider = $cardDetector->detect($cardNumber);

echo $cardProvider; // "Visa"
````
The method will return the card provider name if the detection is successful, otherwise it will return `null`

## Test

The package also contains Unit tests for all supported card providers, to ensure that the detection is accurate and working properly.

To run the tests, execute the following command:

```
composer test
```


## Intention

This package is intended to be used in projects that need to validate and process credit card payments, or in any other project where the card provider needs to be known.

## Disclaimer

This package is for educational purposes only and should not be used in production. Use at your own risk.

## Credits

- [Omar Abdelaziz](https://github.com/OmarAbdelazizMahmed)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


