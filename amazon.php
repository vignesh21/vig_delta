<?php
$url = "http://www.myurl.com/iec/Server.php?asin=$asin&platform=$platform_variant";
$azn_data = file_get_contents($url);
$azn_data = unserialize($azn_data);
echo "\nReturned Data = $azn_data\n";
?>
