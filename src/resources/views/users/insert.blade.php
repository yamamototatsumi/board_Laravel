<!DOCTYPE html>
<html labg="ja">
<head>
<meta chrset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<title>新規ユーザー登録</title>
<link rel="stylesheet" href="{{ asset('css/signUp.css') }}">
</head>
<body>
  <div class="form-wrapper">
    <h1>新規会員登録</h1>
    <form method="post" action="{{ url('users/insert') }}">
      @csrf
      <div class="form-item">
        <label for="email"></label>
        <p class="inputform">ログインID：<?php echo $email["email"]?><p>
        <p class="error_result"></p>
      </div>
      <div class="form-item">
        <label for="password">半角英数10文字以上</label>
        <input type="password" id="pass1" class="inputform" name="pass" required="required" placeholder="パスワード">
        <p class="error_result"></p>
      </div>
      <div class="form-item">
        <label for="password2"></label>
        <input type="password" id="pass2" class="inputform" required="required" placeholder="パスワード再確認">
        <p class="error_result"></p>
      </div>
      <div class="form-item">
        <label for="name">半角英数8文字以上</label>
        <input type="text" name="name" id="nickname" class="inputform" required="required" placeholder="ニックネーム">
        <p class="error_result"></p>
      </div>
      <div class="button-panel">
        <?php echo '<input type="hidden" value="'.$email["email"].'" name="email">'?>
        <input type="submit" class="button" title="Sign In" id="submit" value="登録" disabled>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="/js/validation.js"></script>
</body>
</html>




