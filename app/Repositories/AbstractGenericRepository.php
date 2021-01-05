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

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $params = array_merge($this->commonParams, [
            "id" => $id
        ]);
        $response = $this->client->get($params);
        return $response["_source"];
    }

    /**
     * @param $id
     * @param array $doc
     * @return mixed
     */
    public function update($id, array $doc)
    {
        $params = array_merge($this->commonParams, [
            "id" => $id,
            "body" => [ "doc" => $doc]
        ]);
        $response = $this->client->update($params);
        return $response["result"];
    }

    /**
     * @param array $match
     * @return mixed
     */
    public function search(array $match = [])
    {
        if(empty($match)) {
            $result = $this->getAll();
        } else {
            $params = array_merge($this->commonParams, [
                "body" => [ "query" => [ "match" => $match]]
            ]);
            $result = $this->client->search($params);
        }
        return $result;
    }

    /**
     * @return mixed
     */
    protected function getAll()
    {
        $params = $this->commonParams;

        return $this->client->search($params);
    }
}