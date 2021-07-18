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
                <h3>Contact Page</h3>
                <a href="{{ route('contact.add') }}">
                    <button class="btn btn-info m-4">Add Contacts</button>
                </a>
                <br>
                <div class="col-md-12">
                    <div class="card">
                        @if (session('success'))

                            <div class="alert alert-success" role="alert">
                                <strong>{{ session('success') }}</strong>

                                <hr>

                            </div>

                        @endif

                        <div class="card-header"> All Contact Data</div>


                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">ID</th>
                                <th scope="col" width="15%">Address</th>
                                <th scope="col" width="25%">Email</th>
                                <th scope="col" width="15%">Phone</th>
                                <th scope="col" width="15%">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php($i = 1)



                            @foreach ( $contacts as $row)

                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $row->address }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>
                                        <a href="{{ url('contact/edit/' . $row->id) }}" class="btn btn-info">Edit
                                        </a>

                                        <a href="{{ url('contact/' . $row->id) }}" class="btn btn-danger"
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
