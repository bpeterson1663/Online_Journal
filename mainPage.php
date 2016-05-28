<?php
	session_start();

	$conn_string = "host=ec2-54-83-47-88.compute-1.amazonaws.com port=5432 dbname=d9u0r98lepbm2d user=slwolrqqwjlidr password=yQPqAl0gTpOtwMUytkl46jmX64";
	$link = pg_connect($conn_string);

	$query="SELECT entry FROM users WHERE id='".$_SESSION['id']."' LIMIT 1;";

	$result = pg_query($link, $query);

	$row = pg_fetch_array($result);

	$entry=$row['entry'];

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Online Journal</title>
    <script src="vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="styles/styles.css" rel="stylesheet" />
  </head>
<body data-spy="scroll" data-target=".navbar-collapse">
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header pull-left">
        <a class="navbar-brand">Online Journal</a>
      </div>
      <div class="pull-right">
        <ul class="navbar-nav nav pull-right">
          <li><a href="index.php?logout=1">Log Out</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container" id="topContainer">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
				<p class="lead lead-welcome"><b>No need to save. It will do it for you!</b></p>
        <textarea class="form-control journal-entry" name="entry">

            <?php echo $entry; ?>
        </textarea>

      </div>
    </div>
  </div>
  <script>
  $("textarea").css("height",$(window).height()-120);
  $("textarea").keyup(function(){
    $.post("update.php", {entry:$("textarea").val()} );
  });
  </script>
</body>
</html>
