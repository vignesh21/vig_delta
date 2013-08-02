<html>
<head><title></title></head>
<body><form name="loginform" action="login.php" method="post">
<table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
<tr>
<td colspan="2">
 <?php
	if( isset($_SESSION['log']) && is_array($_SESSION['log']) && count($_SESSION['log']) >0 ) {
			echo '<ul class="err">';
			foreach($_SESSION['log'] as $msg) {
			echo '<li>',$msg,'</li>'; 
				}
			echo '</ul>';
			unset($_SESSION['log']);
			}
?>
</td>
</tr>
<tr>
<td width="116"><div align="right">Username</div></td>
<td width="177"><input name="username" type="text" /></td>
</tr>
<tr>
<td><div align="right">Password</div></td>
<td><input name="password" type="text" /></td>
</tr>
<tr>
<td><div align="right"></div></td>
<td><input name="" type="submit" value="login" /></td>
</tr>
</table>
</form>

