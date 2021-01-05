<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    protected $projectRepo;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepo = $projectRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->projectRepo->store($request->input());
        if($result == "created"){
            return response('Successful Operation', Response::HTTP_CREATED);
        }
        else {
            return response('Failed Operation', Response::HTTP_BAD_REQUEST);
        }
    }

    public function index()
    {
        $results = $this->projectRepo->search();
        return $results["hits"]["hits"];
    }
}
