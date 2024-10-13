@extends('layouts.app')

@section('page_title')
    Restaurants
@endsection

@section('content')
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
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Image</th>
                <th>Minimum Charge</th>
                <th>Whats Up</th>
                <th>City</th>
                <th>Show</th>
                <th>Active</th>
                <th>De Active</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if (count($records) > 0)
            @foreach ($records as $record)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->name }}</td>
                <td>{{ $record->email }}</td>
                <td>{{ $record->phone }}</td>
                <td>{{ $record->image }}</td>
                <td>{{ $record->minimum_charge }}</td>
                <td>{{ $record->whats_up }}</td>
                <td>{{ $record->region->city->name }}</td>
                <td><a class="btn btn-primary" href="#">Show</a></td>
                @if ($record->is_active == 0)
                <td>
                    <form action="{{ route('restaurants.active', $record->id) }}" method="post">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-success">Active</button>
                    </form>
                </td>
                <td>Not Active</td>
                @elseif ($record->is_active == 1)
                <td>Active</td>
                <td>
                    <form action="{{ route('restaurants.deActive', $record->id) }}" method="post">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-warning">De Active</button>
                    </form>
                </td>
                @endif
                <td>
                    <form action="{{ route('restaurants.destroy', $record->id) }}" method="post">
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
