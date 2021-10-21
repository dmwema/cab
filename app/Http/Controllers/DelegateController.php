<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Delegate;
use App\Models\Product;
use Illuminate\Http\Request;

class DelegateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delegates = Delegate::all();

        $clients_nav = Client::orderBy('name')->get();
        $products_nav = Product::orderBy('name')->get();

        return view('delegates.all', ["delegates" => $delegates, 'products_nav' => $products_nav, 'clients_nav' => $clients_nav]);
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
        ]);

        $delegate = new Delegate();
        $delegate->name = $request->name;
        $delegate->phone = $request->phone;

        $delegate->save();

        return redirect()->route('delegates')->with('success', 'Delégué ajouté avec succès');
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
        $delegate = Delegate::find($request->id);

        $clients_nav = Client::orderBy('name')->get();
        $products_nav = Product::orderBy('name')->get();

        return view('delegates.edit', ['delegate' => $delegate, 'products_nav' => $products_nav, 'clients_nav' => $clients_nav]);
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
        $delegate = Delegate::find($request->id);
        if ($request->name) {
            $delegate->name = $request->name;
        }
        if ($request->phone) {
            $delegate->phone = $request->phone;
        }

        $delegate->save();

        return redirect()->route('delegates')->with('success', 'Délégué modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delegate = Delegate::find($request->id);
        $delegate->delete();

        return redirect()->route('delegates')->with('success', 'Delégué supprimé avec succès');
    }
}
