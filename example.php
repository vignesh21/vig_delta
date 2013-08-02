<?php
 
/**
 
 * @author  : Kalyan Chakravarthy
 
 * @date    : 1-Mar-10
 
 * @desc    : A simple PHP-cURL API library to access flipkart.com shopping site
 
 * @version : v0.1
 
 * @license : GPL
 
 * @url     : http://code.google.com/p/flipkurl
 
 *
 
 * @note    : Most of the code is documented and self explanatory.
 
 */
 

 
/**
 
 * A basic cURL class
 
 *
 
 */
 
class cURL {
 
        var $headers;
 
        var $user_agent;
 
        var $compression;
 
        var $cookie_file;
 
        var $proxy;
 
        var $header = 0;
 
        
 
        /**
 
         * Constructer. 
 
         * Set the basic useragent, headers and etc.
 
         *
 
         * @param boolean $cookies
 
         * @param string $cookie
 
         * @param string $compression
 
         * @param string $proxy
 
         * @return cURL instance
 
         */
 
        function cURL($cookies = TRUE, $cookie = 'cookies.txt', $compression = 'gzip', $proxy = '') {
 
                $this->headers [] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
 
                $this->headers [] = 'Connection: Keep-Alive';
 
                $this->headers [] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
 
                $this->user_agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)';
 
                $this->compression = $compression;
 
                $this->proxy = $proxy;
 
                $this->cookies = $cookies;
 
                if ($this->cookies == TRUE)
 
                        $this->cookie ( $cookie );
 
        }
 
        /**
 
         * Set the cookie file name. If file exists then file name is made absolute
 
         * else an empty file is created.
 
         *
 
         * @param string $cookie_file
 
         */
 
        function cookie($cookie_file) {
 
                if (file_exists ( $cookie_file )) {
 
                        $this->cookie_file = realpath($cookie_file);
 
                } else {
 
                        $fch = fopen ( $cookie_file, 'w' ) or $this->error ( 'The cookie file could not be opened. Make sure this directory has the correct permissions' );
 
                        $this->cookie_file = realpath($cookie_file);
 
                        fclose ( $fch );
 
                }
 
        }
 
        
 
        /**
 
         * Send a GET request via curl, using the current settings, cookies, etc
 
         *
 
         * @param string $url
 
         * @return string - contents of the url
 
         */
 
        function get($url) {
 
                $process = curl_init ( $url );
 
                curl_setopt ( $process, CURLOPT_HTTPHEADER, $this->headers );
 
                curl_setopt ( $process, CURLOPT_HEADER, $this->header );
 
                curl_setopt ( $process, CURLOPT_USERAGENT, $this->user_agent );
 
                if ($this->cookies == TRUE)
 
                        curl_setopt ( $process, CURLOPT_COOKIEFILE, $this->cookie_file );
 
                if ($this->cookies == TRUE)
 
                        curl_setopt ( $process, CURLOPT_COOKIEJAR, $this->cookie_file );
 
                curl_setopt ( $process, CURLOPT_ENCODING, $this->compression );
 
                curl_setopt ( $process, CURLOPT_TIMEOUT, 30 );
 
                if ($this->proxy)
 
                        curl_setopt ( $process, CURLOPT_PROXY, $this->proxy );
 
                if ($this->referer)
 
                        curl_setopt( $process, CURLOPT_REFERER, $this->referer );
 
                curl_setopt ( $process, CURLOPT_AUTOREFERER, 1 );
 
                curl_setopt ( $process, CURLOPT_RETURNTRANSFER, 1 );
 
                curl_setopt ( $process, CURLOPT_FOLLOWLOCATION, 1 );
 
                $return = curl_exec ( $process );
 
                curl_close ( $process );
 
                return $return;
 
        }
 
        /**
 
         * Send a POST request along with the post data
 
         *
 
         * @param string $url - a valid url resource
 
         * @param string $data - url encoded query string
 
         * @return string - contents of the url fetc
 
         */
 
        function post($url, $data) {
 
                $process = curl_init ( $url );
 
                curl_setopt ( $process, CURLOPT_HTTPHEADER, $this->headers );
 
                curl_setopt ( $process, CURLOPT_HEADER, $this->header );
 
                curl_setopt ( $process, CURLOPT_USERAGENT, $this->user_agent );
 
                if ($this->cookies == TRUE)
 
                        curl_setopt ( $process, CURLOPT_COOKIEFILE, $this->cookie_file );
 
                if ($this->cookies == TRUE)
 
                        curl_setopt ( $process, CURLOPT_COOKIEJAR, $this->cookie_file );
 
                curl_setopt ( $process, CURLOPT_ENCODING, $this->compression );
 
                curl_setopt ( $process, CURLOPT_TIMEOUT, 30 );
 
                if ($this->proxy)
 
                        curl_setopt ( $process, CURLOPT_PROXY, $this->proxy );
 
                if ($this->referer)
 
                        curl_setopt( $process, CURLOPT_REFERER, $this->referer );
 
                curl_setopt ( $process, CURLOPT_POSTFIELDS, $data );
 
                curl_setopt ( $process, CURLOPT_AUTOREFERER, 1 );
 
                curl_setopt ( $process, CURLOPT_RETURNTRANSFER, 1 );
 
                curl_setopt ( $process, CURLOPT_FOLLOWLOCATION, 1 );
 
                curl_setopt ( $process, CURLOPT_POST, 1 );
 
                $return = curl_exec ( $process );
 
                curl_close ( $process );
 
                return $return;
 
        }
 
        /**
 
         * Just dump the error in a formatted way
 
         *
 
         * @param string $error
 
         */
 
        function error($error) {
 
                echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>";
 
                die ();
 
        }
 
}
 

 
/**
 
 * Various utility functions for the Flipkurl class
 
 * Contains functions for cleaning, parsing data mainly
 
 * the fetching part etc are implemented in Flipkurl class
 
 *
 
 */
 
