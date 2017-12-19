<?php
if(!function_exists('themetera_get_post_categories')){
	
	function themetera_get_post_categories($post,$taxonomy='category',$args=array('fields'=>'all')) {
		$categories=wp_get_post_terms($post,$taxonomy, $args);
		return $categories;
	}
}

if(!function_exists('themetera_get_post_single_category')){
	
	function themetera_get_post_single_category($post,$taxonomy='category',$arg=array('fields'=>'all')) {
		$categories=themetera_get_post_categories($post,$taxonomy, $args);
		if(!empty($categories[0]))
			return $categories[0];
		else 
			return false;
	}
}

if(!function_exists('themetera_get_post_categories_string')){
	
	function themetera_get_post_categories_string($post,$taxonomy='category',$args=array('fields'=>'all')) {
		$output=false;
		$categories=themetera_get_post_categories ($post,$taxonomy, $args);
		
		if(!empty($categories) && !is_wp_error($categories))
		{
			foreach($categories as $category){
				$output.='<a href="'.get_term_link($category->term_id).'">'.$category->name.'</a>,';
			}
			$output=trim($output,',');
		}
		return $output;
	}
}

if(!class_exists('Themetera_Walker_Comment')){
	
	class Themetera_Walker_Comment extends Walker_Comment {
		var $tree_type = 'comment';
		var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' ); 
		
		// start_el – HTML for comment template
		function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
			$depth++;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			?>

			<div <?php comment_class('review-comment-list') ?> id="comment-<?php comment_ID() ?>">
					
				<div class="review-comment-img">
							<?php echo get_avatar( $comment, 38, 'mystery', 'User' ); ?>
						</div>
						<div class="review-comment-content">
							<div class="star-grp">
								<i class="star-big"></i>
								<i class="star-big"></i>
								<i class="star-big star-inactive"></i>
								<i class="star-big star-inactive"></i>
								<i class="star-big star-inactive"></i>
							</div>
							<span><a href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a></span>
							<i><?php comment_date(); ?></i>
							<?php if ($comment->comment_approved == '0') { ?>
							<p class="comment-meta-item"><?php _e('Your comment is awaiting moderation.','themetera');?></p>
							<?php } ?>
							<p><?php comment_text() ?></p>
							<p><?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
						</div>

		<?php }

		// end_el – closing HTML for comment template
		function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

			</div>

		<?php }
		

	}
}

