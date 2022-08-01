<!DOCTYPE html>
<html labg="ja">
<head>
<meta chrset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ログイン画面</title>
<link rel="stylesheet" href="{{ asset('css/articleList.css') }}">
</head>
<body>
  <?php
    foreach ( $this->data as $row ) {
      if(!(isset($row['deleted_at']))){
        echo "<div class= 'kiji'><p class ='row row2'>"."タイトル:".$row["title"]. "</p>";
        echo  "<p class ='row row3'>"."内容:".nl2br($row['content']). "</p>"; 
        echo "<p class ='row row4'>"."投稿者".$row['name']. "</p>";
        echo "<p class ='row row5'>"."投稿日時".$row['created_at']. "</p>";
        echo "<a href='comment?id=".$row['id']."'>コメント</a>";
        echo"</div>";
      }
    };
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>