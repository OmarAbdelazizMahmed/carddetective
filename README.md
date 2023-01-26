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
$cardProvider = $cardDetector->detectCardProvider($cardNumber);

echo $cardProvider; // "Visa"
````
The method will return the card provider name if the detection is successful, otherwise it will return `null`

## Laravel Support

The package supports Laravel 5.5 and above.

To use the package with Laravel, you need to register the service provider and facade in the `config/app.php` file:

````
'providers' => [
    // ...
    CardDetective\CardProviderDetector\Providers\CardDetectiveServiceProvider::class,
],

'aliases' => [
    // ...
    'CardDetective' => CardDetective\CardProviderDetector\Facades\CardDetective::class,
],
````

You can use the package by resolving it from the service container or by using the facade.

Here is an example of how you can use the package by resolving it from the service container:

````
use App\CardDetective;

class MyController extends Controller
{
    public function detect(CardDetective $detector)
    {
        $detector->detectCardProvider('1234567812345678');
    }
}

````

Here is an example of how you can use the package by using the facade:

````

use CardDetective;

class MyController extends Controller
{
    public function detect()
    {
        CardDetective::detectCardProvider('1234567812345678');
    }
}

````

## Support masking of card numbers

The package also supports masking of card numbers. This is useful when you need to display the card number to the user, but you don't want to display the full card number. The package can be used to mask the card number by passing the card number to the `maskCardNumber` method.

Here is an example of how you can use the package to mask a card number:

````
use CardDetective;

class MyController extends Controller
{
    public function mask()
    {
        CardDetective::maskCardNumber('1234567812345678');
    }
}

````


## Configuration

The package comes with a default configuration file that contains the bin ranges and regular expressions for all supported card providers. You can publish the configuration file by running the following command:

```
php artisan vendor:publish --provider="CardDetective\CardProviderDetector\CardProviderDetectorServiceProvider"
```



## Test

The package also contains Unit tests for all supported card providers, to ensure that the detection is accurate and working properly.

To run the tests, you need to install the development dependencies by running the following command:

```
./vendor/bin/phpunit
```

## Intention

This package is intended to be used in projects that need to validate and process credit card payments, or in any other project where the card provider needs to be known.

## Disclaimer

This package is for educational purposes only and should not be used in production. Use at your own risk.

## Credits

- [Omar Abdelaziz](https://github.com/OmarAbdelazizMahmed)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