if(!function_exists('themetera_currency_list')){
	
	function themetera_currency_list(){
		
		$currencies=array (
            'ALL' => 'Albania Lek',
            'AFN' => 'Afghanistan Afghani',
            'ARS' => 'Argentina Peso',
            'AWG' => 'Aruba Guilder',
            'AUD' => 'Australia Dollar',
            'AZN' => 'Azerbaijan New Manat',
            'BSD' => 'Bahamas Dollar',
            'BBD' => 'Barbados Dollar',
            'BDT' => 'Bangladeshi taka',
            'BYR' => 'Belarus Ruble',
            'BZD' => 'Belize Dollar',
            'BMD' => 'Bermuda Dollar',
            'BOB' => 'Bolivia Boliviano',
            'BAM' => 'Bosnia and Herzegovina Convertible Marka',
            'BWP' => 'Botswana Pula',
            'BGN' => 'Bulgaria Lev',
            'BRL' => 'Brazil Real',
            'BND' => 'Brunei Darussalam Dollar',
            'KHR' => 'Cambodia Riel',
            'CAD' => 'Canada Dollar',
            'KYD' => 'Cayman Islands Dollar',
            'CLP' => 'Chile Peso',
            'CNY' => 'China Yuan Renminbi',
            'COP' => 'Colombia Peso',
            'CRC' => 'Costa Rica Colon',
            'HRK' => 'Croatia Kuna',
            'CUP' => 'Cuba Peso',
            'CZK' => 'Czech Republic Koruna',
            'DKK' => 'Denmark Krone',
            'DOP' => 'Dominican Republic Peso',
            'XCD' => 'East Caribbean Dollar',
            'EGP' => 'Egypt Pound',
            'SVC' => 'El Salvador Colon',
            'EEK' => 'Estonia Kroon',
            'EUR' => 'Euro Member Countries',
            'FKP' => 'Falkland Islands (Malvinas) Pound',
            'FJD' => 'Fiji Dollar',
            'GHC' => 'Ghana Cedis',
            'GIP' => 'Gibraltar Pound',
            'GTQ' => 'Guatemala Quetzal',
            'GGP' => 'Guernsey Pound',
            'GYD' => 'Guyana Dollar',
            'HNL' => 'Honduras Lempira',
            'HKD' => 'Hong Kong Dollar',
            'HUF' => 'Hungary Forint',
            'ISK' => 'Iceland Krona',
            'INR' => 'India Rupee',
            'IDR' => 'Indonesia Rupiah',
            'IRR' => 'Iran Rial',
            'IMP' => 'Isle of Man Pound',
            'ILS' => 'Israel Shekel',
            'JMD' => 'Jamaica Dollar',
            'JPY' => 'Japan Yen',
            'JEP' => 'Jersey Pound',
            'KZT' => 'Kazakhstan Tenge',
            'KPW' => 'Korea (North) Won',
            'KRW' => 'Korea (South) Won',
            'KGS' => 'Kyrgyzstan Som',
            'LAK' => 'Laos Kip',
            'LVL' => 'Latvia Lat',
            'LBP' => 'Lebanon Pound',
            'LRD' => 'Liberia Dollar',
            'LTL' => 'Lithuania Litas',
            'MKD' => 'Macedonia Denar',
            'MYR' => 'Malaysia Ringgit',
            'MUR' => 'Mauritius Rupee',
            'MXN' => 'Mexico Peso',
            'MNT' => 'Mongolia Tughrik',
            'MZN' => 'Mozambique Metical',
            'NAD' => 'Namibia Dollar',
            'NPR' => 'Nepal Rupee',
            'ANG' => 'Netherlands Antilles Guilder',
            'NZD' => 'New Zealand Dollar',
            'NIO' => 'Nicaragua Cordoba',
            'NGN' => 'Nigeria Naira',
            'NOK' => 'Norway Krone',
            'OMR' => 'Oman Rial',
            'PKR' => 'Pakistan Rupee',
            'PAB' => 'Panama Balboa',
            'PYG' => 'Paraguay Guarani',
            'PEN' => 'Peru Nuevo Sol',
            'PHP' => 'Philippines Peso',
            'PLN' => 'Poland Zloty',
            'QAR' => 'Qatar Riyal',
            'RON' => 'Romania New Leu',
            'RUB' => 'Russia Ruble',
            'SHP' => 'Saint Helena Pound',
            'SAR' => 'Saudi Arabia Riyal',
            'RSD' => 'Serbia Dinar',
            'SCR' => 'Seychelles Rupee',
            'SGD' => 'Singapore Dollar',
            'SBD' => 'Solomon Islands Dollar',
            'SOS' => 'Somalia Shilling',
            'ZAR' => 'South Africa Rand',
            'LKR' => 'Sri Lanka Rupee',
            'SEK' => 'Sweden Krona',
            'CHF' => 'Switzerland Franc',
            'SRD' => 'Suriname Dollar',
            'SYP' => 'Syria Pound',
            'TWD' => 'Taiwan New Dollar',
            'THB' => 'Thailand Baht',
            'TTD' => 'Trinidad and Tobago Dollar',
            'TRY' => 'Turkey Lira',
            'TRL' => 'Turkey Lira',
            'TVD' => 'Tuvalu Dollar',
            'UAH' => 'Ukraine Hryvna',
            'GBP' => 'United Kingdom Pound',
            'USD' => 'United States Dollar',
            'UYU' => 'Uruguay Peso',
            'UZS' => 'Uzbekistan Som',
            'VEF' => 'Venezuela Bolivar',
            'VND' => 'Viet Nam Dong',
            'YER' => 'Yemen Rial',
            'ZWD' => 'Zimbabwe Dollar'
        );
		
		return $currencies;
		
	}
}