class FlipMisc {
 
        /**
 
         * Returns all instances between two string delimiters
 
         *
 
         * @param string $s - the string to find stuff inside
 
         * @param string $st - starting string
 
         * @param string $en - ending string
 
         * @return array - all matching instances
 
         */
 
        static function get_between($s,$st='<',$en='>') {
 
                $re = array();
 
                $el = explode($st,$s);
 
                $l = count($el);
 
                $cpos=0;
 
                $m = array();
 
                for( $i=1; $i<$l; $i++ ) { 
 
                        $m[]= substr($el[$i],0,strpos($el[$i],$en) );
 
                }
 
                return $m;
 
        }
 
        /**
 
         * Returns the first instance between two string delimiters
 
         *
 
         * @param string $s - the string to find stuff inside
 
         * @param string $st - starting string
 
         * @param string $en - ending string
 
         * @return array - all matching instances
 
         */
 
        static function get_single_between( $s, $st, $en ) {
 
                $re = array();
 
                $el = explode($st,$s);
 
                $l = count($el);
 
                $cpos=0;
 
                $m = '';
 
                for( $i=1; $i<$l; $i++ ) { 
 
                        return substr($el[$i],0,strpos($el[$i],$en) );
 
                }
 
                return $m;      
 
        }
 
        /**
 
         * Returns the integer version of the rupees string
 
         * Input is given with "Rs. 123". Simple cleanup thou.
 
         * Can use regex, but duh forgot.
 
         *
 
         * @param string $str
 
         * @return integer - int value in the money
 
         */
 
        static function get_price_int( $str ) {
 
                $str = trim(str_ireplace( 'Rs', '', trim($str) ));
 
                $str = trim( $str, '.' );
 
                $str = trim( $str );
 
                $str = (int)$str;
 
                return $str;
 
        }
 
        
 
        /**
 
         * This function is used to extract information such as price, discount being given & savings
 
         * in proper integer / float formats from the given html block containing priced related stuff 
 
         *
 
         * @param string $str
 
         * @return array - containing price, discount% & saving
 
         */
 
        static function clean_prices( $str ) {
 
                $price=0;
 
                $discount=0;
 
                $saving=0;      
 
                $parts = explode( "<br />", $str );
 
                $parts = array_map( 'trim', $parts );
 
                $price = $parts[0];
 
                if( count($parts)>2 ) {
 
                        $saving = substr( $parts[1], strpos( $parts[1], "Rs" ) );
 
                        $discount = (float)FlipMisc::get_single_between( $parts[2], "(", "%)" );
 
                }
 
                if( stripos( $price, "Rs" ) !== false )
 
                        $price = str_ireplace( "Rs", "", $price );
 
                        $price = trim( $price, ". " );
 
                        $price = (int)$price;
 
                if( stripos( $saving, "Rs" ) !== false )
 
                        $saving = str_ireplace( "Rs", "", $saving );
 
                        $saving = trim( $saving, ". " );
 
                        $saving = (int)$saving;
 
                return array( 'price'=>$price, 'discount'=>$discount, 'saving'=>$saving );
 
        }
 
