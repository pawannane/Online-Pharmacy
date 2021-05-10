
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Signin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <?php
  
  if(isset($_POST["submit"])){  
  
    if(!empty($_POST['email']) && !empty($_POST['pass'])) {  
    $email=$_POST['email'];  
    $pass=$_POST['pass'];   

    $con=mysqli_connect('localhost','root','mysql','online_pharmacy') or die(mysql_error());  
  
    $query=$con->query("SELECT * FROM user_data WHERE `Email`='".$email."' AND `Password`='".$pass."'");  
    $numrows=mysqli_num_rows($query);  
    if($numrows!=0)  
    {  
    while($row=mysqli_fetch_assoc($query))  
    {  
    $dbEmail=$row['Email'];  
    $dbPassword=$row['Password'];  
    }  
  
    if($email == $dbEmail && $pass == $dbPassword)  
    {  
    session_start();  
    $_SESSION['sess_user']=$email;  
  
    /* Redirect browser */  
    header("Location: index.html");  
    }  
    } else {  
    echo "Invalid username or password!";  
    }  
  
} else {  
    echo "All fields are required!";  
}
} 

  ?>
  <body class="text-center">
    <form class="form-signin" action="" method="post">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" id="submit" name="submit" type="submit">Sign in</button>
  <a class="btn btn-lg btn-primary btn-block" href="sign-up.html" onclick="_blank">Sign up</a>
</form>

</body>
</html>
