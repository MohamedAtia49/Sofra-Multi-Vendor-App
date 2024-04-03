@extends('layouts.app')

@section('page_title')
    Offers
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
                <th>Meal Name</th>
                <th>Meal Description</th>
                <th>Meal Image</th>
                <th>Date From</th>
                <th>Date To</th>
                <th>Restaurant Name</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->meal_name }}</td>
                <td>{{ $record->meal_description }}</td>
                <td>{{ $record->meal_image }}</td>
                <td>{{ $record->date_from }}</td>
                <td>{{ $record->date_to }}</td>
                <td>{{ $record->restaurant->name }}</td>
                <td><form action="{{ route('contacts.destroy', $record->id) }}" method="post">
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
