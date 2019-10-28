<?php

namespace Omneo\Apparel21\Serializers\Concerns;

use Omneo\Apparel21\Entities;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait MapPayments
{
    /**
     * Map payments to given payload array.
     *
     * @param  array      $payload
     * @param  Collection $payments
     * @return array
     */
    protected function mapPayments(array $payload, Collection $payments)
    {
        Arr::set($payload, 'Payments', []);

        $payments->each(function (Entities\Payment $payment) use (&$payload) {
            array_push($payload['Payments'], $this->serializePayment($payment));
        });

        return $payload;
    }

    /**
     * Serialize given payment.
     *
     * @param  Entities\Payment $payment
     * @return array
     */
    protected function serializePayment(Entities\Payment $payment)
    {
        return array_filter([
            '@node'         => 'PaymentDetail',
            'Id'            => $payment->getIdentifiers()->get('ap21_id'),
            'Stan'          => $payment->getIdentifiers()->get('ap21_stan'),
            'Settlement'    => $payment->getIdentifiers()->get('ap21_settlement'),
            'Reference'     => $payment->getIdentifiers()->get('ap21_reference'),
            'MerchantId'    => $payment->getIdentifiers()->get('ap21_merchant_id'),
            'AccountId'     => $payment->getIdentifiers()->get('ap21_account_id'),
            'CardType'      => $payment->getAttributes()->get('card_type'),
            'AuthCode'      => $payment->getAttributes()->get('auth_code'),
            'Message'       => $payment->getAttributes()->get('message'),
            'Origin'        => $payment->getType(),
            'Amount'        => $payment->getAmount() / 100,
            'VoucherNumber' => $payment->getAttributes()->get('voucher_number'),
            'ValidationId'  => $payment->getAttributes()->get('validation_id'),
        ]);
    }
}