<link rel="stylesheet" href="{{ asset('css/stylesHeadder.css') }}">
<div class="msg">
  <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">マイページ</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ログイン</a>
                @if (Route::has('register'))
                    <a href="/users/insert" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">新規登録</a>
                @endif
            @endauth
        </div>
    @endif
</div>
  <h1 class="headline"><a>みんなの掲示板</a></h1>
  <ul class="nav-list">
    <div class="A">
      <li><a href="/users/mypage" class="nav-list-item navI">ホーム</a></li>
      <li><a href="/articles/index" class="nav-list-item navI">投稿一覧</a></li>
      <li><a href="/articles/insert" class="nav-list-item navI">新規投稿</a></li>
    </div>
  </ul>
    {{-- <h3>adminLink</h3> --}}
</html>
