<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransactionHistory;

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
        $portfolioWorth = $btcRate * $activeUser->bitcoin + $activeUser->balance;

        $data = ['name' => $activeUser->name, 'balance' => $activeUser->balance, 'btcBalance' => $activeUser->bitcoin, 'btcRate' => $btcRate, 'portfolioWorth' => $portfolioWorth];

        // Pass the user data to the view
        return view('dashboard', compact('data'));
    }

    public function handleForm(Request $request)
    {
        // Validate the request data
        $request->validate([
            'action' => 'required|in:buy,sell',
            'amount' => 'required|numeric|min:0.00000001', // Minimum amount to avoid zero or negative numbers
        ]);

        // Fetch the authenticated user
        $activeUser = Auth::user();

        // Fetch the current BTC to USDT rate from Binance API
        $endpoint = "https://api.binance.com/api/v3/ticker/price?symbol=BTCUSDT";
        $response = @file_get_contents($endpoint);

        // Handle potential API errors
        if ($response === FALSE) {
            return redirect()->back()->with('error', 'Could not fetch BTC rate. Please try again later.');
        }

        $btcRate = json_decode($response, true);

        // Perform the buy or sell action
        if ($request->input('action') == 'buy') {
            // Calculate the cost in USD and update user's balance and bitcoin
            $cost = $request->input('amount') * $btcRate['price'];
            if ($activeUser->balance >= $cost) {
                $activeUser->balance -= $cost;
                $activeUser->bitcoin += $request->input('amount');

                // Save the transaction to the transaction history
                TransactionHistory::create([
                    'user_id' => $activeUser->id,
                    'buySell' => 'buy',
                    'amount' => $request->input('amount'),
                    'rate' => $btcRate['price']
                ]);
            } else {
                return redirect()->back()->with('error', 'Insufficient balance.');
            }
        } else {
            // Calculate the earnings in USD and update user's balance and bitcoin
            if ($activeUser->bitcoin >= $request->input('amount')) {
                $earnings = $request->input('amount') * $btcRate['price'];
                $activeUser->balance += $earnings;
                $activeUser->bitcoin -= $request->input('amount');

                TransactionHistory::create([
                    'user_id' => $activeUser->id,
                    'buySell' => 'sell',
                    'amount' => $request->input('amount'),
                    'rate' => $btcRate['price']
                ]);
            } else {
                return redirect()->back()->with('error', 'Insufficient bitcoin.');
            }
        }

        // Save the updated user data
        $activeUser->save();

        // Redirect back to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Transaction successful.');
    }
}
