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
}