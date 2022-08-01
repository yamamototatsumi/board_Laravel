<h1><?php 
echo $msg;?></h1>
<?php 
// echo $this->data["link"];
echo   env('URL') . 'users/insert?id='.$userId;
?>

