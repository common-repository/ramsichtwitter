<?php
/*
Plugin Name: tweets for wordpresss
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: The Plugin's Version Number, e.g.: 1.0
Author: Name Of The Plugin Author
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/
?>
<?php
  function get_twitts($username = '', $count = 10, $hyper_linked = false, $link_target_blank = false) {
	$num = $count;
	include_once(ABSPATH . WPINC . '/feed.php');
	$feeds = fetch_feed('https://api.twitter.com/1/statuses/user_timeline.rss?screen_name=' . $username);
	echo '<ul class="twitter">';

	$maxitems = $feeds->get_item_quantity($count);
	if ($maxitems == 0) {
		echo '<li>No twitter feeds</li>';
	} else {
		$feeds_items = $feeds->get_items(0, $maxitems);
		foreach($feeds_items as $item) {
			if (!$hyper_linked) {
				echo '<li>' . esc_html($item->get_title()) . '</li>';
			} else {
				if ($link_target_blank)
					echo '<li><a href="' . $item->get_permalink() . '" target="_blank">' . substr(strstr($item->get_title(), ': '), 2, strlen($item->get_title())) . '</a></li>';
				else
					echo '<li><a href="' . $item->get_permalink() . '" >' . substr(strstr($item->get_title(), ': '), 2, strlen($item->get_title())) . '</a></li>'; 
			}	
		}
	}
	echo '</ul>';
}
?>