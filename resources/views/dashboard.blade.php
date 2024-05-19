<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p><strong>Name:</strong> {{ $data['name'] }}</p>
                    <p><strong>Balance:</strong> {{ $data['balance'] }}$</p>
                    <p><strong>Bitcoin:</strong> {{ $data['btcBalance'] }}</p>
                    <p><strong>BTC:</strong> {{ $data['btcRate'] }}$</p>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('dashboard.handleForm')}}">
                        @csrf
                        <div>
                            <label for="action">Buy or sell Bitcoin</label>
                            <select class="form-control" id="action" name="action">
                                <option value="buy">Buy</option>
                                <option value="sell">Sell</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="number" step="0.00000001" class="form-control" id="amount" name="amount" placeholder="Amount">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
</x-app-layout>
