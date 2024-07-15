<?php

namespace OncologySupport\AmazonSMSHelper;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AmazonSMSHelper.
 *
 * @author Ernest Hymel
 */
class OncologySupportAmazonSMSHelperBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
