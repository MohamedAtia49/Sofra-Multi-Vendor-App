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
                    <h2>Edit Settings</h2>
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
        <form action="{{ route('settings.update', $record->id) }}" method="post">
            @csrf
            @method('put')
            <label class="text-center">App Commissions</label>
            <input type="text" value="{{ $record->app_commissions_text }}" name="app_commissions_text" class="form-control form-control-lg mb-3" placeholder="App Commissions">
            <label class="text-center">About App</label>
            <textarea name="about_app" rows="4" class="form-control">{{ $record->about_app }}</textarea>
            <button type="submit" class="btn btn-primary btn-outline-warning">Update</button>
          </form>
    </div> <!-- card-body -->
</div> <!-- card -->
</div> <!-- col-md-8 -->
</div> <!-- row -->
</div>
@endsection
