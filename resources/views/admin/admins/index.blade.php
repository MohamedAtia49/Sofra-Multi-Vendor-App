@extends('layouts.app')

@section('page_title')
    Admin
@endsection

@section('content')
    @if (session('message'))
        <div class="alert alert-success text-center">
            <h1 class="text-success text-light">{{ session('message') }}</h1>
        </div>
    @elseif (session('cant_delete_super_admin'))
        <div class="alert alert-warning text-center">
            <h1 class="text-success text-light">{{ session('cant_delete_super_admin') }}</h1>
        </div>
    @elseif (session('deleted_message'))
        <div class="alert alert-danger text-center">
            <h1 class="text-success text-light">{{ session('deleted_message') }}</h1>
        </div>
    @endif
    <table class="table table-striped table-hover table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Permission</th>
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
                <td>{{ $record->email }}</td>
                <td>
                    @foreach($record->roles as $role)
                        <span class="badge text-sm bg-primary text-dark @if ($role->name == "super admin") bg-warning @endif">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach ($record->roles as $role)
                        @foreach ($role->permissions as $permission)
                            <span class="badge text-sm bg-gradient-maroon text-light">{{ $permission->name }}</span>
                        @endforeach
                    @endforeach
                </td>
                <td><a href="{{ route('admins.edit', $record->id) }}" class="btn btn-success">Edit</a></td>
                <td><form action="{{ route('admins.destroy', $record->id) }}" method="post">
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