if(!function_exists('themetera_currency_symbol_list')){
	
	function themetera_currency_symbol_list(){
		
		$currency_symbols = array(
				'AED' => '&#1583;.&#1573;', // ?
				'AFN' => '&#65;&#102;',
				'ALL' => '&#76;&#101;&#107;',
				'AMD' => '',
				'ANG' => '&#402;',
				'AOA' => '&#75;&#122;', // ?
				'ARS' => '&#36;',
				'AUD' => '&#36;',
				'AWG' => '&#402;',
				'AZN' => '&#1084;&#1072;&#1085;',
				'BAM' => '&#75;&#77;',
				'BBD' => '&#36;',
				'BDT' => '&#2547;', // ?
				'BGN' => '&#1083;&#1074;',
				'BHD' => '.&#1583;.&#1576;', // ?
				'BIF' => '&#70;&#66;&#117;', // ?
				'BMD' => '&#36;',
				'BND' => '&#36;',
				'BOB' => '&#36;&#98;',
				'BRL' => '&#82;&#36;',
				'BSD' => '&#36;',
				'BTN' => '&#78;&#117;&#46;', // ?
				'BWP' => '&#80;',
				'BYR' => '&#112;&#46;',
				'BZD' => '&#66;&#90;&#36;',
				'CAD' => '&#36;',
				'CDF' => '&#70;&#67;',
				'CHF' => '&#67;&#72;&#70;',
				'CLF' => '', // ?
				'CLP' => '&#36;',
				'CNY' => '&#165;',
				'COP' => '&#36;',
				'CRC' => '&#8353;',
				'CUP' => '&#8396;',
				'CVE' => '&#36;', // ?
				'CZK' => '&#75;&#269;',
				'DJF' => '&#70;&#100;&#106;', // ?
				'DKK' => '&#107;&#114;',
				'DOP' => '&#82;&#68;&#36;',
				'DZD' => '&#1583;&#1580;', // ?
				'EGP' => '&#163;',
				'ETB' => '&#66;&#114;',
				'EUR' => '&#8364;',
				'FJD' => '&#36;',
				'FKP' => '&#163;',
				'GBP' => '&#163;',
				'GEL' => '&#4314;', // ?
				'GHS' => '&#162;',
				'GIP' => '&#163;',
				'GMD' => '&#68;', // ?
				'GNF' => '&#70;&#71;', // ?
				'GTQ' => '&#81;',
				'GYD' => '&#36;',
				'HKD' => '&#36;',
				'HNL' => '&#76;',
				'HRK' => '&#107;&#110;',
				'HTG' => '&#71;', // ?
				'HUF' => '&#70;&#116;',
				'IDR' => '&#82;&#112;',
				'ILS' => '&#8362;',
				'INR' => '&#8377;',
				'IQD' => '&#1593;.&#1583;', // ?
				'IRR' => '&#65020;',
				'ISK' => '&#107;&#114;',
				'JEP' => '&#163;',
				'JMD' => '&#74;&#36;',
				'JOD' => '&#74;&#68;', // ?
				'JPY' => '&#165;',
				'KES' => '&#75;&#83;&#104;', // ?
				'KGS' => '&#1083;&#1074;',
				'KHR' => '&#6107;',
				'KMF' => '&#67;&#70;', // ?
				'KPW' => '&#8361;',
				'KRW' => '&#8361;',
				'KWD' => '&#1583;.&#1603;', // ?
				'KYD' => '&#36;',
				'KZT' => '&#1083;&#1074;',
				'LAK' => '&#8365;',
				'LBP' => '&#163;',
				'LKR' => '&#8360;',
				'LRD' => '&#36;',
				'LSL' => '&#76;', // ?
				'LTL' => '&#76;&#116;',
				'LVL' => '&#76;&#115;',
				'LYD' => '&#1604;.&#1583;', // ?
				'MAD' => '&#1583;.&#1605;.', //?
				'MDL' => '&#76;',
				'MGA' => '&#65;&#114;', // ?
				'MKD' => '&#1076;&#1077;&#1085;',
				'MMK' => '&#75;',
				'MNT' => '&#8366;',
				'MOP' => '&#77;&#79;&#80;&#36;', // ?
				'MRO' => '&#85;&#77;', // ?
				'MUR' => '&#8360;', // ?
				'MVR' => '.&#1923;', // ?
				'MWK' => '&#77;&#75;',
				'MXN' => '&#36;',
				'MYR' => '&#82;&#77;',
				'MZN' => '&#77;&#84;',
				'NAD' => '&#36;',
				'NGN' => '&#8358;',
				'NIO' => '&#67;&#36;',
				'NOK' => '&#107;&#114;',
				'NPR' => '&#8360;',
				'NZD' => '&#36;',
				'OMR' => '&#65020;',
				'PAB' => '&#66;&#47;&#46;',
				'PEN' => '&#83;&#47;&#46;',
				'PGK' => '&#75;', // ?
				'PHP' => '&#8369;',
				'PKR' => '&#8360;',
				'PLN' => '&#122;&#322;',
				'PYG' => '&#71;&#115;',
				'QAR' => '&#65020;',
				'RON' => '&#108;&#101;&#105;',
				'RSD' => '&#1044;&#1080;&#1085;&#46;',
				'RUB' => '&#1088;&#1091;&#1073;',
				'RWF' => '&#1585;.&#1587;',
				'SAR' => '&#65020;',
				'SBD' => '&#36;',
				'SCR' => '&#8360;',
				'SDG' => '&#163;', // ?
				'SEK' => '&#107;&#114;',
				'SGD' => '&#36;',
				'SHP' => '&#163;',
				'SLL' => '&#76;&#101;', // ?
				'SOS' => '&#83;',
				'SRD' => '&#36;',
				'STD' => '&#68;&#98;', // ?
				'SVC' => '&#36;',
				'SYP' => '&#163;',
				'SZL' => '&#76;', // ?
				'THB' => '&#3647;',
				'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
				'TMT' => '&#109;',
				'TND' => '&#1583;.&#1578;',
				'TOP' => '&#84;&#36;',
				'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
				'TTD' => '&#36;',
				'TWD' => '&#78;&#84;&#36;',
				'TZS' => '',
				'UAH' => '&#8372;',
				'UGX' => '&#85;&#83;&#104;',
				'USD' => '&#36;',
				'UYU' => '&#36;&#85;',
				'UZS' => '&#1083;&#1074;',
				'VEF' => '&#66;&#115;',
				'VND' => '&#8363;',
				'VUV' => '&#86;&#84;',
				'WST' => '&#87;&#83;&#36;',
				'XAF' => '&#70;&#67;&#70;&#65;',
				'XCD' => '&#36;',
				'XDR' => '',
				'XOF' => '',
				'XPF' => '&#70;',
				'YER' => '&#65020;',
				'ZAR' => '&#82;',
				'ZMK' => '&#90;&#75;', // ?
				'ZWL' => '&#90;&#36;',
			);
		
		return $currency_symbols;
		
	}
}


