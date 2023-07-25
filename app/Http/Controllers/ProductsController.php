<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Products;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductsController extends Controller
{
    use HttpResponse;
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection(
          Products::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ProductResource
     */
    public function store(StoreProductRequest $request): ProductResource
    {
        $request->validated();

        $product = Products::create([
            "name" => $request->name,
            "color"  => $request->color,
            "price"  => $request->price,
            "category"  => $request->category
        ]);

        return ProductResource::make($product);

    }

    /**
     * Display the specified resource.
     *
     * @param  Products $products
     * @return ProductResource
     */
    public function show(Products $products): ProductResource
    {
       return ProductResource::make($products);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Products $products
     * @return ProductResource
     */
    public function update(Request $request, Products $products): ProductResource
    {
        $products->update($request->all());

        return ProductResource::make($products);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Products $products
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Products $products)
    {
        $products->delete();

        return $this->success([],$products->id." has been destroyed",204);
    }
}
