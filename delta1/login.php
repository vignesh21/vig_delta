<?php
include("bill.php");
$con=mysql_connect("localhost","root","");
if(!$con)
{
echo mysql_error();
}
mysql_select_db("shopping");
$sel="Select * from customers where name==$_POST['username'] && password==$_POST['password']";
$csel=mysql_query($sel,$con);
if($csel)
{
echo "logged in";
echo" <script>window.location='products.php'</script>";
$_SESSION['cart']['uname']=$_POST['username'];
}
else
{
echo"Sorry,could not login";
}
?>

<html>
<head>
<title>Login</title>
</head>
<body>
<form name="log" method="post" >
Username:<input type="text" name="username">
Password:<input type="password" name="password">
</form>
 