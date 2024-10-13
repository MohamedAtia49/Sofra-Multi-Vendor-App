@extends('layouts.app')

@section('page_title')
    Regions
@endsection

@section('content')
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Region</th>
                <th>City</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if (count($records) > 0)
            @foreach ($records as $record)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->name }}</td>
                <td>{{ $record->city->name }}</td>
                <td><a href="{{ route('regions.edit', $record->id) }}" class="btn btn-success">Edit</a></td>
                <td><form action="{{ route('regions.destroy', $record->id) }}" method="post">
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
@endsection
