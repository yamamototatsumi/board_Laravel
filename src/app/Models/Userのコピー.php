<?php
require_once ( dirname(__FILE__) . $_ENV["DBSET_DIRECTRY"]); 
require_once ( dirname(__FILE__) . $_ENV["DATA_BOX_DIRECTRY"]); 


class UserModelConstruct extends TransBase{
  public function __construct()
  {
    $db_set = new DbSetUp();
    $this->dbh = $db_set->connect();
  }
}
class UserModels extends UserModelConstruct{
  public function selectUserName(string $id) {
    $stmt = $this->dbh->prepare("select name from users where user_id='$id'");
    $stmt->execute();
    $userName = $stmt->fetch(PDO::FETCH_BOTH);
    return $userName["name"];
  }

  public function selectUserNameWithPass(string $id) :array{
    $stmt = $this->dbh->prepare("select name,pass from users where user_id='$id'");
    $stmt->execute();
    $userInfo = $stmt->fetch(PDO::FETCH_BOTH);
    return $userInfo;
  }

  public function updateUser(string $id,string $name,string $pass){
    $sql = "UPDATE users SET name = :name, pass = :pass, updated_at = now() WHERE user_id = '$id'";
    $stmt = $this->dbh->prepare($sql);
    $stmt->bindParam( ':name', $name, PDO::PARAM_STR);
    $stmt->bindParam( ':pass', $pass, PDO::PARAM_STR);
    $this->trans($sql,$stmt);
  }

  public function getUserInfo(string $email) {
    $sql = "SELECT email,pass,user_id FROM users WHERE email = :email";
    $stmt = $this->dbh->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
    return $member;
  }

  public function addUser(string $email,string $pass,string $name,string $userId){
    $sql = "INSERT INTO users(email, pass, name,user_id,created_at) VALUES (:email, :pass, :name,:user_id,now())";
    $stmt = $this->dbh->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':pass', $pass);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':user_id', $userId);
    $this->trans($sql,$stmt);
  }

  public function monthUser() :string{
    $sql="SELECT DATE_FORMAT(created_at, '%Y-%m') as purchase_month,
    COUNT(*) as count FROM users GROUP BY
    DATE_FORMAT(created_at, '%Y%m') order by created_at desc";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute();
    $month = $stmt-> fetch(PDO::FETCH_ASSOC);
    return $month["count"];
  }

  public function checkUser(string $email) {
    $sql = "SELECT id FROM users WHERE email = '$email'";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute();
    $email = $stmt->fetch();
    return $email;
  }

  public function adminCheck($user_id){
    $sql = "SELECT admin FROM users WHERE user_id = '$user_id'";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute();
    $admin = $stmt->fetch();
    return $admin;
  }

  public function adminPageCount() :array
    {
      $count = $this->dbh->prepare('SELECT COUNT(id) AS count FROM users');
      $count->execute();
      $total_count = $count->fetch(PDO::FETCH_ASSOC);
      return $total_count;
    }
  public function adminPagerSystem(int $now, int $max_num) :array
  {
    $stmt = $this->dbh->prepare("SELECT * FROM users 
    ORDER BY id DESC LIMIT :start,:max ");
      if ($now == 1) {
        $stmt->bindValue(":start", $now -1, PDO::PARAM_INT);
        $stmt->bindValue(":max", $max_num, PDO::PARAM_INT);
      } else {
        $stmt->bindValue(":start", ($now -1) * $max_num, PDO::PARAM_INT);
        $stmt->bindValue(":max", $max_num, PDO::PARAM_INT);
      }
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }


  public function getData($start,$end){    
    if($start === "--"){
      $start="0000-00-00";
    }
    if($end === "--"){
      $end =date("Y-m-d");
    }
    $sql = 'SELECT * FROM users WHERE created_at BETWEEN"' . $start .'&nbsp;  00:00:00" AND"' .$end .'&nbsp;  23:59:59"';
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function insert($tmp_name){
      $sql= 'INSERT INTO users ( email, user_id, pass, name, created_at, updated_at, deleted_at) VALUES (  ?, ?, ?, ?, ?, ?, ?)';
      $stmt = $this->dbh->prepare($sql);
      $msg = $this->inport($tmp_name,$stmt);
    return $msg;
  }

  public function inport($tmp_name,$stmt){
    set_time_limit(0);
    $cost = 4;
    $this->dbh->beginTransaction();
    try {
      $fp = fopen($tmp_name, 'rb');
      while ($row = fgetcsv($fp)) {
        if ($row === array(null)) {
          continue;
        }
        $row[2] = password_hash($row[2], PASSWORD_BCRYPT, ["cost" => $cost]);
        $executed = $stmt->execute($row);
      }
      //200秒ぐらい必要
      if (!feof($fp)) {
        // ファイルポインタが終端に達していなければエラー
        throw new RuntimeException('CSV parsing error');
      }
      fclose($fp);
        $this->dbh->commit();
    } catch (Exception $e) {
      fclose($fp);
      $this->dbh->rollBack();
      throw $e;
    }
    return $executed;
  }
}
?>