        /**
 
         * Similarly clean up the chunk of html containing book related info
 
         * like link to book's page, id, title, author, etc 
 
         *
 
         * @param string $str
 
         * @return array
 
         */
 
        static function clean_titles( $str ) {
 
                $link = FlipMisc::get_single_between( $str, 'href="', '"' );
 
                $edition_id = substr( $link, strrpos( $link, "-" )+1 );
 
        
 
                $title = FlipMisc::get_single_between( $str, '">', "</a>" );
 
                $author = FlipMisc::get_single_between( $str, "<span>", "</span>" );
 
                $author = trim( strip_tags( $author ) );
 
                if( ($pos=strpos($author,"by")) !== false and $pos == 0 )
 
                        $author = trim( substr( $author, 2 ) );
 
                
 
                if( empty($edition_id) ) {
 
                        $title = $author = $link = '';
 
                        $id = null;
 
                }
 
                return array( 'id'=>$edition_id, 'author'=>$author, 'title'=>$title, 'link'=>$link );
 
        }
 
        /**
 
         * This function uses the above few functions to fetch and clean up the data from cart contets page
 
         * and puts them in a nicely formatted array
 
         *
 
         * @param string $con - raw HTML of the viewcart.php page
 
         * @return array
 
         */
 
        static function getCartContents( $con ) {
 
                $prices = FlipMisc::get_between( $con, '<div class="cart_edition_price">', '</div>' );
 
                $titles = FlipMisc::get_between( $con, '<div class="cart_edition_title">', '</div>' );
 

 
                foreach( $prices as $pi=>$value )
 
                        $prices[ $pi ] = FlipMisc::clean_prices( $prices[$pi] );
 
                foreach( $titles as $ti=>$value )
 
                        $titles[ $ti ] = FlipMisc::clean_prices( $titles[$ti] );
 
        
 
                $quantity = FlipMisc::get_between( $con, 'cart_edition_qty_textbox" size="3" value="','"' );
 
                
 
                $summary = FlipMisc::get_between( $con, '<span class="cart_summary_price">', '</span>' );
 
                $summary = array_map( 'strip_tags', $summary );
 
                $summary_arr["total"] = (int)trim(str_ireplace( 'Rs', '', trim($summary[0]) ),' .,');
 
                $summary_arr["discount"] = (float)FlipMisc::get_single_between( $summary[1], "(", '%)' );
 
                $summary_arr["saving"] = (int)trim(FlipMisc::get_single_between( $summary[1], ".", '(' ));
 
                        
 
                $cart = array();
 
                foreach( $titles as $title_i=>$info ) {
 
                        $eid = strtoupper($info["id"]);
 
                        if( empty( $eid ) ) continue;
 
                        $cart[ $eid ] = array_merge( $prices[ $title_i ], $info );
 
                        $cart[ $eid ][ "quantity" ] = (int)$quantity[ $title_i ];
 
                }
 
                
 
                $cartinfo = array(
 
                        'items' => $cart,
 
                        'summary' => $summary_arr
 
                        );
 
                return $cartinfo;
 
        }
 
        
 
        /**
 
         * This parses the search listing page's raw HTML to fetch the listing in a formatted array
 
         * for easier use.
 
         * 
 
         * It makes use of DomDocument & DomXPath. Remembered that i could use it after
 
         * i wrote the dirty way for getCartContents(). Not feeling like rewriting the above chunk, so letteing it be.
 
         * Perhaps will include in next-version, if there is one !
 
         *
 
         * @param string $con - raw html dump
 
         * @return array
 
         */
 
