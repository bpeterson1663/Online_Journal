<?php
  //$link = mysqli_connect('localhost', 'root', 'root', 'online_journal');
$url = parse_url(getenv("heroku_4e7a27171206c39"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$link = new mysqli($server, $username, $password, $db);
?>
