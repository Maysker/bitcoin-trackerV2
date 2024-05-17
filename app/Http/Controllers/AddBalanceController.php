<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AddBalanceController extends Controller
{
    public function updateBalance(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'balance' => ['min:0'],
        ]);

        $user = User::findOrFail($userId); // Find the user by ID

        $newBalance = $user->balance + $request->input('balance'); // Add the new balance to the existing one

        $user->update(['balance' => $newBalance]); // Update the user's balance in the database

        return redirect()->route('dashboard')->with('success', 'Balance successfully added.'); // Redirect back to the dashboard with a success message
    }
}