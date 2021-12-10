<?php
session_start();
session_destroy();
echo "du er logget ud!";
header('Location:/~mrbl/miniprojekt/forum.php');
exit;
?>
