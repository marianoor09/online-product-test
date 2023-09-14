<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function getAllProducts(Request $request) {
        $products = $this->paginate(env('APP_PAGINATE',10));
        return $products;
    }

    public function addProduct(Request $request) {
        $this->name = $request->get('name');
        $this->price = $request->get('price');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $this->image = $imageName;
            Storage::disk('public')->put($imageName,file_get_contents($image));
        }
        $this->save();

        return ['data' => $this , 'message' => 'Product Added Successfully'];
    }

    public function editProduct(Request $request, $id) {
        $product = $this->find($id);

        if ($product) {
            $product->name = $request->get('name');
            $product->price = $request->get('price');
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->put($imageName,file_get_contents($image));
                $product->image = $imageName;
            }
            $product->save();
            return ['data' => $product,'message' => 'Product Updated Successfully'];
        }

        return ['data' => null , 'message' => 'Record does not found'];
    }

    public function deleteProduct($id) {
        $product = $this->find($id);
        if ($product) {
            $product->delete();
            return ['message' => 'Product Deleted Successfully'];
        }
        return ['data' => null , 'message' => 'Record does not found'];
    }


}
