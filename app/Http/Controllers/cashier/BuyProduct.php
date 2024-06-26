<?php

namespace App\Http\Controllers\cashier;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TicketSubscriptionSetting;
use App\Traits\NodeApi\QrTokenTrait;
use App\Traits\Purchase\PurchaseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyProduct extends Controller
{
    use PurchaseTrait;

    public function __invoke(Request $request)
    {
        try {
            DB::beginTransaction();

            $requestData = $request->input('product');

            $allMuseumProduct = Product::where(['museum_id' => getAuthMuseumId(), 'status' => 1])->get();

            if ($allMuseumProduct->count()) {
                $data['purchase_type'] = 'offline';
                $data['status'] = 1;
                $data['items'] = [];

                $haveValue = false;

                foreach ($requestData as $key => $countProduct) {
                    if ($countProduct = (int) $countProduct) {
                        $haveValue = true;
                        if($p = $allMuseumProduct->find((int) $key)){
                            if ($p->quantity  < $countProduct) {
                                session(['errorMessage' => 'Պետք է համապատասխանեն ապրանքի քանակ և մուտքագրված թիվ դաշտերը']);
                                DB::rollBack();
                                return redirect()->back();
                            }

                            $p->update(['quantity' => $p->quantity - $countProduct]);

                            $data['items'][] = [
                                "type" => 'product',
                                "product_id" => (int) $key,
                                "quantity" => (int) $countProduct
                            ];
                        }
                    }
                }

                if(!$haveValue){
                    session(['errorMessage' => 'Լրացրեք քանակ դաշտը']);
                       
                    DB::rollBack();
                    return redirect()->back();
                }

                $addTicketPurchase = $this->purchase($data);

                if ($addTicketPurchase) {
                    session(['success' => 'Ապրանքը վաճառված է']);

                    DB::commit();
                    return redirect()->back();
                }
            }

            session(['errorMessage' => 'Ինչ որ բան այն չէ, խնդրում ենք փորձել մի փոքր ուշ']);
            DB::rollBack();
            return redirect()->back();

        } catch (\Exception $e) {
            session(['errorMessage' => 'Ինչ որ բան այն չէ, խնդրում ենք փորձել մի փոքր ուշ']);
            DB::rollBack();
            dd($e->getMessage());
            return false;
        } catch (\Error $e) {
            session(['errorMessage' => 'Ինչ որ բան այն չէ, խնդրում ենք փորձել մի փոքր ուշ']);
            DB::rollBack();
            dd($e->getMessage());
            return false;
        }
    }
}
