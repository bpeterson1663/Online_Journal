<?php

include('login.php');
include('connection.php');
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="styles/styles.css" rel="stylesheet" />
  </head>
<body data-spy="scroll" data-target=".navbar-collapse">
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand">Online Journal</a>
      </div>
      <div class="collapse navbar-collapse">
        <form class="navbar-form navbar-right" method="POST">
          <div class="form-group">
            <label for="loginEmail">Email: </label>
            <input class="form-control" placeholder="Email" type="email" name="loginEmail" id="loginEmail" value="<?php echo addslashes($_POST['loginEmail']);?>"/>
          </div>
          <div class="form-group">
            <label for="loginPassword">Password: </label>
            <input class="form-control" placeholder="Password" type="password" name="loginPassword" value="<?php echo addslashes($_POST['loginPassword']);?>"/>
          </div>

          <input class="btn btn-success" type="submit" name="submit" value="Log In" />
        </form>
      </div>
    </div>
  </div>

  <div class="container" id="topContainer">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h1>Online Journal</h1>
        <p class="lead">Your own personal online journal wherever you want it.</p>
        <?php
          if($error){
            echo '<div class="alert alert-danger">'.addslashes($error).'</div>';
          }
          if($message){
            echo '<div class="alert alert-success">'.addslashes($message).'</div>';
          }
         ?>
        <form method="POST">
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" placeholder="Email" type="email" name="email" id="email" value="<?php echo addslashes($_POST['email']);?>"/>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" placeholder="Password" type="password" name="password" value="<?php echo addslashes($_POST['password']);?>"/>
          </div>

          <input class="btn btn-lg btn-success" type="submit" name="submit" value="Sign Up" />
        </form>


      </div>
    </div>
  </div>
</body>
</html>
