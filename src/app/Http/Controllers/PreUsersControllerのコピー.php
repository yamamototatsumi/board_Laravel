<?php
// require_once ( dirname(__FILE__) . '/../Models/PreUser.php'); 

// class PreUsersConstruct extends DataBox{
//   public function __construct()
//   {
//     $this->models = new PreUserModels();
//   }
// }

// class PreUsersController extends PreusersConstruct{
//   protected $data;
//   public function getSignUp(){
//     require_once( dirname(__FILE__) . $_ENV["PRE_USERS_DIRECTRY"] . "signup.php"); 
//   }
  
//   public function addPreUsers(){
//     $member = $this->models->selectEmail($_POST['email']);
//     if (!empty($member["email"])) {
//       $this->data["msg"] = $this->data()["registerError"];
//       $this->data["link"] = $this->data()["sigunUpLink"];
//     } else {
//       $this->data["msg"] = $this->data()["mail"];
//       $this->data["link"] = $this->data()["loginLink"];
//       $userId = hash_hmac( 'sha256', uniqid(mt_rand()), true );
//       $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24)); 
//       $this->models->addUser($_POST["email"],$userId);
//       $this->data["url"] = $this->sendmail($userId);
//     }
//     require_once( dirname(__FILE__) . $_ENV["PRE_USERS_DIRECTRY"] . "register.php");
//   }

//   public function changeUrl($userId){ 
//     $url = "http://".getenv('SERVER_NAME')."/user?id=".$userId;
//     return $url;
//   }
  
//   public function sendmail($userId){
//     $url = $this->changeUrl($userId);
//     if(mb_send_mail('100day891@gmail.com', '掲示板本登録用メールアドレス', '
//       本登録をするにはこのURLのページへアクセスしてください。'.$url)) {
//         echo "送信完了";
//     } else {
//         echo "送信失敗";
//     }
//     return $url;
//   }
// }
?>