<?php
include("includes/db.php");
include("includes/functions.php");
?>
<html>
<head><title>Thank you!</title></head>
<body>
<?php
@$ctype=$_POST['s'];
@$cno=$_POST['num'];
@$date=date('y-m-d');
@$cusid=mysql_insert_id($con);
$con=mysql_connect("localhost","root","");
if(!$con)
{
die("Couldnot connect to the server".mysql_error());
}
echo "Your credit card number is ".$cno;
mysql_select_db("shopping");
$add="insert into Credit Card values($ctype,$cno,$cusid,$date)";
$cadd=mysql_query($add,$con);
echo "Your order has been registered...<br>It will be delivered within two days<br>";
echo "Thank you for shopping with us!";
?>

 
