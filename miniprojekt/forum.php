<!DOCTYPE html>
<html>
<head>

<title>Forum</title>
<style>
body {
background-color: white;
font-family: helvetica;
  color: black;
  font-size: 1.5rem;

}

h1{
  font-family: helvetica;
    font-size: 45px;
    font-weight: bold;
    text-align: center;
}

h2{
  font-family: helvetica;
    font-size: 30px;
    text-align: center;
}

p{
  font-family: helvetica;
    font-size: 20px;
    text-align: center;
}

p1{
  font-family: helvetica;
    font-size: 20px;
    text-align: center;
}

p2{
  font-family: helvetica;
    font-size: 15px;
    text-align: center;
}

form{
  font-family: helvetica;
    font-size: 20px;
    text-align: center;
}

.boxed {
  border: 2px solid black;
}



</style>
<script>
function ajax(url, handle) {
  // Fetch document from `url`, pass result to function `handle`.
  var request = new XMLHttpRequest();
  request.open("GET", url, true);
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      handle(this.responseText);
    }
  };
  request.send();
}

function skift2(text) {
if(text == 0){
 document.body.style.backgroundColor = "white";
 }else{
     document.body.style.backgroundColor = "#2b2e4a";
 }
}

function skift(n){
  var c = 0;
  if(n == 0){
 c = 1;
 }else{
     c = 0;
 }
  ajax('ajax12.php?chek=' + c, skift2);
}

function myFunction(){
  ajax("ajax12.php?", skift);
}

</script>
</head>
<body>
<button id="124" type="button" onclick="myFunction()"> Skift Mode </button>

<script>
ajax("ajax12.php?",skift2);
</script>
  <h1>Velkommen til dette forum</h1>
  <p>Login eller opret en bruger for at kunne poste indlæg, kommentere på andres indlæg, eller like dem. </p>
<?php
session_start();
require_once '/home/mir/forum/forum.php';

if (!empty($_SESSION["uid"])) {
  echo "<p>Du er logget ind som: " . $_SESSION["uid"] . "</p>";
  echo "<form action='/~mrbl/miniprojekt/logout.php' method='post'>";
  echo "<input type='submit' value='Logout'>";
  echo "</form><br>";

  if(!empty($_POST['overskrift']) && !empty($_POST['indhold'])) {

    $opslag = add_post($_SESSION['uid'], $_POST['overskrift'], $_POST['indhold']);

      if(!empty($opslag)){
        echo "<p>Dit opslag er oprettet</p>";
      }else{
        echo "<p>Problemer med at oploade</p>";
      }
   }
      echo "<form action='/~mrbl/miniprojekt/forum.php' method='post'>";
      echo "<label for='overskrift'>Title: </label><br>";
      echo "<input type='text' id='overskrift' name='overskrift'><br>";
      echo "<label for='indhold'>Indhold: </label><br>";
      echo "<input type='text' id='indhold' name='indhold'>";
      echo "<br><br>";
      echo "<input type='submit' value='Send opslag'>";
      echo "</form>";
}

if (!empty($_POST["password"]) && !empty($_POST["uid"])) {
  if (login($_POST["uid"], $_POST["password"])) {
      $_SESSION["uid"] = $_POST["uid"];
      header('Location:/~mrbl/miniprojekt/forum.php');
      exit;
  }else{
      echo "<p>Du har tastet din kode eller dit bruger navn forkert</p>";
  echo "<form action='/~mrbl/miniprojekt/forum.php' method='post'>";
  echo "<label for='uid'>Username: </label>";
  echo "<input type='text' id='uid' name='uid'><br>";
  echo "<label for='password'>Password: </label>";
  echo "<input type='password' id='password' name='password'>";
  echo "<br>";
  echo "<input type='submit' value='Login'>";
  echo "</form>";
  echo "<form action='/~mrbl/miniprojekt/opretbruger.php' method='post'>";
  echo "<input type='submit' value='Opret bruger'>";
  echo "</form>";
}
}elseif (empty($_SESSION["uid"])){
  echo "<form action='/~mrbl/miniprojekt/forum.php' method='post'>";
  echo "<label for='uid'>Username: </label>";
  echo "<input type='text' id='uid' name='uid'><br>";
  echo "<label for='password'>Password: </label>";
  echo "<input type='password' id='password' name='password'>";
  echo "<br>";
  echo "<input type='submit' value='Login'>";
  echo "</form>";
  echo "<form action='/~mrbl/miniprojekt/opretbruger.php' method='post'>";
  echo "<input type='submit' value='Opret bruger'>";
  echo "</form>";
}


    foreach(get_pids() as $value){
        $posts = get_post($value);
        $reads = has_read($posts['pid'], $_SESSION['uid']);
        if($reads == FALSE && !empty($_SESSION['uid'])){
           echo "<h2>Title: " . "<a href='https://wits.ruc.dk/~mrbl/miniprojekt/post.php?post=" . $posts['pid'] . "'>"  . $posts['title'] . "</a></h2>" . "<p> Author: " . $posts['uid'] . "   Date: " . $posts['date'] . "</p><p1>" . "<div class='boxed'>" . $posts['content']
            . "</div>" . "</p1><p2>Svar til post:</p2><br>";


        $svar = get_aids_by_pid($value);
        foreach ($svar as $x) {
          $answer = get_answer($x);
          echo "<p2>Author: " . $answer['uid'] . ", Dato: " . $answer['date'] . "<br>Svar: " . $answer['content'] ."</p2><br>";
          $likes = get_likes_by_aid($x);
          echo "<p2>Antal likes: " . count($likes) . "</p2><br>";
          $y++;
          if($y==5){
            $y=0;
            break;
          }
        }
        }elseif(empty($_SESSION['uid'])){
           echo "<h2>Title: " . "<a href='https://wits.ruc.dk/~mrbl/miniprojekt/post.php?post=" . $posts['pid'] . "'>"  . $posts['title'] . "</a></h2>" . "<p> Author: " . $posts['uid'] . "   Date: " . $posts['date'] . "</p><p1>" . "<div class='boxed'>" . $posts['content']
            . "</div>" . "</p1><p2>Svar til post:</p2><br>";


       $svar = get_aids_by_pid($value);
       foreach ($svar as $x) {
         $answer = get_answer($x);
          echo "<p2>Author: " . $answer['uid'] . ", Dato: " . $answer['date'] . "<br>Svar: " . $answer['content'] ."</p2><br>";
         $likes = get_likes_by_aid($x);
         echo "<p2>Antal likes: " . count($likes) . "</p2><br>";
         $y++;
         if($y==5){
           $y=0;
           break;
         }
        }
        }
  }
?>
</body>
</html>
