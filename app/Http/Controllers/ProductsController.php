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
     * @return \Illuminate\Http\JsonResponse|AnonymousResourceCollection|object
     */
    public function index()
    {
        return ProductResource::collection(
          Products::all()
        )->response()->setStatusCode(201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ProductResource|\Illuminate\Http\JsonResponse|object
     */
    public function store(StoreProductRequest $request)
    {
        $request->validated();

        $product = Products::create([
            "name" => $request->name,
            "color"  => $request->color,
            "price"  => $request->price,
            "category"  => $request->category
        ]);

        return ProductResource::make($product)->response()->setStatusCode(201);

    }

    /**
     * Display the specified resource.
     *
     * @param  Products $product
     * @return ProductResource|\Illuminate\Http\JsonResponse|object
     */
    public function show(Products $product)
    {
       return ProductResource::make($product)->response()->setStatusCode(201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Products $product
     * @return ProductResource|\Illuminate\Http\JsonResponse|object
     */
    public function update(Request $request, Products $product)
    {
        $product->update($request->all());

        return ProductResource::make($product)->response()->setStatusCode(201);
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
