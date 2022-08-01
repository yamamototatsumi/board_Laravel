<!DOCTYPE html>
<html labg="ja">
<head>
<meta chrset="utf-8" />
<title>ログイン画面</title>
<link rel="stylesheet" href="{{ asset('css/articleList.css') }}">
</head>
<body>
    <form id="form2" class="form_wrap" action="user/download" method="POST">
    <p>何も入力しなければ全期間ダウンロードされます</p>
      <div class="csv_import_textarea">
        <input type="text" class="input" name="year" >年
        <input type="text" class="input" name="month">月
        <input type="text" class="input" name="day">日から<br>
        <input type="text" class="input" name="yearEnd" >年
        <input type="text" class="input" name="monthEnd">月
        <input type="text" class="input" name="dayEnd">日までを
        <input type="submit" value="csvダウンロード">
      </div>  
    </form>
    <form enctype="multipart/form-data" method="post" action="user/upload">
      <fieldset>
        <legend>ファイルインポート</legend>
        Filename(CSVファイルのみ対応しています): <input type="file" name="upfile" accept=".csv"/><br />
        <input type="submit" value="Upload" />
      </fieldset>
    </form><br><br><br><br>
    <table border="1">
    <?php
      foreach ( $this->data as $row ) {
        echo "<tr'><td>"."メール:".$row["email"]. "</td>";
        echo  "<td>"."ID:".($row['user_id']). "</td>"; 
        echo "<td>"."パス".$row['pass']. "</td>";
        echo "<td>"."名前".$row['name']. "</td>";
        echo "<td>"."登録日時".$row['created_at']. "</td>";
        echo "<td>"."更新日時".$row['updated_at']. "</td>";
        echo "<td>"."削除日時".$row['deleted_at']. "</td></tr>";
        echo"</div>"; 
      }
    ?>
    </table>
    <?php
      for ( $n = 1; $n <= $pages; $n ++){
        if ( $n == $now ){
          echo "<span style='padding: 5px;'>$now</span>";
        }else{
          echo "<a href='./article?page_id=$n' style='padding: 5px;'>$n</a>";
          if($n % 50 === 0){
            echo "<br>";
          }
        }
      }
      ?>
  </body>
</html>

