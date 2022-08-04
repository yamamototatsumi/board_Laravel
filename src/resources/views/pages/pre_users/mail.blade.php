<?php
echo "仮登録が完了しました<br>";
echo "本登録を完了させるには下記URLから登録してください";
echo   env('URL') . 'users/insert?id='.$userId;
?>
