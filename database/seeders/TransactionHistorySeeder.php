<?php

namespace Database\Seeders;

use App\Models\TransactionHistory;
use Illuminate\Database\Seeder;

class TransactionHistorySeeder extends Seeder
{
    public function run()
    {
        TransactionHistory::factory()->count(50)->create(); 
    }
}
