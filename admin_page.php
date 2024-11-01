<?php

function amanuke_pp_isset_var($array,$name,$default="") {
	if (isset($array[$name])) {
		return $array[$name]; 
	} else 
	return $default;
}

function amanuke_pp_admin(){
	
	if(isset($_POST['submitted'])){
        //Get form data
		$amanuke_pp_options = array();
		foreach ($_POST as $key => $value) {
			$amanuke_pp_options[$key] = $value;
		}
		update_option('amanuke_pp_options',$amanuke_pp_options);
		
		
        echo "<div id=\"message\" class=\"updated fade\"><p><strong>Data has been updated</strong></p></div>";
    }
	$amanuke_pp_options = get_option("amanuke_pp_options");
	
	if (is_admin) {
		$prettyPhotoJS = plugin_dir_path(__FILE__).'js/jquery.prettyPhoto.js';
		$prettyPhotoCSS = plugin_dir_path(__FILE__).'css/prettyPhoto.css';
		$prettyPhotoImage = plugin_dir_path(__FILE__).'images/prettyPhoto';
		
		if ((!file_exists($prettyPhotoJS)) || (!file_exists($prettyPhotoCSS)) || (!file_exists($prettyPhotoJS))) {
			$warning1 = "";
			if (!file_exists($prettyPhotoJS)) {
				$warning1 = '1. <b>'. $prettyPhotoJS  .' </b> is not exist <br />';
			}
			$warning2 = "";
			if (!file_exists($prettyPhotoCSS)) {
					$warning2 =  '2. <b>'. $prettyPhotoCSS  .' </b> is not exist <br />';
				}
			$warning3 = "";
			if (!file_exists($prettyPhotoImage)) {
					$warning3 =  '3. <b>'. $prettyPhotoImage  .' </b> is not exist.<br>';
				}
				
			echo '<div class="error" style="margin-top:20px"><h3>Warning</h3><p>'. $warning1 . $warning2 . $warning3 .'<br />Please <a href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/" target="_blank"> download prettyPhoto first </a> and extract and copy to <b>'. plugin_dir_path(__FILE__) .'</b> with this structure : 
				<br>- /js/jquery.prettyPhoto.js
				<br>- /css/prettyPhoto.css
				<br>- /images/prettyPhoto
			<br><br> Because PrettyPhoto JQuery Plugins is <i><b>Creative Common Licensed</b></i> so it must be downloaded from the creator website</div> ';
		}		
	}
?>	
	
	<div style="width:750px;float:left">
	<h3>Amanuke Pretty Photo</h3>
	<form method="post" name="options" target="_self">
	<table class="form-table">
	  <tbody>
		
		<tr valign="top">
			<th scope="row"><label for="az_public_key">Theme</label></th>
			<td>
				<select name="amanuke_pp_theme">
				<?php
					
					$amanuke_pp_theme = amanuke_pp_isset_var($amanuke_pp_options,'amanuke_pp_theme','facebook');
					
					$list_theme['pp_default'] = "pp_default";
					$list_theme['light_rounded'] = "light_rounded";
					$list_theme['dark_rounded'] = "dark_rounded";
					$list_theme['light_square'] = "light_square";
					$list_theme['dark_square'] = "dark_square";
					$list_theme['facebook'] = "facebook";
					foreach($list_theme as $key => $value) {
						if ($key==$amanuke_pp_theme)
							echo "<option value=\"$key\" selected>$value</option>";
						else
							echo "<option value=\"$key\">$value</option>";
					}
				?>
				</select>
				<span class="description"></span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="az_public_key">Autoplay Slideshow</label></th>
			<td>
				<select name="amanuke_pp_autoplay_slideshow">
				<?php
					
					$amanuke_pp_autoplay_slideshow =  amanuke_pp_isset_var($amanuke_pp_options,'amanuke_pp_autoplay_slideshow','false');
					
					$list_autoplay_slideshow['false'] = "false";
					$list_autoplay_slideshow['true'] = "true";
					
					foreach($list_autoplay_slideshow as $key => $value) {
						if ($key==$amanuke_pp_autoplay_slideshow)
							echo "<option value=\"$key\" selected>$value</option>";
						else
							echo "<option value=\"$key\">$value</option>";
					}
				?>
				</select>
				<span class="description">true / false . Default : false</span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="az_public_key">Autoplay</label></th>
			<td>
				<select name="amanuke_pp_autoplay">
				<?php
					
					$amanuke_pp_autoplay =  amanuke_pp_isset_var($amanuke_pp_options,'amanuke_pp_autoplay','false');
					
					$list_autoplay['false'] = "false";
					$list_autoplay['true'] = "true";
					
					foreach($list_autoplay as $key => $value) {
						if ($key==$amanuke_pp_autoplay)
							echo "<option value=\"$key\" selected>$value</option>";
						else
							echo "<option value=\"$key\">$value</option>";
					}
				?>
				</select>
				<span class="description">Automatically start videos: True/False (Defaul : false)</span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="az_public_key">Opacity</label></th>
			<td><input class="regular-text" type="text" name="amanuke_pp_opacity"  value="<?php 
				$amanuke_pp_opacity =  amanuke_pp_isset_var($amanuke_pp_options,'amanuke_pp_opacity','0.8');
				echo $amanuke_pp_opacity; 
			?>"/> <span class="description"> Value between 0 and 1 (default : 0.8) </span></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="az_public_key">Slideshow</label></th>
			<td><input class="regular-text" type="text" name="amanuke_pp_slideshow"  value="<?php 
				$amanuke_pp_slideshow =  amanuke_pp_isset_var($amanuke_pp_options,'amanuke_pp_slideshow','5000');
				echo $amanuke_pp_slideshow; 
			?>"/> <span class="description"> interval time in ms (default 5000)  </span></td>
		</tr>
	  </tbody>
	</table>
	<p class="submit">
	<input type="submit" name="submitted" value="Save Data" />
	</p>
	</form>
	</div>
	<div style="width:350px;border-style: solid;margin-left:20px;padding:20px;padding-top:0px;border-color:#000000;float:left">
		<h4><?php _e('Recent News :'); ?></h4>
		<?php // Get RSS Feed(s)
		include_once(ABSPATH . WPINC . '/feed.php');
		add_filter( 'wp_feed_cache_transient_lifetime', create_function('$a', 'return 3600;') );
		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed('http://wpamanuke.com/?amanuke_rss=rss&amanuke-news-category=amanuke%20prettyphoto');
		if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly 
			// Figure out how many total items there are, but limit it to 5. 
			$maxitems = $rss->get_item_quantity(5); 

			// Build an array of all the items, starting with element 0 (first element).
			//$rss_items = $rss->get_items(0, $maxitems); 
		endif;
		
		?>

		<ul>
			<?php 
			$i = 0;
			
			if ($maxitems == 0) echo '<li>No items.</li>';
			else
			// Loop through each feed item and display each item as a hyperlink.
			foreach ( $rss->get_items() as $item ) { 
			
			?>
			<li>
				- <a  target="_blank" href='<?php echo esc_url( $item->get_permalink() ); ?>'
				title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
				<?php echo esc_html( $item->get_title() ); ?></a>
			</li>
			<?php } ?>
		</ul>
		<h4><?php _e('Do you like this plugins :'); ?></h4>
		Any kind of contribution would be highly appreciated. Thanks! <br />
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="98SSKNVHKF254">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

		<h4><?php _e('Credits'); ?></h4>
		- <a href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/" target="_blank">Pretty Photo JQuery Plugins</a>
	</div>
	<div style="clear:both">
	</div>
<?php
}
function amanuke_pp_admin_addpage() {
    //add_submenu_page('options-general.php', 'AutoZoneWP', 'AutoZoneWP', 10, __FILE__, 'az_admin');
	add_menu_page('AmaNukePP', 'WPAmaNuke Pretty Photo',8,__FILE__);
	add_submenu_page(__FILE__, 'Dashboard', 'AmaNukePP Setting', 8, __FILE__,"amanuke_pp_admin");
}
add_action('admin_menu', 'amanuke_pp_admin_addpage');
?>