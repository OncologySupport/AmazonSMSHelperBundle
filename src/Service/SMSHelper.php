<?php

namespace OncologySupport\AmazonSMSHelper\Service;

use Aws\Result;
use Aws\Sns\SnsClient;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class SMSHelper
{
    public function __construct(#[Autowire(param: 'env(AMAZON_SNS_ACCESS_ID)')]     private readonly string $sns_access_id,
                                #[Autowire(param: 'env(AMAZON_SNS_SECRET)')]        private readonly string $sns_secret,
                                #[Autowire(param: 'env(AMAZON_SNS_DEFAULT_REGION')] private readonly string $sns_region
    )
    {
    }

    public function send(string $message, string $cell): Result
    {
        $cell = preg_replace("/[^0-9]+/", "", $cell);

        $snsClient = new SnsClient([
            'region' => $this->sns_region,
            'version' => '2010-03-31',
            'credentials' => ["key" => urlencode($this->sns_access_id), "secret" => urlencode($this->sns_secret)],
        ]);

        return $snsClient->publish([
            'Message' => $message,
            'PhoneNumber' => $cell,
        ]);
    }
}