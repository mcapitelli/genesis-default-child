<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;
/**
 * <Function Title>
 * 
 * <functionname>
 *
 * This class constructs each individual options page
 * included with the current theme.
 *
 * @file 					<filename.php>
 * @package 			ExMachina
 * @subpackage 		<subpackagename>
 * @author 				Michael Capitelli
 * @copyright 		Copyright (c) 2011 - 2012, Michael Capitelli
 * @license 			http://opensource.org/licenses/GPL-3.0
 * @version 			0.3.0
 * @filesource 		wp-content/themes/exmachina/framework/<filename.php>
 * @since 				0.3.0
 */
##################################################################
# begin functions
##################################################################

// BACKEND FUNCTIONS ****************************

add_filter( 'http_request_args', 'ex_dont_update_theme', 5, 2 );
/**
 * Don't Update Theme
 * @since 1.0.0
 *
 * If there is a theme in the repo with the same name, 
 * this prevents WP from prompting an update.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */

function ex_dont_update_theme( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}


// FRONTEND FUNCTIONS ****************************

add_action( 'genesis_footer', 'ex_footer' );
/**
 * Adds Custom Theme Footer 
 *
 * @author Michael Capitelli
 * @since 1.0
 *
 */
function ex_footer() {
	echo '<div class="one-half first" id="footer-left">' . wpautop( genesis_get_option( 'footer-left', 'child-settings' ) ) . '</div>';
	echo '<div class="one-half" id="footer-right">' . wpautop( genesis_get_option( 'footer-right', 'child-settings' ) ) . '</div>';
}

add_filter( 'genesis_post_info', 'ex_post_info_filter' );
/**
 * Customize the post info function
 *
 * @author Michael Capitelli
 * @since 1.0
 *
 */
function ex_post_info_filter($post_info) {
if (!is_page()) {
    $post_info = genesis_get_option( 'post_info', 'child-settings' );
    return $post_info;
}}

add_filter( 'genesis_post_meta', 'ex_post_meta_filter' );
/**
 * Customize the post meta function
 *
 * @author Michael Capitelli
 * @since 1.0
 *
 */
function ex_post_meta_filter($post_meta) {
if (!is_page()) {
    $post_meta = genesis_get_option( 'post_meta', 'child-settings' );
    return $post_meta;
}}

##################################################################
# end functions
##################################################################
?>