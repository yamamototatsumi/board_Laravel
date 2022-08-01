<!DOCTYPE html>
<html labg="ja">
<head>
<meta chrset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<title>コメ編集</title>
<link rel="stylesheet" href="{{ asset('css/articleEdit.css') }}">
</head>
<body>
  <div class="articleBody">
    <?php
      
    ?>
  <div class="articleOld"> 
    <p>現在のコメント</p>
    <?php echo nl2br($this->data['content']);?>
  </div>
  <div class="hensyuu">
    <form action="updateComment" method="POST">
      <label>新しいコメント:</label>
      <textarea name="main" id="main" required='required'></textarea><br>
      <?php echo "<input type='hidden' name='id' value='".$_GET["id"]."'>"; ?>
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']) ?>"></input>
      <input type="submit" id="submit" value="編集する">
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
