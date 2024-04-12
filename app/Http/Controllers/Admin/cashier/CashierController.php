<?php

namespace App\Http\Controllers\Admin\cashier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cashier\CashierEventRequest;
use App\Models\ProductCategory;
use App\Services\Cashier\CashierService;
use App\Traits\Purchase\PurchaseTrait;
use Illuminate\Http\Request;

class CashierController extends Controller
{
   public $cashierService;

   public function __construct(CashierService $cashierService)
   {
      $this->cashierService = $cashierService;
   }

   public function index(Request $request)
   {
      $allData = $this->cashierService->getAllData();

      if($allData['success']) {
         $data = $allData['data'];
         return view('content.cashier.create', compact('data'));
      }

      return redirect()->route('tickets_show');
   }

   public function checkCoupon(Request $request)
   {
      $checkedData = $this->cashierService->checkCoupon($request->all());

      return response()->json($checkedData);
   }

   public function getEventDetails($id)
   {
      $event = $this->cashierService->getEventDetails($id);

      if ($event) {
         return response()->json($event);
      }

      return response()->json(['error' => translateMessageApi('something-went-wrong')], 500);
   }

   public function createEducational(CashierEventRequest $request)
   {
      dd($request->all());
   }

   public function getMuseumProduct(Request $request)
   {
      $product_category = ProductCategory::all();
      $data = $this->cashierService->getMuseumProduct($request->all());

      return view('content.cashier.product', [
         'data' => $data,
         'product_category' => $product_category,
      ])
         ->with('i', ($request->input('page', 1) - 1) * 5);
   }
}
