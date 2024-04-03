@extends('layouts.app')

@section('page_title')
    clients
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
                <th>City</th>
                <th>Active</th>
                <th>De Active</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->name }}</td>
                <td>{{ $record->email }}</td>
                <td>{{ $record->phone }}</td>
                <td>{{ $record->region->city->name }}</td>
                @if ($record->is_active == 0)
                <td>
                    <form action="{{ route('clients.active', $record->id) }}" method="post">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-success">Active</button>
                    </form>
                </td>
                <td>Not Active</td>
                @elseif ($record->is_active == 1)
                <td>Active</td>
                <td>
                    <form action="{{ route('clients.deActive', $record->id) }}" method="post">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-warning">De Active</button>
                    </form>
                </td>
                @endif
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
    </table>
@endsection
