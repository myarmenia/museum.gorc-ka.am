<?php
declare(strict_types=1);

namespace App\Traits\NodeApi;

use App\Models\PurchasedItem;
use App\Models\TicketQr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Http;

trait QrTokenCorporativeTrait
{

    public function getTokenQr(int $purchaseId, object $corporative, int $ticketCount): bool|object
    {

        $url = env('NODE_API_URL') . 'getQr';

        $allData = [];

        try {
            DB::beginTransaction();
            $purchase = PurchasedItem::where('purchase_id', $purchaseId)->where('type', 'corporative')->first();

            if(!$purchase){
                DB::rollBack();
                return false;
            }

            $purchasesKeys = [
                'corporative' => $ticketCount
            ];
           

            $data = $this->getReqQrToken($url, $purchasesKeys);

            $quantity = $ticketCount;

            for ($i = 0; $i < $quantity; $i++) {
                $type = $purchase->type;
                $token = $data[$type][0]['unique_token'];
                $path = $data[$type][0]['qr_path'];

                $newData = [
                    'museum_id' => $purchase->museum_id,
                    'purchased_item_id' => $purchase->id,
                    'item_relation_id' => $purchase->item_relation_id,
                    'token' => $token,
                    'path' => $path,
                    'type' => $type,
                    'ticket_token' => Carbon::now()->secondsSinceMidnight().rand(1000, 9999),
                    'price' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $allData[] = $newData;
                array_shift($data[$type]);
            }
          
            $insert = TicketQr::insert($allData);
 
            if (!$insert) {
                DB::rollBack();
                return false;
            }
    
            DB::commit();

            return TicketQr::orderBy('id', 'desc')->take($ticketCount)->get();
            
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return false;
        } catch (\Error $e) {
            DB::rollBack();
            dd($e->getMessage());
            return false;
        }

    }

    public function getReqQrToken(string $url, array $data): array
    {
        $req = Http::post($url, $data);
        $response = $req->getBody()->getContents();
        $response = json_decode($response, true);

        return $response;
    }
}
