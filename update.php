<?php

  session_start();
  $server = 'us-cdbr-iron-east-04.cleardb.net';
  $username = 'b8c9d44004cc5d';
  $password = '42f42c8f';
  $db = 'heroku_7da4bb181d6ffac';

  $link = mysqli_connect($server, $username, $password, $db);

  $query = "UPDATE users SET entry='".mysqli_real_escape_string($link, $_POST['entry'])."' WHERE id='".$_SESSION['id']."' LIMIT 1";

  mysqli_query($link, $query);
 ?>
