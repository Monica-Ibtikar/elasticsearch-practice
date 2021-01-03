<?php
/**
 * Created by PhpStorm.
 * User: monica
 * Date: 30/12/20
 * Time: 05:01 م
 */
namespace App\Repositories\Contracts;

interface GenericRepositoryInterface
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes);

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param $id
     * @param array $doc
     * @return mixed
     */
    public function update($id, array $doc);

    /**
     * @param array $match
     * @return mixed
     */
    public function search(array $match);
}