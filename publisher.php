<?php
  require_once __DIR__ . "/vendor/autoload.php";
  $con = new MongoDB\Client("mongodb://localhost:27017");
  $db =$con->Lb2_Iteh;
  $tbl= $db->Library;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lb2</title>
</head>
<body>
<?php
if (isset($_POST['publisher'])) $author = $_POST['publisher'];
  else $author = 'Джозеф Конрад';

  print "<table border ='1'>";
  $publisherStorage = " <tr><th>Назва</th><th>ISBN</th><th>Рік</th><th>Видавництво</th><th>Кількість сторінок</th></tr>";
    $coll=$tbl->find(["publisher"=>$author],["projection"=>["_id"=>0]]);
          
    foreach ($coll as $col) {
      $nam=$col['name'];
      if (isset($col['ISBN'])) $isb = $col['ISBN'];
        else $isb = '-';
      if (isset($col['year']))$yea=$col['year'];
        else $yea = '-';
      if (isset($col['publisher']))$pub=$col['publisher'];
        else $pub = '-';
      if (isset($col['quantity']))$qua=$col['quantity'];
        else $qua = '-';
   
        $publisherStorage = $publisherStorage. " <tr><td>$nam</td><td>$isb</td><td>$yea</td><td>$pub</td><td>$qua</td></tr>";
    
    }
    print $publisherStorage;
    print"<script>localStorage.setItem('$author','$publisherStorage')</script>";
    
?>
<input type="button" value="Повернутися" onclick="history.back();return false;" />
</body>
</html>