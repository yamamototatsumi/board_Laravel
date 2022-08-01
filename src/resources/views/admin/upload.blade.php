<!DOCTYPE html>
<head>
  <title>CSV to MySQL importation</title>
</head>
<body>
<?php if (isset($this->data)): ?>
  <fieldset>
    <legend>Result</legend>
    <span style="color:<?php echo($this->data[0]) ?>;"><?php echo($this->data[1])?></span>
  </fieldset>
<?php endif; ?>
<a href="../../../admin">管理者ページトップへ戻る</a>
</body>
</html>




