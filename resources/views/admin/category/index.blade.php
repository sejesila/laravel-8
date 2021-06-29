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
                        <div class="card-header"> All Category</div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID Number</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- @php($unique_id = 1) --}}

                                    @foreach ($categories as $category)
                                      <tr>
                                            <th scope="row">{{ $categories->firstItem()+$loop->index}}</th>
                                            <td>{{ $category->category_name }}</td>
                                            {{-- <td>{{ $category->user_id }}</td> --}}
                                      {{--  Eloquent --}}      <td>{{ $category->user->name }}</td>

                                     {{--   <td>{{ $category->name }}</td> using query builder --}}

                                            <td>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td>
                                            <td>

                                                    <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>


                                                    <a href="" class="btn btn-danger">Edit</a>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>
                            {{ $categories->links() }} {{-- pagination --}}



                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"> Add Category</div>
                            <div class="card-body">
                                <form action="{{ route('store.category') }}" method="POST">
                                    @csrf
                                    <div class="form-group m-2">
                                        <label class="m-2" for="cat_name">Category Name</label>
                                        <input type="text" class="form-control m-2" name="category_name">

                                        @error('category_name')

                                            <span class="text-danger">{{ $message }}</span>

                                        @enderror

                                    </div>

                                    <button type="submit" class="btn btn-primary m-2">Add Category</button>
                                </form>

                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </x-app-layout>
