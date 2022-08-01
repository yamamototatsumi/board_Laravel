<body>
  <?PHP
    include( dirname(__FILE__). '/../headder.php');
  ?>
  <main>
  <h2>投稿完了！</h2>
  <pre>
  <?php
    echo "投稿完了！！！<br>";
    echo "<a href = '../comment?id=".$_POST["id"]."'>コメントを確認する</a>";
  ?>
    </pre>
  </main>
</body>