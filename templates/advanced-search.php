<?php
/*
Template Name:Advanvanced Search
*/
?>

<?php get_header(); ?>

<?php
$location=$start_date=$end_date=$type=$min_price=$max_price=$bedrooms=$bathrooms=$property_type='';
if(!empty($_GET['location']))
	$location=sanitize_title($_GET['location']);
if(!empty($_GET['start_date']))
	$start_date=$_GET['start_date'];
if(!empty($_GET['end_date']))
	$end_date=$_GET['end_date'];
if(!empty($_GET['type']))
	$type=$_GET['type'];
if(!empty($_GET['price'])){
	$price=explode($_GET['price']);
	$min_price=$price[0];
	$max_price=$price[1];
}
if(!empty($_GET['bedrooms']))
	$bedrooms=$_GET['bedrooms'];
if(!empty($_GET['bathrooms']))
	$bathrooms=$_GET['bathrooms'];
if(!empty($_GET['property_type']))
	$property_type=$_GET['property_type'];

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args=array('post_type'=>'themetera_property','post_status'=>'publish','posts_per_page'=>-1,'paged'=>$paged);
$tax_query=array('relation'=>'AND');
if(!empty($location)){
	$tax_query[]=array(
			'taxonomy' => 'themetera_location',
			'field'    => 'slug',
			'terms'    => $location,
		);	
}
if(!empty($property_type)){
	$tax_query[]=array(
			'taxonomy' => 'themetera_type',
			'field'    => 'term_id',
			'terms'    => $property_type,
		);	
}
$args['tax_query']= $tax_query;

$meta_query=array('relation'=>'AND');
if(!empty($type))
{
	$meta_query[]=array(
			'key'     => '_type',
			'value'   => $type,
			'compare' => '=',
		);
}
if(!empty($min_price) && !empty($max_price))
{
	$meta_query[]=array(
			'key'     => '_price',
			'value'   => $min_price,
			'compare' => '>=',
		);
	$meta_query[]=array(
			'key'     => '_price',
			'value'   => $min_price,
			'compare' => '<=',
		);
}
if(!empty($bedrooms))
{
	$meta_query[]=array(
			'key'     => '_bedrooms',
			'value'   => $bedrooms,
			'compare' => '=',
		);
}
if(!empty($bathrooms))
{
	$meta_query[]=array(
			'key'     => '_bathrooms',
			'value'   => $bathrooms,
			'compare' => '=',
		);
}


$args['meta_query']=$meta_query;

//Booking query
if(!empty($start_date) && !empty($end_date))
{
	
	$start_date=themetera_parse_datepicker_ts($start_date);
	$end_date=themetera_parse_datepicker_ts($end_date);
	
	//get booked properties by date
	$reserved=themetera_get_booked_property_by_date($start_date,$end_date);
	
	//set main query arg
	$args['post__not_in']=$reserved;
	
}

//Run query to get all the properties to show in map
$search_query=new wp_query($args);
$marker_array=array();
if($search_query->have_posts()){
	while ( $search_query->have_posts() ) { $search_query->the_post();		 
		$coorinate=get_post_meta(get_the_ID(),'lat_long',true);
		$coorinate=explode(';',$coorinate);
		if(!empty($coorinate[0]))
		$marker_array[]=$coorinate[0];
		}
	wp_reset_postdata();
	wp_reset_query();
}

//Run search query again for property limit and pagination
$args['posts_per_page']=3;
?>

 <main>
	<div class="main-part">
		<section class="rent-property search-outer">
			<?php while ( have_posts() ) { the_post(); ?>
			
			<?php 
			$temp_query = $wp_query;
			$wp_query=$search_query=new WP_Query($args);
			?>
			<div id="search-list" class="col-md-8 col-sm-8 col-xs-12 search-left-col search-wrapper">
				<?php if($search_query->have_posts()){ ?>
				<div class="search-left">
					<div class="rent-title">
						<div class="rent-title-left">
							<span><?php echo $search_query->found_posts; ?> Properties for rent and sale</span>
						</div>
						<div class="rent-title-right">
							<span><i class="icon-sort"></i>Newest</span>
						</div>
					</div>
					<div class="rent-wrap">
						<div class="row search-list-wrap">
							<?php 
							
							while ( $search_query->have_posts() ) { $search_query->the_post();?>
								
								<?php get_template_part('property','loop'); ?>							
							
							<?php } ?>
							
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								
								<div class="loading-wrap">
									<div class="loadmore-pagination"><?php echo paginate_links(); ?></div>
									<!--<a href="#" class="loading"><i class="load-img"></i>Loading 9 of 367</a>-->
								</div>
							 </div>
						</div>
						<?php wp_reset_postdata();wp_reset_query();?>
					</div>
				</div>
			<?php } 
			$wp_query=$temp_query;
			?>
			</div>
			<div id="map_canvas" class="col-md-4 col-sm-4 col-xs-12 search-right-col open search-wrapper">
				<!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d181140.11997830836!2d20.28251356769907!3d44.815159728600605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7aa3d7b53fbd%3A0x1db8645cf2177ee4!2sBelgrade%2C+Serbia!5e0!3m2!1sen!2sin!4v1507115561921" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
			</div>
			<div class="search-map-btn">
				<div class="list-show list-map-common open" data-id="search-list"><i class="icon-theme icon-list"></i>List</div>
				<div class="map-show list-map-common" data-id="search-map"><i class="icon-theme icon-map"></i>Map</div>
			</div>
			<?php 
			wp_localize_script( 'themetera-cs-map','themeteraProperties',array(
			'markerArray'=>json_encode($marker_array)
			) );
			} ?>
		</section>
	</div>
</main>



<?php get_footer(); ?>