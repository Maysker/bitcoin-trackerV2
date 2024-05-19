<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session('success'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    </div>
@endif

    <div style="margin-top: 30px;" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex justify-around p-6">
            <!-- User Information -->
            <div class="text-gray-900 dark:text-gray-100">
                <p><strong>Name:</strong> {{ $data['name'] }}</p>
                <p><strong>Balance:</strong> {{ $data['balance'] }}$</p>
                <p><strong>Bitcoin:</strong> {{ $data['btcBalance'] }}</p>
                <p><strong>BTC Rate:</strong> {{ $data['btcRate'] }}$</p>
                <p><strong>Portfoli worth:</strong> {{ $data['portfolioWorth'] }}$</strong></p>
            </div>

            <!-- Form -->
            <div style="margin-left: 5rem;" class="text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{ route('dashboard.handleForm') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="action" class="block text-lg font-medium text-white">Buy or sell Bitcoin</label>
                        <select class="form-control mt-1 block w-full text-black" id="action" name="action">
                            <option value="buy">Buy</option>
                            <option value="sell">Sell</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="block text-lg font-medium text-white">Amount:</label>
                        <input type="number" step="0.00000001" class="form-control mt-1 block w-full text-black" id="amount" name="amount" placeholder="Amount">
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-4 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
        
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
   <?php 
        // Start the session
        session_start();

        // Call the MailController funciton send
        $data = \App\Http\Controllers\MailController::send();

        // Display the price change details
        echo "24-Hour Price Change for Bitcoin (BTC/USDT): ". PHP_EOL;
        echo "<ul>";
        echo "<li>Price Change: ". $data['priceChange']. PHP_EOL. "</li>";
        echo "<li>Price Change Percent: ". $data['priceChangePercent']. "%". PHP_EOL. "</li>";
        echo "</ul>";
        ?>
                </div>
            </div>
        </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-start">
            <a href="{{ route('transactions.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Transactie Geschiedenis
            </a>
        </div>
    </div>
</div>
    
</x-app-layout>
