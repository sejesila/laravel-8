@extends('admin.admin_master')

@section('admin')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Categories

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        @endif
                        <div class="card-header"> Update About Us</div>
                        <div class="card-body">
                            <form action="{{ url('about-us/update/'.$data->id) }}" method="POST">
                                @csrf
                                <div class="form-group m-2">
                                    <label class="m-2" for="title"> Update About Us Title</label>
                                    <input type="text" class="form-control m-2" name="title"
                                        value="{{ $data->title }}">                                   

                                </div>
                                <div class="form-group m-2">
                                    <label class="m-2" for="short_desc"> Short Desc</label>
                                    <input type="text" class="form-control m-2" name="short_desc"
                                        value="{{ $data->short_desc }}">

                                   

                                </div>
                                <div class="form-group m-2">
                                    <label class="m-2" for="long_desc"> Long Desc</label>
                                    <input type="text" class="form-control m-2" name="long_desc"
                                        value="{{ $data->long_desc }}">

                                   

                                </div>

                                <button type="submit" class="btn btn-primary m-2">Edit </button>
                            </form>

                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
