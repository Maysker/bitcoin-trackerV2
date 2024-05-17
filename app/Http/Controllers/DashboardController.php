<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the authenticated user
        $activeUser = Auth::user();
        $endpoint = "https://api.binance.com/api/v3/ticker/price?symbol=BTCUSDT";
        $response = file_get_contents($endpoint);
        $btcInfo = json_decode($response, true);
        $btcRate = $btcInfo['price'];

        $data = ['name' => $activeUser->name, 'balance' => $activeUser->balance, 'btcBalance' => $activeUser->bitcoin, 'btcRate' => $btcRate];

        // Pass the user data to the view
        return view('dashboard', compact('data'));
        
    }
}