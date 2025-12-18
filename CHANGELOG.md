# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.0] - 2024-12-XX

### Added
- PHP 8.2 support
- Design patterns implementation (Strategy, Factory, Repository)
- Laravel Pint for code style enforcement
- Separate `ServiceProviders` directory for better organization
- Comprehensive interfaces and contracts (`CardDetectorInterface`, `CardProviderInterface`, `CardValidationInterface`)
- `CardProviderServiceProvider` for card provider registration
- Enhanced dependency injection support

### Changed
- Refactored codebase with design patterns for better maintainability
- Separated service providers from card providers for clearer organization
- Improved code readability and structure
- Enhanced validation logic with card-specific security code validation
- Updated `CardDetectiveServiceProvider` to use proper dependency injection
- Improved card number masking to show first 4 and last 4 digits

### Removed
- UI support components (`CardBrand`, `CardPreview`, `CardPreviewBuilder`)
- UI-related methods from `CardDetective` class (`getCardBrand`, `getCardBrandColors`, `getCardLogo`, `getCardIcon`, `generateCardPreview`)
- Brand property from `CardInfo` DTO

### Fixed
- Provider detection order issues (Elo and Hipercard now detected correctly)
- Security code validation logic (card-specific validation)
- Card number masking logic (now shows first 4 and last 4 digits)
- Input validation to handle edge cases

### Technical Details
- All 39 tests passing with 78 assertions
- Code formatted with Laravel Pint
- Improved separation of concerns
- Better adherence to SOLID principles

## [1.0.3] - Previous Release

### Fixed
- Various bug fixes and improvements

## [1.0.2] - Previous Release

### Fixed
- Various bug fixes and improvements

## [1.0.1] - Previous Release

### Fixed
- Various bug fixes and improvements

## [1.0.0] - Initial Release

### Added
- Initial release of Card Detective package
- Card provider detection for 12+ providers
- Luhn algorithm validation
- Card number masking and formatting
- Security code and expiry date validation
- Laravel integration

