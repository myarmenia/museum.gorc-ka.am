<?php

namespace App\Http\Controllers\API\MuseumBranch;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\MuseumBranchesResource;
use App\Models\MuseumBranch;
use Illuminate\Http\Request;

class MuseumBranchesController extends BaseController
{
    public function __invoke($museum_id){

      $museum_branches = MuseumBranch::where(['museum_id'=>$museum_id,'status'=>1])->get();

      MuseumBranchesResource::collection($museum_branches);
      return $this->sendResponse(MuseumBranchesResource::collection($museum_branches),'success');

    }
}
