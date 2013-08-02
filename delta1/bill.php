<?php
	include("includes/db.php");
	include("includes/functions.php");
	
		@$name=$_REQUEST['name'];
		@$email=$_REQUEST['email'];
		@$address=$_REQUEST['address'];
		@$phone=$_REQUEST['contact'];
		
		@$result=mysql_query("insert into customers values('','$name','$email','$address','$phone')");
		@$customerid=mysql_insert_id();
		@$date=date('Y-m-d');
		@$result=mysql_query("insert into orders values('','$date','$customerid')");
		@$orderid=mysql_insert_id();
		
		@$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++)
		{
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			mysql_query("insert into order_detail values ($orderid,$pid,$q,$price)");
		}
		echo"<center>Purchase Summary</center>";
		$max=count($_SESSION['cart']);
		?>
		<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
        <?php
        echo '<tr bgcolor="#FFFFFF" style="font-weight:bold"><td>Serial</td><td>Name</td><td>Price</td><td>Qty</td><td>Amount</td></tr>';
		for($i=0;$i<$max;$i++)
		{
		    $pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			$pname=get_product_name($pid);
		?>
		<tr><td><?php echo $i+1;?></td><td><?php echo $pname;?></td><td><?php echo $price;?></td><td><?php echo $q;?></td><td><?php echo $price*$q; ?></td></tr>  
		<?php
		}
		?>
		</table>
		<input type="button" name="confirm" value="Confirm!Pay!" onClick="window.location='payment.php'">
		<input type="button" name="rectify" value="Change Contents!" onClick="window.location='shoppingcart.php'">
		
