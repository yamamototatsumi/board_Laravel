<!DOCTYPE html>
<html labg="ja">
<head>
<meta chrset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ asset('css/signUp.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<title>新規ユーザー登録</title>
</head>
<body>
  <div class="form-wrapper">
    <h1>新規ユーザー登録</h1>
    <form method="post" action="{{ url('preUsers/signUp') }}">
      @csrf
      <div class="form-item">
        <label for="email"></label>
        <input type="email" id="email" class="inputform" name="email" required="required" placeholder="ログインID(メールアドレス)">
        <p class="error_result"></p>
      </div>
      <div class="button-panel">
        <input type="submit" class="button" title="Sign In" id="submit" value="新規登録">
      </div>
      <p>※ご登録のメールアドレス宛に本登録用のURLが送信されます。</p>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="/js/singnup.js"></script>
</body>
</html>

