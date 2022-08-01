<?php
class DataBox {
  public function data(){
    $data = array('logoutLink'=>"<a href ='../logout'>ログアウト</a>",
                  'loginLink'=>"<a href ='../login'>ログイン</a>",
                  'notLoginName'=>'ログインしていません',
                  'loginMsg'=>'ログインしました。',
                  'mypageLink'=>'<a href="../mypage">ホーム</a>',
                  'error'=>'メールアドレスもしくはパスワードが間違っています。',
                  'registerError'=>"<h1>既に登録されています</h1>",
                  'register'=>'<h1>新規ユーザー本登録</h1>',
                  'sigunUpLink'=>'<a href="signUp">戻る</a>',
                  'mail'=>'登録メールアドレス宛に本登録用URLを送信しました。',
                  'edit'=>"<a href='updateArticle?id=".$this->data['article_ID']."'>編集</a>",
                  'delete'=>"<a href='deleteArticle?id=".$this->data['article_ID']."'>削除</a>",
                  'errorresult'=>'エラーです！！！！！！',
                  'notData'=>'',
                  "adminLink"=>'<a href="../../../admin">管理者ページ</a>',
                  'headerLink'=>'<ul class="nav-list">
                                  <div class="A">
                                  <li><a href="/../mypage" class="nav-list-item navI">ホーム</a></li>
                                  <li><a href="/../login" class="nav-list-item navI">ログイン</a></li>
                                  <li><a href="/../article" class="nav-list-item navI">投稿一覧</a></li>
                                  <li><a href="/../newPost" class="nav-list-item navI">新規投稿</a></li>
                                  </div>
                                  </ul>',
                  'change'=> "<h2>名前の変更が完了しました</h2>
                              <h1>あなたはこれから" .$this->data['name']."です！</h1>
                              <a href = '../mypage'>マイページへ戻る</a>",
                  'changeFailure'=>'<h2>現在のパスワードが違います！</h2>
                                    <a href="updateUser">戻る</a>',
    );
    return $data;
    }
  }
?>
