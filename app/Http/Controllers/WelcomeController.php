<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Delivery;
use App\Models\Payment;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = count(Client::all());
        $delivery = Delivery::all()->sum('amount');
        $payment = Payment::all()->sum('amount');

        return view('welcome', ['clients' => $clients, 'delivery' => $delivery, 'balance' => $delivery - $payment]);
    }
}
