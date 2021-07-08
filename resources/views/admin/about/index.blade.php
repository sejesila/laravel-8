@extends('admin.admin_master')

@section('admin')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Contents

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h3>Home About</h3>
                <a href="{{ route('about.add') }}"><button class="btn btn-info m-4">Add About Us</button></a>
                <br>
                <div class="col-md-12">
                    <div class="card">
                        @if (session('success'))

                            <div class="alert alert-success" role="alert">
                                <strong>{{ session('success') }}</strong>

                                <hr>

                            </div>

                        @endif

                        <div class="card-header"> All About Us</div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">ID</th>
                                    <th scope="col" width="15%">About Us Title</th>
                                    <th scope="col" width="25%">Short Desc</th>
                                    <th scope="col" width="15%">Long Desc</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php($i = 1)



                                @foreach ($about as $row)

                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->short_desc }}</td>
                                        <td>{{ $row->long_desc }}</td>
                                        <td>
                                            <a href="{{ url('about-us/edit/' . $row->id) }}" class="btn btn-info">Edit
                                            </a>

                                            <a href="{{ url('about-us/' . $row->id) }}" class="btn btn-danger"
                                                onclick="return confirm('Are you sure yo want to delete this brand?')">Delete
                                            </a>

                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
