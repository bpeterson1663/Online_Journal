
<?php

  session_start();

  if($_GET['logout']==1 AND $_SESSION['id']){
    session_destroy();
    $message = "You have been logged out. Have a nice day!";
    session_start();
  }

  $conn_string = "host=ec2-54-83-47-88.compute-1.amazonaws.com port=5432 dbname=d9u0r98lepbm2d user=slwolrqqwjlidr password=yQPqAl0gTpOtwMUytkl46jmX64";
  $link = pg_connect($conn_string);

//checks if submit button was pressed
  if($_POST['submit']=="Sign Up"){
    //form validation
    if(!$_POST['email']){//if they didnt enter anything for email
      $error.="<br/>Please enter your email";
    }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){//validate if valid email
      $error.="<br/>Please enter a valid email address";
    }
    if (!$_POST['password']){//check if they enter anything for a password
      $error.="<br/>Please enter your password";
    }else{
      if(strlen($_POST['password']) < 8 ){//checks if password is atleast 8 characters
        $error.="<br/>Please enter a password longer than 8 characters.";
      }
      if(!preg_match('`[A-Z]`', $_POST['password'])){//checks to see if any capital letters are in the password and if not throw an error
        $error.="<br/>Please include at least one capital letter in your password";
      }
    }
    if ($error){
      $error = "<br/>There were error(s) in your signup details:".$error;
    }else{//check to see if email already exists

      $query="SELECT * FROM users WHERE email='".pg_escape_string($link, $_POST['email'])."'";

      $result = pg_query($link, $query);

      $results = pg_fetch_rows($result);

      if($results){
        $error = "That Email address is already registered. Do you want to log in";
      }else{
        $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".pg_escape_string($link, $_POST['email'])."', '".md5(md5($_POST['email']).$_POST['password'])."');";

        pg_query($link, $query);


        header("Location: mainPage.php");

        $_SESSION['id']=pg_insert($link);//starts the session with the last person that was created


      }
    }
  }

  if ($_POST['submit'] == "Log In") {

  $query = "SELECT * FROM users WHERE email='".pg_escape_string($link, $_POST['loginemail'])."' AND password='".md5(md5($_POST['loginemail']).$_POST['loginpassword'])."';";

  $result = pg_query($link, $query);


  $row = pg_fetch_array($result);

  if($row){

    $_SESSION['id']=$row['id'];

    header("Location:mainPage.php");

  } else {
    $error = "We could not find a user with that email and password. Please try again.";
  }

}
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
            <label for="loginemail">Email: </label>
            <input class="form-control" placeholder="Email" type="email" name="loginemail" id="loginemail" />
          </div>
          <div class="form-group">
            <label for="loginpassword">Password: </label>
            <input class="form-control" placeholder="Password" type="password" name="loginpassword" />
          </div>

          <input class="btn btn-info" type="submit" name="submit" value="Log In" />
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

          <input class="btn btn-lg btn-info" type="submit" name="submit" value="Sign Up" />
        </form>


      </div>
    </div>
  </div>
</body>
</html>