        static function parseSearchListing( $con ) {
 
                $docObj = new DOMDocument();
 
                @$docObj->loadHTML( $con );
 
                
 
                $xpath = new DOMXPath( $docObj );
 
                $items = $xpath->query("//div[@class='search_result_item']");
 
                $sinfo = $xpath->query("//span[@class='search_intro']")->item(0)->nodeValue;
 
                
 
                //Showing 1-10 of 2461 search result
 
                $matches = array();
 
                preg_match( "/([\d]+)-([\d]+) of ([\d]+)/", $sinfo, $matches );
 
                $listing["from"] = (int)$matches[1];
 
                $listing["to"] = (int)$matches[2];
 
                $listing["total"] = (int)$matches[3];
 
                $listing["pages"] = ceil( (float)$listing["total"] / ($listing["to"]-$listing["from"]) );
 
                $listing["page"] = ceil($listing["from"] / ($listing["to"]-$listing["from"]));  
 
                
 
                foreach( $items as $i=>$item ) {
 
                        $j = $i+1;
 
                        $tinfo = $xpath->query("//div[@class='search_result_item'][$j]//div[@class='search_result_title']//a");
 
                        $opinfo = $xpath->query("//div[@class='search_result_item'][$j]//span[@class='search_results_price']//span")->item(0);
 
                        $dpinfo = $xpath->query("//div[@class='search_result_item'][$j]//span[@class='search_results_price']//font")->item(0);
 
                        $diinfo = $xpath->query("//div[@class='search_result_item'][$j]//span[@class='search_results_discount']//b")->item(0);
 
                        $status = $xpath->query("//div[@class='search_result_item'][$j]//td//i")->item(0);
 
                        $summary= $xpath->query("//div[@class='search_result_item'][$j]//div[@class='search_results_about']")->item(0);
 
                        $id =  $xpath->query("//div[@class='search_result_item'][$j]//input[@name='eid']")->item(0);
 
                        if( !$id )
 
                                $id =  $xpath->query("//div[@class='search_result_item'][$j]//input[@name='edition_id']")->item(0);
 
                        
 
                        $dpinfo = $dpinfo ? FlipMisc::get_price_int($dpinfo->nodeValue) : 0;
 
                        $opinfo = $opinfo ? FlipMisc::get_price_int($opinfo->nodeValue) : $dpinfo;
 
                        $spinfo = $opinfo != $dpinfo ? $opinfo-$dpinfo : 0;
 
                        $diinfo = $diinfo ? (float)trim($diinfo->nodeValue,'%') : 0;
 
                        $summary= $summary? $summary->nodeValue : "";
 
                        
 
                        $stinfo = trim($status->nodeValue,'. ');
 
                        $stinfo = empty($stinfo) ? "Out of stock" : $stinfo;
 
                        
 
                        $title = array();
 
                        $title[ "mrp" ] = $opinfo;
 
                        $title[ "price" ] = $dpinfo;
 
                        $title[ "saving" ] = $spinfo;
 
                        $title[ "discount" ] = $diinfo;
 
                        $title[ "status" ] = $stinfo;
 
                        $title[ "summary" ] = $summary;
 
                        
 
                        $title[ "eid" ] = $id->getAttribute('value');
 
                
 
                        foreach( $tinfo as $z=>$bar ) {
 
                                if( $z==0 ) {
 
                                        $title["title"] = trim($bar->nodeValue);
 
                                        $title["link"] = $bar->getAttribute('href');
 
                                } else {
 
                                        $title["author"][] = $bar->nodeValue;
 
                                }
 
                        }
 
                        $listing["results"][] = $title; 
 
                }
 
                return $listing;
 
        }
 
}
 

 
/**
 
 * class Flipkurl
 
 * The main class to handle the flipkart functions
 
 *
 
 */
 
class Flipkurl {
 
        var $cookiefile;
 
        var $h_curl = null;
 
        var $isLogged = false;
 
        var $email;
 
        var $pass;
 
        var $cookies_dir = "./";
 
        function __construct() {
 
                $this->init();
 
        }
 
        /**
 
         * Retreives a formatted array of the search listing for given parameters
 
         *
 
         * Login required - no
 
         * 
 
         * @param string $search - keyword term
 
         * @param string $who - get by author or title
 
         * @param int $page - the page number of listing
 
         * @return array
 
         */
 
        function getSearchListing( $search, $who='', $page='' ) {
 
                $query = urlencode($search);
 
                if( $page )
 
                        $page = "&start=".($page*10);
 
                if( $who ) {
 
                        if( $who == 'author' or $who == 'title' )
 
                                $who = '&field='.$who;
 
                } 
 
                $url = "http://www.flipkart.com/search.php?query=$query".$page.$who;
 
                $con = $this->h_curl->get( $url );
 
                
 
                $listing = FlipMisc::parseSearchListing( $con );
 
                return $listing;
 
        }
 
        
 
        /**
 
         * Returns the current contents of shopping cart
 
         *
 
         * @return array
 
         */
 
        function getCartContents() {
 
                $con = $this->h_curl->get( "http://www.flipkart.com/viewcart.php");
 
                //var_dump( $con );
 
                $contents = FlipMisc::getCartContents( $con );
 
                return $contents;
 
        }
 
        
 
        /**
 
         * Init
 
         *
 
         */
 
        function init() {
 
                $this->h_curl = new cURL(1);
 
                $this->cookies_dir = "./";
 
                $this->h_curl->referer = "http://www.flipkart.com";
 
        }
 
