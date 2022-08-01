<?php
require_once ( dirname(__FILE__) . '/../Models/User.php'); 
require_once ( dirname(__FILE__) . '/../Models/Article.php');

class AdminUsersConstruct extends DataBox{
  public function __construct()
  {
    $this->models = new UserModels();
  }
}
class AdminUsersController extends AdminUsersConstruct
{
    public function getTop()
    {
      if($this->adminCheck()["0"]==="1"){
        require_once(dirname(__FILE__) . $_ENV["ADMIN_DIRECTRY"] . "admintop.php");
      }
    }

    public function getUser()
    {
        $total_count = $this->models->adminPageCount();
        $pages = ceil($total_count['count'] / MAX_NUM);
        if (!isset($_GET['page_id'])) {
            $now = 1;
        } else {
            $now = $_GET['page_id'];
        }
        $this->data = $this->models->adminPagerSystem($now, MAX_NUM);
        if ($this->adminCheck()["0"]==="1") {
            require_once(dirname(__FILE__) . $_ENV["ADMIN_DIRECTRY"] . "user.php");
        }
    }

    public function download()
    {
      $file_path = "/Applications/XAMPP/xamppfiles/htdocs/bulletin_board/user.csv";
      $export_csv_title = ["ID","email", "user_id", "pass","name","created_at","updated_at","deleted_at"];
      $export_sql = $this->models->getData($_POST["year"]."-".$_POST["month"]."-".$_POST["day"], $_POST["yearEnd"]."-".$_POST["monthEnd"]."-".$_POST["dayEnd"]);
      foreach ($export_csv_title as $key => $val) {
          $export_header[] = mb_convert_encoding($val,"utf-8", "SJIS");
      }
      if (touch($file_path)) {
          $file = new SplFileObject($file_path, "w");
          // write csv header
          $file->fputcsv($export_header);
          // query database
          // create csv sentences
          foreach ($export_sql as $row) {
              $file->fputcsv($row);
          }
          $this->download_file($file_path);
        }
    }

    public function download_file($path_file)
    {
        /* ファイルの存在確認 */
        if (!file_exists($path_file)) {
          die("Error: File(".$path_file.") does not exist");
        }
        /* オープンできるか確認 */
        if (!($fp = fopen($path_file, "r"))) {
            die("Error: Cannot open the file(".$path_file.")");
        }
        fclose($fp);
        /* ファイルサイズの確認 */
        if (($content_length = filesize($path_file)) == 0) {
            die("Error: File size is 0.(".$path_file.")");
        }
        require_once(dirname(__FILE__) . $_ENV["ADMIN_DIRECTRY"] . "user_download.php");
        if (!readfile($path_file)) {
            die("Cannot read the file(".$path_file.")");
        }
        exit;
    }

    public function h($str)
    {
      return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }

    public function insert()
    {     
      if (isset($_FILES['upfile']['error']) && is_int($_FILES['upfile']['error'])) {
        try {
          /* ファイルアップロードエラーチェック */
          switch ($_FILES['upfile']['error']) {
            case UPLOAD_ERR_OK:
            // エラー無し
            break;
            case UPLOAD_ERR_NO_FILE:
            // ファイル未選択
              throw new RuntimeException('ファイルが選択されていません');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
            // サイズ確認
              throw new RuntimeException('ファイルが大きすぎます');
            default:
              throw new RuntimeException('エラーです');
          }
          $tmp_name = $_FILES['upfile']['tmp_name'];
          $detect_order = 'ASCII,JIS,UTF-8,CP51932,SJIS-win';
          setlocale(LC_ALL, 'ja_JP.UTF-8');
          /* 文字コードを変換してファイルを置換 */
          $buffer = file_get_contents($tmp_name);
          if (!$encoding = mb_detect_encoding($buffer, $detect_order, true)) {
            // 文字コードの自動判定に失敗
            unset($buffer);
            throw new RuntimeException('文字の検出に失敗しました');
          }
          file_put_contents($tmp_name, mb_convert_encoding($buffer, 'UTF-8', $encoding));
          unset($buffer);
          $executed = $this->models->insert($tmp_name);
              /* 結果メッセージをセット */
        if (isset($executed)) {
          $this->data = array('green', 'インポートが完了しました');
        } else {
          $this->data = array('black', 'インポートエラーです');
        }
        } catch (Exception $e) {
        $this->data = array('red', $e->getMessage());
      }
    }
    if ($this->adminCheck()["0"]==="1") {
      require_once(dirname(__FILE__) . $_ENV["ADMIN_DIRECTRY"] . "upload.php");
    }
  }

  public function adminCheck(){
    $flag=$this->models->adminCheck($_SESSION["id"]);
      if($flag["admin"]==="1"){
        return $flag;
      }else{
        return require_once(dirname(__FILE__) . $_ENV["USERS_DIRECTRY"] . "error.php");
      }
  }
}
?>


