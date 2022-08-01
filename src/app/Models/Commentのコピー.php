<?php
  require_once ( dirname(__FILE__) . $_ENV["DBSET_DIRECTRY"]); 
  require_once ( dirname(__FILE__) . $_ENV["DATA_BOX_DIRECTRY"]); 
  
  class CommentModelConstruct extends TransBase{
    public $sql;
    public $stmt;
    public function __construct()
    {
      $db_set = new DbSetUp();
      $this->dbh = $db_set->connect();
    }
  }

  class CommentModels extends CommentModelConstruct{
    public function addComment(string $content, string $article_id, string $id) {
      $sql = "INSERT INTO comments(content, created_at, article_id, user_id) VALUES (:content, now(), :article_id,:user_id)";
      $stmt = $this->dbh->prepare($sql);
      $stmt->bindValue(':content', $content);
      $stmt->bindValue(':article_id', $article_id);
      $stmt->bindValue(':user_id', $id);
      $this->trans($sql, $stmt);
    }
    public function selectCommentWithUser(string $id) :object{
      $sql = "SELECT comments.content AS comment_content,
      users.user_id AS userID, 
      comments.id AS comment_ID, 
      comments.created_at AS comment_created_at,
      users.name AS username,
      comments.deleted_at AS deleted_at
      FROM users INNER JOIN comments 
      ON users.user_id = comments.user_id 
      WHERE comments.article_id = $id ";
      $stmt = $this->dbh->query($sql);
      return $stmt;
    }
    public function selectComment(string $id) :array{
      $sql = "SELECT * FROM comments WHERE id ='$id'";
      $stmt = $this->dbh->query($sql);
      $member = $stmt->fetch(PDO::FETCH_ASSOC);
      return $member;
    }
    public function deleteComment(string $id) {
      $sql = "UPDATE comments SET deleted_at = now() WHERE id ='$id'";
      $stmt = $this->dbh->prepare($sql);
      $this->trans($sql,$stmt);
    }
    public function updateComment(string $main,string $id){
      $sql = "UPDATE comments SET content = :content, updated_at = now() WHERE id = '$id'";
      $stmt = $this->dbh->prepare($sql);
      $stmt->bindParam(':content',$main,PDO::PARAM_STR);
      $this->trans($sql,$stmt);
    }
  }
?>
