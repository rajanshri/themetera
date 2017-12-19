<?php
add_action( 'init', 'themetera_custom_post_types',0 );
if(!function_exists('themetera_custom_post_types')){
	function themetera_custom_post_types() { 
	
		$labels = array(
			'name'                => _x( 'Properties', 'Property', 'themetera' ),
			'singular_name'       => _x( 'Property', 'Property', 'themetera' ),
			'menu_name'           => __( 'Properties', 'themetera' ),
			'parent_item_colon'   => __( 'Parent Property', 'themetera' ),
			'all_items'           => __( 'All Properties', 'themetera' ),
			'view_item'           => __( 'View Property', 'themetera' ),
			'add_new_item'        => __( 'Add New Property', 'themetera' ),
			'add_new'             => __( 'Add New', 'themetera' ),
			'edit_item'           => __( 'Edit Property', 'themetera' ),
			'update_item'         => __( 'Update Property', 'themetera' ),
			'search_items'        => __( 'Search Properties', 'themetera' ),
			'not_found'           => __( 'Not Found', 'themetera' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'themetera' ),
		);
		 
	
		 
		$args = array(
			'label'               => __( 'Properties', 'themetera' ),
			'description'         => __( 'Properties', 'themetera' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail','author','excerpt','comments' ),
			//'taxonomies'          => array( 'bcg_country','bcg_region','bcg_resort' ),			
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'        	  => THEMETERA_URL.'/images/home.png',
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'rewrite'           => array( 'slug' => 'properties' ),
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		 
		
		register_post_type( 'themetera_property', $args );
		flush_rewrite_rules( true );
		
		$labels = array(
			'name'                => _x( 'Bookings', 'Property', 'themetera' ),
			'singular_name'       => _x( 'Booking', 'Property', 'themetera' ),
			'menu_name'           => __( 'Bookings', 'themetera' ),
			'parent_item_colon'   => __( 'Parent Property', 'themetera' ),
			'all_items'           => __( 'All Booking', 'themetera' ),
			'view_item'           => __( 'View Booking', 'themetera' ),
			'add_new_item'        => __( 'Add New Booking', 'themetera' ),
			'add_new'             => __( 'Add New', 'themetera' ),
			'edit_item'           => __( 'Edit Booking', 'themetera' ),
			'update_item'         => __( 'Update Booking', 'themetera' ),
			'search_items'        => __( 'Search Bookings', 'themetera' ),
			'not_found'           => __( 'Not Found', 'themetera' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'themetera' ),
		);
		 
	
		 
		$args = array(
			'label'               => __( 'Bookings', 'themetera' ),
			'description'         => __( 'Bookings', 'themetera' ),
			'labels'              => $labels,
			'supports'            => array( 'title','author' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'        	  => THEMETERA_URL.'/images/calendar.png',
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'rewrite'           => array( 'slug' => 'bookings' ),
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		 
		
		register_post_type( 'themetera_booking', $args );
		flush_rewrite_rules( true );
		
		$labels = array(
		'name'              => _x( 'Locations', 'Locations', 'themetera' ),
		'singular_name'     => _x( 'Location', 'Location', 'themetera' ),
		'search_items'      => __( 'Search Location', 'themetera' ),
		'all_items'         => __( 'All Locations', 'themetera' ),
		'parent_item'       => __( 'Parent Location', 'themetera' ),
		'parent_item_colon' => __( 'Parent Location:', 'themetera' ),
		'edit_item'         => __( 'Edit Location', 'themetera' ),
		'update_item'       => __( 'Update Location', 'themetera' ),
		'add_new_item'      => __( 'Add New Location', 'themetera' ),
		'new_item_name'     => __( 'New Location Name', 'themetera' ),
		'menu_name'         => __( 'Locations', 'themetera' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'public'			=>true,
			'rewrite'           => array( 'slug' => 'locations' ),
			
		);

		register_taxonomy( 'themetera_location', array( 'themetera_property' ), $args );
		flush_rewrite_rules( true );
		
		$labels = array(
		'name'              => _x( 'Property Types', 'Property Types', 'themetera' ),
		'singular_name'     => _x( 'Property Type', 'Property Type', 'themetera' ),
		'search_items'      => __( 'Search Property Type', 'themetera' ),
		'all_items'         => __( 'All Property Types', 'themetera' ),
		'parent_item'       => __( 'Parent Property Type', 'themetera' ),
		'parent_item_colon' => __( 'Parent Property Type:', 'themetera' ),
		'edit_item'         => __( 'Edit Property Type', 'themetera' ),
		'update_item'       => __( 'Update Property Type', 'themetera' ),
		'add_new_item'      => __( 'Add New Property Type', 'themetera' ),
		'new_item_name'     => __( 'New Property Type Name', 'themetera' ),
		'menu_name'         => __( 'Property Types', 'themetera' ),
		);

		$args = array(
			'hierarchical'      => false ,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'public'			=>true,
			'rewrite'           => array( 'slug' => 'property-type' ),
			
		);

		register_taxonomy( 'themetera_type', array( 'themetera_property' ), $args );
		flush_rewrite_rules( true );
		
		$labels = array(
		'name'              => _x( 'Amenities', 'Amenities', 'themetera' ),
		'singular_name'     => _x( 'Amenity', 'Amenity', 'themetera' ),
		'search_items'      => __( 'Search Amenity', 'themetera' ),
		'all_items'         => __( 'All Amenities', 'themetera' ),
		'parent_item'       => __( 'Parent Amenity', 'themetera' ),
		'parent_item_colon' => __( 'Parent Amenity:', 'themetera' ),
		'edit_item'         => __( 'Edit Amenity', 'themetera' ),
		'update_item'       => __( 'Update Amenity', 'themetera' ),
		'add_new_item'      => __( 'Add New Amenity', 'themetera' ),
		'new_item_name'     => __( 'New Amenity Name', 'themetera' ),
		'menu_name'         => __( 'Amenities', 'themetera' ),
		);

		$args = array(
			'hierarchical'      => false ,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'public'			=>true,
			'rewrite'           => array( 'slug' => 'amenities' ),
			
		);

		register_taxonomy( 'themetera_amenities', array( 'themetera_property' ), $args );
		flush_rewrite_rules( true );
		
		
		
		
		
		
	}
}


add_action( 'themetera_location_add_form_fields', 'themetera_location_add_meta_field', 10, 2 );

if(!function_exists('themetera_location_add_meta_field'))
{
	function themetera_location_add_meta_field($taxonomy)
	{
		?>
		<div class="form-field">
			<label for="zip-code"><?php _e( 'Zip Code', 'themetera' ); ?></label>
			<input type="text" name="zip" id="zip" value="">
		</div>
		<div class="form-field">
			<label for="image"><?php _e( 'Image', 'themetera' ); ?></label>
			<input type="text" name="image" id="image" value="">
			<input type="button" class="button button-primary" value="<?php _e('Upload','themetera'); ?>" class="themetera-upload">
			<input type="hidden" name="attachment_id">
			<div class="themetera-upload-snap"></div>
		</div>
		<div class="form-field">			
			<label for="map"><?php _e( 'Map', 'themetera' ); ?></label>
			<p id="status"></p>
			<div id="map_canvas" style="height:300px;width:373px;border: dotted 1px #000;"></div>
			<input type="hidden" name="latitude" id="latitude">
			<input type="hidden" name="longitude" id="longitude">
			
		</div>
		<div class="form-field">			
			<label for="map"><?php _e( 'Co-ordinate', 'themetera' ); ?></label>
			<input type="text" name="lat_long">
		</div>
		<?php
	}
}

add_action( 'themetera_location_edit_form_fields', 'themetera_location_edit_meta_field', 10, 2 );

if(!function_exists('themetera_location_edit_meta_field'))
{
	function themetera_location_edit_meta_field($term, $taxonomy)
	{
		$zip = get_term_meta( $term->term_id, 'zip', true );
		$image = get_term_meta( $term->term_id, 'image', true );
		$attachment_id = get_term_meta( $term->term_id, 'attachment_id', true );
		$latitude = get_term_meta( $term->term_id, 'latitude', true );
		$longitude = get_term_meta( $term->term_id, 'longitude', true );
		$lat_long = get_term_meta( $term->term_id, 'lat_long', true );
		?>
		<tr class="form-field term-group-wrap">
			<th scope="row">
				<label for="zip-code"><?php _e( 'Zip Code', 'themetera' ); ?></label>
			</th>
			<td>
				<input type="text" name="zip" id="zip" value="<?php echo $zip; ?>">
			</td>
		</tr>
		<tr class="form-field term-group-wrap">
			<th scope="row">
				<label for="image"><?php _e( 'Image', 'themetera' ); ?></label>
			</th>
			<td>
				<input type="text" name="image" id="image" value="<?php echo $image; ?>">
				<input type="button" class="button button-primary" value="<?php _e('Upload','themetera'); ?>" class="themetera-upload">
				<input type="hidden" name="attachment_id" value="<?php echo $attachment_id; ?>">
				<div class="themetera-upload-snap"></div>
			</td>
		</tr>
		<tr class="form-field term-group-wrap">
			<th scope="row">
				<label for="map"><?php _e( 'Map', 'themetera' ); ?></label>
			</th>
			<td>
				<p id="status"></p>
				<div id="map_canvas" style="height:300px;width:373px;border: dotted 1px #000;"></div>
				<input type="hidden" name="latitude" id="latitude" value="<?php echo $latitude; ?>">
				<input type="hidden" name="longitude" id="longitude" value="<?php echo $longitude; ?>">
				
			</td>
		</tr>
		<tr class="form-field term-group-wrap">
			<th scope="row">
				<label for="map"><?php _e( 'Co-ordinate', 'themetera' ); ?></label>
			</th>
			<td>
				<input type="text" name="lat_long" value="<?php echo $lat_long; ?>">
			</td>
		</tr>
		
		<?php
	}
}

add_action( 'created_themetera_location', 'themetera_location_save_taxonomy_meta', 10, 2 );
add_action( 'edited_themetera_location', 'themetera_location_save_taxonomy_meta', 10, 2 );

if(!function_exists('themetera_location_save_taxonomy_meta'))
{
	function themetera_location_save_taxonomy_meta($term_id, $tag_id)
	{
		if( isset( $_POST['image'] ) ) {
			update_term_meta( $term_id, 'image', esc_attr( $_POST['image'] ) );
		}
		if( isset( $_POST['attachment_id'] ) ) {
			update_term_meta( $term_id, 'attachment_id', esc_attr( $_POST['attachment_id'] ) );
		}
		if( isset( $_POST['zip'] ) ) {
			update_term_meta( $term_id, 'zip', esc_attr( $_POST['zip'] ) );
		}
		if( isset( $_POST['latitude'] ) ) {
			update_term_meta( $term_id, 'latitude', esc_attr( $_POST['latitude'] ) );
		}
		if( isset( $_POST['longitude'] ) ) {
			update_term_meta( $term_id, 'longitude', esc_attr( $_POST['longitude'] ) );
		}
		if( isset( $_POST['lat_long'] ) ) {
			update_term_meta( $term_id, 'lat_long', esc_attr( $_POST['lat_long'] ) );
		}
	}
}