        /**
 
         * Login into flipkart. 
 
         *
 
         * If the cookie file is already present, a new curl request won't be sent.
 
         * Instead the existing file will be considered authenticated and used for all subsequent requests 
 
         * 
 
         * @param string $email - plaintext username/email id
 
         * @param string $pass - plaintext password
 
         * @param boolean $fresh - do a fresh login and rewrite cookie file
 
         * @return true - if login successful, else false
 
         */
 
        function login( $email, $pass, $fresh=false ) {
 
                $this->email = $email;
 
                $this->pass = $pass;
 
                $cookiefile = rtrim($this->cookies_dir,'/'). "/".md5($email).".txt";
 
                $this->cookiefile = $cookiefile;
 
                if( !$fresh && file_exists( $cookiefile ) && strlen($x=file_get_contents($cookiefile))>10 ) {
 
                        $this->h_curl->cookie( $cookiefile );
 
                        //var_dump( $this->h_curl->cookie_file );
 
                        $this->isLogged = true;
 
                        return true;
 
                } else {
 
                        $this->h_curl->cookie( $cookiefile );           
 
                        $res = $this->doAction( "LOGINUSERACCOUNT", array("email"=>$email,"password"=>md5($pass)) );
 
                        if ( trim($res) == "0" ) {
 
                                $this->isLogged = false;
 
                                unlink( $cookiefile );
 
                                return false;
 
                        } else {
 
                                $this->isLogged = true;
 
                                return true;
 
                        }
 
                }
 
                return false;
 
        }
 
        /**
 
         * Logout. Cleanup cookie files and any other traces;
 
         *
 
         */
 
        function logout() {
 
                $this->isLogged = false;
 
                @unlink( $this->cookiefile );
 
                $this->init();
 
        }
 
        /**
 
         * Flipkart's all main functions go via a gateway file called kenny.php and it takes action parameter
 
         *
 
         * @param string $action - what action to be performed
 
         * @param array $params - any additional parameters
 
         * @return string - raw HTML after doing a POST to gateway file
 
         */
 
        function doAction( $action, $params=array() ) {
 
                $params[ "action" ] = $action;
 
                return $this->h_curl->post( "http://www.flipkart.com/kenny.php", http_build_query($params));
 
        }
 
        /**
 
         * Add a book to the shopping cart.
 
         * The bookid is a unique code at flipkart for every book.
 
         * It can be obtained via search listing function
 
         * 
 
         * Bookid is also known as edition id  
 
         *
 
         * @param string $bid - unique bookid
 
         */
 
        function addBook( $bid ) {
 
                $res = $this->h_curl->post("http://www.flipkart.com/viewcart.php", "eid=$bid");
 
        }
 
        /**
 
         * Remove a particular book from shopping cart
 
         *
 
         * @param string $bid
 
         */
 
        function removeBook( $bid ) {
 
                $res = $this->h_curl->post("http://www.flipkart.com/kenny.php", "action=DELETEFROMCART&edition_id=$bid" );
 
        }
 
        /**
 
         * Update the quantity of a particular book in the cart
 
         *
 
         * @param string $bid
 
         * @param int $qty
 
         */
 
        function updateQuantity( $bid, $qty ) {
 
                $res = $this->h_curl->post("http://www.flipkart.com/kenny.php", "action=CHANGE_CART_QTY&edition_id=$bid&quantity=$qty" );               
 
        }
 
        /**
 
         * Add a particular book to wishlist
 
         *
 
         * @param string $bid
 
         */
 
        function addToWishList( $bid ) {
 
                $res = $this->h_curl->post("http://www.flipkart.com/kenny.php", "action=ADDTOWISHLIST&edition_id=$bid" ); 
 
        }
 
        /**
 
         * You can move a book from your current shopping cart to wishlist.
 
         * Makes sense cos you don't wana buy it now, but you don't wana lose selection either.
 
         *
 
         * @param string $bid
 
         */
 
        function moveToWishList( $bid ) {
 
                $res = $this->h_curl->post("http://www.flipkart.com/kenny.php", "action=MOVE_TOWISHLIST_FROMCART&edition_id=$bid" );
 
        }
 
        /**
 
         * Remove the book from wishlist
 
         *
 
         * @param int $bid
 
         */
 
        function removeFromWishList( $bid ) {
 
                $res = $this->h_curl->post("http://www.flipkart.com/kenny.php", "action=DELETEFROMWISHLIST&edition_id=$bid" );
 
        }
 
}
 
?> 
