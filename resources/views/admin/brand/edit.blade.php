@extends('admin.admin_master')

@section('admin')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brands

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
                        <div class="card-header"> Update Brand</div>
                        <div class="card-body">
                            <form action="{{ url('brand/update/' . $brands->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                                <div class="form-group m-2 p-2">
                                    <label class="m-2" for="brand_name"> Update Brand Name</label>
                                    <input type="text" class="form-control m-2 p-2" name="brand_name"
                                        value="{{ $brands->brand_name }}">

                                    @error('brand_name')

                                        <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>
                                <div class="form-group m-2">
                                    <label class="m-2" for="new_image"> Update Brand Image</label>
                                    <input class="form-control m-2 p-2" type="file" name="brand_image"
                                        value="{{ $brands->brand_image }}">

                                    @error('brand_image')

                                        <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>
                                <div class="form-group m-2 p-2">
                                    <img src="{{ asset($brands->brand_image) }}" style="width: 400px; height:200px;"
                                        alt="">
                                </div>

                                <button type="submit" class="btn btn-primary m-2">Edit Brand</button>
                            </form>

                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
