<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('build/assets/app-1bd03d06.css') }}">
    <title>Document</title>
</head>
<body>
    <style>
            /* Base table styles */
            .custom-table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
                border-collapse: collapse;
            }

            /* Zebra-striping */
            .custom-table tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            /* Hover effect */
            .custom-table tr:hover {
                background-color: #e9e9e9;
            }

            /* Border */
            .custom-table {
                border: 1px solid #ddd;
            }

            .custom-table th,
            .custom-table td {
                border: 1px solid #ddd;
                padding: 8px;
            }

            .custom-table th {
                background-color: #f2f2f2;
            }
    </style>
    <table class="custom-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Meal</th>
                <th>Quantity</th>
                <th>Note</th>
                <th>Payment Method</th>
                <th>State</th>
                <th>Client</th>
                <th>Restaurant</th>
                <th>Total Price</th>
                <th>Commission</th>
                <th>Net Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->name }}</td>
                <td>{{ $record->phone }}</td>
                <td>{{ $record->address }}</td>
                <td>
                    @foreach ($record->meals as $meal)
                        {{ $meal->name }}
                    @endforeach
                </td>
                <td>
                    @foreach ($record->meals as $meal)
                        {{ $meal->pivot->quantity }}
                    @endforeach
                </td>
                <td>{{ $record->note }}</td>
                <td>{{ $record->payment_method }}</td>
                @if ($record->state == 'pending')
                    <td class="badge text-sm bg-warning text-dark mt-3 ml-3">{{ $record->state }}</td>
                @elseif ($record->state == 'accepted')
                    <td class="badge text-sm bg-success text-dark mt-3 ml-3">{{ $record->state }}</td>
                @elseif ($record->state == 'rejected')
                    <td class="badge text-sm bg-danger text-dark mt-3 ml-3">{{ $record->state }}</td>
                @elseif ($record->state == 'declined')
                    <td class="badge text-sm bg-danger text-dark mt-3 ml-3">{{ $record->state }}</td>
                @elseif ($record->state == 'delivered')
                    <td class="badge text-sm bg-primary text-dark mt-3 ml-3">{{ $record->state }}</td>
                @endif
                <td>{{ $record->client->name }}</td>
                <td>{{ $record->restaurant->name }}</td>
                <td>{{ $record->total_price }}</td>
                <td>{{ $record->commission }}</td>
                <td>{{ $record->net }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
