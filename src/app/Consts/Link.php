<?php
namespace App\Consts;

class Link
{
  public const TOP  =  "/";

  public const LOGIN = "/users/login";

  public const MYPAGE = "/users/mypage";

  public const ADMIN = "../../../admin";

  public const LOGOUT = "/users/logout";

  public const UPDATE = "/users/update";

  public const ARTICLES = "/articles/index";

  public const HEADER ='<ul class="nav-list">
  <div class="A">
  <li><a href="/../mypage" class="nav-list-item navI">ホーム</a></li>
  <li><a href="/../login" class="nav-list-item navI">ログイン</a></li>
  <li><a href="/../article" class="nav-list-item navI">投稿一覧</a></li>
  <li><a href="/../newPost" class="nav-list-item navI">新規投稿</a></li>
  </div>
  </ul>';

}

?>