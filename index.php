<?php
  session_start();
//checks if submit button was pressed
  if($_POST['submit']=="Sign Up"){
    //form validation
    if(!$_POST['name']){
      $error.="<br/>Please enter your name";
    }
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
      echo "<br/>There were error(s) in your signup details:".$error;
    }else{//check to see if email already exists
      $link = mysqli_connect('localhost', 'root', 'root', 'online_journal');


      $query="SELECT * FROM users WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'";

      $result = mysqli_query($link, $query);

      $results = mysqli_num_rows($result);

      if($results){
        echo "That Email address is already registered. Do you want to log in";
      }else{
        $query = "INSERT INTO `users` (`name`, `email`, `password`) VALUES( '".$_POST['name']."', ".mysqli_real_escape_string($link, $_POST['email'])."', '".md5(md5($_POST['email']).$_POST['password'])."')";

        mysqli_query($link, $query);

        echo "You've been signed up!";

        $_SESSION['id']=mysqli_insert_id($link);//starts the session with the last person that was created
      }
    }
  }

  if($_POST['submit']=="Log In"){

      $query = "SELECT * FROM users WHERE email='".mysqli_real_escape_string($link, $_POST['loginEmail'])."' AND password='".md5(md5($_POST['loginEmail']).$_POST['loginPassword'])."' LIMIT 1";

      $result = mysqli_query($link, $query);

      $row = mysqli_fetch_array($result);

      if($row){
        $_SESSION['id']=$row['id'];
      }else{
        echo "We Could not find a user with that email and password. Please try again.";
      }
  }
?>

<form method="POST">
  <label for="name">Name: </label>
  <input type="name" name="name" id="name" value="<?php echo addslashes($_POST['name']);?>"/>
  <label for="email">Email: </label>
  <input type="email" name="email" id="email" value="<?php echo addslashes($_POST['email']);?>"/>
  <label for="password">Password: </label>
  <input type="password" name="password" value="<?php echo addslashes($_POST['password']);?>"/>
  <input type="submit" name="submit" value="Sign Up" />
</form>

<form method="POST">
  <label for="loginEmail">Email: </label>
  <input type="email" name="loginEmail" id="loginEmail" value="<?php echo addslashes($_POST['email']);?>"/>
  <label for="loginPassword">Password: </label>
  <input type="password" name="loginPassword" value="<?php echo addslashes($_POST['password']);?>"/>
  <input type="submit" name="submit" value="Log In" />
</form>
