<?php 
 error_reporting(E_ALL && E_NOTICE);
 $name = $_POST['name'];
 $mail = $_POST['mail'];
 $con=mysql_connect("localhost","root","");
 if(!$con)
 {
 echo mysql_error();
 }
 mysql_select_db("shopping");
  $query = "SELECT * FROM `customers` WHERE `name` = '".$name."' and `email` = '".$mail."'";
 $result = mysql_query($query);
 if(mysql_num_rows($result) != 0)
 { 
 session_start();
 if(isset ($_SESSION['user']))
 {
  $_SESSION['user'] = $name;
  }
 $_SESSION['logged_in'] = true;
 echo "<script>window.location='products.php'</script>";
 }
 else
 { 
   if(isset ($_SESSION['user']))
   {
       unset($_SESSION['user'], $_SESSION['logged_in']);
       echo"<script>alert('Not logged in')</script>";
    }
 }
 ?>
  <html>
  <head><title>Login</title>
  <h1><center>LOGIN</center></h1></head>
  <hr>
  <body>
  <form action="log.php" method="POST">
 <center>
 <table>
 <tr>
 <td>
 Username:</td>
 <td>
 <input name="name" type="text"></td>
 </tr><tr>
 <td>email:</td>
 <td><input name="mail" type="text"></td>
 </tr>
 </table>
 <input type="submit" value="Login">
 </form>
</center>
</body>
</html>

 