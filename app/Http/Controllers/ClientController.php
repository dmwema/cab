<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Delegate;
use App\Models\Delivery;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::orderBy('name')->get();

        $is_filter = false;

        $delegate2_obj = null;

        if ($request->delegate2 != null && $request->delegate2 != 0) {
          $is_filter = true;
          $clients = Client::orderBy('name')->where('delegate', $request->delegate2)->get();
          $delegate2_obj = Delegate::find($request->delegate2);
        } else {
          $clients = Client::orderBy('name')->get();
        }

        $delegates_obj = Delegate::all();
        $deliveries_obj = Delivery::all();
        $payments_obj = Delivery::all();

        $delegates = [];
        $deliveries = [];
        $payments = [];
        $soldes = [];

        foreach ($clients as $client) {
            foreach ($delegates_obj as $d) {
                if ($d->id == $client->delegate) {
                    $delegates[$client->id] = $d->name;
                }
                if ($client->delegate == null) {
                    $delegates[$client->id] = "Non défini";
                }
            }
            if ($delegates_obj->isEmpty() || $delegates == []) {
                $delegates[$client->id] = "Non défini";
            }
        }

        foreach ($clients as $client) {
            $delivery = 0;
            foreach ($deliveries_obj as $d) {
                if ($d != null) {
                    if ($d->client == $client->id) {
                        $delivery += $d->price * $d->qte;
                    }
                }
            }
            $deliveries[$client->id] = $delivery;
        }

        foreach ($clients as $client) {
            $payment = 0;
            foreach ($payments_obj as $p) {
                if ($p != null) {
                    if ($p->client == $client->id) {
                        $payment += $p->amount;
                    }
                }
            }
            $payments[$client->id] = $payment;
            $soldes[$client->id] = $client->initial + $deliveries[$client->id] - $payments[$client->id];
        }

        $total = 0;

        foreach ($soldes as $solde) {
            $total += $solde;
        }

        $clients_nav = Client::orderBy('name')->get();
        $products_nav = Product::orderBy('name')->get();

        return view('clients.all', ['clients' => $clients, 'delegate2_obj' => $delegate2_obj, 'is_filter' => $is_filter, 'products_nav' => $products_nav, 'clients_nav' => $clients_nav, 'total' => $total, 'balances' => $soldes, 'delegates_obj' => $delegates_obj, 'delegates' => $delegates]);
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
            'initial' => 'required|numeric',
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->adress = $request->adress;
        $client->delegate = $request->delegate;
        $client->initial = $request->initial;

        $client->save();

        return redirect()->route('clients')->with('success', 'Client ajouté avec succès');
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
        $client = Client::find($request->id);
        $delegates = Delegate::all();

        $clients_nav = Client::orderBy('name')->get();
        $products_nav = Client::orderBy('name')->get();

        return view('clients.edit', ['products_nav' => $products_nav, 'clients_nav' => $clients_nav, 'client' => $client, 'delegates' => $delegates]);
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
        $client = Client::find($request->id);
        if ($request->name) {
            $client->name = $request->name;
        }
        if ($request->adress) {
            $client->adress = $request->adress;
        }
        if ($request->delegate) {
            $client->delegate = $request->delegate;
        }
        if ($request->phone) {
            $client->phone = $request->phone;
        }
        if ($request->initial != null) {
            $client->initial = $request->initial;
        }

        $client->save();

        return redirect()->route('clients')->with('success', 'Client modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $client = Client::find($request->id);
        $payments = Payment::where('client', $client)->delete();
        $delivery = Delivery::where('client', $client)->delete();
        $client->delete();

        return redirect()->route('clients')->with('success', 'Client supprimé avec succès');
    }
}
