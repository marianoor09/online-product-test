<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\AddProductRequest;

class ProductController extends Controller
{
    protected $product;

    function __construct(Product $product) {
        $this->product = $product;
    }

    // Here we will retrive all the results with pagination 

    public function getAllProducts(Request $request) {
        try {
            
            $products = $this->product->getAllProducts($request);
            return response()->json(['data' => $products], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    // Here we will add the product 

    public function addProduct(AddProductRequest $request) {
        try {
            $product = $this->product->addProduct($request);
            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    // Here we will update the product by passing the param { id } 
    public function editProduct(Request $request, $id) {
        try {
            $product = $this->product->editProduct($request,$id);
            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    // Here we will retrive the product by param { id } 
    public function getProductById($id) {
        if ($this->product->find($id)) {
            
         return response()->json(['data' => $this->product->find($id) ],200); 
        }
         return response()->json(['message' => 'Record does not found'],200); 
    }

    // Here we will delete the product By param { id }
    public function deleteProduct($id) {
        try {
            $deletedProduct = $this->product->deleteProduct($id);
            return response()->json($deletedProduct);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

    }


}
