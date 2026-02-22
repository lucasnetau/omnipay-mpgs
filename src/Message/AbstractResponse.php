<?php declare(strict_types=1);

namespace Omnipay\Mpgs\Message;

use Omnipay\Common\Message\RequestInterface;

/**
 * Class AbstractResponse.
 */
class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    protected array $headers;

    protected int $status;

    /**
     * @param RequestInterface $request
     * @param array $data
     * @param array $headers
     * @param int $status
     */
    public function __construct(RequestInterface $request, array $data, array $headers, int $status)
    {
        parent::__construct($request, $data);
        $this->headers = $headers;
        $this->status = $status;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getStatusCode()
    {
        return $this->status;
    }

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return false;
    }

    public function getMessage()
    {
        return $this->data['result'] ?? null;
    }

    public function isMessageSuccess()
    {
        return $this->getMessage() === 'SUCCESS';
    }
}
