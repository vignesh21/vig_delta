<?php
	include("db.php");
	include("functions.php");
	$comm=isset($_REQUEST["command"]) ? $_REQUEST['command'] : null;
	$p=isset($_REQUEST["productid"]) ? $_REQUEST['productid'] : null;
	$q=isset($_REQUEST["quantity"]) ? $_REQUEST['quantity'] : null;
	if($comm=='add' && $p>0)
	{
		$pid=$_REQUEST['productid'];
		addtocart($pid,$q);
		exit();
	}
	
?>
<html>
<head>
<title>Products</title>
<script>
function addtocart(pid)
    {
	document.form1.productid.value=pid; 
    document.form1.command.value='add';    
	document.form1.quantity.value=1;
	document.form1.submit(pid,1);
	}
</script>
</head>


<body>
<form name="form1" action="shopping.php">
	<input type="hidden" name="productid">
    <input type="hidden" name="command">
	<input type="hidden" name="quantity">
</form>
<div align="center">
	<h1 align="center">Products</h1>
	<table border="0" cellpadding="2px" width="600px">
		<?php
			$result=mysql_query("select * from products") or die("select * from products"."<br/><br/>".mysql_error());
			while($row=mysql_fetch_array($result)){
		?>
    	<tr>
        	<td><img src="<?php echo $row['picture']?>" /></td>
            <td>   	<b><?php echo $row['name']?></b><br />
            		<?php echo $row['description']?><br />
                    Price:<big style="color:green">
                    	$<?php echo $row['price']?></big><br /><br />
                    <input type="button" value="Add to Cart" onclick="addtocart(<?php echo $row['serial']?>)" />
			</td>
		</tr>
        <tr><td colspan="2"><hr size="1" /></td>
        <?php } ?>
    </table>
</div>
</body>
</html>