if(!function_exists('themetera_property_details_breadcrumb')){
	
	function themetera_property_details_breadcrumb(){
		global $post;
		$output='';
		
		$bedrooms=get_post_meta($post->ID,'_bedrooms',true);
		$bedrooms=!empty($bedrooms)?$bedrooms:0;
		$output.=sprintf(_n( '%d bedroom ', '%d bedrooms ', $bedrooms, 'themetera' ), $bedrooms );
		$types = wp_get_post_terms($post->ID,'themetera_type' ); 
		if(!empty($types[0]))
			$output.=sprintf(__('%s in ','themetera'),$types[0]->name);
	
		$locations=wp_get_post_terms($post->ID,'themetera_location', $args );
		if(!empty($locations[0]))
		{
			$output.='<a href="'.get_term_link($locations[0]->term_id).'">'.$locations[0]->name.'</a>'; 
			$ancestors = get_ancestors( $locations[0]->term_id, 'themetera_location', 'taxonomy' );
			if(!empty($ancestors)){
				$output.='<i class="arrow-right-grey"></i>';
				$i=1;
				foreach($ancestors as $ancestor)
				{
					$parent_location=get_term($ancestor,'themetera_location');
					
					$output.='<a href="'.get_term_link($parent_location->term_id).'">'.$parent_location->name.'</a>'; 
					if($i<count($ancestors))
						$output.='<i class="arrow-right-grey"></i>';
					$i++;
				}
			
				
			}
		}
	
		
		return $output;
		
	}
}

