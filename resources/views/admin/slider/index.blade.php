@extends('admin.admin_master')

@section('admin')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Sliders

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h3>Home Slider</h3>
                <a href="{{ route('slider.add') }}"><button class="btn btn-info m-4">Add Slider</button></a>
                <br>
                <div class="col-md-12">
                    <div class="card">
                        @if (session('success'))

                            <div class="alert alert-success" role="alert">
                                <strong>{{ session('success') }}</strong>

                                <hr>

                            </div>

                        @endif

                        <div class="card-header"> All Sliders</div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">ID</th>
                                    <th scope="col" width="15%">Slider Title</th>
                                    <th scope="col" width="25%">Slider Desc</th>
                                    <th scope="col" width="15%">Slider Image</th>        
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php($i = 1) 
                                                                  
                                

                                @foreach ($sliders as $row)

                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td><img src="{{ asset($row->image) }}" alt="{{ $row->name }}"
                                                style="height: 40px; width:70px;"></td>
                                        
                                        <td>

                                            <a href="{{ url('slider/edit/' . $row->id) }}" class="btn btn-info">Edit
                                            </a>


                                            <a href="{{ url('slider/' . $row->id) }}" class="btn btn-danger"
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
