<?php
  function cur($url) 
  {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);    // Setting cURL's URL option with the $url variable passed into the function
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Setting cURL's option to return the webpage data
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL
        return $data;   // Returning the data from the function
    }
   function scrape_between($data, $start, $end){
        $data = stristr($data, $start); // Stripping all data from before $start
        $data = substr($data, strlen($start));  // Stripping $start
        $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
        $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
        return $data;   // Returning the scraped data from the function
    }
	$scraped_page = cur("http://www.flipkart.com");    // Downloading IMDB home page to variable $scraped_page
    $scraped_data = scrape_between($scraped_page, "<div class='unit'>", "</div>");   // Scraping downloaded dara in $scraped_page for content between <title> and </title> tags
     
    echo $scraped_data; // Echoing $scraped data, should show "The Internet Movie Database (IMDb)"

?>


 <form onsubmit="return submitSearchForm();" method="GET" id="fk-header-search-form" action="/search" autocomplete="off">
			<table width="100%" cellspacing="0" cellpadding="0" class="search-form-table">
				<tr>
                    <td>
                        <div class="fk-search-bar ctgry-right" id="fk-search-bar">
                            <span class="fk-inline-block search-category" id="search-category">
                                <span id="search-category-name"><span class="gray-text">in</span> All Categories</span>
                                <span id="fk-menuSelIcon" class="fk-menu-dd-icon"></span>
                                <select id="fk-search-select" class="search-select" onchange="javascript:selectMItem(this);">
                                                                                <option value="search.flipkart.com" data-storeId="search.flipkart.com" data-storeurl="/search" displaystr="All Categories">All Categories</option>
                                                                                    <option value="2oq" data-storeId="2oq" data-storeurl="/clothing/pr" displaystr="Clothing">Clothing</option>
                                                                                    <option value="osp" data-storeId="osp" data-storeurl="/footwear/pr" displaystr="Footwear">Footwear</option>
                                                                                    <option value="tyy" data-storeId="tyy" data-storeurl="/mobiles-accessories/pr" displaystr="Mobiles &amp; Accessories">Mobiles &amp; Accessories</option>
                                                                                    <option value="6bo" data-storeId="6bo" data-storeurl="/computers/pr" displaystr="Computers">Computers</option>
                                                                                    <option value="reh" data-storeId="reh" data-storeurl="/bags-wallets-belts/pr" displaystr="Watches, Bags & Wallets">Watches, Bags & Wallets</option>
                                                                                    <option value="jek" data-storeId="jek" data-storeurl="/cameras-accessories/pr" displaystr="Cameras &amp; Accessories">Cameras &amp; Accessories</option>
                                                                                    <option value="bks" data-storeId="bks" data-storeurl="/books/pr" displaystr="Books, Pens & Stationery">Books, Pens & Stationery</option>
                                                                                    <option value="j9e" data-storeId="j9e" data-storeurl="/home-kitchen/pr" displaystr="Home &amp; Kitchen">Home &amp; Kitchen</option>
                                                                                    <option value="t06" data-storeId="t06" data-storeurl="/beauty-and-personal-care/pr" displaystr="Beauty & Personal Care">Beauty & Personal Care</option>
                                                                                    <option value="4rr" data-storeId="4rr" data-storeurl="/gaming/pr" displaystr="Games &amp; Consoles">Games &amp; Consoles</option>
                                                                                    <option value="ckf" data-storeId="ckf" data-storeurl="/tv-audio-video-players/pr" displaystr="TVs & Video Players">TVs & Video Players</option>
                                                                                    <option value="6bo,ord" data-storeId="6bo,ord" data-storeurl="/computers/audio-players/pr" displaystr="Home Audio &amp; MP3 Players">Home Audio &amp; MP3 Players</option>
                                                                                    <option value="4kt" data-storeId="4kt" data-storeurl="/music-movies-posters/pr" displaystr="Music, Movies & Posters">Music, Movies & Posters</option>
                                                                                    <option value="kyh" data-storeId="kyh" data-storeurl="/baby-care/pr" displaystr="Baby Care & Toys">Baby Care & Toys</option>
                                                                                    <option value="dep" data-storeId="dep" data-storeurl="/sports-fitness/pr" displaystr="Sports & Fitness">Sports & Fitness</option>
                                                                                    <option value="ixq" data-storeId="ixq" data-storeurl="/ebooks/pr" displaystr="eBooks">eBooks</option>
                                                                        </select>
                            </span>

                            <div class="rmargin5" id="search-box-container">
                                <input type="text" tabindex="1" value="" placeholder="Search for items" id="fk-top-search-box" class="fk-search-box ac_input" name="q" autocomplete="off">
                                <input type='hidden' name='sid' id='header_sid' value='search.flipkart.com' />
                                                                    <input	type="hidden" id="as" value="off" name="as" />
                                                                    <input	type="hidden" id="as-show" value="off" name="as-show" />
                                                            </div>
                        </div>
                    </td>
                    <td align="left" style="width: 40px;">
                        <div class="btn btn-blue btn-search">
						    <input type="submit" class="search-icon" value="&nbsp;" tabindex="2"/>
                        </div>
                                                <input type='hidden' name='otracker' id="searchTracker" value='start' />
                	</td>
        	</tr>
			</table>
		</form>
