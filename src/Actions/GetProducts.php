<?php

namespace Omneo\Apparel21\Actions;

use GuzzleHttp;
use Carbon\Carbon;
use Omneo\Apparel21\Parsers;
use Omneo\Apparel21\Contracts;
use Illuminate\Support\Collection;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class GetProducts extends BaseAction implements Contracts\Action
{
    /**
     * Whether to return full or simple product data
     *
     * @var bool
     */
    public $simple = true;

    /**
     * How many records to skip.
     *
     * @var integer
     */
    public $skip;

    /**
     * How many records to take.
     *
     * @var integer
     */
    public $take;

    /**
     * Timestamp to search updated after.
     *
     * @var Carbon
     */
    public $updatedAfter;

    /**
     * Set whether to return full or simple product data
     *
     * @param  bool $simple
     * @return static
     */
    public function simple($simple)
    {
        $this->simple = $simple;

        return $this;
    }

    /**
     * Set how many records to skip.
     *
     * @param  integer $skip
     * @return static
     */
    public function skip($skip)
    {
        $this->skip = $skip;

        return $this;
    }

    /**
     * Set how many records to take.
     *
     * @param  integer $take
     * @return static
     */
    public function take($take)
    {
        $this->take = $take;

        return $this;
    }

    /**
     * Set timestamp to search updated after.
     *
     * @param  Carbon $updatedAfter
     * @return static
     */
    public function updatedAfter(Carbon $updatedAfter)
    {
        $this->updatedAfter = $updatedAfter;

        return $this;
    }

    /**
     * Build a PSR-7 request.
     *
     * @return RequestInterface
     */
    public function request()
    {
        if($this->simple){
            $request = new GuzzleHttp\Psr7\Request('GET', 'ProductsSimple');
        } else {
            $request = new GuzzleHttp\Psr7\Request('GET', 'Products');
        }

        if($this->take){
            return $request->withUri($request->getUri()->withQuery(http_build_query([
                'startRow'     => $this->skip ? $this->skip + 1 : 0,
                'pageRows'     => $this->take,
                'updatedAfter' => $this->updatedAfter ? $this->updatedAfter->format('Y-m-d\TH:i:s') : null
            ])));
        } else {
            return $request->withUri($request->getUri()->withQuery(http_build_query([
                'updatedAfter' => $this->updatedAfter ? $this->updatedAfter->format('Y-m-d\TH:i:s') : null
            ])));
        }
    }

    /**
     * Transform a PSR-7 response.
     *
     * @param  ResponseInterface $response
     * @return LengthAwarePaginator|Collection
     */
    public function response(ResponseInterface $response)
    {
        $data = (new Parsers\PayloadParser)->parse((string) $response->getBody());

        $collection = new Collection;

        if($this->simple){
            foreach ($data->ProductSimple as $product) {
                $collection->push((new Parsers\ProductSimpleParser)->parse($product));
            }
        } else {
            foreach ($data->Product as $product) {
                $collection->push((new Parsers\ProductParser)->parse($product));
            }
        }

        if ($this->take) {
            return new LengthAwarePaginator(
                $collection,
                (int) $data->attributes()->TotalRows,
                $this->take,
                ceil(($this->skip / $this->take) + 1)
            );
        }

        return $collection;
    }
}