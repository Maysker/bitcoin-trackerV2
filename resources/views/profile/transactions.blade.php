<x-app-layout>
    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 20px;">
        <h1 class="page-title">Transactiegeschiedenis</h1>
        <!-- Connect CSS DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th style="color: #ffffff;">Datum</th>
                    <th style="color: #ffffff;">Type</th>
                    <th style="color: #ffffff;">Aantal</th>
                    <th style="color: #ffffff;">Prijs per eenheid</th>
                    <th style="color: #ffffff;">Totale kosten</th>
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

   <!-- Connect jQuery and JS DataTables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <!-- Additional styles -->
    <style>
        .page-title {
            font-size: 1.5em;
            color: #ffffff;
            text-align: center;
            margin-bottom: 20px;
        }
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: #ffffff; 
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #ffffff !important;
        }
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            color: #000000; 
            background-color: #ffffff;
        }
        .dataTables_length select {
            padding-right: 20px;
            width: 55px;
        }
    </style>
</x-app-layout>
