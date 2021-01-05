<?php
/**
 * Created by PhpStorm.
 * User: monica
 * Date: 30/12/20
 * Time: 06:26 م
 */
namespace App\Repositories\Contracts;

interface DepartmentRepositoryInterface extends GenericRepositoryInterface
{
    public function getDevelopers($id);
    public function updateDeveloper($developerData, $departmentId, $developerMail);
    public function deleteDeveloper( $departmentId, $developerMail);
    public function addDeveloper($developerData, $departmentId);
}