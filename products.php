<?php
    error_reporting(E_ALL && E_NOTICE);
	echo "<hr>";
	include("includes/db.php");
	include("includes/functions.php");
	?>
<html>
<head>
<title>Products</title>
<script>
<?php

?>
</script>
</head>


<body>
 <div align="center">
	<h1 align="center">Products</h1>
	<table border="0" cellpadding="2px" width="600px">
		<?php
		echo "Powered by Flipkart";
		?>
		<form name="form1" onSubmit="check()"> 
		<select name="products">
		<option value="Laptops">Laptops</option>
		<option value="Mobiles">Mobiles</option>
		<tr><td>Search your Requirements here:</td>
		<td><input type="text" name="search">
		</td>
		<td><input type="submit" value="Search"></td>
		</tr>
		</form>
    </table>
</div>
</body>
</html>
