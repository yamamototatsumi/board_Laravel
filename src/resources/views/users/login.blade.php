<!DOCTYPE html>
<html labg="ja">
<head>
<meta chrset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<title>ログイン画面</title>
</head>
<body>
  <div class="form-wrapper">
    <h1>ログイン</h1>
    <form action="users/login" method="post">
      <div class="form-item">
        <label for="email"></label>
        <input type="email" name="login_email" required="required" placeholder="ログインID"></input>
      </div>
      <div class="form-item">
        <label for="password"></label>
        <input type="password" name="login_pass" required="required" placeholder="パスワード"></input>
      </div>
      <div class="button-panel">
        <input type="submit" class="button" title="Sign In" value="ログイン" ></input>
      </div>
    </form>
    <div class="form-footer">
      <p><a href="/preUsers/signUp">アカウント新規作成</a></p>
      <p><a href="#">パスワードをお忘れですか？</a></p>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
