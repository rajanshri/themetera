<?php
// Include ReduxCore
if ( file_exists( dirname( __FILE__ ) . '/framework/framework.php' ) ) {
	require_once dirname( __FILE__ ) . '/framework/framework.php';
}

// Include ReduxExtension
if ( file_exists( dirname( __FILE__ ) . '/extension-loader.php' ) ) {
	require_once dirname( __FILE__ ) . '/extension-loader.php';
}


if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "themetera";

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );


$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	'opt_name'             => $opt_name,
	'display_name'         => $theme->get( 'Name' ),
	'display_version'      => $theme->get( 'Version' ),
	'menu_type'            => 'menu',
	'allow_sub_menu'       => true,
	'menu_title'           => $theme->get( 'Name' ),
	'page_title'           => $theme->get( 'Name' ),	
	'google_api_key'       => '',
	'google_update_weekly' => false,
	'async_typography'     => true,
	'admin_bar'            => true,
	'admin_bar_icon'       => 'dashicons-portfolio',
	'admin_bar_priority'   => 50,
	'global_variable'      => '',
	'dev_mode'             => false,
	'update_notice'        => true,
	'customizer'           => true,
	'page_priority'        => null,
	'page_parent'          => 'themes.php',
	'page_permissions'     => 'manage_options',
	'menu_icon'            => '',
	'last_tab'             => '',
	'page_icon'            => 'icon-themes',
	'page_slug'            => '',
	'save_defaults'        => true,
	'default_show'         => false,
	'default_mark'         => '',
	'show_import_export'   => true,
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	'output_tag'           => true,
	'database'             => '',
	'use_cdn'              => true,
	// HINTS
	'hints'                => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)
);


Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */



/*
 *
 * ---> START SECTIONS
 *
 */



// -> START Basic Fields
Redux::setSection( $opt_name, array(
	'title'            => __( 'Personalization', 'themetera' ),
	'id'               => 'personalization',
	'desc'             => __( 'Theme personalization settings', 'themetera' ),
	'customizer_width' => '400px',
	'icon'             => 'el el-wrench',
	'fields'           => array(
		array(
                'id'       => 'logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo', 'themetera' ),
                'compiler' => 'true',
                'desc'     => __( 'Upload logo image.', 'themetera' ),
                'subtitle' => __( 'Upload logo image', 'themetera' ),
                'default'  => array( 'url'=>THEMETERA_URL.'/images/_logo.png' ),
            ),
		
	)
) );


Redux::setSection( $opt_name, array(
	'title'            => __( 'General', 'themetera' ),
	'id'               => 'general',
	'desc'             => __( 'Theme general settings', 'themetera' ),
	'customizer_width' => '400px',
	'icon'             => 'el el-wrench',
	'fields'           => array(
		array(
			'title'             => __( 'Website Type', 'themetera' ),
			'desc'             => '',
			'id'               => 'website_type',
			'type'             => 'select',
			'show_option_none' => true,
			'default'          => 'both',
			'options'          => array(
				'rent' => __( 'Rent', 'themetera' ),
				'sell'   => __( 'Sell', 'themetera' ),
				'both'     => __( 'Both', 'themetera' ),
			),
		),
		array(
			'title'             => __( 'Default Currency', 'themetera' ),
			'desc'             => '',
			'id'               => 'default_currency',
			'type'             => 'select',
			'show_option_none' => true,
			'default'          => 'USD',
			'options'          => themetera_currency_list(),
		),
		
		
	)
) );




?>