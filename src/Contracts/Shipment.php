<?php

namespace Omneo\Apparel21\Contracts;

use Carbon\Carbon;
use Illuminate\Support\Collection;

interface Shipment
{
    /**
     * Return carrier name.
     *
     * @return string
     */
    public function getCarrierName();

    /**
     * Set carrier name.
     *
     * @param  string $carrierName
     * @return static
     */
    public function setCarrierName($carrierName = null);

    /**
     * Return carrier URL.
     *
     * @return string
     */
    public function getCarrierUrl();

    /**
     * Set carrier URL.
     *
     * @param  string $carrierUrl
     * @return static
     */
    public function setCarrierUrl($carrierUrl = null);

    /**
     * Return tracking code.
     *
     * @return string
     */
    public function getTrackingCode();

    /**
     * Set tracking code.
     *
     * @param  string $trackingCode
     * @return static
     */
    public function setTrackingCode($trackingCode = null);

    /**
     * Return dispatch date.
     *
     * @return Carbon
     */
    public function getDispatchDate();

    /**
     * Set dispatch date.
     *
     * @param  Carbon $dispatchDate
     * @return static
     */
    public function setDispatchDate($dispatchDate = null);

    /**
     * Return contents collection.
     *
     * @return Collection
     */
    public function getContents();

    /**
     * Set contents collection.
     *
     * @param  Collection $contents
     * @return static
     */
    public function setContents(Collection $contents);
}