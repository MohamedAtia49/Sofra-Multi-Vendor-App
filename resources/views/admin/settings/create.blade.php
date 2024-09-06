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
                    <h2>Create Setting</h2>
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
        <form action="{{ route('settings.store') }}" method="post">
            @csrf
            @method('post')
            <label class="text-center">Key Name</label>
            <input type="text"  name="key" class="form-control form-control-lg mb-3" placeholder="Key Name">
            <label class="text-center">Value</label>
            <textarea name="value" rows="4" class="form-control mb-3"></textarea>
            <select name="type" class="form-control mb-3">
                <option value="" selected disabled>Type</option>
                @foreach ($types as $type)
                        <option>{{ $type}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-outline-warning">Create</button>
        </form>
    </div> <!-- card-body -->
</div> <!-- card -->
</div> <!-- col-md-8 -->
</div> <!-- row -->
</div>
@endsection
