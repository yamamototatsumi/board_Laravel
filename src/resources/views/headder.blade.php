<!-- header -->
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ asset('css/stylesHeadder.css') }}">
</head>
<div class="msg">
  <?php 
    echo '<h1>'.$this->data["name"].'</h1>'; 
    echo $this->data["link"] ;
  ?>
</div>
<header>
  <h1 class="headline"><a>みんなの掲示板</a></h1>
  <?php 
    echo "<h3>" .$this->data["headerLink"]. "</h3>";
    echo "<h3>" .$this->data["adminLink"]."</h3>";
  ?>
  </header>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
