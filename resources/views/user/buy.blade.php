@extends('user.master')
@section('title')
    Buy Item
@endsection

@section('body_content')
<!-- banner part design -->
<div class="my-5">
    <img src="{{ url('/img/home.png') }}" alt class="home_banner">
</div>
<!-- instruction section design -->
<div>
    <p class="text-center fs-3 font-monospace">Buy anyone product
        and get your gift.</p>
    </div>
    <!-- shopping product section design -->
    <div>
        <!-- Product Purchase Form -->
        <div class="container mt-5">
                <!-- Show success message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Show validation errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <h2 class="text-center mb-4">Shop Product Purchase</h2>
                    <form action="{{ route('storePage') }}" method="POST" class="form">
                        @csrf

                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <p>Your Ticket Name:</p>
                                <input type="text" name="name" id="" value="{{old('name')}}" required>
                            </div>
                            <!-- Number -->
                            <div class="col-md-6 mb-3">
                                <p>Your Contact Number:</p>
                                <input type="number" name="number" id="" value="{{old('number')}}" required>
                                @error('number')
                                    <p class="text-danger">Input your valid phone number</p>
                                @enderror
                            </div>
                            <!-- Product Name -->
                            <div class="col-md-6 mb-3">
                                <p>Product Name:</p>
                                <input type="text" name="product_name" value="{{$item->name}}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Price Per Unit -->
                            <div class="col-md-6 mb-3">
                                <p>Price Per Unit (BDT):</p>
                                <input type="number" name="unit_price" value="{{$item->price}}" readonly>
                            </div>
                            <!-- Total Amount -->
                            <div class="col-md-6 mb-3">
                                <label for="totalAmount" class="form-label">Total Amount (BDT)</label><br>
                                <input type="number" name="sum_price" id="sum" readonly>
                            </div>
                        </div>

                        <!-- Calculate Button -->
                            <button type="submit" class="btn btn-primary">Pay now</button>
                    </form>
                </div>
                
            </div>
@endsection