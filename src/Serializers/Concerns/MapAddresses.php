<?php

namespace Omneo\Apparel21\Serializers\Concerns;

use Omneo\Apparel21\Entities;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait MapAddresses
{
    /**
     * Map addresses to given payload array.
     *
     * @param  array      $payload
     * @param  Collection $addresses
     * @return array
     */
    protected function mapAddresses(array $payload, Collection $addresses)
    {
        collect([
            'billing'  => 'Addresses.Billing',
            'delivery' => 'Addresses.Delivery',
        ])->each(function ($payloadKey, $addressType) use ($addresses, &$payload) {

            if ($address = $addresses->first(function (Entities\Address $address) use ($addressType) {
                return $addressType === $address->getType();
            })) {
                Arr::set($payload, $payloadKey, $this->serializeAddress($address));
            }

        });

        return $payload;
    }

    /**
     * Serialize given address.
     *
     * @param  Entities\Address $address
     * @return array
     */
    protected function serializeAddress(Entities\Address $address)
    {
        return array_filter([
            'ContactName'  => $address->getContactName(),
            'CompanyName'  => $address->getCompanyName(),
            'AddressLine1' => $address->getLine1(),
            'AddressLine2' => $address->getLine2(),
            'City'         => $address->getCity(),
            'State'        => $address->getState(),
            'Postcode'     => $address->getPostcode(),
            'Country'      => $address->getCountry()
        ]);
    }
}