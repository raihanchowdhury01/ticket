@extends('user.master')
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
                    {{-- message --}}
                    <div>
                        @if(session('success'))
                            <div style="color: green;">
                                {{ session('success') }}
                            </div>
                        @endif
                    
                        @if(session('error'))
                            <div style="color: red;">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                <!-- shopping product section design -->
                <div>
                    <div class="container mt-4">
                        @if ($items->count() > 0)
                        <div class="row">
                            @foreach ($items as $item)
                            <!-- Card -->
                            <div class="col-12 col-md-4 col-lg-3 mb-4">
                                <div class="card h-100">
                                    <img src="{{ url('Uploaded_Photo/'. $item->image) }}" class="card-img-top card-image fixed-size" alt="Product 1">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->name }}</h5>
                                        <p class="fs-2">Price: <span class="price" id="price-{{ $item->id }}">{{ $item->price }}</span> BDT</p>
                                        <p>Quantity:</p>
                                        <input type="number" id="quantity-{{ $item->id }}" class="quantity form-control mb-2" value="1" min="1">
                                        <a href="{{ route('BuyItem', $item->id) }}" class="buy" id="buy-{{ $item->id }}" class="btn btn-block add-to-cart" data-id="{{ $item->id }}">
                                        <button >Add to Cart</button></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif                    
                    </div>
                </div>
@endsection