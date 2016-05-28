<?php
  //$url=parse_url("mysql://bf5bc9a564006f:cfd4bb5e@us-cdbr-iron-east-04.cleardb.net/heroku_4e7a27171206c39?reconnect=true");

  $server = 'us-cdbr-iron-east-04.cleardb.net';
  $username = 'bf5bc9a564006f';
  $password = 'cfd4bb5e';
  $db = 'heroku_4e7a27171206c39';

  $link = mysqli_connect($server, $username, $password, $db);

  //mysql_select_db($db);
 ?>
