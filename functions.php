<?php
if(!defined('THEMETERA_URL'))define('THEMETERA_URL',get_template_directory_uri());
if(!defined('THEMETERA_PATH'))define('THEMETERA_PATH',get_template_directory());

/*require_once(THEMETERA_PATH.'/includes/config.php');
require_once(THEMETERA_PATH.'/includes/post_types.php');
require_once(THEMETERA_PATH.'/includes/metabox.php');
require_once(THEMETERA_PATH.'/includes/widgets.php');*/
require_once(THEMETERA_PATH.'/includes/template-functions.php');
require_once(THEMETERA_PATH.'/includes/config.php');
require_once(THEMETERA_PATH.'/includes/post_types.php');
require_once(THEMETERA_PATH.'/includes/metabox.php');


add_action( 'after_setup_theme', 'themetera_setup' );

if(!function_exists('themetera_setup')){
	
	function themetera_setup(){
		
		load_theme_textdomain( 'themetera' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		$GLOBALS['content_width'] = apply_filters( 'themetera_content_width', 840 );
	
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 324, 207 );

		
		register_nav_menus( array(
			'footer' => __( 'Footer Menu', 'bcg' )
			) );
		
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list'
		) );
		
		register_sidebar( array(
			'name' => __( 'Footer Top', 'themetera' ),
			'id' => 'footer-top',
			'description' => __( 'Widget area for footer top section.', 'themetera' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );
		

	}
}

add_action( 'wp_enqueue_scripts', 'themetera_enqueue_script' );
if(!function_exists('themetera_enqueue_script')){
	
	function themetera_enqueue_script() {
		
		wp_enqueue_style( 'themetera-bootstrap-datepicker', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,600i,700,700i,800|Roboto:400,700' );
		wp_enqueue_style( 'themetera-bootstrap-datepicker', THEMETERA_URL . '/css/bootstrap-datepicker.css' );
		wp_enqueue_style( 'themetera-bootstrap-slider', THEMETERA_URL . '/css/bootstrap-slider.css' );
		wp_enqueue_style( 'themetera-slick', THEMETERA_URL . '/css/slick.css' );		
		wp_enqueue_style( 'themetera-slick-theme', THEMETERA_URL . '/css/slick-theme.css' );
		wp_enqueue_style( 'themetera-bootstrap', THEMETERA_URL . '/css/bootstrap.css' );
		
		wp_enqueue_style( 'themetera-default', THEMETERA_URL . '/css/default.css' );
		wp_enqueue_style( 'themetera-default-date', THEMETERA_URL . '/css/default.date.css' );
		wp_enqueue_style( 'themetera-default-time', THEMETERA_URL . '/css/default.time.css' );
		wp_enqueue_style( 'themetera-style', THEMETERA_URL . '/css/style.css' );
		
		wp_enqueue_script( 'jquery');		
		
		wp_enqueue_script( 'themetera-bootstrap',THEMETERA_URL.'/js/bootstrap.min.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-meanmenu',THEMETERA_URL.'/js/jquery.meanmenu.min.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-bootstrap-datepicker',THEMETERA_URL.'/js/bootstrap-datepicker.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-bootstrap-datepicker-pt',THEMETERA_URL.'/js/bootstrap-datepicker.pt.min.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-picker',THEMETERA_URL.'/js/picker.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-picker-date',THEMETERA_URL.'/js/picker.date.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-picker-time',THEMETERA_URL.'/js/picker.time.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-bootstrap-slider',THEMETERA_URL.'/js/bootstrap-slider.min.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-infiniteload',THEMETERA_URL.'/js/jquery.infiniteload.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-slick',THEMETERA_URL.'/js/slick.min.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-scrolltofixed',THEMETERA_URL.'/js/jquery-scrolltofixed.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-isotop',THEMETERA_URL.'/js/isotop.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-packery-mode',THEMETERA_URL.'/js/packery-mode.pkgd.min.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-googlemap-api','//maps.google.com/maps/api/js?key=AIzaSyDtbvfJKlPp-22K3TTHjE6P9_ujnv2IAms', array('jquery'),false, false );
		wp_enqueue_script( 'themetera-cs-map',THEMETERA_URL.'/js/cs.maps.js', array('jquery'),false, true );
		$booking_array=array();
		if(is_singular('themetera_property')){
			global $post;
			
			wp_enqueue_script( 'themetera-property',THEMETERA_URL.'/js/property.js', array('jquery'),false, true );
		
			//get all bookings
			$booking_array=themetera_get_property_booking($post->ID);
			
		}
		
		wp_enqueue_script( 'themetera-app',THEMETERA_URL.'/js/app.js', array('jquery'),false, true );
		
		
		
		wp_localize_script( 'themetera-app','themetera',array(
			'themeurl'=>THEMETERA_URL,
			'ajaxurl'=>admin_url('admin-ajax.php'),
			'booking_array'=>json_encode($booking_array)
		) );
	}

}

add_action( 'admin_enqueue_scripts', 'themetera_admin_enqueue_script' );
if(!function_exists('themetera_admin_enqueue_script')){
	function themetera_admin_enqueue_script($hook) {
		wp_enqueue_style( 'themetera-chosen', THEMETERA_URL . '/css/chosen.css' );
		
		
		wp_enqueue_script('jquery');
		wp_enqueue_media();
		wp_enqueue_script( 'themetera-googlemap-api','//maps.google.com/maps/api/js?key=AIzaSyDtbvfJKlPp-22K3TTHjE6P9_ujnv2IAms', array('jquery'),false, false );
		wp_enqueue_script( 'themetera-chosen',THEMETERA_URL.'/js/chosen.jquery.min.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-map',THEMETERA_URL.'/js/cs.maps.js', array('jquery'),false, true );
		wp_enqueue_script( 'themetera-admin',THEMETERA_URL.'/js/admin.js', array('jquery'),false, true );
	}

}

 

function alter_the_query( $request ) {
   
   echo $request;

    return $request;
}
//add_filter( 'posts_request', 'alter_the_query' );
add_filter('show_admin_bar', '__return_false');
?>