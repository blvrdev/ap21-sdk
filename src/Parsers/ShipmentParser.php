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
            $this->parseContents($payload->Contents)
        );

        return $shipment;
    }

    /**
     * Parse payload Contents to a collection
     *
     * @param  SimpleXMLElement $xml
     * @return Collection
     */
    public function parseContents(SimpleXMLElement $xml)
    {
        $collection = collect();

        foreach($xml->Contents as $content){
            $collection->push((new Entities\Content)
                ->setCode((string) $content->ProductCode)
                ->setColor((string) $content->ColourCode)
                ->setSize((string) $content->SizeCode)
                ->setSkuId((int) $content->SkuId)
                ->setQuantity((int) $content->Quantity)
            );
        }

        return $collection->reject(function (Entities\Content $content) {
            return empty($content->getQuantity());
        });
    }
}