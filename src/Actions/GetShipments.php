<?php

namespace Omneo\Apparel21\Actions;

use GuzzleHttp;
use Omneo\Apparel21\Parsers;
use Omneo\Apparel21\Contracts;
use Illuminate\Support\Collection;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GetShipments extends BaseAction implements Contracts\Action
{
    /**
     * Person ID
     *
     * @var int
     */
    public $personId;

    /**
     * Order ID
     *
     * @var int
     */
    public $orderId;

    /**
     * GetShipments constructor.
     *
     * @param int $orderId
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Set person.
     *
     * @param  integer $personId
     * @return static
     */
    public function person($personId)
    {
        $this->personId = $personId;

        return $this;
    }

    /**
     * Set order.
     *
     * @param  integer $orderId
     * @return static
     */
    public function order($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Build a PSR-7 request.
     *
     * @return RequestInterface
     */
    public function request()
    {
        return new GuzzleHttp\Psr7\Request('GET', 'Persons/' . $this->personId . '/Shipments/' . $this->orderId);
    }

    /**
     * Transform a PSR-7 response.
     *
     * @param  ResponseInterface $response
     * @return Collection
     */
    public function response(ResponseInterface $response)
    {
        $xml = (new Parsers\PayloadParser)->parse((string) $response->getBody());

        $collection = new Collection;

        foreach ($xml as $item) {
            $collection->push(
                (new Parsers\ShipmentParser)->parse($item)
            );
        }

        return $collection;
    }
}