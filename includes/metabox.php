<?php
if ( file_exists( dirname( __FILE__ ) . '/metabox/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/metabox/init.php';
}
if ( file_exists( dirname( __FILE__ ) . '/metabox/tab-extension/extension.php' ) ) {
	require_once dirname( __FILE__ ) . '/metabox/tab-extension/extension.php';
}

add_action( 'cmb2_admin_init', 'themetera_custom_metaboxes' );
if(!function_exists('themetera_custom_metaboxes'))
{
	function themetera_custom_metaboxes()
	{
		$prefix = '_';
		
		$box_options = array(
			'id'           => 'themetera_property_meta',
			'title'        => __( 'Property Details', 'themetera' ),
			'object_types' => array( 'themetera_property' ),
			'show_names'   => true,
		);

		// Setup meta box
		$property_meta = new_cmb2_box( $box_options );

		// setting tabs
		$tabs_setting           = array(
			'config' => $box_options,
			//		'layout' => 'vertical', // Default : horizontal
			'tabs'   => array()
		);
		$tabs_setting['tabs'][] = array(
			'id'     => 'general',
			'title'  => __( 'General', 'themetera' ),
			'fields' => array(
				array(
					'name' => __( 'Active', 'themetera' ),
					'id'   => $prefix.'active',
					'type' => 'checkbox'
				),
				array(
					'name'           => __( 'Property Type', 'themetera' ),
					'id'             => $prefix.'type_id',
					'taxonomy'       => 'themetera_type', //Enter Taxonomy Slug
					'type'           => 'taxonomy_select',
				),
				array(
					'name' => __( 'Reference ID', 'themetera' ),
					'id'   => $prefix.'reference_id',
					'type' => 'text'
				),
				
			)
		);
		$tabs_setting['tabs'][] = array(
			'id'     => 'pricing',
			'title'  => __( 'Pricing', 'themetera' ),
			'fields' => array(				
				array(
					'name'    => __( 'Property for', 'themetera' ),
					'id'      => $prefix.'type',
					'type'    => 'radio_inline',
					'options' => array(
						'rent' => __( 'Rent', 'themetera' ),
						'sale'   => __( 'Sale', 'themetera' ),
					),
					'default' => 'rent',
				),
				array(
					'name' => __( 'Default pricing plans', 'themetera' ),
					'id'   => $prefix.'price',
					'type' => 'text'
				),
				array(
					'name'             => __( 'Default pricing plans', 'themetera' ),					
					'id'               => $prefix.'per',
					'type'             => 'select',
					'show_option_none' => true,
					'default'          => 'night',
					'options'          => array(
						'night' => __( 'night', 'themetera' ),
						'week'   => __( 'week', 'themetera' ),
						'month'     => __( 'month', 'themetera' ),
						'year'     => __( 'year', 'themetera' ),
						'bed'     => __( 'bed', 'themetera' ),
					),
				),
				array(
					'id'      => $prefix.'additional_prices',
					'type'    => 'group',
					'options' => array(
						'group_title'   => __( 'Additional price {#}', 'themetera' ),
						'add_button'    => __( 'Additional price', 'themetera' ),
						'remove_button' => __( 'Remove price', 'themetera' ),
						'sortable'      => false
					),
					'fields'  => array(
						array(
							'name' => __( 'From', 'themetera' ),
							'id'   => 'from',
							'type' => 'text_date',
						),
						array(
							'name' => __( 'To', 'themetera' ),
							'id'   => 'to',
							'type' => 'text_date',
						),
						array(
							'name'             => __( 'Per', 'themetera' ),					
							'id'               => 'per',
							'type'             => 'select',
							'show_option_none' => true,
							'default'          => 'night',
							'options'          => array(
								'night' => __( 'night', 'themetera' ),
								'week'   => __( 'week', 'themetera' ),
								'month'     => __( 'month', 'themetera' ),
								'year'     => __( 'year', 'themetera' ),
								'bed'     => __( 'bed', 'themetera' ),
							),
						),
					)
				),
				array(
					'name' => __( 'Allow instant booking', 'themetera' ),
					'id'   => $prefix.'instant_booking',
					'type' => 'checkbox'
				),
				array(
					'name' => __( 'Max. occupants', 'themetera' ),
					'id'   => $prefix.'max_occupants',
					'type' => 'text'
				),
				array(
					'name' => __( 'Min. nights to stay', 'themetera' ),
					'id'   => $prefix.'min_booking_length',
					'type' => 'text'
				),
				array(
					'name' => __( 'Cleaning fee', 'themetera' ),
					'id'   => $prefix.'cleaning_fee',
					'type' => 'text'
				),
				array(
					'name' => __( 'Refundable deposit', 'themetera' ),
					'id'   => $prefix.'refundable_deposit',
					'type' => 'text'
				),
				array(
					'name' => __( 'Reservation fee', 'themetera' ),
					'id'   => $prefix.'markup',
					'type' => 'text'
				),
			)
		);
		
		
		$tabs_setting['tabs'][] = array(
			'id'     => 'images',
			'title'  => __( 'Images', 'themetera' ),
			'fields' => array(				
				array(
					'name' => __( 'Images', 'themetera' ),
					'desc' => '',
					'id'   => $prefix.'images',
					'type' => 'file_list',
					
				)
			)
		);
		
		$tabs_setting['tabs'][] = array(
			'id'     => 'details',
			'title'  => __( 'Details', 'themetera' ),
			'fields' => array(				
				array(
					'name' => __( 'Meta Keywords', 'themetera' ),
					'desc' => '',
					'id'   => $prefix.'keyword-1',
					'type' => 'text',					
				),
				array(
					'name' => __( 'Meta description', 'themetera' ),
					'desc' => '',
					'id'   => $prefix.'metadesc-1',
					'type' => 'text',					
				),
				array(
					'name' => __( 'Number of bedrooms', 'themetera' ),
					'desc' => '',
					'id'   => $prefix.'bedrooms',
					'type' => 'text',
					'default' => '0',
				),
				array(
					'name' => __( 'Number of bathrooms', 'themetera' ),
					'desc' => '',
					'id'   => $prefix.'bathrooms',
					'type' => 'text',
					'default' => '0',
				),
				array(
					'name' => __( 'Living area', 'themetera' ),
					'desc' => '',
					'id'   => $prefix.'living_area',
					'type' => 'text',
					'default' => '0',
				),
				array(
					'name' => __( 'Total area', 'themetera' ),
					'desc' => '',
					'id'   => $prefix.'total_area',
					'type' => 'text',
					'default' => '0',
				),
				array(
					'name' => __( 'Floor', 'themetera' ),
					'desc' => '',
					'id'   => $prefix.'floor',
					'type' => 'text',
					'default' => '0',
				),
				array(
					'name' => __( 'Number of floors', 'themetera' ),
					'desc' => '',
					'id'   => $prefix.'num_floors',
					'type' => 'text',
					'default' => '0',
				),
				array(
					'name' => __( 'Furnished', 'themetera' ),
					'desc' => '',
					'id'   => $prefix.'furnished',
					'type' => 'checkbox',
				),
				
			)
		);
		
		$tabs_setting['tabs'][] = array(
			'id'     => 'amenities',
			'title'  => __( 'Amenities', 'themetera' ),
			'fields' => array(				
				array(
						'name'           => __('Amenities','themetera'),
						'id'             =>$prefix.'amenities',
						'taxonomy'       => 'themetera_amenities', 
						'type'           => 'taxonomy_multicheck_inline',
						
					) 
			)
		);
		
		$tabs_setting['tabs'][] = array(
			'id'     => 'location',
			'title'  => __( 'Location', 'themetera' ),
			'fields' => array(				
				array(
					'name'           => __( 'Location', 'themetera' ),
					'desc'           => '',
					'id'             => 'location_id',
					'taxonomy'       => 'themetera_location', 
					'type'           => 'taxonomy_select',					
				), 
				array(
					'name' => __( 'Address', 'themetera' ),
					'desc' => '',
					'id'   => $prefix.'address',
					'type' => 'text',
				),
				array(
					'name' => __( 'Zip', 'themetera' ),
					'desc' => '',
					'id'   => $prefix.'zip',
					'type' => 'text',
				),
				
				array(
					'name' => __( 'Co-ordinate', 'themetera' ),
					'id'   => 'lat_long',
					'type' => 'text',
				),
				array(
					'name'    => '&nbsp',
					'id'      => 'map',
					'type'    => 'map_area',
				)
			)
		);

		// set tabs
		$property_meta->add_field( array(
			'id'   => '__tabs',
			'type' => 'tabs',
			'tabs' => $tabs_setting
		) );
		
		//Booking meta
		$booking_meta = new_cmb2_box( array(
		'id'            => 'booking_metabox',
		'title'         => __( 'Booking Details', 'themetera' ),
		'object_types'  => array( 'themetera_booking', 'themetera'), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, 
	) );

	// Regular text field
	$booking_meta->add_field( array(
			'name'    => __('Check In Date','themetera'),
			'id'      => $prefix.'checkin_date',
			'type'    => 'text_date',
			'date_format' => 'Y-m-d'
	));
	$booking_meta->add_field( array(
			'name'    => __('Check Out Date','themetera'),
			'id'      => $prefix.'checkout_date',
			'type'    => 'text_date',
			'date_format' => 'Y-m-d'
	));
	$booking_meta->add_field( array(
			'name'    => __('Guests Number','themetera'),
			'id'      => $prefix.'guests',
			'type'    => 'text',
	));
	$booking_meta->add_field( array(
		'name'             => __('Property','themetera'),
		'id'               => $prefix.'property_id',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => themetera_get_property_array()
	) );
	/*$booking_meta->add_field( array(
		'name'             => __('Status','themetera'),
		'id'               => $prefix.'status',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          =>array(
						'0'=>'Pending',
						'1'=>'Accepted'
		),
		'default'=>'0'
		
	) );*/

		
		
	}
}

add_action( 'cmb2_render_map_area', 'cmb2_render_callback_for_map_area', 10, 5 );
function cmb2_render_callback_for_map_area( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
	$latitude=get_post_meta($object_id,'_latitude',true);
	$longitude=get_post_meta($object_id,'_longitude',true);
	echo '<p id="status"></p><div id="map_canvas" style="width:500px;height:300px;border: dotted 1px #000;">  </div>';
	
}



?>