@extends('layouts.app')

@section('page_title')
    Settings
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>All Settings</h2>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div> <!-- card-header -->

    <div class="card-body text-center">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>value</th>
                    <th>Type</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <td>{{ $record->key }}</td>
                        <td>{{ $record->value }}</td>
                        <td>{{ $record->type }}</td>
                        <td><a class="btn btn-success" href="{{ route('settings.edit', $record->id) }}">Edit</a></td>
                        <td>
                            <form action="{{ route('settings.destroy', $record->id) }}" method="post">
                                @csrf
                                @method('Delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- card-body -->
</div> <!-- card -->
</div> <!-- col-md-8 -->
</div> <!-- row -->
</div>
@endsection
