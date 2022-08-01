<!DOCTYPE html>
<html labg="ja">
<head>
<meta chrset="utf-8" />
<title>ログイン画面</title>
<link rel="stylesheet" href="{{ asset('css/articleList.css') }}">
</head>
<body>
  <div class="articleBody">
    <form action="article" method="post">
      <h3>記事の検索</h3>
      <label>検索キーワード:</label>
      <input type="text" name="keyword" id="keyword" required="required">
      <input type="submit" name="submit" id="submit" value="検索">
    </form>
    <ul>
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
    </ul>
    <?php
      for ( $n = 1; $n <= $pages; $n ++){
        if ( $n == $now ){
          echo "<span style='padding: 5px;'>$now</span>";
        }else{
          echo "<a href='./article?page_id=$n' style='padding: 5px;'>$n</a>";
        }
      }
      ?>
    </div>
  </body>
</html>

