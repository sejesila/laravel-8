@extends('admin.admin_master')

@section('admin')

    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Add Contact</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Address</label>
                        <input type="text" class="form-control" name="address">

                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Email</label>
                        <input class="form-control" name="email" type="email"></input>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Phone</label>
                        <input type="tel" class="form-control" name="phone"></input>
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
