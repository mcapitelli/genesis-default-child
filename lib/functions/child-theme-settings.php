<?php
/**
 * Child Theme Settings
 *
 * This file registers all of this child theme's specific Theme Settings, accessible from
 * Genesis > Child Theme Settings.
 *
 */ 
 
/**
 * Registers a new admin page, providing content and corresponding menu item
 * for the Child Theme Settings page.
 *
 * @since 1.0.0
 *
 * @package BE_Genesis_Child
 * @subpackage Child_Theme_Settings
 */
class Child_Theme_Settings extends Genesis_Admin_Boxes {
	
	/**
	 * Create an admin menu item and settings page.
	 * @since 1.0.0
	 */
	function __construct() {
		
		// Specify a unique page ID. 
		$page_id = 'child';
		
		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => 'Genesis - Child Theme Settings',
				'menu_title'  => 'Child Theme Settings',
			)
		);
		
		// Set up page options. These are optional, so only uncomment if you want to change the defaults
		$page_ops = array(
		//	'screen_icon'       => 'options-general',
		//	'save_button_text'  => 'Save Settings',
		//	'reset_button_text' => 'Reset Settings',
		//	'save_notice_text'  => 'Settings saved.',
		//	'reset_notice_text' => 'Settings reset.',
		);		
		
		// Give it a unique settings field. 
		// You'll access them from genesis_get_option( 'option_name', 'child-settings' );
		$settings_field = 'child-settings';
		
		// Set the default values
		$default_settings = array(
			'post_info' => '[post_date] by [post_author_posts_link] at [post_time] [post_comments] [post_edit]',
			'post_meta' => '[post_categories] [post_tags]',
			'footer-left'   => 'Copyright &copy; ' . date( 'Y' ) . ' All Rights Reserved',
			'footer-right' => 'Site by <a href="http://www.yoursite.com">Michael Capitelli</a>',
		);
		
		// Create the Admin Page
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		// Initialize the Sanitization Filter
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );
			
	}

	/** 
	 * Set up Sanitization Filters
	 * @since 1.0.0
	 *
	 * See /lib/classes/sanitization.php for all available filters.
	 */	
	function sanitization_filters() {
		
		genesis_add_option_filter( 'safe_html', $this->settings_field,
			array(
				'post_info',
				'post_meta',
				'footer-left',
				'footer-right',
			) );
	}
	
	/**
	 * Set up Help Tab
	 * @since 1.0.0
	 *
	 * Genesis automatically looks for a help() function, and if provided uses it for the help tabs
	 * @link http://wpdevel.wordpress.com/2011/12/06/help-and-screen-api-changes-in-3-3/
	 */
	 function help() {
	 	$screen = get_current_screen();

		$screen->add_help_tab( array(
			'id'      => 'sample-help', 
			'title'   => 'Sample Help',
			'content' => '<p>Help content goes here.</p>',
		) );
	 }
	
	/**
	 * Register metaboxes on Child Theme Settings page
	 * @since 1.0.0
	 */
	function metaboxes() {
		
		add_meta_box('postinfo_metabox', 'Post Info', array( $this, 'postinfo_metabox' ), $this->pagehook, 'main', 'high');
		
		add_meta_box('footer_metabox', 'Footer', array( $this, 'footer_metabox' ), $this->pagehook, 'main', 'high');
		
	}
	
	/**
		 * Post Info Metabox
		 * @since 1.0.0
		 */
		function postinfo_metabox() {	
			?>
			<label>Enter your custom post info:</label><br />
			<input type="text" name="<?php echo $this->get_field_name( 'post_info' ) ;?>" id="<?php echo $this->get_field_id( 'post_info' ) ;?>" value="<?php echo esc_attr( $this->get_field_value( 'post_info' ) );?>" size="80" />
			</p>
			
			<label>Enter your custom post meta:</label><br />
			<input type="text" name="<?php echo $this->get_field_name( 'post_meta' ) ;?>" id="<?php echo $this->get_field_id( 'post_meta' ) ;?>" value="<?php echo esc_attr( $this->get_field_value( 'post_meta' ) );?>" size="80" />
			</p>
			
			<hr class="div" />
			<p><strong>Shortcode Reference</strong></p>
			<ul>
				<li>[post_date] - <span class="description">Date the post was published</span></li>
				<li>[post_time] - <span class="description">Time the post was published</span></li>
				<li>[post_author] - <span class="description">Post author display name</span></li>
				<li>[post_author_link] - <span class="description">Time the post was published</span></li>
				<li>[post_author_posts_link] - <span class="description">Post author display name, linked to their archive</span></li>
				<li>[post_comments] - <span class="description">Post comments link</span></li>
				<li>[post_tags] - <span class="description">List of post tags</span></li>
				<li>[post_categories] - <span class="description">List of post categories</span></li>
				<li>[post_edit] - <span class="description">Post edit link (visible to admins)</span></li>
			</ul>
			<p><span class="description">For a more comprehensive shortcode usage guide, please see the official <a href="http://www.studiopress.com/tutorials/shortcode-reference">shortcode reference</a></span></p>
			<?php
					}
	
	/**
	 * Footer Metabox
	 * @since 1.0.0
	 */
	function footer_metabox() {
		
	echo '<p><strong>Footer Left:</strong></p>';
	wp_editor( $this->get_field_value( 'footer-left' ), $this->get_field_id( 'footer-left' ), array( 'textarea_rows' => 5 ) );	

	echo '<p><strong>Footer Right:</strong></p>';
	wp_editor( $this->get_field_value( 'footer-right' ), $this->get_field_id( 'footer-right' ), array( 'textarea_rows' => 5 ) ); 
	}
	
	
}

/**
 * Add the Theme Settings Page
 * @since 1.0.0
 */
function be_add_child_theme_settings() {
	global $_child_theme_settings;
	$_child_theme_settings = new Child_Theme_Settings;	 	
}
add_action( 'genesis_admin_menu', 'be_add_child_theme_settings' );
