<x-app-layout>
    <div class="text-gray-900 dark:text-gray-100">
        <h1>Transactiegeschiedenis</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Type</th>
                    <th>Aantal</th>
                    <th>Prijs per eenheid</th>
                    <th>Totale kosten</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->buySell }}</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->rate }}</td>
                    <td>{{ $transaction->amount * $transaction->rate }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
