<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ticket Page</title>
        <link rel="shortcut icon" href="{{ url('/img/lottery.jpeg') }}" type="image/x-icon">
        <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="{{ asset('https://kit.fontawesome.com/cc76e3cc3d.js') }}" crossorigin="anonymous"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- stylesheet -->
        <link rel="stylesheet" href="{{ asset('style.css') }}">
    </head>
    <body>
        <header>
            <!-- large device menu -->
            <div class="d-none d-md-block">
                <nav class="my-5 container">
                    <div class="d-flex justify-content-between gap-5">
                        <ul class="sm_ul">
                            <li><a href="{{ asset('/') }}" class="text-black">Home</a></li>
                            <li><a href="{{ asset('/') }}" class="text-black">Shop</a></li>
                            <li><a href="{{ route('ticketPage') }}" class="text-black">Ticket</a></li>
                            
                        </ul>
                        <div>
                            @if (Route::has('login'))
                                <nav class="-mx-3 d-flex flex-1 justify-content-end">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class=" text-black text-decoration-none" > Dashboard </a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                        
                                            <x-responsive-nav-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-responsive-nav-link>
                                        </form>
                                        @else
                                            <a href="{{ route('login') }}" class="px-3 py-2 text-black text-decoration-none" > Log in </a>
                    
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="px-3 py-2 text-black text-decoration-none" > Register </a>
                                        @endif
                                    @endauth
                                </nav>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
            <!-- small device menu -->
            {{-- this code aren't working in live server --}}
            <i class="fa-solid fa-bars fs-1 openBar d-block d-md-none"></i>
            <div class="scale openMenu d-md-none d-block">
                <i class="fa-solid fa-x text-white p-3 closeBar"></i>
                <nav class="my-5 container">
                    <div class="gap-5">
                        <div>
                            @if (Route::has('login'))
                                <nav class="">
                                    <ul class="sm_ul px-3 py-2">
                                        <li><a href="{{ asset('/') }}">Home</a></li>
                                        <li><a href="{{ asset('/') }}">Shop</a></li>
                                        <li><a href="{{ asset('ticket') }}">Ticket</a></li>
                                        
                                    </ul>
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="text-decoration-none ath" > Dashboard </a>
                                        <form method="POST" action="{{ route('logout') }}" class="ath">
                                            @csrf
                                        
                                            <x-responsive-nav-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-responsive-nav-link>
                                        </form>
                                        @else
                                        <div>
                                            <a href="{{ route('login') }}" class="px-3 py-2 text-decoration-none ath" > Log in </a>
                                        </div>
                    
                                        @if (Route::has('register'))
                                        <div>
                                            <a href="{{ route('register') }}" class="px-3 py-2 text-decoration-none ath"> Register </a>
                                        </div>
                                        @endif
                                    @endauth
                                </nav>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <main>
            <!-- banner part design -->
            <div class="my-5">
                <img src="/img/home.png" alt class="home_banner">
            </div>
            <!-- instruction section design -->
            <div>
                <p class="text-center fs-3 font-monospace">Purchase your ticket and get your gift.</p>
            </div>
            {{-- lottery ticket purchase part design start from here --}}
            <div class="ticket_container my-5">
                @if ($items->count()>0)
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Ticket Name</th>
                        <th scope="col">Purchace Product</th>
                        <th scope="col">Unit Amount(BDT)</th>
                        <th scope="col">Total Amount(BDT)</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <th scope="row">{{$item->name}}</th>
                                <td>{{$item->item}}</td>
                                <td>{{$item->unit}}</td>
                                <td>{{$item->amount}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                @endif
            </div>
        </main>
        <!-- footer section design -->
        <footer>
            <p class="text-center">@copyright 2024</p>
        </footer>
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') }}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="{{ asset('script.js') }}"></script>
        <script>
            // small device menu bar slide script
            const openBtn = document.querySelector(".openBar");
            const closeBtn = document.querySelector(".closeBar");
            const openMenu = document.querySelector(".openMenu");
            openBtn.addEventListener("click", ()=>{
                openMenu.classList.remove('scale');
                openMenu.classList.add('scales');
            });
            closeBtn.addEventListener("click", ()=>{
                openMenu.classList.remove('scales');
                openMenu.classList.add('scale');
            });
        </script>
    </body>
</html>