if(!function_exists('themetera_property_gallery')){
	
	function themetera_property_gallery(){
		global $post;
		$output='';
		
		$images=get_post_meta($post->ID,'_images',true);
		
		if(has_post_thumbnail()){
			$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
			$images[$post_thumbnail_id]=wp_get_attachment_url( $post_thumbnail_id );
			
		}
	$formatted_price=themetera_property_formatted_price($post->ID);
	
	if(!empty($images)){
		
		$output.='<div class="detail-slider">
					<div class="slider-single slider">';
					foreach($images as $key=>$image){
						$output.='<div class="slider-single-item">
							<img src="'.$image.'" alt="">
							<div class="slider-label">
								<span> '.($formatted_price).'</span>
							</div>
						</div>';
					}						
		$output.='</div>
					<div class="expand-part">
						<i class="expand-icon"></i>
					</div>
				</div>';
	}
		
		return $output;
		
	}
}

if(!function_exists('themetera_property_coordinate')){
	
	function themetera_property_coordinate($id){
		
		$output=array('latitude'=>false,'longitude'=>false,'zoom'=>10);
		
		$lat_long_zoom=get_post_meta($id,'lat_long',true);
		$lat_long_zoom_arr=explode(';',$lat_long_zoom);
		
		if(!empty($lat_long_zoom_arr[1]))
			$output['zoom']=$lat_long_zoom_arr[1];
		if(!empty($lat_long_zoom_arr[0])){
			$lat_long_arr=explode(',',$lat_long_zoom_arr[0]);
			
			$output['latitude']=!empty($lat_long_arr[0])?$lat_long_arr[0]:false;
			$output['longitude']=!empty($lat_long_arr[1])?$lat_long_arr[1]:false;
		}
		
		return $output;
		
	}
}

if (!function_exists('themetera_property_formatted_price'))
{
	function themetera_property_formatted_price($id)
	{
		global $themetera;
		$output='';
		$amount=get_post_meta($id,'_price',true);
		$per=get_post_meta($id,'_per',true);
		$currency=$themetera['default_currency']; $decimals = 0;
		$amount = number_format($amount, $decimals, '.', ',');
		$currency_symbol_list=themetera_currency_symbol_list();
		$currency_symbol=$currency_symbol_list[$currency];		

		$ret = "<strong>$currency_symbol$amount</strong> per $per";

		return $ret;
	}
}

if (!function_exists('themetera_get_all_property'))
{
	function themetera_get_all_property(){
		
		$args=array(
				'posts_per_page'   => -1,
				'post_type'        => 'themetera_property',
				'post_status'      => 'publish',
				//'suppress_filters' => true 
			);
			
		return get_posts( $args );
	}
}

