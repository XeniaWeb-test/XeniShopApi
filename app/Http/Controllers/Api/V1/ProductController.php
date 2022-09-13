<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreProductRequest;
use App\Http\Requests\V1\UpdateProductRequest;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new ProductFilter();
        $queryItems = $filter->transform($request); // [['column','operator','value']]

        /**
         *  return new ProductCollection(Product::paginate(5)->sortDesc()); // Return {'data':... , 'links': ... , 'meta':...}
         *  return ProductResource::collection(Product::paginate(20)->sortDesc()); // Return only 20 {'data':... } without links and meta
         */

        $includeCategory = $request->query('includeCategory');
        $products = Product::where($queryItems);
        if ($includeCategory) {
            $products = $products->with('category');
        }

        if (count($queryItems) == 0) {
            return response([
                'cards' => new ProductCollection($products->get()->sortDesc()),
                'message' => 'Retrieved successfully',
            ]);
        } else {
            return response([
                'cards' => new ProductCollection($products->get()->sortDesc()),
                'message' => 'Retrieved successfully',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\V1\StoreProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
//    public function store(Request $request)
    {
// Example JSON for front:
//        {
//            "title": "New Titile",
//            "price": 25,
//            "description": "New my description",
//            "categoryId": 4,
//            "image": "https://picsum.photos/id/1015/300/250",
//            "comment": "New comment"
//        }

        $card = $request->file('image')->store('/', 'photos');
        if (!$card) {
            return response(['message' => 'Error file upload'], 500);
        }

        $product = Product::create($request->input());
//        // @todo - временный абсолютный путь для локали
        $product->update(['image' => 'https://shop-api/storage/photos/' . $card]);
        return response(new ProductResource($product));
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\V1\UpdateProductRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->input());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
