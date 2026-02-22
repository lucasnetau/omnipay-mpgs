<?php declare(strict_types=1);

namespace Omnipay\Mpgs\Message;

use function array_reverse;

/**
 * Class PurchaseResponse.
 */
class PurchaseResponse extends \Omnipay\Mpgs\Message\AbstractResponse
{
    public function isSuccessful()
    {
        $statusCode = $this->getStatusCode();

        return $statusCode >= 200 && $statusCode <= 399;
    }

    public function getSuccessIndicator()
    {
        return $this->data['successIndicator'] ?? null;
    }

    public function getSessionId()
    {
        return $this->data['session']['id'] ?? null;
    }
}
