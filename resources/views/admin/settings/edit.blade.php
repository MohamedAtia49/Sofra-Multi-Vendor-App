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
                    <h2>Edit Setting</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div> <!-- card-header -->

    <div class="card-body text-center">
        <form action="{{ route('settings.update',$record->id) }}" method="post">
            @csrf
            @method('PUT')
            <label class="text-center">Key Name</label>
            <input type="text" name="key" value="{{ $record->key }}" class="form-control form-control-lg mb-3" placeholder="Key Name">
            <label class="text-center">Value</label>
            <textarea name="value" rows="4" class="form-control mb-3">{{ $record->value }}</textarea>
            <select name="type" class="form-control mb-3">
                <option value="" readonly disabled>Type</option>
                @foreach ($types as $type)
                        <option value="{{ $type }}" @if($setting_type == $type) selected @endif>{{ $type }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-outline-warning">Update</button>
        </form>
    </div> <!-- card-body -->
</div> <!-- card -->
</div> <!-- col-md-8 -->
</div> <!-- row -->
</div>
@endsection
