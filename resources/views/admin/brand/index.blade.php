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


                        <div class="card-header"> All Brands</div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($brands as $brand)

                                    <tr>
                                        <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td><img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_name }}"
                                                style="height: 40px; width:70px;"></td>
                                        <td>
                                            @if ($brand->created_at == null)

                                                <span class="text-danger">No Date Set</span>

                                            @else

                                                {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>

                                            <a href="{{ url('brand/edit/' . $brand->id) }}" class="btn btn-info">Edit
                                            </a>


                                            <a href="{{ url('brand/' . $brand->id) }}" class="btn btn-danger"
                                                onclick="return confirm('Are you sure yo want to delete this brand?')">Delete
                                            </a>

                                        </td>
                                    </tr>

                                @endforeach



                            </tbody>

                        </table>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> Add Brand</div>
                        <div class="card-body">
                            <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group m-2">
                                    <label class="m-2" for="brand_name">Brand Name</label>

                                    <input type="text" class="form-control m-2" name="brand_name">
                                    @error('brand_name')

                                        <span class="text-danger m-2">{{ $message }}</span>

                                    @enderror
                                    <label class="m-2" for="brand_name">Brand Image</label>
                                    <input class="form-control m-2" type="file" name="brand_image">
                                    @error('brand_image')

                                        <span class="text-danger m-2">{{ $message }}</span>

                                    @enderror




                                </div>

                                <button type="submit" class="btn btn-primary m-4">Add Brand</button>
                            </form>

                        </div>


                    </div>
                </div>

            </div>
        </div>



    </div>
@endsection
