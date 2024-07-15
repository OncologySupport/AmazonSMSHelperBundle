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

### Step 3: Configuration

To use this bundle, 

You need to configure the following parameters in your `.env` file. You should have an AWS account with SNS service enabled. 
Enabling SNS requires that you request an Origination number and then go through the process of removing that number from the sandbox.

Once SNS is enabled, you will need IAM configured to get the `access_key_id` and `secret_access_key` for the AWS account.
Here is how I did this: from the IAM console, I created a new user with programmatic access. I then attached a new 
policy to the user with the following json policy:

```json
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Sid": "OncologySupport0",
            "Effect": "Allow",
            "Action": "sns:Publish",
            "Resource": "*",
            "Condition": {
                "IpAddress": {
                    "aws:SourceIp": [
                        "xxx.xxx.xxx.xxx",
                        "yyy.yyy.yyy.yyy"
                    ]
                }
            }
        }
    ]
}
```
This policy allows the SNS user you created to send SMS messages. 
You will need to replace `xxx.xxx.xxx.xxx` and `yyy.yyy.yyy.yyy` with the IP addresses of the servers that will be sending the SMS messages.
You can also omit the "Condition" block if you want to allow the user to send SMS messages from any IP address, but this is not recommended for security reasons.
You can also be more permissive with the "Action" section if you want to allow the user to do more than just send SMS messages.
Here is an example that is more permissive:

```json
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Effect": "Allow",
            "Action": "sns:*",
            "Resource": "*"
        }
    ]
}
```

In any case you will need to get the `access_key_id` and `secret_access_key` for the user you created, 
and you will need to set the `default_region` to the region where you created the SNS topic (e.g., us-east-1). 
You can store these values in your `.env` file like this:

```dotenv
# AWS credentials
AMAZON_SNS_ACCESS_ID=your_aws_access_key_id
AMAZON_SNS_SECRET=your_aws_secret_access_key
AMAZON_SNS_DEFAULT_REGION=your_aws_default_region
```

Even better, you can store these values in your `.env.local` file, which is not committed to your repository.

### Step 4: Use it!
When you are ready to send a message, you can use the `AmazonSMSHelper` service like this:

```php
<?php
use OncologySupport\AmazonSMSHelper\Service\AmazonSMSHelper;

$smsHelper = new AmazonSMSHelper();

$result = $smsHelper('+12125551234', 'This is a test message.');
```

Enjoy!
