<?php
/**
Plugin Name: CFS DEV TOOLS
Plugin URI: http://cleanforest.co
Description: CFS Dev Tools
Author: Noam Eppel
Version: 1.0
Author URI: http://cleanforest.co
License: GNU General Public License (Version 2 - GPLv2)
Network: true
*/

/**
 * [devnote Development Notes]
 * @param  [string|array] $note
 * @echo strings and var_dump arrays
 */
function devnote($note) {
	if (ENVIRONMENT == 'DEVELOPMENT' && is_user_logged_in() && isset($_GET['devnote']) ) {
		if( is_array( $note ) || is_object( $note ) ) {
			echo "<pre class='devnote'>";
			var_dump($note);
			echo "</pre>";
			echo("<script>console.log('DEVNOTE: ".json_encode($note)."');</script>");
		} else {
			echo "<span class='devnote'>$note</span>";
			echo("<script>console.log('DEVNOTE: ".$note."');</script>");
		}
	}
}

/**
 * [cfs_show_db_queries will display total number of DB queries and the time required to generate page]
 * @echo in footer
 */
function cfs_show_page_time() {
	if (ENVIRONMENT == 'DEVELOPMENT' && is_user_logged_in() && isset($_GET['devnote']) ) {
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
	if (ENVIRONMENT == 'DEVELOPMENT' && SAVEQUERIES === true && is_user_logged_in() && isset($_GET['devnote']) ) {
    	global $wpdb;
    	echo "<h2>DISPLAY OF SQL QUERIES</h2>";
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
	if (ENVIRONMENT == 'DEVELOPMENT' && is_user_logged_in() && isset($_GET['devnote']) ) {
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
