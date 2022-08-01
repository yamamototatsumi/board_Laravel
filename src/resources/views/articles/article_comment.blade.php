

<!DOCTYPE html>
  <html labg="ja">
  <head>
    <meta chrset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>コメントページ</title>
    <link rel="stylesheet" href="{{ asset('css/articleList.css') }}">
  </head>
  <body>
    <div class="articleBody">
      <?php
          echo "<p class='p'>投稿詳細</p>";
          echo "<div class= 'kiji'><p class ='row row2'>"."タイトル:".$this->data["article_title"]. "</p>";
          echo  "<p class ='row row3'>"."内容:".nl2br($this->data['article_content']). "</p>"; 
          echo "<p class ='row row4'>"."投稿者".$this->data['userName']. "</p>";
          echo "<p class ='row row5'>"."投稿日時".$this->data['article_created_at']. "</p>";
          if ($_SESSION['id'] === $this->data["userID"]) {
              echo $this->data["edit"];
              echo $this->data["delete"];
          }
          echo"</div>";
      ?>
    </div>
    <div class="comment">
      <p class="p">コメントする</p>
      <form method="POST" action="../comment">
        <textarea name="main" id="main" required></textarea>
        <div class="AA"><?php echo "<input type='hidden' name='id' value=".$_GET["id"].">"; ?></div>
        <input type="submit" value="コメントする" id="submit">
      </form>
    </div>
    <div class="commentList">
      <?PHP 
        foreach ($this->data["stmt"] as $row) {
          if(!(isset($row['deleted_at']))){
            echo "<div class= 'kiji'><p class ='row row2'>"."コメント:".nl2br($row['comment_content']). "</p>";
            echo "<p class ='row row4'>"."投稿者".$row['username']. "</p>";
            echo "<p class ='row row5'>"."投稿日時".$row['comment_created_at']. "</p>";
            if($_SESSION['id'] === $row['userID']){
              echo "<a href='../updateComment?id=".$row['comment_ID']."'>編集</a>";
              echo "<a href='/../deleteComment?id=".$row['comment_ID']."'>削除</a>";
            }
            echo"</div>";
          }
        };  
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>
