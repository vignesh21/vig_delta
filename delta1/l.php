<?php
if (isset($_POST['password'])) 
{
 include("db.php");
 $username =  mysql_real_escape_string($_POST['username']);
 $password = mysql_real_escape_string($_POST['password']);
 $qstr = "SELECT * from customers where name='$username' and password ='$password'";

 $result = mysql_query($qstr);
 if (mysql_num_rows($result))  echo "<font color=#008000><Center><b>**Successful Login**</b></Center></font>";
 else echo "<font color=#ff0000><Center><b>**Failed Login**</b></Center></font>";
 mysql_close();
}
else echo "<font color=#ff8000><Center><b>**No login attempted**</b></Center></font>";
?> 