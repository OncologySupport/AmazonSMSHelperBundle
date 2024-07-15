# AmazonSMSHelper Bundle

`AmazonSMSHelperBundle` 

## Documentation

## License

AmazonSMSHelperBundle is released under the MIT License. See the bundled [LICENSE](LICENSE) file for details.

## Installation

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
composer require oncology-support/amazon-sms-helper-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
composer require oncology-support/amazon-sms-helper-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    OncologySupport\AmazonSMSHelper\OncologySupportAmazonSMSHelperBundle::class => ['all' => true],
];
```

### Step 3: Use it!


Enjoy!
