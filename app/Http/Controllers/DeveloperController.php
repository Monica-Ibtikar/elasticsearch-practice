<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DeveloperRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeveloperController extends Controller
{
    protected $developerRepo;

    public function __construct(DeveloperRepositoryInterface $developerRepository)
    {
        $this->developerRepo = $developerRepository;
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
}
