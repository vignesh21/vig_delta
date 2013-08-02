<?php
function curl()
{
$ch = curl_init(); 
curl_setopt($ch,CURLOPT_URL,"http://flipkart.com/");    
curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE); 
$q="mobile";
curl_setopt($ch,CURLOPT_POSTFIELDS,"q=$q");
curl_setopt($ch,CURLOPT_SETCOOKIES,"products");
curl_setopt($ch,CURLOPT_COOKIEJAR,"vignesh");
curl_setopt($ch,CURLOPT_AUTOREFERER,TRUE);
curl_setopt($ch,CURLOPT_BINARYTRANSFER,TRUE);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,TRUE);
curl_setopt($ch,CURLOPT_HEADREFERER,TRUE);
curl_setopt($ch,CURLOPT_HEADER,TRUE);
$data = curl_exec($ch); 
echo $data;
curl_close($ch);    
return $data;   
}

