<?php
  require_once ( dirname(__FILE__) . $_ENV["DBSET_DIRECTRY"]); 
  require_once ( dirname(__FILE__) . $_ENV["DATA_BOX_DIRECTRY"]); 

  class ArticleModelConstruct extends TransBase{
    public function __construct()
    {
      $db_set = new DbSetUp();
      $this->dbh = $db_set->connect();
    }
  }

class ArticleModels extends ArticleModelConstruct{
  public function updataArticle(string $title, string $main, string $id)
  {
    $sql = "UPDATE articles SET title = :title, content = :content, updated_at = now() WHERE id = '$id'";
    $stmt = $this->dbh->prepare($sql);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':content', $main, PDO::PARAM_STR);
    $this->trans($sql, $stmt);
  }
  
  public function selectArticleWithUser($id):array
  {
    $sql = "SELECT users.name AS userName,
    users.user_id AS userID, 
    articles.id AS article_ID, 
    articles.title AS article_title, 
    articles.content AS article_content, 
    articles.created_at AS article_created_at  
    FROM articles
    INNER JOIN users 
    ON articles.user_id = users.user_id  
    WHERE articles.id = '$id'";
    $stmt = $this->dbh->query($sql);
    $userInfo = $stmt->fetch(PDO::FETCH_BOTH);
    return $userInfo;
  }

  public function selectArticle(string $id):array
  {
    $sql = "SELECT * FROM articles WHERE id ='$id'";
    $stmt = $this->dbh->query($sql);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
    return $member;
  }
  
  public function deleteArticle(string $id)
  { 
    $sql = "UPDATE articles SET deleted_at = now() WHERE id ='$id'";
    $stmt = $this->dbh->prepare($sql);
    $this->trans($sql, $stmt);
  }

  public function pageCount() :array
  {
    $count = $this->dbh->prepare('SELECT COUNT(id) AS count FROM articles where deleted_at is NULL');
    $count->execute();
    $total_count = $count->fetch(PDO::FETCH_ASSOC);
    return $total_count;
  }

  public function adminPageCount() :array
  {
    $count = $this->dbh->prepare('SELECT COUNT(id) AS count FROM articles');
    $count->execute();
    $total_count = $count->fetch(PDO::FETCH_ASSOC);
    return $total_count;
  }
  
  public function pagerSystem(int $now, int $max_view) :array
  {
    $stmt = $this->dbh->prepare("SELECT articles.title,articles.content,articles.created_at,users.name,articles.id,articles.deleted_at
    FROM articles  INNER JOIN users ON articles.user_id = users.user_id where articles.deleted_at is NULL ORDER BY articles.id DESC LIMIT :start,:max ");
      if ($now == 1) {
        $stmt->bindValue(":start", $now -1, PDO::PARAM_INT);
        $stmt->bindValue(":max", $max_view, PDO::PARAM_INT);
      } else {
        $stmt->bindValue(":start", ($now -1) * $max_view, PDO::PARAM_INT);
        $stmt->bindValue(":max", $max_view, PDO::PARAM_INT);
      }
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $data;
  }
  
  public function adminPagerSystem(int $now, int $max_num) :array
  {
    $stmt = $this->dbh->prepare("SELECT articles.title,articles.content,articles.created_at,users.name,articles.id,articles.deleted_at,articles.updated_at
    FROM articles  INNER JOIN users ON articles.user_id = users.user_id 
    ORDER BY articles.id DESC LIMIT :start,:max ");
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
  

  public function searchArticle(string $keyword) :array
  {
      $sql = "SELECT articles.title,articles.content,articles.created_at,users.name,articles.id,articles.deleted_at
    FROM articles INNER JOIN users ON articles.user_id = users.user_id WHERE title like :title or content like :content";
      $stmt = $this->dbh->prepare($sql);
      $keyword = '%'.$keyword.'%';
      $stmt->bindParam(':title', $keyword, PDO::PARAM_STR);
      $stmt->bindParam(':content', $keyword, PDO::PARAM_STR);
      $stmt->execute();
      $articleLists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $articleLists;
  }
  public function monthArticle() :string
  {
    $sql="SELECT DATE_FORMAT(created_at, '%Y-%m') as purchase_month,
    COUNT(*) as count FROM articles GROUP BY
    DATE_FORMAT(created_at, '%Y%m') order by created_at desc";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute();
      $month = $stmt-> fetch(PDO::FETCH_ASSOC);
      return $month["count"];
  }
  public function addArticle($title,$id,$content)
  {
    $sql = 'INSERT INTO articles(title,content,user_id,created_at) VALUES (:title,:content,:user_id,now())';
    $stmt = $this->dbh->prepare($sql);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':content', $content);
    $stmt->bindValue(':user_id', $id);
    $this->trans($sql, $stmt);
  }

  public function getData($start,$end){    
    if($start === "--"){
      $start="0000-00-00";
    }
    if($end === "--"){
      $end =date("Y-m-d");
    }
    $sql = 'SELECT * FROM articles WHERE created_at BETWEEN"' . $start .'&nbsp;  00:00:00" AND"' .$end .'&nbsp;  23:59:59"';
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function insert($tmp_name){
    
      $sql= 'INSERT INTO articlesTest ( user_id, title, content, created_at, updated_at, deleted_at) VALUES (  ?, ?, ?, ?, ?, ? )';
      $stmt = $this->dbh->prepare($sql);
      $msg = $this->inport($tmp_name,$stmt);
    return $msg;
  }

  public function inport($tmp_name,$stmt){
    $this->dbh->beginTransaction();
    try {
      $fp = fopen($tmp_name, 'rb');
      while ($row = fgetcsv($fp)) {
        if ($row === array(null)) {
          continue;
        }
        $executed = $stmt->execute($row);
      }
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

