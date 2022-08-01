<?php
require_once ( dirname(__FILE__) . '/../Models/Comment.php'); 

class CommentsConstruct extends DataBox{
  public function __construct()
  {
    $this->models = new CommentModels();
    $this->token = new TokenCheck();
  }
}

class CommentsController extends CommentsConstruct{
  protected $data;
  public function addComment() {
    $main = $this->inputCheck($_POST['main']);
    $this->models->addComment($main,$_POST["id"],$_SESSION["id"]);
    require_once ( dirname(__FILE__) . $_ENV["COMMENTS_DIRECTRY"] . "comment.php"); 
  }
  
  public function getUpdateComment() {
    $this->data = $this->models->selectComment($_GET['id']);
    if($this->data["user_id"] === $_SESSION["id"]){
      require_once ( dirname(__FILE__) . $_ENV["COMMENTS_DIRECTRY"] . "comment_edit.php"); 
    }else{
      $this->data["msg"]=$this->data()["errorresult"];
      require_once ( dirname(__FILE__) .$_ENV["USERS_DIRECTRY"] . "error.php"); 
    }
  }

  public function updateComment() {
    $this->token->check();
      $main = $this->inputCheck($_POST['main']);
      $this->models->updateComment($main, $_POST['id']);
      require_once ( dirname(__FILE__) . $_ENV["COMMENTS_DIRECTRY"] . "comment_edit_finish.php");
    }

  public function deleteComment() {
    $this->models->deleteComment($_GET['id']) ;
    require_once ( dirname(__FILE__) . $_ENV["COMMENTS_DIRECTRY"] . "comment_delete.php");
  }

  public function inputCheck ($html) {
    return htmlspecialchars($html, ENT_QUOTES, "UTF-8");
  }
}


?>