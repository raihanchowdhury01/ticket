@extends('admin.master')
@section('title')
    Home Page
@endsection
@section('body_content')
                <!-- banner part design -->
                <div class="my-5">
                    <img src="{{ asset('/img/home.png') }}" alt class="home_banner">
                </div>
                <!-- instruction section design -->
                <div>
                    <p class="text-center fs-3 font-monospace">Buy anyone product and get your gift.</p>
                </div>
                <!-- shopping product section design -->
                <div>
                    <div class="container mt-4">
                        <form action="{{ route('updatePage', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="photo" class="form-label">Product Photo</label>
                                <input type="file" name="photo" class="form-control" id="photo">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" name="name" value="{{$item->name}}" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Product Price</label>
                                <input type="number" name="price" value="{{$item->price}}" class="form-control" id="price">
                            </div>
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </form>                        
                    </div>
                </div>
@endsection