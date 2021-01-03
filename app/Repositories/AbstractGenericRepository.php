<?php
/**
 * Created by PhpStorm.
 * User: monica
 * Date: 30/12/20
 * Time: 05:02 م
 */
namespace App\Repositories;

use App\Repositories\Contracts\GenericRepositoryInterface;
use Elasticsearch\ClientBuilder;

class AbstractGenericRepository implements GenericRepositoryInterface
{
    protected $index;
    protected $commonParams;
    protected $client;

    /**
     * AbstractGenericRepository constructor.
     *
     * @param $index
     */
    public function __construct($index)
    {
        $this->index = $index;
        $this->commonParams = [
            "index" => $this->index,
        ];
        $this->client = app(ClientBuilder::class);
    }

    /**
     * index a document to elasticsearch
     *
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes)
    {
        $params = array_merge($this->commonParams, [
            "body" => $attributes
        ]);
        $response = $this->client->index($params);
        return $response["result"];
    }
}