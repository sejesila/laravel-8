<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Multi Images

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card-group">
                        @foreach ($images as $multi )
                        <div class="col-md-4 mt-2">
                            <div class="card">
                                <img src="{{ asset($multi->image) }}" alt="">
                            </div>
                        </div>
                            
                        @endforeach
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header"> Multi Image</div>
                        <div class="card-body">
                            <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group m-2">

                                    <label class="m-2" for="image">Brand Image</label>
                                    <input class="form-control m-2" type="file" name="image[]" multiple>
                                    @error('image')

                                        <span class="text-danger m-2">{{ $message }}</span>

                                    @enderror

                                </div>

                                <button type="submit" class="btn btn-primary m-4">Add Image</button>
                            </form>

                        </div>


                    </div>
                </div>

            </div>
        </div>



    </div>
</x-app-layout>
