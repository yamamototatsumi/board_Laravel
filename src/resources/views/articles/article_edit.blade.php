<!DOCTYPE html>
<html labg="ja">
<head>
  <meta chrset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <title>投稿編集</title>
  <link rel="stylesheet" href="{{ asset('css/articleEdit.css') }}">
</head>
<body>
  <div class="articleBody">
    <div class="articleOld"> 
      <p>タイトル</p>
      <p><?php echo "<p class='p1'>".$this->data['title']."</p>";?></p><br>
      <?php echo nl2br($this->data['content']);?>
    </div>
    <div class="hensyuu">
      <form action="updateArticle" method="POST">
        <label>タイトル：</label>
        <input type="text" name="title" id="title" class="articleform"><br>
        <label>　　内容:</label>
        <textarea name="content" id="main" class="articleform"></textarea><br>
        <?php echo "<input type='hidden' name=id value=".$_GET['id'].">"; ?>
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']) ?>"></input>
        <input type="submit" value="編集する" id="submit" disabled>
      </form>
    </div>
    <script src="/js/articleedit.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>
