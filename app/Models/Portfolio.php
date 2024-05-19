<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'balance', 'last_update'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalWinLoss()
    {
        $totalWinLoss = 0;

        foreach ($this->transactions as $transaction) {
            $quantity = $transaction->type === 'buy' ? $transaction->amount : -$transaction->amount;
            $averageBuyPrice = $transaction->total_cost / $transaction->amount;

            if ($transaction->type === 'sell') {
                $winLoss = ($transaction->price_per_unit - $averageBuyPrice) * $quantity;
            } else {
                $currentPrice = $this->getCurrentPrice();
                if ($currentPrice !== null) {
                    $winLoss = ($currentPrice - $averageBuyPrice) * $quantity;
                } else {
                    $winLoss = 0; 
                }
            }
            $totalWinLoss += $winLoss;
        }

        return $totalWinLoss;
    }


    public function getCurrentPrice()
    {
        $endpoint = "https://api.binance.com/api/v3/ticker/24hr?symbol=BTCUSDT";

        try {
            $response = file_get_contents($endpoint);
            $data = json_decode($response, true);
            return $data['lastPrice'];
        } catch (Exception $e) {
            // Handle API request failures or decoding errors 
            return null;
        }
    }
}

