<!DOCTYPE html>
<html labg="ja">
<html>
<head>
  <title>@yield('title')</title>
  @yield('css')

</head>

<body>
  <header>
    @include('includes.header')
  </header>

  <main>
    @yield('content')
  </main>

  <footer>
    @include('includes.footer')
  </footer>
</body>

</html>