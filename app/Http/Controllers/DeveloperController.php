<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DepartmentRepositoryInterface;
use App\Repositories\Contracts\DeveloperRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeveloperController extends Controller
{
    protected $developerRepo;
    protected $departmentRepo;

    public function __construct(DeveloperRepositoryInterface $developerRepository, DepartmentRepositoryInterface $departmentRepository)
    {
        $this->developerRepo = $developerRepository;
        $this->departmentRepo = $departmentRepository;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->developerRepo->store($request->input());
        if($result == "created"){
            return response('Successful Operation', Response::HTTP_CREATED);
        }
        else {
            return response('Failed Operation', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        $this->developerRepo->update($id, $request->input());
        $supervisedDepartment = $this->departmentRepo->search(["leader.id" => $id]);
        if($supervisedDepartment["hits"]["total"]["value"] == 1){
            $this->departmentRepo->update($supervisedDepartment["hits"]["hits"][0]["_id"], ["leader" => $request->input()]);
        }
        return response('Successful Operation', Response::HTTP_OK);
    }
}
