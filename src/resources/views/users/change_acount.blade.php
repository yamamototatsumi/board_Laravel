<!DOCTYPE html>
<html labg="ja">
<head>
<meta chrset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<title>ログイン画面</title>
<link rel="stylesheet" href="{{ asset('css/changeAcount.css') }}">
</head>
<body>
  <form action="updateUser" method="POST">
    <h1>ユーザー情報変更</h1>
    <p>現在のユーザー名</p> 
    <?PHP 
        echo $this->data["name"]; 
    ?>
    <p>新しいユーザー名:</p>
    <input type='text' id="newname" name='name' class="ca_inputform"><br>
    <p class="change_acount_error_result">半角英数8文字以上</p>
    <p>現在のパスワード</p>
    <input type= "password" id="oldpass" name="oldpass" class="ca_inputform"><br>
    <p class="change_acount_error_result">半角英数10文字以上</p>
    <p>新しいパスワード</p>
    <input type= "password" id="newpass" name="pass" class="ca_inputform"><br>
    <p class="change_acount_error_result">半角英数10文字以上</p>
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']) ?>"></input>
    <input type="submit" value="変更する" id="change_acount_submit" disabled>
  </form>
  <script src="/js/changeAcount.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
