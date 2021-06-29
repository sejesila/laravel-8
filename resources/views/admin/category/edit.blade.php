<x-app-layout>
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
                            <div class="card-header"> Update Category</div>
                            <div class="card-body">
                                <form action="{{ url('category/update/'.$categories->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group m-2">
                                        <label class="m-2" for="cat_name"> Update Category Name</label>
                                        <input type="text" class="form-control m-2" name="category_name" value="{{ $categories->category_name }}">

                                        @error('category_name')

                                            <span class="text-danger">{{ $message }}</span>

                                        @enderror

                                    </div>

                                    <button type="submit" class="btn btn-primary m-2">Edit Category</button>
                                </form>

                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </x-app-layout>
