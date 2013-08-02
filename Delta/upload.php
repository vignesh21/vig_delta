<?php
$allow=new array("gif","jpg","png");
$ext=end(explode(".",$_FILES["file"]["name"]));
if((($_FILES["file"]["type"]=="image/png")||($_FILES["file"]["type"]=="image/jpg"))&&($_FILES["file"]["size"]<1000000)&&in_array($ext,$allow))
{
                 if($_FILES["file"]["error"]>0)
                             {
                                       echo("Errors:".$_FILES["file"]["error"]."<br>";
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
                                                             move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$FILES["file"]["name"]);
                                                             echo "Stored in:"."upload/".$_FILES["file"]["name"];
                                                       }
                                 }
}
