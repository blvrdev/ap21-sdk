<?php

namespace Omneo\Apparel21\Serializers\Concerns;

use Omneo\Apparel21\Entities;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait MapContacts
{
    /**
     * Map contacts to given payload array.
     *
     * @param  array      $payload
     * @param  Collection $contacts
     * @return array
     */
    protected function mapContacts(array $payload, Collection $contacts)
    {
        collect([
            'email'        => 'Contacts.Email',
            'work_phone'   => 'Contacts.Phones.Work',
            'home_phone'   => 'Contacts.Phones.Home',
            'mobile_phone' => 'Contacts.Phones.Mobile',
        ])->each(function ($payloadKey, $contactType) use ($contacts, &$payload) {

            if ($contact = $contacts->first(function (Entities\Contact $contact) use ($contactType) {
                return $contactType === $contact->getType();
            })) {
                Arr::set($payload, $payloadKey, $contact->getValue());
            }

        });

        return $payload;
    }
}