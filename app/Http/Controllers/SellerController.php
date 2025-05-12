<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    public function index()
    {
        $products = session()->get('products', []);
        return view('pages.admin.manage_product', compact('products'));
    }

    public function store(Request $request)
    {
        $products = session()->get('products', []);
        $newId = count($products) > 0 ? max(array_column($products, 'id')) + 1 : 1;

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        $products[] = [
            'id' => $newId,
            'image' => $imagePath ? asset('storage/' . $imagePath) : null,
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'warranty' => $request->warranty,
            'piece' => $request->piece
        ];

        session(['products' => $products]);

        return redirect()->route('manage_product.index')->with('success', 'Product added!');
    }

    public function update(Request $request, $id)
    {
        $products = session()->get('products', []);

        foreach ($products as &$product) {
            if ($product['id'] == $id) {
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('uploads', 'public');
                    $product['image'] = asset('storage/' . $imagePath);
                }

                $product['name'] = $request->name;
                $product['category'] = $request->category;
                $product['description'] = $request->description;
                $product['price'] = $request->price;
                $product['warranty'] = $request->warranty;
                $product['piece'] = $request->piece;
                break;
            }
        }

        session(['products' => $products]);

        return redirect()->route('manage_product.index')->with('success', 'Product updated!');
    }

    public function destroy($id)
    {
        $products = session()->get('products', []);
        $products = array_filter($products, fn($p) => $p['id'] != $id);
        session(['products' => array_values($products)]);

        return redirect()->route('manage_product.index')->with('success', 'Product deleted!');
    }
  
}
