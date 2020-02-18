<?php

namespace Omneo\Apparel21\Parsers;

use Carbon\Carbon;
use SimpleXMLElement;
use Omneo\Apparel21\Entities;

class ShipmentParser
{
    /**
     * Parse the given SimpleXmlElement to a Shipment entity.
     *
     * @param  SimpleXMLElement $payload
     * @return Entities\Shipment
     */
    public function parse(SimpleXMLElement $payload)
    {
        $shipment = (new Entities\Shipment)
            ->setCarrierName((string) $payload->CarrierName)
            ->setCarrierUrl((string) $payload->CarrierUrl)
            ->setTrackingCode((string) $payload->ConNote)
            ->setDispatchDate(Carbon::parse((string) $payload->DespatchDate));

        $shipment->setContents(
            (new ContentParser)->parseCollection($payload->Contents)
        );

        return $shipment;
    }
}