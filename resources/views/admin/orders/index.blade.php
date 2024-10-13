@extends('layouts.app')

@section('page_title')
    clients
@endsection

@section('content')
    <div class="row">
        <div class="col-8">
            <form action="" method="get">
                <div class="row">
                    <div class="col-4">
                        <div class="input-group mb-3 ml-3">
                            <input type="text" class="form-control" name='search' value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4">
            <h5> <a href="{{ route('generate.pdf') }}"><i class="fas fa-print">Print</i></a> </h5>
        </div>
    </div>
    <table class="table table-striped table-hover table-bordered">
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
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if (count($records) > 0)
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
                <td>
                    <form action="{{ route('clients.destroy', $record->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        @else
            No data found
        @endif
    </table>
    {{ $records->links() }}
@endsection
