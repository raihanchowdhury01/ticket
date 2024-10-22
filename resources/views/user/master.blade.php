<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <link rel="shortcut icon" href="{{ url('/img/lottery.jpeg') }}" type="image/x-icon">
        <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="{{ asset('https://kit.fontawesome.com/cc76e3cc3d.js') }}" crossorigin="anonymous"></script>

        <!-- stylesheet -->
        <link rel="stylesheet" href="{{ asset('style.css') }}">
    </head>
    <body>

        <!-- <i class="fa-solid fa-bars"></i>
    <i class="fa-solid fa-xmark"></i> -->
        <header>
            <!-- small device menu -->
            <div>
                <nav class="my-5">
                    <div class="d-flex justify-content-between gap-5">
                        <ul class="sm_ul">
                            <li><a href="{{ asset('/') }}" class="text-black">Home</a></li>
                            <li><a href="{{ asset('/') }}" class="text-black">Shop</a></li>
                            <li><a href="{{ asset('ticket') }}" class="text-black">Ticket</a></li>
                            
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
        </header>

        <main class="container">
            @yield('body_content')
        </main>

        <!-- footer section design start from here -->
         <footer>
            <p class="text-center">@copyright 2024</p>
         </footer>
         <script src="{{ asset('script.js') }}"></script>
         <script>
            // লোকাল স্টোরেজ থেকে ডেটা রিট্রিভ করে দেখানো
            const sum = localStorage.getItem('total_price');
            document.getElementById('sum').value = sum;
        </script>
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') }}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>