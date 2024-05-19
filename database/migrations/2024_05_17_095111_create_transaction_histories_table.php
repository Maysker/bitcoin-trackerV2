<?php

namespace App\Http\Controllers;

use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        $transactions = TransactionHistory::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('profile.transactions', ['transactions' => $transactions]);
    }
}