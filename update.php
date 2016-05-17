<?php

  session_start();
  include('connection.php');

  $query = "UPDATE users SET entry='".mysqli_real_escape_string($link, $_POST['entry'])."' WHERE id='".$_SESSION['id']."' LIMIT 1";

  mysqli_query($link, $query);
 ?>
