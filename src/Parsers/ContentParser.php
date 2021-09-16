<?php

namespace Omneo\Apparel21\Parsers;

use SimpleXMLElement;
use Illuminate\Support\Collection;
use Omneo\Apparel21\Entities\Content;

class ContentParser
{
    /**
     * Parse a collection of contents.
     *
     * @param  SimpleXMLElement $xml
     * @return Collection
     */
    public function parseCollection(SimpleXMLElement $xml)
    {
        $collection = collect();

        foreach($xml->Contents as $content){
            $collection->push((new Content)
                ->setCode((string) $content->ProductCode)
                ->setColor((string) $content->ColourCode)
                ->setSize((string) $content->SizeCode)
                ->setSkuId((int) $content->SkuId)
                ->setQuantity((int) $content->Quantity)
            );
        }

        return $collection->reject(function (Content $content) {
            return empty($content->getQuantity());
        });
    }
}