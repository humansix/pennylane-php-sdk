Pennylane PHP SDK
This client library for pennylane.com API.

Prerequisites
PHP >=8.2
Composer
Installation
For production environments you can include the library as a dependency in your project using composer.

composer require humansix/pennylane-php-sdk
You will also need to ensure you have packages that satisfy the virtual psr/http-client-implementation and psr/http-factory-implementation requirements. If you do not, then you can require Guzzle, which will satisfy both:

composer require guzzlehttp/guzzle
Usage
See the example folder for working examples of how to use the library.

Tests & Quality
We use PHPUnit for unit testing the app and PHPStan, PHP CodeSniffer and PHP Mess Detector for quality checks.

Run composer unit-test to run the unit tests.
Run composer quality-check to run the quality check tools.