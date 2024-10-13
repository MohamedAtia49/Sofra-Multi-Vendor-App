@extends('layouts.app')

@section('page_title')
    Roles
@endsection

@section('content')
    @if (session('message'))
        <div class="alert alert-success text-center">
            <h1 class="text-success text-light">{{ session('message') }}</h1>
        </div>
    @elseif (session('deleted_message'))
        <div class="alert alert-danger text-center">
            <h1 class="text-success text-light">{{ session('deleted_message') }}</h1>
        </div>
    @endif
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if(count($records) > 0)
            @foreach ($records as $record)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->name }}</td>
                <td>
                    @foreach ($record->permissions as $permission)
                        <span class="badge text-sm bg-primary text-dark">{{ $permission->name }}</span>
                    @endforeach
                </td>
                <td><a href="{{ route('roles.edit', $record->id) }}" class="btn btn-success">Edit</a></td>
                <td><form action="{{ route('roles.destroy', $record->id) }}" method="post">
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
