<?php
    
    $con=mysql_connect("localhost","root","");
	if(!$con)
	{
	die("Demo is not available, please try again");
	}
	$db="create database shopping";
	$cdb=mysql_query($db,$con);
	@mysql_select_db("shopping") or die("Demo is not available, please try again later");
	session_start();
    	
$cus="CREATE TABLE IF NOT EXISTS `customers` (
  `serial` int(11) NOT NULL auto_increment,
  `name` varchar(20) collate latin1_general_ci NOT NULL,
  `email` varchar(80) collate latin1_general_ci NOT NULL,
  `address` varchar(80) collate latin1_general_ci NOT NULL,
  `phone` varchar(20) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`serial`)
)";
$cus1=mysql_query($cus,$con);

$ord="CREATE TABLE IF NOT EXISTS `orders` (
  `serial` int(11) NOT NULL auto_increment,
  `date` date NOT NULL,
  `customerid` int(11) NOT NULL,
  PRIMARY KEY  (`serial`)
)"; 
$ord1=mysql_query($ord,$con);

$det="CREATE TABLE IF NOT EXISTS `order_detail` (
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
)";
$det1=mysql_query($det,$con);

$pro="CREATE TABLE IF NOT EXISTS `products` (
  `serial` int(11) NOT NULL auto_increment,
  `name` varchar(20) collate latin1_general_ci NOT NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL,
  `price` float NOT NULL,
  `picture` varchar(80) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`serial`)
)";
 $pro1=mysql_query($pro,$con);

$ins="INSERT INTO `products` (`serial`, `name`, `description`, `price`, `picture`) VALUES
(1, 'View Sonic LCD', '19in View Sonic Black LCD, with 10 months warranty', 250, 'images/lcd.jpg'),
(2, 'IBM CDROM Drive', 'IBM CDROM Drive', 80, 'images/cdrom-drive.jpg'),
(3, 'Laptop Charger', 'Dell Laptop Charger with 6 months warranty', 50, 'images/charger.jpg'),
(4, 'Seagate Hard Drive', '80 GB Seagate Hard Drive in 10 months warranty', 40, 'images/hard-drive.jpg'),
(5, 'Atech Mouse', 'Black colored laser mouse. No warranty', 5, 'images/mouse.jpg'),
(6, 'Nokia 5800', 'Nokia 5800 XpressMusic is a mobile device with 3.2in widescreen display brings photos, video clips and web content to life', 299, 'images/mobile.jpg')";
$ins1=mysql_query($ins,$con);

	?>