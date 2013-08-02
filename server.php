<?php
if(isset($_GET["asin"]))
     {
         $asin = $_GET["asin"];
         $platform = $_GET["platform"];
         echo "\nASIN = $asin\nPlatform = $platform";
         //Below line gets all serialize price data for my product
         $serialized_data = amazon_data_chooser($asin, $platform);

         return($serialized_data);
     }
     else
     {
         echo "Warning: No Data Found!";
     }
?>
