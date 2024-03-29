<?php
namespace App\Traits\Purchase;

use App\Models\EventConfig;
use App\Models\PersonPurchase;
use App\Models\Product;
use App\Models\Purchase;

trait UpdateItemQuantityTrait
{
  public function updateItemQuantity($purchase_id)
  {

      $array_types = ['product', 'event', 'corporative'];

      $purchase = Purchase::find($purchase_id);
      $items = $purchase->purchased_items->whereIn('type', $array_types)->get();
      if(count( $items) > 0){
            switch ($items->type) {
              case 'product':
                $this->updateProductQuantity($items);
                break;
              case 'event':
                $this->updateEventConfigeQuantity($items);
                break;
              case 'corporative':
                $this->updateCorporativeQuantity($items);
                break;

            }
      }
  }

  public function updateProductQuantity($item){

      $product = Product::find($item->item_relation_id);
      $quantity = $product->quantity - $item->quantity;
      $product->update(['quantity' => $quantity]);
  }


  public function updateEventConfigeQuantity($item)
  {

    $event_config = EventConfig::find($item->item_relation_id);
    $quantity = $event_config->visitors_quantity + $item->quantity;
    $event_config->update(['visitors_quantity' => $quantity]);
  }

  // ============ Gevorgi kodi mas =======================

  // public function updateCorporativeQuantity($item)
  // {

  //
  // }



}
