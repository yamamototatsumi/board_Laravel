<!DOCTYPE html>
<html labg="ja">
<head>
<meta chrset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<title>投稿一覧</title>
<link rel="stylesheet" href="{{ asset('css/poststyles.css') }}">
</head>
<body>
  <h1>新規投稿</h1>
  <form id="postform" action="newPost" method="POST">
    <div class="group">
      <input id="text3" type="text" name="title" id="title" class="postform" placeholder="タイトルを入力" required="required">
      <div class="text_underline"></div>
    </div>
  <textarea class="txt postform" id="main" name="content" placeholder="本文を入力" required="required"></textarea>
  <input type="submit"  value="投稿" class="button" id="submit">
  </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>

