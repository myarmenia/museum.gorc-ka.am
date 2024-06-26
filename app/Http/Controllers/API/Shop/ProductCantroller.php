<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\Shop\MuseumListResource;
use App\Http\Resources\Shop\ProductCategoryListResource;
use App\Http\Resources\Shop\ProductFilterResource;
use App\Http\Resources\Shop\ShopResource as ShopShopResource;
use App\Http\Resources\ShopResource;
use App\Models\Museum;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductCantroller extends Controller
{
  protected $model;

	public function __construct(Product $model)
	{
		$this->model = $model;
	}
  public function index(Request $request){

    $data = $this->model
                ->filter($request->all())
      ->orderBy('id', 'DESC')
      ->where('status',1)
      ->paginate(12)->withQueryString();

      return ShopShopResource::collection($data);

  }

  public function productCategory(){
    $product_category = ProductCategory::all();
    return ProductCategoryListResource::collection($product_category);
  }


}
