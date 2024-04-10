<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\Museum;
use App\Models\Payment;
use App\Models\Purchase;
use App\Models\PurchasedItem;
use App\Traits\Reports\ReportTrait;
use Illuminate\Http\Request;

class ReportsForSuperAdminController extends Controller
{
  use ReportTrait;
  protected $model;
  public function __construct(PurchasedItem $model)
  {
      $this->middleware('role:super_admin|general_manager|chief_accountant');
      $this->model = $model;

  }

  public function index(Request $request)
  {

// dd($request->all());
    $data = $this->report($request->all(), $this->model);

    $museums = Museum::all();

    return view("content.reports.super-admin", compact('data', 'museums'));

  }
}
