<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        $clients_nav = Client::all();
        $products_nav = Product::orderBy('name')->get();

        return view('products.all', ["products" => $products, 'products_nav' => $products_nav, 'clients_nav' => $clients_nav]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('products')->with('success', 'Produit ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $product = Product::find($request->id);

        $clients_nav = Client::all();
        $products_nav = Product::orderBy('name')->get();

        return view('products.edit', ['product' => $product, 'products_nav' => $products_nav, 'clients_nav' => $clients_nav]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($request->id);
        if ($request->name) {
            $product->name = $request->name;
        }
        if ($request->price) {
            $product->price = $request->price;
        }

        $product->save();

        return redirect()->route('products')->with('success', 'Produit modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();

        return redirect()->route('products')->with('success', 'Produit supprimé avec succès');
    }
}
