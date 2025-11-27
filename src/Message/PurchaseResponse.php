<?php

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

    public function getTransactionReference() {
        //Get the latest transaction of payment and use the receipt value
        $transactions = array_reverse($this->data['transaction']);
        foreach($transactions as $transaction) {
            if (($transaction['transaction']['type'] ?? null) === 'PAYMENT') {
                return $transaction['transaction']['receipt'];
            }
        }
        return null;
    }
}
