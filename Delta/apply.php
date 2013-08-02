<?php
@$name=isset($_POST["fname"])  ? $_POST["fname"] : null;
@$roll=isset($_POST["roll"]) ? $_POST["roll"] : null;
@$date=isset($_POST["dob"]) ? $_POST["dob"] : null;
@$mail=isset($_POST["mail"]) ? $_POST["mail"] : null;
@$dept=isset($_POST["dept"]) ? $_POST["dept"] : null;
@$pass=isset($_POST["pwd"]) ? $_POST["pwd"] : null;
@$add=isset($_POST["add"]) ? $_POST["add"] : null;
@$school=isset($_POST["s"]) ? $_POST["s"] : null;
@$gender=isset($_POST["sex"]) ? $_POST["sex"] : null;
@$club=isset($_POST['club']) ? implode(",",$_POST['club']) : null;
@$allow=array("jpg","png");
@$ext=end(explode(".",$_FILES["file"]["name"]));
if((($_FILES["file"]["type"]=="image/png")||($_FILES["file"]["type"]=="image/jpg"))&&($_FILES["file"]["size"]<1000000)&&in_array($ext,$allow))
{
                 if($_FILES["file"]["error"]>0)
                             {
                                       echo "Errors:".$_FILES["file"]["error"]."<br>";
                              }
                  else
                              {
                                       echo"Upload:".$_FILES["file"]["name"]."<br>";
                                        echo"Type:".$_FILES["file"]["type"]."<br>";
                                         if(FILE_EXISTS("upload/".$_FILES["file"]["name"]))
                                                    {
                                                         echo $_FILES["file"]["name"]."already exists";
                                                    }
                                             else
                                                      {
                                                             move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"]);
                                                             echo "Stored in:"."upload/".$_FILES["file"]["name"];
                                                       }
                                 }
}
$fe=$_FILES["file"]["tmp_name"];
$op=fopen($fe,'r');
$read=fread($op,fileSize($fe));
fclose($op);
$imgData =addslashes($read);
$con=mysql_connect("localhost","root","");
if(!$con)
{
die("Sorry,could not connect:".mysql_error());
}
$sel=mysql_select_db("vignesh",$con);
if(!$sel)
{
$db="create database vignesh";
$cdb=mysql_query($db,$con);
           if($cdb) 
                   {
                      echo "database vignesh created";
                    }
mysql_select_db("vignesh",$con);
}
$ins="insert into college values('$_POST[fname]',$_POST[roll],'$date','$_POST[mail]','$_POST[add]','$_POST[sex]','$_POST[s]','$_POST[dept]','$_POST[pwd]','$club')";
$cins=mysql_query($ins,$con);
      if($cins)
            {
                  echo "Records on ".$name." inserted";
             }
mysql_query("create table photos(image blob,Rollno bigint,Type varchar(10))",$con);
$im="insert into photos(image,Rollno,Type) values('$imgData','$_POST[roll]','$ext')";
$cim=mysql_query($im,$con);
         if($cim)
           {
                   echo "Photo of ".$name." inserted";
           }
mysql_close($con);
?>