if (!function_exists('themetera_get_property_array'))
{
	function themetera_get_property_array(){		
			$property_array=array();
			$properties = themetera_get_all_property();
			
			if(!empty($properties))
			{
				foreach($properties as $property)
				$property_array[$property->ID]=$property->post_title;
			}
		return $property_array;
	}
}

if (!function_exists('themetera_get_date_difference'))
{
	function themetera_get_date_difference($start_date,$end_date){		
			//Convert them to timestamps.
			$date1Timestamp = strtotime($start_date);
			$date2Timestamp = strtotime($end_date);
			 
			//Calculate the difference.
			$difference = $date2Timestamp - $date1Timestamp;
		return $difference;
	}
}

add_action( 'wp_ajax_themetera_calculate_booking_cost', 'themetera_calculate_booking_cost' );
add_action( 'wp_ajax_nopriv_themetera_calculate_booking_cost', 'themetera_calculate_booking_cost' );
if(!function_exists('themetera_calculate_booking_cost'))
{
	function themetera_calculate_booking_cost()
	{
		global $themetera;
		
		$currency=$themetera['default_currency'];
		$currency_symbol_list=themetera_currency_symbol_list();
		$currency_symbol=$currency_symbol_list[$currency];
		
		$property_id        =   intval($_POST['property_id']);
        $booking_from_date  =   themetera_parse_datepicker_ts($_POST['fromdate']);
        $booking_to_date    =   themetera_parse_datepicker_ts($_POST['todate']);
		
		$price=get_post_meta($property_id,'_price',true);
		$max_occupants=get_post_meta($property_id,'_max_occupants',true);
		$min_booking_length=get_post_meta($property_id,'_min_booking_length',true);
		$cleaning_fee=get_post_meta($property_id,'_cleaning_fee',true);
		$refundable_deposit=get_post_meta($property_id,'_refundable_deposit',true);
		$reservation_fee=get_post_meta($property_id,'_markup',true);
		
		$output='';
		
		$diff=($booking_to_date-$booking_from_date)+1;
		$date_diff=ceil($diff/(60*60*24));
		
		$total_price=number_format($price*$date_diff, 2, '.', '');
		
		
		
		if($date_diff < $min_booking_length)
			$output=sprintf(__('You have to stay minimum %d nights','themetera'),$min_booking_length);
		else{
			$output='<table>
						<tbody>
							<tr>
								<td>'.$currency_symbol.$price.' x '.$date_diff.' nights</td>
								<td>'.$currency_symbol.$total_price.'</td>
							</tr>';
							if(!empty($cleaning_fee)){
							$output.='<tr>
								<td>'.__('Cleaning Fee','themetera').'</td>
								<td>'.$currency_symbol.$cleaning_fee.'</td>
							</tr>';
							}
							if(!empty($refundable_deposit)){
							$output.='<tr>
								<td>'.__('Refundable Deposit','themetera').'</td>
								<td>'.$currency_symbol.$refundable_deposit.'</td>
							</tr>';
							}
							if(!empty($reservation_fee)){
							$output.='<tr>
								<td>'.__('Reservation Fee','themetera').'</td>
								<td>'.$currency_symbol.$reservation_fee.'</td>
							</tr>';
							}
							
			$output.='</tbody>
					</table>
					<div class="guest-total">
						<table>
							<tbody>
								<tr>
									<td>'.__('Total','themetera').'</td>
									<td>'.$currency_symbol.($total_price+$cleaning_fee+$refundable_deposit+$reservation_fee).'</td>
								</tr>
							</tbody>
						</table>
					</div>';
		}
		
		
		echo $output;
		die;
	}
}

