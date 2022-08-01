<!DOCTYPE html>
<html labg="ja">
<head>
<meta chrset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<title>マイページ</title>
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
  <div class="mainarea">
    <?PHP
      echo '<a href="" class="btn btn-flat"><span>'.$this->data["name"].'</span></a><br><br><br>';
      echo '<a href="updateUser" class="btn btn-flat"><span>情報変更</span></a><br><br><br>';
      echo '<a href="article"  class="btn btn-flat"><span>投稿一覧</span></a><br><br><br>';
      echo '<a href="newPost" class="btn btn-flat"><span>新規投稿</span></a>';
    ?>
    <?php
      echo '<p class="registerCount">今月の登録者数:'.$this->data["usercount"].'人</p>';
      echo '<p class="registerCount">今月の投稿記事者数:'.$this->data["articlecount"].'件</p>';

    ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>