<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <p><strong>Name:</strong> {{ $data['name'] }}</p>
                <p><strong>Balance:</strong> {{ $data['balance'] }}$</p>
                <p><strong>Bitcoin:</strong> {{ $data['btcBalance'] }}</p>
                <p><strong>BTC Rate:</strong> {{ $data['btcRate'] }}$</p>
            </div>
            <div class="py-12">
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif


                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('dashboard.handleForm') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="action">Buy or sell Bitcoin</label>
                            <select class="form-control mt-1 block text-black" id="action" name="action">
                                <option value="buy">Buy</option>
                                <option value="sell">Sell</option>
                            </select>
                        </div>
                
                        <div class="mb-4">
                            <label for="amount">Amount:</label>
                            <input type="number" step="0.00000001" class="form-control mt-1 block text-black" id="amount" name="amount" placeholder="Amount">
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
                    </form>
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

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        
        </div>
    </div>
</x-app-layout>
