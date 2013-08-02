<?php
    error_reporting(E_ALL && E_NOTICE);
	include("includes/db.php");
	include("includes/functions.php");
	include("includes/style.css");
	include("includes/font.css");
	
	if($_REQUEST['command']=='update'){
		$name=$_REQUEST['name'];
		$email=$_REQUEST['email'];
		$address=$_REQUEST['address'];
		$phone=$_REQUEST['phone'];
		
		$result=mysql_query("insert into customers values('','$name','$email','$address','$phone')");
		$customerid=mysql_insert_id();
		$date=date('Y-m-d');
		$result=mysql_query("insert into orders values('','$date','$customerid')");
		$orderid=mysql_insert_id();
		
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			mysql_query("insert into order_detail values ($orderid,$pid,$q,$price)");
		}
		
	}
?>
<html>
<head><title>Payment</title>
<br><h1><center>PAYMENT</center>
</head>
<script  language="javascript">
function testCreditCard ()
 {
  myCardNo = document.getElementById('CardNumber').value;
  myCardType = document.getElementById('CardType').value;
  if (checkCreditCard (myCardNo,myCardType)) {
    return true;
  } 
  else
  {
  alert (ccErrors[ccErrorNo]);
  return false;
  }
}
var ccErrorNo = 0;
var ccErrors = new Array ()

ccErrors [0] = "Unknown card type";
ccErrors [1] = "No card number provided";
ccErrors [2] = "Credit card number is in invalid format";
ccErrors [3] = "Credit card number is invalid";
ccErrors [4] = "Credit card number has an inappropriate number of digits";

function checkCreditCard (cardnumber, cardname) {
     
   var cards = new Array();

 cards [0] = {name: "Visa", 
               length: "13,16", 
               prefixes: "4",
               checkdigit: true};
  cards [1] = {name: "MasterCard", 
               length: "16", 
               prefixes: "51,52,53,54,55",
               checkdigit: true};
  cards [2] = {name: "DinersClub", 
               length: "14,16", 
               prefixes: "36,38,54,55",
               checkdigit: true};
  cards [3] = {name: "CarteBlanche", 
               length: "14", 
               prefixes: "300,301,302,303,304,305",
               checkdigit: true};
  cards [4] = {name: "AmEx", 
               length: "15", 
               prefixes: "34,37",
               checkdigit: true};
  cards [5] = {name: "Discover", 
               length: "16", 
               prefixes: "6011,622,64,65",
               checkdigit: true};
  cards [6] = {name: "JCB", 
               length: "16", 
               prefixes: "35",
               checkdigit: true};
  cards [7] = {name: "enRoute", 
               length: "15", 
               prefixes: "2014,2149",
               checkdigit: true};
  cards [8] = {name: "Solo", 
               length: "16,18,19", 
               prefixes: "6334,6767",
               checkdigit: true};
  cards [9] = {name: "Switch", 
               length: "16,18,19", 
               prefixes: "4903,4905,4911,4936,564182,633110,6333,6759",
               checkdigit: true};
  cards [10] = {name: "Maestro", 
               length: "12,13,14,15,16,18,19", 
               prefixes: "5018,5020,5038,6304,6759,6761,6762,6763",
               checkdigit: true};
  cards [11] = {name: "VisaElectron", 
               length: "16", 
               prefixes: "4026,417500,4508,4844,4913,4917",
               checkdigit: true};
  cards [12] = {name: "LaserCard", 
               length: "16,17,18,19", 
               prefixes: "6304,6706,6771,6709",
               checkdigit: true};
               
  var cardType = -1;
  for (var i=0; i<cards.length; i++) 
  {
  if (cardname.toLowerCase () == cards[i].name.toLowerCase())
    {
      cardType = i;
      break;
    }
  }
  

  if (cardType == -1) 
  {
     ccErrorNo = 0;
     return false; 
  }
   
  if (cardnumber.length == 0) 
  {
     ccErrorNo = 1;
     return false; 
  }
    
  cardnumber = cardnumber.replace (/\s/g, "");
  
  var cardNo = cardnumber
  var cardexp = /^[0-9]{13,19}$/;
  if (!cardexp.exec(cardNo))  {
     ccErrorNo = 2;
     return false; 
  }
       
  if (cards[cardType].checkdigit) {
    var checksum = 0;                                  
    var mychar = "";                                  
    var j = 1;                                        
  
    var calc;
    for (i = cardNo.length - 1; i >= 0; i--)
	{
    
      calc = Number(cardNo.charAt(i)) * j;
    
      if (calc > 9) {
        checksum = checksum + 1;
        calc = calc - 10;
      }
    
      checksum = checksum + calc;
    
      if (j ==1) 
	  {
	  j = 2
	  } 
	  else 
	  {
	  j = 1
	  };
    } 
  
    if (checksum % 10 != 0)  {
     ccErrorNo = 3;
     return false; 
    }
  }  
  
  var LengthValid = false;
  var PrefixValid = false; 
  var undefined; 
  var prefix = new Array ();
  var lengths = new Array ();
    
  prefix = cards[cardType].prefixes.split(",");
      
  for (i=0; i<prefix.length; i++)
  {
    var exp = new RegExp ("^" + prefix[i]);
    if (exp.test (cardNo)) PrefixValid = true;
  }
      
  if (!PrefixValid)
  {
     ccErrorNo = 3;
     return false; 
  }
    
 lengths = cards[cardType].length.split(",");
  for (j=0; j<lengths.length; j++) {
    if (cardNo.length == lengths[j]) LengthValid = true;
  }
  
  if (!LengthValid)
  {
     ccErrorNo = 4;
     return false; 
  };   
  return cv();
}
function cv()
{
var cv=document.getElementById('cvn').value;
var pattern=/^\d$/
if(!pattern.test(cv) && cv==="")
{
alert("Improper cv number!");
return false;
}
else
{
         if(cv.length!=10)
		 {
		   alert("Improper CV!");
		   return false;
		 }
		 else
		 {
		   return true;
		  }
		  
}
}
</script>
<body>
<center>
<form name="form" action="confirm.php" method="post" onSubmit="return testCreditCard()">
<br>
<table cellpadding="5" cellspacing="5">
<tr><td>Card Type</td>
<td><select name="s" id="CardType" onClick="t.value=s.value">
<option value="Visa">Visa</option>
<option value="MasterCard">MasterCard</option>
<option value="DinersClub">Diners'Club</option>
<option value="AmEx">American Express</option>
<option value="Discover">Discover</option>
<option value="JCB">JCB</option>
<option value="Switch">Switch</option>
<option value="Solo">Solo</option>
<option value="enRoute">enRoute</option>
<option value="Maestro">Maestro</option>
<option value="CarteBlanche">CarteBlanche</option>
<option value="VisaElectron">VisaElectron</option>
<option value="LaserCard">LaserCard</option>
</select>
</td>
<td><input type="text" name="t"></td>
</tr>
<tr>
<div id="card">
<tr>
<td>Card Number:</td><td><input type="text" name="num" id="CardNumber"></td>
</tr>
<tr>
<td>CV number:</td><td><input type="password" name="cv" id="cvn"></td>
</table>
</div>
<input type="submit" value="Make Payment!">
</form>
</center>
</body>
