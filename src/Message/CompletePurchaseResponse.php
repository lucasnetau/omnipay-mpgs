<?php declare(strict_types=1);

namespace Omnipay\Mpgs\Message;

use Omnipay\Mpgs\Enums\StatusEnum;
use function array_reverse;

/**
 * Class CompletePurchaseResponse.
 */
class CompletePurchaseResponse extends \Omnipay\Mpgs\Message\AbstractResponse
{
    public function isSuccessful()
    {
        $statusCode = $this->getStatusCode();

        return $statusCode >= 200 && $statusCode <= 399;
    }

    public function getOrderId()
    {
        return $this->data['id'] ?? null;
    }

    public function getOrderStatus()
    {
        return $this->data['status'] ?? null;
    }

    public function getOrderReference()
    {
        return $this->data['reference'] ?? null;
    }

    public function isCaptured()
    {
        return $this->getOrderStatus() == StatusEnum::CAPTURED;
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
