<!DOCTYPE html>
<html>
<head>

<title>Forum opret bruger</title>
<link rel="stylesheet" href="mystyle.css">
<style>
body {
background-color: white;
font-family: helvetica;
  color: black;
  font-size: 1.5rem;
}

h1{
  font-family: helvetica;
    color: black;
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
}

p{
  font-family: helvetica;
    color: black;
    font-size: 20px;
    text-align: center;
}

form{
  font-family: helvetica;
    color: black;
    font-size: 20px;
    text-align: center;
}
</style>
<body>
  <h1>Her kan du oprette en bruger, ved udfylde nedenstående felter, og trykke på submit.</h1>
<?php
session_start();
require_once '/home/mir/forum/forum.php';
echo "<form action='/~mrbl/miniprojekt/forum.php' method='post'>";
      echo "<input type='submit' value='Tilbage'>";
      echo "</form>";

if (!empty($_POST["password"]) && !empty($_POST["uid"]) && !empty($_POST["firstname"]) && !empty($_POST["lastname"])){

$uid = $_POST['uid'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$password = $_POST['password'];

    $adduser = add_user($uid, $firstname, $lastname, $password);

      if($adduser == true){
        $_SESSION["uid"] = $_POST["uid"];
        header('Location:/~mrbl/miniprojekt/forum.php');
        exit;
    }else{
    echo "<p>Dette username er i brug</p>";
    echo "<form action='/~mrbl/miniprojekt/opretbruger.php' method='post'>";
    echo "<label for='uid'>Firstname:</label><br>";
    echo "<input type='text' id='firstname' name='firstname'><br>";
    echo "<label for='uid'>Lastname:</label><br>";
    echo "<input type='text' id='lastname' name='lastname'><br>";
    echo "<label for='uid'>Username:</label><br>";
    echo "<input type='text' id='uid' name='uid'><br>";
    echo "<label for='password'>Password</label><br>";
    echo "<input type='password' id='password' name='password'>";
    echo "<br><br>";
    echo "<input type='submit' value='Submit'>";
  }
}elseif(!empty($_POST["password"]) or !empty($_POST["uid"]) or !empty($_POST["firstname"]) or !empty($_POST["lastname"])){
  echo "<p>Du har glemt at udfylde et felt</p>";
  echo "<form action='/~mrbl/miniprojekt/opretbruger.php' method='post'>";
  echo "<label for='uid'>Firstname:</label><br>";
  echo "<input type='text' id='firstname' name='firstname'><br>";
  echo "<label for='uid'>Lastname:</label><br>";
  echo "<input type='text' id='lastname' name='lastname'><br>";
  echo "<label for='uid'>Username:</label><br>";
  echo "<input type='text' id='uid' name='uid'><br>";
  echo "<label for='password'>Password</label><br>";
  echo "<input type='password' id='password' name='password'>";
  echo "<br><br>";
  echo "<input type='submit' value='Submit'>";
}else{
  echo "<form action='/~mrbl/miniprojekt/opretbruger.php' method='post'>";
  echo "<label for='uid'>Firstname:</label><br>";
  echo "<input type='text' id='firstname' name='firstname'><br>";
  echo "<label for='uid'>Lastname:</label><br>";
  echo "<input type='text' id='lastname' name='lastname'><br>";
  echo "<label for='uid'>Username:</label><br>";
  echo "<input type='text' id='uid' name='uid'><br>";
  echo "<label for='password'>Password</label><br>";
  echo "<input type='password' id='password' name='password'>";
  echo "<br><br>";
  echo "<input type='submit' value='Submit'>";
}
?>
</body>
</html>
