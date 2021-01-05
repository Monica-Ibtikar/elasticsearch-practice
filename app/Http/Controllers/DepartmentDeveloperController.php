<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DepartmentRepositoryInterface;
use Illuminate\Http\Request;

class DepartmentDeveloperController extends Controller
{
    protected $departmentRepo;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepo = $departmentRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $departmentId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $departmentId)
    {
        return $this->departmentRepo->addDeveloper($request->input(), $departmentId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $departmentId
     * @param $developerMail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $departmentId, $developerMail )
    {
        return $this->departmentRepo->updateDeveloper($request->input(), $departmentId, $developerMail);
    }

    public function index($departmentId)
    {
        return $this->departmentRepo->getDevelopers($departmentId);
    }

    public function destroy($departmentId, $developerMail)
    {
        return $this->departmentRepo->deleteDeveloper($departmentId, $developerMail);
    }
}
