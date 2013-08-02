<html>
<title>Make Payment!</title>
<head><h1 id="head" align="center">Payment Segment</h1>
</head>
<hr id="ruler">
<style>
#card
{
visibility:hidden;
}
</style>
<script language="javascript">
function toggle()
{
          document.getElementById('card').style.visibility='visible';
}
function validate()
{
alert("Hello!Welcome to the payment sector!");
}
function cardno(cardnumber,cardtype);
{
alert("!");
var valid=false;
var pattern=/[^\d ]/;
valid=!pattern.test(cardnumber);
if(valid)
    {
        var con=cardnumber.replace(/ /g,"");
        var len=con.length;
		var lenval=false;
        var prefix=false;
        var prepattern;
        
        switch(cardtype)
        {
            case "mastercard":
            lenval=(len==16);
			prepattern=/^5[1-5]/;
			break;
		    
			case "visa":
			lenval=(len==16||len==13);
			prepattern=/^4/;
			break;
			
			case "amex":
			lenval=(len==15);
			prepattern=/^3(4|7)/;
			break;
			
			default:
			prepattern=/^$/;
			alert("Card type not found");
		}
else
{
alert("Enter the correct card number!");
return false();
}
    prefix=!prepattern.test(con);
    valid=prefix && lenval;
	    if(valid)
        {
	        window.location="confirm.php";
	    }
	    else 
	    {
	        alert("Enter Valid Card Number!");
	        return false;
	    }
    }	 
}
</script>