<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Card Detective Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration options for the Card Detective
    | package. You can customize various aspects of card detection and validation.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Default Mask Character
    |--------------------------------------------------------------------------
    |
    | The character used to mask card numbers when displaying them.
    | Default is '*' but you can change it to any character.
    |
    */
    'mask_character' => '*',

    /*
    |--------------------------------------------------------------------------
    | Default Card Number Separator
    |--------------------------------------------------------------------------
    |
    | The separator used when formatting card numbers for display.
    | Default is a space ' ' but you can use '-', '.', or any other character.
    |
    */
    'card_number_separator' => ' ',

    /*
    |--------------------------------------------------------------------------
    | Enable Strict Validation
    |--------------------------------------------------------------------------
    |
    | When enabled, the package will perform stricter validation checks
    | including length validation based on card provider requirements.
    |
    */
    'strict_validation' => true,

    /*
    |--------------------------------------------------------------------------
    | Supported Card Providers
    |--------------------------------------------------------------------------
    |
    | List of card providers that are enabled for detection.
    | You can disable specific providers by removing them from this array.
    |
    */
    'enabled_providers' => [
        'visa',
        'mastercard',
        'amex',
        'diners',
        'jcb',
        'discover',
        'rupay',
        'unionpay',
        'maestro',
        'elo',
        'mir',
        'hipercard',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Card Providers
    |--------------------------------------------------------------------------
    |
    | You can add custom card providers here. Each provider should have
    | the following structure:
    |
    | 'custom_provider' => [
    |     'regex' => '/^pattern$/',
    |     'name' => 'Provider Name',
    |     'type' => 'Credit/Debit',
    |     'valid_lengths' => [16],
    |     'has_security_code' => true,
    |     'security_code_length' => 3,
    |     'features' => ['chip', 'contactless'],
    | ],
    |
    */
    'custom_providers' => [
        // Add your custom providers here
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for security-related features.
    |
    */
    'security' => [
        /*
        |--------------------------------------------------------------------------
        | Enable CVV/CVC Validation
        |--------------------------------------------------------------------------
        |
        | When enabled, the package will validate CVV/CVC codes based on
        | the card provider's requirements.
        |
        */
        'validate_security_code' => true,

        /*
        |--------------------------------------------------------------------------
        | Enable Expiry Date Validation
        |--------------------------------------------------------------------------
        |
        | When enabled, the package will validate expiry dates to ensure
        | they are not in the past.
        |
        */
        'validate_expiry_date' => true,

        /*
        |--------------------------------------------------------------------------
        | Expiry Date Buffer
        |--------------------------------------------------------------------------
        |
        | Number of months before expiry date to consider a card as expired.
        | This helps prevent issues with cards that expire soon.
        |
        */
        'expiry_buffer_months' => 0,
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Configuration for logging card detection activities.
    |
    */
    'logging' => [
        /*
        |--------------------------------------------------------------------------
        | Enable Logging
        |--------------------------------------------------------------------------
        |
        | When enabled, the package will log card detection activities.
        | This can be useful for debugging and monitoring.
        |
        */
        'enabled' => false,

        /*
        |--------------------------------------------------------------------------
        | Log Level
        |--------------------------------------------------------------------------
        |
        | The log level for card detection activities.
        | Options: 'debug', 'info', 'warning', 'error'
        |
        */
        'level' => 'info',

        /*
        |--------------------------------------------------------------------------
        | Log Channel
        |--------------------------------------------------------------------------
        |
        | The log channel to use for card detection activities.
        | Uses Laravel's default logging configuration.
        |
        */
        'channel' => 'default',
    ],
];
