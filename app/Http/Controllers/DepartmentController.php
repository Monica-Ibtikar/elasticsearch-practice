<?php

namespace App\Http\Controllers;

use App\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;
use App\Repositories\Contracts\DeveloperRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    protected $departmentRepo;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepo = $departmentRepository;
        $repoBaseName = basename(DeveloperRepositoryInterface::class);
        $this->middleware("inner.object:leader,$repoBaseName")->only('update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->departmentRepo->store($request->input());
        if($result == "created"){
            return response('Successful Operation', Response::HTTP_CREATED);
        }
        else {
            return response('Failed Operation', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
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
        $result = $this->departmentRepo->update($id, $request->input());
        if($result == "updated"){
            return response('Successful Operation', Response::HTTP_OK);
        }
        else {
            return response('Failed Operation', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {

    }
}
