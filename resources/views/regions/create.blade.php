@extends('layouts.app')

@section('page_title')
    Regions
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Add New Region</h2>
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
        <form action="{{ route('regions.store') }}" method="post">
            @csrf
            <label class="text-center">Regions Name</label>
            <input type="text" name="name" class="form-control form-control-lg mb-3" placeholder="Region Name">
            <label class="text-center">Regions City</label>
            <select name="city_id" class="form-control mb-3">
                <option value="" disabled selected>City</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-outline-warning">Save</button>
          </form>
    </div> <!-- card-body -->
</div> <!-- card -->
</div> <!-- col-md-8 -->
</div> <!-- row -->
</div>
@endsection
