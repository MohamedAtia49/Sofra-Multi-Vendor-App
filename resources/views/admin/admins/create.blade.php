@extends('layouts.app')

@section('page_title')
    Admin
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Add New Admin</h2>
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
        <form action="{{ route('admins.store') }}" method="post">
            @csrf
            <label class="text-center">Name</label>
            <input type="text" name="name" class="form-control form-control-lg mb-3" placeholder="Name">
            <label class="text-center">Email</label>
            <input type="email" name="email" class="form-control form-control-lg mb-3" placeholder="Email">
            <label class="text-center">Password</label>
            <input type="password" name="password" class="form-control form-control-lg mb-3" placeholder="Password">
            <label class="text-center">Password Confirmation</label>
            <input type="password" name="password_confirmation" class="form-control form-control-lg mb-3" placeholder="Password Confirmation">
            <label class="text-center">Add Role</label> <br>
            <input id="selectAll" type="checkbox"><label for='selectAll'> Select All </label>
            <div class="row mb-2">
                @foreach ($records as $record)
                    <div class="col-sm-3">
                        <label class="text-danger">
                            <input type="checkbox" value={{ $record->id }} name="roles[]"> {{ $record->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary btn-outline-warning">Create</button>
        </form>
    </div> <!-- card-body -->
</div> <!-- card -->
</div> <!-- col-md-8 -->
</div> <!-- row -->
</div>
@endsection

@push('scripts')
    <script>
        $("#selectAll").click(function() {
        $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });
    </script>
@endpush