add_action( 'wp_ajax_themetera_save_booking', 'themetera_save_booking' );
add_action( 'wp_ajax_nopriv_themetera_save_booking', 'themetera_save_booking' );
if(!function_exists('themetera_save_booking'))
{
	function themetera_save_booking()
	{
		global $themetera;
		
		$currency=$themetera['default_currency'];
		$currency_symbol_list=themetera_currency_symbol_list();
		$currency_symbol=$currency_symbol_list[$currency];
	
		global $current_user;
        $user_id            =   $current_user->ID;
		$property_id        =   intval($_POST['property_id']);
        $booking_from_date  =   themetera_parse_datepicker_ts($_POST['fromdate']);
        $booking_to_date    =   themetera_parse_datepicker_ts($_POST['todate']);
		$guests		        =   intval($_POST['guests']);
		
		$price=get_post_meta($property_id,'_price',true);
		$max_occupants=get_post_meta($property_id,'_max_occupants',true);
		$min_booking_length=get_post_meta($property_id,'_min_booking_length',true);
		$cleaning_fee=get_post_meta($property_id,'_cleaning_fee',true);
		$refundable_deposit=get_post_meta($property_id,'_refundable_deposit',true);
		$reservation_fee=get_post_meta($property_id,'_markup',true);
		
		$output='';
		
		$diff=($booking_to_date-$booking_from_date)+1;
		$date_diff=ceil($diff/(60*60*24));
		
		$bookings=themetera_get_property_booking($property_id );
		
				
		$total_price=number_format($price*$date_diff, 2, '.', '');
		
		if(!is_user_logged_in())
			$output='<div class="error">'.__('Please login for booking','themetera').'</div>';
		else if($guests>$max_occupants)
			$output='<div class="error">'.__('Maximum guest limit is over','themetera').'</div>';
		else if($date_diff < $min_booking_length)
			$output='<div class="error">'.sprintf(__('You have to stay minimum %d nights','themetera'),$min_booking_length).'</div>';
		else if(in_array(date('Y-m-d',$booking_from_date),$bookings) || in_array(date('Y-m-d',$booking_to_date),$bookings))
			$output='<div class="error">'.__('Already booked','themetera').'</div>';
		else{
			$event_name         =   esc_html__( 'Booking Request','themetera');
			
			$post = array(
            'post_title'	=> $event_name,
            'post_status'	=> 'pending', 
            'post_type'         => 'themetera_booking' ,
            'post_author'       => $user_id
			);
			$post_id =  wp_insert_post($post );  
			
			$post = array(
				'ID'                => $post_id,
				'post_title'	=> $event_name.' '.$post_id
			);
			wp_update_post( $post );
			
			update_post_meta($post_id, '_property_id', $property_id);
			update_post_meta($post_id, '_checkin_date', date('Y-m-d',$booking_from_date));
			update_post_meta($post_id, '_checkout_date', date('Y-m-d',$booking_to_date));
			update_post_meta($post_id, '_booking_pay_ammount', $total_price);
			update_post_meta($post_id, '_guests', $guests);
			//update_post_meta($post_id, '_status', 0);
			
			$output.='<div class="right-top-tt">
							<span>'.$currency_symbol.$total_price.' <small>'.sprintf(__('subtotal for %d days.','themetera'),$date_diff).'</small></span>
						</div>
						<div class="side-title-bg">
							<span>'.$_POST['fromdate'].' - '.$_POST['todate'].'</span>
						</div>';
		}
		
		
		
		
		
		echo $output;
		die;
	}
}


if(!function_exists('themetera_get_property_booking'))
{
	function themetera_get_property_booking($property_id)
	{
		$booking_array=array();
		$bookings_query=new WP_Query(array('post_type'=>'themetera_booking','post_status'=>array('publish','pending'),'posts_per_page'=>-1,'meta_query'  => array(array('key'=> '_checkin_date','value'=> date("Y-m-d"),'compare' => '>=','type'=> 'DATE'),array('key'=> '_property_id','value'=> $property_id)) ));
		
		if ( $bookings_query->have_posts() ) {
			while ( $bookings_query->have_posts() ) {
				$bookings_query->the_post();				
				 $checkin_date=get_post_meta(get_the_ID(),'_checkin_date',true);
				 $checkout_date=get_post_meta(get_the_ID(),'_checkout_date',true);
				 $diff=themetera_get_date_difference($checkin_date,$checkout_date)+1;
				 $date_diff=$diff/(60*60*24);
				 for($i=0;$i<$date_diff;$i++)
				 {
					 $booking_array[]=date('Y-m-d', strtotime('+'.$i.' day', strtotime($checkin_date)));
				 }
			}				
			wp_reset_postdata();
		} 
		array_unique($booking_array);
		return $booking_array;
	}
}

