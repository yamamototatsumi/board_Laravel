<?php
require_once ( dirname(__FILE__) . '/../Models/Article.php'); 
require_once ( dirname(__FILE__) . '/../Models/Comment.php'); 
const MAX_VIEW = 10;

class ArticlesConstruct extends DataBox{
  public function __construct()
  {
    $this->models = new ArticleModels();
    $this->commentModels = new CommentModels();
    $this->token = new TokenCheck();
  }
}

class ArticlesController extends ArticlesConstruct{
  protected $data;
  public function index() {
    $total_count = $this->models->pageCount();
    $pages = ceil($total_count['count'] / MAX_VIEW);
    if(!isset($_GET['page_id'])){ 
        $now = 1;
    }else{
        $now = $_GET['page_id'];
    }
    $this->data = $this->models->PagerSystem($now, MAX_VIEW);
    require_once ( dirname(__FILE__) . $_ENV["ARTICLES_DIRECTRY"] . "article_list.php"); 
  }

  public function searchArticle() {
    $this->data = $this->models->searchArticle($_POST["keyword"]);
    require_once ( dirname(__FILE__) . $_ENV["ARTICLES_DIRECTRY"] . "search_article.php"); 
  }

  public function displayNewPost() {
    require_once ( dirname(__FILE__) . $_ENV["ARTICLES_DIRECTRY"] . "new_post.php"); 
  }

  public function addArticle() { 
    $title = $this->inputCheck($_POST["title"]);
    $content = $this->inputCheck($_POST["content"]);
    $this->models->addArticle($title, $_SESSION["id"], $content);
    require_once ( dirname(__FILE__) . $_ENV["ARTICLES_DIRECTRY"] . "post_finish.php"); 
  }

  public function inputCheck ($html) {
    return htmlspecialchars($html, ENT_QUOTES, "UTF-8");
  }

  public function indexComment() {
    $this->data = $this->models->selectArticleWithUser($_GET["id"]);
    if($_SESSION['id'] === $this->data['userID']){
      $this->data["edit"] = $this->data()["edit"];
      $this->data["delete"] = $this->data()["delete"];
    }
    $this->data["stmt"]=$this->commentModels->selectCommentWithUser($_GET["id"]);
    require_once ( dirname(__FILE__) . $_ENV["ARTICLES_DIRECTRY"] . "article_comment.php"); 
  }

  public function getUpdateArticle() {
    $this->data = $this->models->selectArticle($_GET["id"]);
    if($this->data["user_id"] === $_SESSION["id"]){
    require_once ( dirname(__FILE__) . $_ENV["ARTICLES_DIRECTRY"] . "article_edit.php"); 
    }else{
      $this->data["msg"] = $this->data["errorresult"];
      require_once ( dirname(__FILE__) . $_ENV["USERS_DIRECTRY"] . "error.php"); 
    }
  }

  public function updateArticle(){
    $this->token->check() ;
    $title =$this->inputCheck($_POST['title']);
    $content = $this->inputCheck($_POST['content']);
    $this->models->updataArticle($title, $content, $_POST['id']);
    require_once ( dirname(__FILE__) . $_ENV["ARTICLES_DIRECTRY"] . "update_article.php"); 
    }

  public function deleteArticle() {
    $this->models->deleteArticle($_GET['id']) ;
    require_once ( dirname(__FILE__) . $_ENV["ARTICLES_DIRECTRY"] . "article_delete.php"); 
  }


} 

?>
