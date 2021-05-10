<?php   
  session_start();  
  if(!isset($_SESSION["sess_user"])){  
      header("location:new_login.php");  
  } else { 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>My Profile</title>
    </head>
     <style>
            *{
                box-sizing: border-box;
            }

            body {
              margin: 0;
            }

            .navbar {
              overflow: hidden;
              background-color: #333;
              font-family: Arial, Helvetica, sans-serif;
            }

            .navbar a {
              float: left;
              font-size: 16px;
              color: white;
              text-align: center;
              padding: 14px 16px;
              text-decoration: none;
            }

            .navbar a:hover{
              background-color: red;
            }

            h2, h3{
                text-align: center;
            }
        </style>
    <body>
        <div class="navbar">
            <a href="index.html">Home</a>
            <a href="profile.php">My Profile</a>
            <a href="orders.php">My Orders</a>
            <a href="new_login.php">Login</a>
            <a href="about.html">About Us</a>
            </div>
        <hr>
        <h2>Logout</h2>
        <hr>
        <h3>Welcome, <?=$_SESSION['sess_user'];?>! 
        <br>
        <a href="logout.php">Logout</a></h3>
    </body>
</html>
<?php
  }
?>