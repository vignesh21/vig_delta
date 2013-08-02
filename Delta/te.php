<?php
$co=mysql_connect("localhost","root","");
mysql_select_db("vignesh",$co);
$s=mysql_query("select image from photos",$co);
if(!$s)
{
echo mysql_error();
}
mysql_close($co);
?>