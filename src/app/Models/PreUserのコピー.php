<?php
  // require_once ( dirname(__FILE__) . $_ENV["DBSET_DIRECTRY"]); 
  // require_once ( dirname(__FILE__) . $_ENV["DATA_BOX_DIRECTRY"]); 

  // class PreUserModelConstruct extends TransBase{
  //   public function __construct()
  //   {
  //     $db_set = new DbSetUp();
  //     $this->dbh = $db_set->connect();
  //   }
  // }
  // class PreUserModels extends PreUserModelConstruct{
  //   public function selectEmail(string $email){
  //     $sql = "SELECT email FROM pre_users WHERE email = :email";
  //     $stmt = $this->dbh->prepare($sql);
  //     $stmt->bindValue(':email', $email);
  //     $stmt->execute();
  //     $member = $stmt->fetch();
  //     return $member;
  //   }
  //   public function getEmail(string $token) :array{
  //     $sql = "SELECT email FROM pre_users WHERE token = '$token'";
  //     $stmt = $this->dbh->prepare($sql);
  //     $stmt->execute();
  //     $email = $stmt->fetch();
  //     return $email;
  //   }
  //   public function addUser(string $email, string $userId) {
  //     $sql = "INSERT INTO pre_users(email, token) VALUES (:email,:user_id)";
  //     $stmt = $this->dbh->prepare($sql);
  //     $stmt->bindValue(':email', $email);
  //     $stmt->bindValue(':user_id', $userId);
  //     $this->trans($sql,$stmt);
  //   }
  // }
?>
