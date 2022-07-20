<?php
  require_once __DIR__ . "/vendor/autoload.php";
  $con = new MongoDB\Client("mongodb://localhost:27017");
  $db =$con->Lb2_Iteh;
  $tbl= $db->Library;
?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Lb2</title>
  </head>
  <body>
  <?php

    
    $fyear = $_POST['FYear'];
    $syear = $_POST['SYear'];
    print "<table border ='1'>";
    $yearStorage= " <tr><th>Назва</th><th>Рік</th><th>Вид</th></tr>";
      $coll=$tbl->find(["year"=>['$gte' => (int)$fyear,'$lte' => (int)$syear]]);
            
      foreach ($coll as $col) {
        $nam=$col['name'];
        $yea=$col['year'];
        $type=$col['type'];
        $yearStorage=$yearStorage." <tr><td>$nam</td><td>$yea</td><td>$type</td></tr>";
      }
      print $yearStorage;
      $year=$fyear.$syear;
      print"<script>localStorage.setItem('$year','$yearStorage')</script>";
      
  ?>
  <input type="button" value="Повернутися" onclick="history.back();return false;" />
  </body>
</html>
