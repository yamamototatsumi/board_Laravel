<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                  @if (isset($authgroup))
                  <a href={{ route('admin/user') }}>ユーザデータ管理</a>
                    @endif
                </div>
            </header>

            <!-- Page Content -->
            {{-- <main>
                {{ 'slot'}}
            </main> --}}
        </div>
    </body>
</html>


<!-- Right Side Of Navbar -->
<ul class="navbar-nav ml-auto">
  <!-- Authentication Links -->
  @if(!Auth::check() && (!isset($authgroup) || !Auth::guard($authgroup)->check()))
      @if (Route::has('login'))
          <li class="nav-item">
              @isset($authgroup)
              <a class="nav-link" href="{{ url("login/$authgroup") }}">{{ __('Login') }}</a>
              @else
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              @endisset
          </li>
      @endif

      @if (Route::has('register'))
      @isset($authgroup)
      @if (Route::has("$authgroup-register"))
          <li class="nav-item">
              <a class="nav-link" href="{{ route("$authgroup-register") }}">{{ __('Register') }}</a>
          </li>
      @endif
      @else
      @if (Route::has('register'))
          <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
      @endif
      @endisset
      @endif
  @else
      <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              @isset($authgroup)
              {{ Auth::guard($authgroup)->user()->name }}
              @else
              {{ Auth::user()->name }}
              @endisset
            @endif
          </a>