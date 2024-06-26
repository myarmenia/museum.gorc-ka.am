<?php

namespace App\Http\Controllers\Admin\Tickets;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tickets\GuideServiceRequest;
use App\Models\GuideService;
use App\Traits\Museum\Tickets\UpdateOrCreateTrait;
use Illuminate\Http\Request;

class GuideServiceController extends Controller
{
  use UpdateOrCreateTrait;

  public function model()
  {
    return GuideService::class;
  }

  public function __invoke(Request $request)
  {

    $guide_service = $this->itemUpdateOrCreate($request);

    if ($guide_service) {

      return response()->json(['result' => 'success']);

    }
  }
}
