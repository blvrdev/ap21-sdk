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
     * @var integer
     */
    public $person;

    /**
     * Order ID
     *
     * @var integer
     */
    public $order;

    /**
     * Set person.
     *
     * @param  integer $person
     * @return static
     */
    public function person($person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Set order.
     *
     * @param  integer $order
     * @return static
     */
    public function order($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Build a PSR-7 request.
     *
     * @return RequestInterface
     */
    public function request()
    {
        return new GuzzleHttp\Psr7\Request('GET', 'Persons/' . $this->person . '/Shipments/' . $this->order);
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