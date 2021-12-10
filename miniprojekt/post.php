<!DOCTYPE html>
<html>
<head>

<title>Forum post</title>
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
    font-size: 45px;
    font-weight: bold;
    text-align: center;
}

h2{
  font-family: helvetica;
    color: black;
    font-size: 30px;
    text-align: center;
}

p{
  font-family: helvetica;
    color: black;
    font-size: 20px;
    text-align: center;
}

p1{
  font-family: helvetica;
    color: black;
    font-size: 20px;
    text-align: center;
}

p2{
  font-family: helvetica;
    color: black;
    font-size: 15px;
    text-align: center;
}

form{
  font-family: helvetica;
    color: black;
    font-size: 20px;
    text-align: center;
}

.boxed {
  border: 2px solid black;
}



</style>
</head>
<body>

<?php
session_start();
require_once '/home/mir/forum/forum.php';
$read = add_read($_GET['post'], $_SESSION['uid']);
echo "<form action='/~mrbl/miniprojekt/forum.php' method='post'>";
      echo "<input type='submit' value='Tilbage'>";
      echo "</form>";

  if(!empty($_SESSION['uid']) && !empty($_POST['lid'])) {
        $addlike = add_like($_POST['lid'], $_SESSION['uid']);
  }
if(!empty($_SESSION['uid']) && !empty($_POST['ulid'])) {
        $deletelike = delete_like($_POST['ulid'], $_SESSION['uid']);
  }
if(!empty($_SESSION['uid']) && !empty($_POST['slet'])) {
        $deleteanswer = delete_answer($_POST['slet']);
  }
if(!empty($_SESSION['uid']) && !empty($_POST['overskrift']) && !empty($_POST['indhold'])) {
        $MODIFY = modify_post($_GET['post'], $_POST['overskrift'], $_POST['indhold']);
  }



$posts = get_post($_GET['post']);
echo "<h2>Title: " . "<a href='https://wits.ruc.dk/~mrbl/miniprojekt/post.php?post=" . $posts['pid'] . "'>"  . $posts['title'] . "</a></h2>" . "<p> Author: " . $posts['uid'] . "   Date: " . $posts['date'] . "</p><p1>" . "<div class='boxed'>" . $posts['content']
 . "</div>" . "</p1><p2>Svar til post:</p2><br>";
if(!empty($_SESSION['uid']) && $posts['uid'] == $_SESSION['uid']){
      echo "<form action='/~mrbl/miniprojekt/post.php?post=" . $_GET['post'] . "'" . "method='post'>";
      echo "<label for='overskrift'>Title:</label><br>";
      echo "<input type='text' id='overskrift' name='overskrift'><br>";
      echo "<label for='indhold'>Indhold</label><br>";
      echo "<input type='text' id='indhold' name='indhold'>";
      echo "<br><br>";
      echo "<input type='submit' value='ændre opslag'>";
      echo "</form>";
        }

 $svar = get_aids_by_pid($_GET['post']);
        foreach ($svar as $x) {
          $answer = get_answer($x);
          echo "<p2>Author: " . $answer['uid'] . ", Dato: " . $answer['date'] . "<br>Svar: " . $answer['content'] ."</p2><br>";
          $likes = get_likes_by_aid($x);
          echo "<p2>Antal likes: " . count($likes) . "</p2><br>";

            $liked = has_liked($answer['aid'], $_SESSION['uid']);
        if(!empty($_SESSION['uid']) && $liked == true){
            echo "<form action='/~mrbl/miniprojekt/post.php?post=" . $_GET['post'] . "'" . "method='post'>";
    echo "<input type='hidden' id='ulid' name='ulid' value='" . $answer["aid"] . "'>";
      echo "<input type='submit' value='unlike'>";
      echo "</form>";

        }elseif(!empty($_SESSION['uid'])){
    echo "<form action='/~mrbl/miniprojekt/post.php?post=" . $_GET['post'] . "'" . "method='post'>";
    echo "<input type='hidden' id='lid' name='lid' value='" . $answer["aid"] . "'>";
      echo "<input type='submit' value='like'>";
      echo "</form>";
        }

          if(!empty($_SESSION['uid']) && $answer['uid'] == $_SESSION['uid']){
    echo "<form action='/~mrbl/miniprojekt/post.php?post=" . $_GET['post'] . "'" . "method='post'>";
    echo "<input type='hidden' id='slet' name='slet' value='" . $answer["aid"] . "'>";
      echo "<input type='submit' value='slet svar'>";
      echo "</form>";
        }


        echo "<br>";
        }

  if(!empty($_SESSION['uid']) && !empty($_GET['post'])) {

      if(!empty($_POST['aindhold'])){
    $svar = add_answer($_SESSION['uid'], $_GET['post'], $_POST['aindhold']);

      header("Refresh:0");
      }
      echo "<form action='/~mrbl/miniprojekt/post.php?post=" . $_GET['post'] . "'" . "method='post'>";
      echo "<label for='aindhold'>Indhold</label><br>";
      echo "<input type='text' id='aindhold' name='aindhold'>";
      echo "<br><br>";
      echo "<input type='submit' value='Send svar til opslag'>";
      echo "</form>";
  }
?>
</body>
</html>