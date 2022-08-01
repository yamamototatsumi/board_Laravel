<?php
class DbSetUp{
  public function connect(){
    try {
        $dbh = new PDO($_ENV["DSN"], $_ENV["USERNAME"], $_ENV["PASSWORD"]);
        return $dbh;
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        return $msg;
    }
  }
}

class TokenCheck{
  public function check(){
    if (! $_SESSION['token']  == $_REQUEST['token'] ) {
      $this->msg = "トークン不一致エラー";
      die();
      return $this->msg;
    }
  }
}

class TransBase{
  public function __construct()
  {
    $db_set = new DbSetUp();
    $this->dbh = $db_set->connect();
  }
  public function trans($sql, $stmt)
    {
        try {
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->beginTransaction();
            $sql;
            $stmt;
            $stmt->execute();
            $this->dbh->commit();
        } catch (Exception $e) {
            $this->dbh->rollBack();
            echo "失敗しました。" . $e->getMessage();
        }
    }
}

?>