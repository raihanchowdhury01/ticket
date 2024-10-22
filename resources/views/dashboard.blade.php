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
            <!-- small device menu -->
            <div>
                <nav class="my-5">
                    <div class="d-flex justify-content-between gap-5">
                        <ul class="sm_ul text-black">
                            <li><a href="{{ route('homepage') }}" class="text-black">Home</a></li>
                            <li><a href="{{ route('dashboard') }}" class="text-black">Profile</a></li>
                            <li><a href="{{ route('profile.update') }}" class="text-black">Profile Edit</a></li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <main>
            <!-- banner part design -->
            <div class="my-5">
                <img src="/img/home.png" alt class="home_banner">
            </div>
            {{-- user details --}}
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Mobile No.</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{Auth::user()->name}}</td>
                    <td>{{Auth::user()->phone}}</td>
                    <td>{{Auth::user()->address}}</td>
                    <td>{{Auth::user()->email}}</td>
                  </tr>
                </tbody>
              </table>
        </main>
        <!-- footer section design -->
        <footer>
            <p class="text-center">@copyright 2024</p>
        </footer>
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') }}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="{{ asset('script.js') }}"></script>
    </body>
</html>