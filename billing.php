<?php
error_reporting(E_ALL && E_NOTICE);
include("includes/db.php");
include("includes/functions.php");
include("includes/style.css");
include("includes/font.css");
?>
<html>
<head>
<title>Billing Info</title>
<script language="Javascript">
function validate()
{
return name();
}
function name()
{
var pattern=/[^a-z]/i;
if(!pattern.test(document.form.name.value))
{
                  if(document.form.name.value.charAt(0)===document.form.name.value.charAt(0).toUpperCase() && document.form.name.value!=="")                                                    { 
                                   return mail();
                                }
                  else
                               {
                                  alert("Enter your Name,starting with Ucase");
                                  return false;
                               }
}
else
alert("Only alphabets");
return false;
}
function mail()
{
var email=document.form.email.value;
var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+$/;
if(email!=="" && pattern.test(email))
{
return contact();
}
else
alert("Enter email id properly");
return false;
}
function contact()
{
var ph=document.form.phone.value;
var pattern=/^\d$/;
if(ph==="" && !pattern.test(ph))
{
alert("Enter only digits in youy contact field");
return false;
ph.select();
}
else
{
               if(ph.length!=10)
                         {
                              alert("Enter your 10 digit mobile number");
                              return false;
                              ph.select();
                         }
               else 
                      return add();
}
}
function add()
{
var add=document.form.address.value;
if(add=="")
{
alert("Enter your address!");
return false;
}
else
{
if(confirm("Do you want to proceed to make payment?"))
{
document.form.submit();
}
else
{
return false;
}
}
}
</script>
</head>


<body>
<form name="form" action="payment.php"onSubmit="return validate()">
    <input type="hidden" name="command" />
	<div align="center">
        <h1 align="center">Billing Info</h1>
        <table border="0" cellpadding="2px">
        	<tr><td>Order Total:</td><td><?php echo get_order_total()?></td></tr>
            <tr><td>Your Name:</td><td><input type="text" name="name"></td></tr>
            <tr><td>Address:</td><td><textarea name="address"></textarea></td></tr>
            <tr><td>Email:</td><td><input type="text" name="email"></td></tr>
            <tr><td>Phone:</td><td><input type="text" name="phone"></td></tr>
            <tr><td>&nbsp;</td><td><input type="submit" value="Make Payment"></td></tr>
        </table>
	</div>
</form>
</body>
</html>
