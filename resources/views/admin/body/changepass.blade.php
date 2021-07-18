@extends('admin.admin_master')

@section('admin')
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Update Password</h2>
        </div>
        @if (session('error'))

            <div class="alert alert-danger" role="alert">
                <strong>{{ session('error') }}</strong>

                <hr>

            </div>

        @endif
        <div class="card-body">
            <form method="post" action="{{route('password.update')}}" class="form-pill">
                @csrf

                <div class="form-group">
                    <label for="exampleFormControlPassword3">Current Password</label>
                    <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password">
                    @error('current_password')
                    <span class="text-dange">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Confirm New Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                </div>

                <button type="submit" class="btn btn-primary m-2">Change </button>

            </form>
        </div>
    </div>

@endsection