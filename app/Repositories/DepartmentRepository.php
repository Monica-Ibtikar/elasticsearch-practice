<?php
/**
 * Created by PhpStorm.
 * User: monica
 * Date: 30/12/20
 * Time: 06:26 م
 */
namespace App\Repositories;

use App\Repositories\Contracts\DepartmentRepositoryInterface;

class DepartmentRepository extends AbstractGenericRepository implements DepartmentRepositoryInterface
{
    public function getDevelopers($id)
    {
        $params = array_merge(
            $this->commonParams,
            ["id" => $id]
            );
        $result = $this->client->get($params);
        return $result["_source"]["developer"];
    }

    public function updateDeveloper($developerData, $departmentId, $developerMail)
    {
        $params = array_merge(
            $this->commonParams,
            [
                'id'    => $departmentId,
                'body'  => [
                    'script' => [
                        'source' => "ctx._source.developer.removeIf(developer -> developer.email == params.email); ctx._source.developer.add(params.developer_data)",
                        'params' => [
                            'email' => $developerMail,
                            "developer_data" => $developerData
                        ]
                    ]
                ]
            ]);
        return $this->client->update($params);
    }

    public function deleteDeveloper($departmentId, $developerMail)
    {
        $params = array_merge(
            $this->commonParams,
            [
                'id'    => $departmentId,
                'body'  => [
                    'script' => [
                        'source' => "ctx._source.developer.removeIf(developer -> developer.email == params.email);",
                        'params' => [
                            'email' => $developerMail
                        ]
                    ]
                ]
            ]);
        return $this->client->update($params);
    }

    public function addDeveloper($developerData, $departmentId)
    {
        $params = array_merge(
            $this->commonParams,
            [
                'id'    => $departmentId,
                'body'  => [
                    'script' => [
                        'source' => "ctx._source.developer.add(params.developer_data);",
                        'params' => [
                            "developer_data" => $developerData
                        ]
                    ]
                ]
            ]);
        return $this->client->update($params);
    }
}