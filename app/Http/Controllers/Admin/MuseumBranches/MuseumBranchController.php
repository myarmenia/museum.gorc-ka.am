<?php

namespace App\Http\Controllers\Admin\MuseumBranches;

use App\Http\Controllers\Controller;
use App\Http\Requests\MuseumBranchRequest;
use App\Interfaces\MuseumBranches\MuseumBranchesRepositoryInterface;
use App\Models\Museum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuseumBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $museumBranchRepository;
    public function __construct(MuseumBranchesRepositoryInterface $museumBranchRepository){
      $this->museumBranchRepository = $museumBranchRepository;

    }
    public function index()
    {

        $museum_branches = $this->museumBranchRepository->all();


        return view("content.museum-branches.index", compact('museum_branches'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $data =$this->museumBranchRepository->creat();

      return view("content.museum-branches.create", compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MuseumBranchRequest $request)
    {

      $branches_created = $this->museumBranchRepository->store($request->all());
      if($branches_created){
        $museum_branches = $this->museumBranchRepository->all();
        return view("content.museum-branches.index", compact('museum_branches'));
      }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}