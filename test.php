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
    <script>
    function getAuthor(){
      let out = document.getElementById('author').value;
      let res = localStorage.getItem(out);
      document.getElementById('result').innerHTML = res;
    }
    function getPublisher(){
      let out = document.getElementById('publisher').value;
      let res = localStorage.getItem(out);
      document.getElementById('result').innerHTML = res;
    }
    function getYear(){
      let out = document.getElementById('FYear').value;
      out += document.getElementById('SYear').value;
      let res = localStorage.getItem(out);
      document.getElementById('result').innerHTML = res;
    }
    </script>
</head>
<body>
<div class="MyForm">
<form action="authors.php" method="post">
      <h3>Получить информацию по имени автора</h3>
      <select name='author' id='author' onchange onclick="getAuthor()">
        <?php
          $coll=$tbl->find(["type"=>"book"],["projection"=>["_id"=>0,"authors" => 1]]);
          foreach ($coll as $col) {
            $nam=$col['authors'];
            var_dump($col);
            print "<option value = '$nam'>$nam</option>";
          }
        ?>
      </select>
      <br>
      <input type="submit" value="ok" >
    </form>
    <br>
    <form action="year.php" method="post">
      <h3>Получить информацию по году</h3>
      <input name='FYear' id='FYear' onchange = "getYear()">
      </input>
      ПО
      <input name='SYear' id='SYear' onchange = "getYear()">
      </input>
      <br>
      <input type="submit" value="ok">
    </form>
    <br>
    <form action="publisher.php" method="post">
      <h3>Получить информацию по издательству</h3>
      <select name = 'publisher' id = 'publisher' onchange onclick = "getPublisher()" >
        <?php
         $coll=$tbl->find(["publisher"=>['$exists'=>true]]);
          
         foreach ($coll as $col) {
           $nam=$col['publisher'];
           var_dump($col);
           print "<option value = '$nam'>$nam</option>";
         }
        ?>
      </select>
      <br>
      <input type="submit" value="ok">
    </form>
  </div>
  <div class="MyForm">
    <table border='1' id='result'>
    </table>
    </div>
 </body>
</html>