if(!function_exists('themetera_get_booked_property_by_date'))
{
	function themetera_get_booked_property_by_date($start_date,$end_date)
	{
		$booking_args=array(
		'post_type'=>'themetera_booking',
		'post_status'=>array('publish','pending'),
		'posts_per_page'=>-1,
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => '_checkin_date',
				'value' => date('Y-m-d',$start_date),
				'compare' => '<=',         
                'type'    => 'DATE' 
			),
			array(
				'key' => '_checkout_date',
				'value' => date('Y-m-d',$end_date),
				'compare' => '>=',         
                'type'    => 'DATE'
			) 
		)
		);
		
		$booking_query=new wp_query($booking_args);
		$booking_array=array();
		if($booking_query->have_posts())
		{
			while ($booking_query->have_posts()): $booking_query->the_post(); 
				$booking_array[]=get_post_meta(get_the_ID(),'_property_id',true);
			endwhile;
			wp_reset_postdata();
			wp_reset_query();
			array_unique($booking_array);
		}
		return $booking_array;
	}
}

if (!function_exists('themetera_parse_datepicker'))
{
	function themetera_parse_datepicker($date, $split=null, $format=null)
	{
		if (empty($format))
			$format = 'dd/mm/yy';

		if (empty($split))
			$split = $format[2];

		$format_parts = explode($split, $format);
		$date_parts = explode($split, $date);

		$return = array();

		for ($i=0; $i<count($format_parts);$i++)
		{
			$part = trim($format_parts[$i]);

			if ($part == 'yy')
				$return['y'] = $date_parts[$i];
			else if ($part == 'dd')
				$return['d'] = $date_parts[$i];
			else if ($part == 'mm')
				$return['m'] = $date_parts[$i];
		}


		return $return;
	}
}

if (!function_exists(' '))
{
	function themetera_parse_datepicker_ts($date, $split=null, $format=null)
	{
		$date = themetera_parse_datepicker($date, $split, $format);
		return mktime(1,1,1,$date['m'],$date['d'],$date['y']);
	}
}

if( !function_exists('themetera_adv_search_link') ){
    function themetera_adv_search_link(){   
        $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'templates/advanced-search.php'
            ));

        if( $pages ){
            $adv_submit = esc_url ( get_permalink( $pages[0]->ID) );
        }else{
            $adv_submit='';
        }

        return $adv_submit;
    }
} // end

add_action('wp_footer','themetera_advanced_search_map',999);
if( !function_exists('themetera_advanced_search_map') ){
	
	function themetera_advanced_search_map()
	{
		if(is_singular())
		{
			global $post;
			$template=get_post_meta($post->ID,'_wp_page_template',true);
			if($template=='templates/advanced-search.php')
			{
				?>
				<script type="text/javascript">
				markers=jQuery.parseJSON(themeteraProperties.markerArray);
				if(markers!=null){
					var lat_long=markers[0].split(',');					
					var latLng = new google.maps.LatLng(lat_long[0], lat_long[1]);
					initializeMap(latLng,false,9);
				}
				jQuery.each(markers, function( index, value ) {
				  var lat_long=markers[index].split(',');					
				  var latLng = new google.maps.LatLng(lat_long[0], lat_long[1]);
				  addMarker(latLng);
				});
				</script>
				<?php
			}
		}
	}
}

?>