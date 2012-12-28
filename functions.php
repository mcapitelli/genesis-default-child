<?php
/**
 * Functions
 *
 * @package      Genesis Default Starter
 * @since        1.0.0
 * @link         https://github.com/mcapitelli/genesis-child-default
 *
 */
/************* REGISTER CHILD THEME (You can Change This) ******/
define( 'CHILD_THEME_NAME', 'Genesis Default Starter' );
define( 'CHILD_THEME_URL', 'http://www.yoursite.com/' );


// THEME SETUP TIME **************************************
add_action('genesis_setup','child_theme_setup', 15);
/**
 * Theme Setup
 * @since 1.0.0
 *
 * This setup function attaches all of the site-wide functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 */
function child_theme_setup() {
	
	// INCLUDE THEME SETUP FILES *****************************
	include_once( CHILD_DIR . '/lib/functions/utility.php');
	include_once( CHILD_DIR . '/lib/functions/child-theme-settings.php' );
	
	// THEME SUPPORT *****************************************
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio' ));
	add_theme_support( 'genesis-post-format-images' );
	add_theme_support( 'genesis-menus', array( 'primary' => 'Primary Navigation Menu' ) );
	add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 100 ) );
	add_theme_support( 'genesis-footer-widgets', 3 );
	add_editor_style( 'lib/css/editor-style.css' );
	
	// CUSTOMIZING GENESIS ***********************************
	/** Remove Unused User Settings */
	remove_action( 'show_user_profile', 'genesis_user_options_fields' );
	remove_action( 'edit_user_profile', 'genesis_user_options_fields' );
	remove_action( 'show_user_profile', 'genesis_user_archive_fields' );
	remove_action( 'edit_user_profile', 'genesis_user_archive_fields' );
	remove_action( 'show_user_profile', 'genesis_user_seo_fields' );
	remove_action( 'edit_user_profile', 'genesis_user_seo_fields' );
	remove_action( 'show_user_profile', 'genesis_user_layout_fields' );
	remove_action( 'edit_user_profile', 'genesis_user_layout_fields' );
	
	/** Remove unused page layouts */
	//genesis_unregister_layout( 'full-width-content' );
	//genesis_unregister_layout( 'content-sidebar' );	
	//genesis_unregister_layout( 'sidebar-content' );
	//genesis_unregister_layout( 'content-sidebar-sidebar' );
	//genesis_unregister_layout( 'sidebar-sidebar-content' );
	//genesis_unregister_layout( 'sidebar-content-sidebar' );
	
	add_action( 'widgets_init', 'remove_genesis_widgets', 20 );
	
	// SCRIPTS, STYLES, & WP_HEAD ************************
	
	
	
	// CONTENT AREA **************************************
	add_filter( 'genesis_edit_post_link', '__return_false' );
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	
	// SIDEBARS AND ASIDES *******************************
	/*
	if you want to remove sidebars, you can use the functions
	below. to add a sidebar, you can just register another.
	*/
	// unregister_sidebar( 'sidebar' );
	// unregister_sidebar( 'sidebar-alt' );
	
	/* 
	to register another sidebar you can use a function similar
	to the one below.
	// register a sidebar for a specific page
	genesis_register_sidebar(array(
		'name'=>'Sidebar Special',
		'id' => 'sidebar-special',
		'description' => 'An Example Special Sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div>",
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => "</h4>"
	));
	*/
	
	// CHILD THEME IMAGE SIZES ***************************
	add_image_size( 'ex_featured', 400, 100, true );
	 
}

// UNREGISTER GENESIS WIDGETS ****************************
/*
to use this function, make sure to uncomment it out in 
the theme setup function above.
*/
function remove_genesis_widgets() {
    //unregister_widget( 'Genesis_eNews_Updates' );
    //unregister_widget( 'Genesis_Featured_Page' );
    //unregister_widget( 'Genesis_User_Profile_Widget' );
    unregister_widget( 'Genesis_Menu_Pages_Widget' );
    unregister_widget( 'Genesis_Widget_Menu_Categories' );
    //unregister_widget( 'Genesis_Featured_Post' );
    //unregister_widget( 'Genesis_Latest_Tweets_Widget' );
}




// CUSTOM CHILD THEME FUNCTIONS /***********************


