<?php
if(isset($_GET["chek"]))
{
  $chek = $_GET["chek"];
  file_put_contents('night.txt', $chek);
  echo $chek;
}
else if (file_exists('night.txt'))
{
  echo file_get_contents('night.txt');
}
else
{
  echo 1;
}

?>
