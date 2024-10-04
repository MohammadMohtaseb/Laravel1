<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'string',
            'price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // $product = new Product();
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return response()->json(data: $product, status: 201);
    }

    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'string',
            'price' => 'numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $product->update($request->only(['name', 'description', 'price']));

        return response()->json($product);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
