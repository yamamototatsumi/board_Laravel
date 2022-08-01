<?php
require_once ( dirname(__FILE__) . '/../Models/User.php'); 
require_once ( dirname(__FILE__) . '/../Models/Article.php');
require_once ( dirname(__FILE__) . '/../Models/PreUser.php');


class UsersConstruct extends DataBox{
  public function __construct()
  {
    $this->models = new UserModels();
    $this->articleModels = new ArticleModels();
    $this->token = new TokenCheck();
  }
}

class UsersController extends UsersConstruct
{
  protected $data;

  public function getLogout()
  {   
      session_destroy();
      $this->data["headerLink"] ="";
      require_once(dirname(__FILE__) . $_ENV["USERS_DIRECTRY"] . "logout.php");
  }

  public function getHeaderLink()
  {
      if (isset($_SESSION["id"])) {
          $this->headerdata = $this->data()["headerLink"];
      } else {
          $this->headerdata = $this->data()["notData"];
      }
      return $this->headerdata;
  }

  public function displayHeadder()
  {
    if ($this->loginCheck()) {
        $this->data = $this->getMyname();
        $this->data["headerLink"] = $this-> getHeaderLink();
    } else {
        $this->data["headerLink"] = $this->data()["notData"];
    }
    $admin = $this->models->adminCheck($_SESSION["id"]);
    if($admin["admin"]==="1"){
      $this->data["adminLink"] = $this->data()["adminLink"];
    }else{
    $this->data["adminLink"] = "";
    }
    require_once(dirname(__FILE__) . $_ENV["VIEWS_DIRECTRY"] ."headder.php");
  }

  public function getMypage()
  {
      $this->data = $this->getMyname();
      $this->data["usercount"] = $this->models->monthUser();
      $this->data["articlecount"] = $this->articleModels -> monthArticle();
      require_once(dirname(__FILE__) . $_ENV["VIEWS_DIRECTRY"] . "mypage.php");
  }
  public function getMyname() :array
  {
      if (isset($_SESSION["id"])) {
          $this->data["name"] = $this->models->selectUserName($_SESSION["id"]);//名前が入ってる
          $this->data["link"] =  $this->data()["logoutLink"];
      } else {
          $this->data["name"] = $this->data()["notLoginName"];
          $this->data["link"] = $this->data()["loginLink"];
      }
      return $this->data;
  }

  public function passCheck() :array
  {
      $member = $this->models->getUserInfo($_POST['login_email']);
      if (password_verify($_POST['login_pass'], $member['pass'])) {
          $_SESSION['id'] = $member['user_id'];
          $this->data['msg'] = $this->data()["loginMsg"];
          $this->data['link'] = $this->data()['mypageLink'];
      } else {
          $this->data['msg'] = $this->data()['error'];
          $this->data['link'] = $this->data()['loginLink'];
      }
      return $this->data;
  }

  public function loginPost() :array
  {
    $this->data = $this->passCheck();
    if($_POST["login_email"] === "admin.admin@gmail.com"){
      $this->headerdata = $this->data()["notData"];
      require_once(dirname(__FILE__) . $_ENV["VIEWS_DIRECTRY"] . "admin/admintop.php");
    }
    else{
      $this->headerdata = $this->data()["headerData"];
      require_once(dirname(__FILE__) . $_ENV["USERS_DIRECTRY"] . "login_result.php");
    }
    return $this->data;
  }

  public function loginCheck() :bool
  {
      $this->flag =false;
      if (isset($_SESSION["id"])) {
          $this->flag = true;
      }
      return $this->flag;
  }

  public function sendRegisterMail()
  {
      if (mb_send_mail('100day891@gmail.com', '登録完了', '
    正常に本登録が完了されましたhttp://'.getenv('SERVER_NAME').'/login')) {
          echo "送信完了";
      } else {
          echo "送信失敗";
      }
  }

  public function getTopPage()
  {
      require_once(dirname(__FILE__) . $_ENV["VIEWS_DIRECTRY"] ."index.php");
  }

  public function getLogin()
  {
      require_once(dirname(__FILE__) . $_ENV["USERS_DIRECTRY"] ."login.php");
  }

  public function getUpdateUser()
  {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
      $this->data = $this->getMyname();
      require_once(dirname(__FILE__) . $_ENV["USERS_DIRECTRY"] . "change_acount.php");
  }

  public function updateUser()
  {
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $this->data = $this->models->selectUserNameWithPass($_SESSION["id"]);
    $this->data["msg"] = $this->token->check();
    if (password_verify($_POST['oldpass'], $this->data['pass'])) {
        $this->models->updateUser($_SESSION["id"], $_POST["name"], $pass);
        $this->data=$this->models->selectUserNameWithPass($_SESSION["id"]);
        $this->data["result"] = $this->data()["change"];
    } else {
        $this->data["result"] = $this->data()["changeFailure"];
    }
    require_once(dirname(__FILE__) . $_ENV["USERS_DIRECTRY"] . "change.php");
  }

  public function getUser()
  {
    $email = $this->PreUserModels->getEmail($_GET["id"]);
    $user = $this->models->checkUser($email["email"]);
    if (empty($user["id"])) {
        $this->data["msg"] = $this->data()['register'];
        require_once(dirname(__FILE__) . $_ENV["USERS_DIRECTRY"] . "register_finish.php");
    } else {
        $this->data["msg"]= $this->data()['registerError'];
        require_once(dirname(__FILE__) . $_ENV["USERS_DIRECTRY"] . "error.php");
    }
  }

  public function addUser()
  {
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $userId=hash_hmac('sha256', uniqid(mt_rand()), true);
    $this->models->addUser($_POST["email"], $pass, $_POST["name"], $userId);
    $this->sendRegisterMail();
    require_once(dirname(__FILE__) . $_ENV["USERS_DIRECTRY"] . "register_finish_end.php");
  }

  public function getError(){
    $this->data["msg"]= $this->data()['errorresult'];
    require_once(dirname(__FILE__) . $_ENV["USERS_DIRECTRY"] . "error.php");
  }

}
?>


