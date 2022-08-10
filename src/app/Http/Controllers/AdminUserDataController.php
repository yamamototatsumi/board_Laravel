<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use App\Models\User;

class AdminUserDataController extends Controller
{

    public function __construct()
    {
        $this->models = new User();
    }
    public function index()
    {
        $data = $this->models->indexAdmin();
        return view('pages/admin/user', ['data'=>$data]);
    }


    public function importCsv(Request $request)
    {
        if ($request->hasFile('csv') && $request->file('csv')->isValid()) {
            // CSV ファイル保存
            $tmpname = uniqid("CSVUP_").".".$request->file('csv')->guessExtension(); //TMPファイル名
            $request->file('csv')->move(public_path()."/csv/tmp", $tmpname);
            $tmppath = public_path()."/csv/tmp/".$tmpname;

            // Goodby CSVの設定
            $config_in = new LexerConfig();
            $config_in
            ->setFromCharset("SJIS-win")
            ->setToCharset("UTF-8") // CharasetをUTF-8に変換
            ->setIgnoreHeaderLine(true) //CSVのヘッダーを無視
        ;
            $lexer_in = new Lexer($config_in);

            $datalist = array();

            $interpreter = new Interpreter();
            $interpreter->addObserver(function (array $row) use (&$datalist) {
                // 各列のデータを取得
                $datalist[] = $row;
            });

            // CSVデータをパース
            $lexer_in->parse($tmppath, $interpreter);

            // TMPファイル削除
            unlink($tmppath);
            foreach($datalist as $row){
              // 各データ取り出し
              $csv_user = $this->get_csv_user($row);
  
              // DBへの登録
              $this->regist_user_csv($csv_user);
          }

                return redirect()->route('admin/user')->with('flashmessage', 'CSVのデータを読み込みました。');
            }
            return redirect()->route('admin/user')->with('flashmessage', 'CSVの送信エラーが発生しましたので、送信を中止しました。');
        }
    

    private function get_csv_user($row){
    $user = array(
      'name' => $row[0], 'email' => $row[1], 'user_id' => $row[2], 'email_verified_at' => $row[3],
      'password' => $row[4], 'remember_token'=>$row[5],'created_at'=>$row[6],'updated_at'=>$row[7]
    );
    var_dump($user);
    return $user;

  }

  private function regist_user_csv($user){
    $newuser = new User;
    foreach($user as $key => $value){
        $newuser->$key = $value;
    }
    $newuser->save();
  }

}


//  // 処理
//  foreach ($datalist as $row) {
//   // 各データ取り出し
//   $csv_user = $this->get_csv_user($row);

//   // DBへの登録
//   $count = 0;
//   foreach ($datalist as $row) {
//       User::insertCsv(['name' => $row[0], 'email' => $row[1], 'user_id' => $row[2], 'email_verified_at' => $row[3],
//                       'password' => $row[4], 'remember_token'=>$row[5],'created_at'=>$row[6],'updated_at'=>$row[7]]);
//       $count++;
//   }









// public function importCsv(Request $request)
// {
//     // CSV ファイル保存
//     var_dump($request->file());
//     exit();
//     $tmpName = mt_rand().".".$request->file('csv')->guessExtension(); //TMPファイル名
//     $request->file()->move(public_path()."/csv/tmp", $tmpName);
//     $tmpPath = public_path()."/csv/tmp/".$tmpName;

//     //Goodby CSVのconfig設定
//     $config = new LexerConfig();
//     $interpreter = new Interpreter();
//     $lexer = new Lexer($config);

//     //CharsetをUTF-8に変換、CSVのヘッダー行を無視
//     $config->setToCharset("UTF-8");
//     $config->setFromCharset("sjis-win");
//     $config->setIgnoreHeaderLine(true);

//     $dataList = [];

//     // 新規Observerとして、$dataList配列に値を代入
//     $interpreter->addObserver(function (array $row) use (&$dataList) {
//         // 各列のデータを取得
//         $dataList[] = $row;
//     });

//     // CSVデータをパース
//     $lexer->parse($tmpPath, $interpreter);

//     // TMPファイル削除
//     unlink($tmpPath);

//     // 登録処理
//     $count = 0;
//     foreach ($dataList as $row) {
//         User::insertCsv(['name' => $row[0], 'email' => $row[1], 'user_id' => $row[2], 'email_verified_at' => $row[3],
//                         'password' => $row[4], 'remember_token'=>$row[5],'created_at'=>$row[6],'updated_at'=>$row[7]]);
//         $count++;
//     };



//     echo $count;
// }