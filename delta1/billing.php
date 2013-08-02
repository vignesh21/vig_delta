<?php
	include("includes/db.php");
	include("includes/functions.php");
?>
<html>
<head>
<title>Register!</title>
<script language="javascript">
function validate()
{
var nam=document.form.name.value;
var pattern=/[^a-z]/i;
if(!pattern.test(nam))
{
       if(nam.charAt(0)===nam.charAt(0).toUpperCase() && nam!="")
         {
            return contact();
         }
        else
		 {
		    alert("Enter Name starting with a capital letter!");
			return false;
			n.select();
		 }
}
else
{
alert("Please enter your name,properly!");
return false;
n.select();		 
}
}
function contact()
{
var con=document.form.contact.value;
var pattern=/^\d$/;
if(!pattern.test(con) && con=="")
{
alert("Enter proper contact number!");
return false;
con.select();
}
else
{
        if(con.length!=10)
		 {
		   alert("Enter correct mobile number!");
		   return false;
		   con.focus();
		 }
		 else
		 {
		    return mail();
		 }
}		 
}
function mail()
{
var em=document.form.email.value;
var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+$/;
if(!pattern.test(em) && em==="")
{
    alert("Enter a valid email id!");
    return false;
	em.focus();
}
else
{
return pass();
}
}
function pass()
{
var password=document.form.pwd.value;
var pass=document.form.pwd1.value;
var pattern=/^[a-z\d\_]/i;
if(!pattern.test(password) && password==="")
{
alert("Enter a valid password!");
return false;
}
else
{
      if(password===pass)
	  {
	    return add();
	  }
	  else
	  {
	    alert("Passwords don't match!");
	    return false;
	  }
}
}
function add()
{
var ad=document.form.address.value;
var pattern=/^[a-z\d]/i;
if(ad==="")
{
alert("Enter the correct address!");
return false;
}
else
{
     if(confirm("Do you want to continue?"))
	 {
	    return true;
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
<form name="form" method="post" action="bill.php" onSubmit="return validate()">
    <input type="hidden" name="command" />
	<div align="center">
        <h1 align="center">Registration</h1>
        <table border="0" cellpadding="2px">
        	<tr><td>Order Total:</td><td><?php echo get_order_total()?></td></tr>
            <tr><td>Your Name:</td><td><input type="text" name="name"></td></tr>
            <tr><td>Address:</td><td><textarea name="address"></textarea></td></tr>
            <tr><td>Email:</td><td><input type="text" name="email"></td></tr>
            <tr><td>Phone:</td><td><input type="text" name="contact"></td></tr>
            <tr><td>Password:</td><td><input type="password" name="pwd"></td></tr>
			<tr><td>Reconfirmation:</td><td><input type="password" name="pwd1"></td></tr>
			<tr><td>&nbsp;</td><td><input type="submit" value="Place Order"></td></tr>
        </table>
	</div>
</form>
</body>
</html>
