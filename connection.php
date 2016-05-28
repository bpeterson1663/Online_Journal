<?php
  $url=parse_url(getenv("mysql://bf5bc9a564006f:cfd4bb5e@us-cdbr-iron-east-04.cleardb.net/heroku_4e7a27171206c39?reconnect=true"));

  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"],1);

  $link = mysqli_connect($server, $username, $password, $db);

  //mysql_select_db($db);
 ?>
