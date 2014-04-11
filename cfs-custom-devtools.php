<?php
/**
Plugin Name: CFS DEV TOOLS
Plugin URI: http://cleanforest.co
Description: CFS Dev Tools
Author: Noam Eppel
Version: 1.4
Author URI: http://cleanforest.co
License: GNU General Public License (Version 2 - GPLv2)
Network: true
*/

/**
 * [check_devmode Sets DEVMODE constant]
 * @return [DEVMODE] [true|false]
 */
function check_devmode() {
	if (ENVIRONMENT == 'DEVELOPMENT' && is_user_logged_in() && isset($_GET['devnote']) ) {
		define('DEVMODE', true);
	} else {
		define('DEVMODE', false);
	}

}

add_action('wp_head', 'check_devmode');


/**
 * [devnote Development Notes]
 * @param  [string|array] $note
 * @echo strings and var_dump arrays
 */
function devnote( $note, $print_to_screen=true ) {
	if (DEVMODE === true ) {
		if (is_array($note) || is_object($note)):
			echo("<script>console.log('%cDEVNOTE: %c".json_encode($note)." %cPROFILER: %c".timer_stop( 0, 5 )." seconds.', 'color: #000', 'color: red', 'color: #000', 'color: #0088cc');</script>");
			if ($print_to_screen):
				echo "<pre class='devnote'>";
				var_dump($note);
				echo "</pre>";	
			endif;
		else:
			echo("<script>console.log('%cDEVNOTE: %c".$note." %cPROFILER: %c".timer_stop( 0, 5 )." seconds.', 'color: #000', 'color: red', 'color: #000', 'color: #0088cc');</script>");
			if ($print_to_screen):
				echo "<span class='devnote'>$note</span>";
			endif;		
		endif;
	}
}

/**
 * [cfs_show_db_queries will display total number of DB queries and the time required to generate page]
 * @echo in footer
 */
function cfs_show_page_time() {
	if (DEVMODE === true ) {
    	echo "<div class='devnote'>CFS DB Queries " . get_num_queries() . ' queries in ' . timer_stop(0,3) . ' seconds.</div>';
    }

}
add_action('wp_footer', 'cfs_show_page_time');

/**
 * [show_savequeries will display database details in footer.]
 * @echo $wpdb queries in footer
 * NOTE: define('SAVEQUERIES', true ); must be set in wp-config.php
 */
function cfs_show_db_queries() {
	if (DEVMODE === true && SAVEQUERIES === true) {
    	global $wpdb;
    	echo "<h2 class='showqueries'>DISPLAY OF SQL QUERIES</h2>";
    	echo "<pre>";
    	print_r( $wpdb->queries );
    	echo "</pre>";
    }
}
add_action('wp_footer', 'cfs_show_db_queries');


/**
 * [devnote_css Styles for Development Notes]
 * @echo CSS Style
 */
function devnote_css() {
	if (DEVMODE === true) {
		echo "
		<style>
		.devnote {
			background:red;
			color: white;
			font-size: 18px;
			font-weight: 900;
			display:inline-block;
			line-height: 24px;
		}
		pre.devnote {
			background:red;
			color: white;
			font-size: 18px;
			font-weight: 400;
			display:inline-block;
			line-height: 24px;
		}
		</style>
		";
	}
}
add_action( 'wp_head', 'devnote_css' );
