
<?php



  if (is_uploaded_file($_FILES["csvfile"]["tmp_name"])) {
    $file_tmp_name = $_FILES["csvfile"]["tmp_name"];
    $file_name = $_FILES["csvfile"]["name"];

    //拡張子を判定
    if (pathinfo($file_name, PATHINFO_EXTENSION) != 'csv') {
      $err_msg = 'CSVファイルのみ対応しています。';
    } else {
      //ファイルをdataディレクトリに移動
      if (move_uploaded_file($file_tmp_name, "../" . $file_name)) {
        //後で削除できるように権限を644に
        chmod("../" . $file_name, 0644);
        $msg = $file_name . "をアップロードしました。";
        $file = '../'.$file_name;
        $fp   = fopen($file, "r");

        //配列に変換する
        while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
          $asins[] = $data;
        }
        fclose($fp);
        //ファイルの削除
        unlink('../'.$file_name);
      } else {
        $err_msg = "ファイルをアップロードできません。";
      }
    }
  } else {
    $err_msg = "ファイルが選択されていません。";
  }

  try {
    $pdo = new PDO(
      'mysql:dbname=board;host=localhost;charset=utf8',
      'root',
      '7491gorira',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    foreach ($asins as $row) {
        // $id   = $row[0];
        $email=$row[0];
        $user_id=hash_hmac('sha256', uniqid(mt_rand()), true);
        
        $pass = $row[2];
        $name = $row[3];
        $created_at = date('Y-m-d H:i:s', rand(time(), strtotime('-3 years')));
        $updated_at =  date('Y-m-d H:i:s', rand(time(), strtotime('-3 years')));
        $deleted_at= date('Y-m-d H:i:s', rand(time(), strtotime('-3 years')));
      
        $arrayValues[] = "('{$email}', '{$user_id}', '{$pass}','{$name}','{$created_at}', '{$updated_at}','{$deleted_at}')";
    } 
      

      $sql = "INSERT INTO test ( email, user_id, pass, name, created_at, updated_at, deleted_at)  VALUES " .join(",", $arrayValues) ;
      $stmt = $pdo->prepare($sql);
      $stmt->execute();



  } catch (PDOException $e) {

    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage()); 

  }

?>





