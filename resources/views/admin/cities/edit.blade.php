@extends('layouts.app')

@section('page_title')
    Cities
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Edit City</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div> <!-- card-header -->

    <div class="card-body text-center">
        <form action="{{ route('cities.update', $record->id) }}" method="post">
            @csrf
            @method('put')
            <label class="text-center">City Name</label>
            <input type="text" value="{{ $record->name }}" name="name" class="form-control form-control-lg mb-3" placeholder="City Name">
            <button type="submit" class="btn btn-primary btn-outline-warning">Update</button>
        </form>
    </div> <!-- card-body -->
</div> <!-- card -->
</div> <!-- col-md-8 -->
</div> <!-- row -->
</div>
@endsection
