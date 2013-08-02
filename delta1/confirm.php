<?php
include("includes/db.php");
include("includes/functions.php");
include("includes/style.css");
include("includes/font.css");
?>
<html>
<head><title>Thank you!</title></head>
<body>
<?php
@$ctype=$_POST['t'];
@$cno=$_POST['num'];
@$date=date('y-m-d');
@$cusid=mysql_insert_id($con);
$con=mysql_connect("localhost","root","");
if(!$con)
{
die("Couldnot connect to the server".mysql_error());
}
echo "Your credit card(" . $ctype . ")number is ".$cno;
mysql_select_db("shopping");
$add="insert into credit card(CardType,CardNumber) values ('$_POST['t'],'$_POST['num']')";
$cadd=mysql_query($add,$con);
if($cadd)
{
echo "Your order has been registered...<br>It will be delivered within two days<br>";
echo "Thank you for shopping with us!";
}
else
{
echo mysql_error();
}
?>

 
