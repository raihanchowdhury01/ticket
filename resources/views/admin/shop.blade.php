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
                        @if ($items->count()>0)
                        <div class="row">
                            @foreach ($items as $item)
                            <!-- Card 1 -->
                            <div class="col-6 col-md-4 col-lg-2 mb-4">
                                <div class="card h-100">
                                    <img src="{{ url('Uploaded_Photo/'. $item->image) }}" class="card-img-top card-image fixed-size" alt="Product 1">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$item->name}}</h5>
                                        <p>Price: <span id="price">{{$item->price}}</span></p>
                                        <p>Quantity:</p>
                                        <input type="number" name="number" id="number" value="1" min="1" class="form-control mb-2">
                                        {{-- <a href="{{ route('BuyItem', $item->id) }}" target="_blank"><button id="buy" class="btn btn-primary btn-block">Add to Cart</button></a> --}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
@endsection