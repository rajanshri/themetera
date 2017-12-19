<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<?php global $themetera; ?>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?php bloginfo('name'); ?><?php wp_title('|', true, 'left'); ?></title>

    <?php wp_head();?>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body <?php body_class(); ?>>

    <div class="wrapper">

        <!-- Start Header -->

        <header>
            <div class="header-part">
                <div class="header-top">
                    <div class="header-top-left">
                        <div class="logo">
                            <a href="#"><img src="images/logo.png" alt=""></a>
                        </div>
						<form action="<?php echo themetera_adv_search_link(0); ?>">
                        <div class="destination">
                            <input type="text" name="location" placeholder="Choose your destination...">
                        </div>
                        <div class="destination-time">
                            <!--<input class="datepicker" type="text" name="txt" placeholder="28 July - 6 August">-->
							<input class="" id="search_start_date" type="text" name="start_date" placeholder="Start Date">
                        </div>
						<div class="destination-time">
                            <!--<input class="datepicker" type="text" name="txt" placeholder="28 July - 6 August">-->
							<input class="" id="search_end_date" type="text" name="end_date" placeholder="End Date">
                        </div>
						
						
						
                    </div>
                    <div class="header-top-right">
                        <div class="money-part">
                            <span>EUR</span>
                        </div>
                        <div class="like-part">
                            <span><i class="like"></i><sup>5</sup></span>
                        </div>
                        <div class="login-part">
                            <a href="#"><i class="user"></i>Login</a>
                        </div>
                    </div>
                    <a href="#" class="bar"></a>
                </div>
                <div class="header-bottom">
                    <div class="menu-main">
                        <nav>
                            <ul>
                                <li class="rent-tab">
                                    <!--<a href="#">Rent <i class="arrow-down"></i></a>
                                    <ul class="sublist">
                                        <li><a href="#">All listings</a></li>
                                        <li><a href="#">Rent</a></li>
                                        <li><a href="#">Buy</a></li>
                                    </ul>-->
									<select name="type">
										<option value="">All listings</option>
										<option value="rent">Rent</option>
										<option value="sale">Buy</option>
									</select>
                                </li>
                                <li class="search-li">
                                    <a href="#">Any price <i class="arrow-down"></i></a>
                                    <div class="sublist sublist-big">
										<?php
										global $wpdb;
										
										$min_price=$wpdb->get_var("SELECT min(cast(meta_value as unsigned)) FROM $wpdb->postmeta WHERE meta_key='_price'");
										$max_price=$wpdb->get_var("SELECT max(cast(meta_value as unsigned)) FROM $wpdb->postmeta WHERE meta_key='_price'");
										?>
                                        <span><?php echo $themetera['default_currency'],$min_price; ?> - <?php echo $themetera['default_currency'],$max_price; ?></span>
                                        <input class="range" name="price" data-slider-min="<?php echo $min_price; ?>" data-slider-max="<?php echo $max_price; ?>" data-slider-step="5" data-slider-value="[<?php echo $min_price; ?>,<?php echo $max_price; ?>]" type="text">
                                        <div class="range-diff">
                                            <strong class="range-left"><?php echo $themetera['default_currency'],$min_price; ?></strong><strong class="range-right"><?php echo $themetera['default_currency'],$max_price; ?></strong>
                                        </div>
										
                                    </div>
                                </li>
                                <li class="search-li">
                                    <!--<a href="#">Beds <i class="arrow-down"></i></a>
                                    <div class="sublist sublist-big">
                                        <div class="badroom-wrap">
                                            <div class="badroom-list">
                                                <div class="badroom-left">
                                                    <span>Beds</span>
                                                </div>
                                                <div class="badroom-right">
                                                    <a href="#" class="btn-minus btn-add">—</a>
                                                    <div class="value-disc">4</div>
                                                    <a href="#" class="btn-plus btn-add">+</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
									<?php
									$beds=$wpdb->get_var("SELECT max(cast(meta_value as unsigned)) FROM $wpdb->postmeta WHERE meta_key='_bedrooms'");
									?>
									<select name="bedrooms">
										<option value="">Bedrooms</option>
									   <?php for($i=1;$i<=$beds;$i++){ ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									   <?php } ?>
									</select>
                                </li>
                                <li class="search-li">
                                    <!--<a href="#">Bedrooms <i class="arrow-down"></i></a>
                                    <div class="sublist sublist-big">
                                        <div class="badroom-wrap">
                                            <div class="badroom-list">
                                                <div class="badroom-left">
                                                    <span>Bedrooms</span>
                                                </div>
                                                <div class="badroom-right">
                                                    <a href="#" class="btn-minus btn-add">—</a>
                                                    <div class="value-disc">4</div>
                                                    <a href="#" class="btn-plus btn-add">+</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
									<?php
									$baths=$wpdb->get_var("SELECT max(cast(meta_value as unsigned)) FROM $wpdb->postmeta WHERE meta_key='_bathrooms'");
									?>
									<select name="bathrooms">
										<option value="">Bathrooms</option>
									   <?php for($i=1;$i<=$baths;$i++){ ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									   <?php } ?>
									</select>
                                </li>
                                <li class="search-li">
                                    <!--<a href="#">Type <i class="arrow-down"></i></a>
                                    <ul class="sublist">
                                        <li><a href="#">House</a></li>
                                        <li><a href="#">Apartment</a></li>
                                        <li><a href="#">Villa with pool</a></li>
                                        <li><a href="#">Cabin</a></li>
                                        <li><a href="#">Studio</a></li>
                                        <li><a href="#">Villa</a></li>
                                        <li><a href="#">Beach House</a></li>
                                    </ul>-->
									<?php
									$property_types = get_terms( 'themetera_type', array(
										'hide_empty' => false,
									) );
									?>
									<select name="property_type">
										<option value="">Type</option>
									   <?php foreach($property_types as $type){ ?>
										<option value="<?php echo $type->term_id; ?>"><?php echo $type->name; ?></option>
									   <?php } ?>
									</select>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="urgent-book"><input type="submit"><!--<a href="#"><i class="icon-book"></i>Instant book</a>--></div>
                </div>
                <div id="search-filterxs" class="filterxs">
                    <div class="filterxs-header">
                        <div class="clear-all">
                            <a href="#">Clear all</a>
                        </div>
                        <div class="filter-close">
                            <i class="arrow-up"></i>
                        </div>
                    </div>
                    <div class="filterxs-body">
                        <div class="destination">
                            <input name="txt" placeholder="Choose your destination..." type="text">
                        </div>
                        <div class="destination-time">
                            <input class="datepicker" name="txt" placeholder="28 July - 6 August" type="text">
                        </div>
                        <div class="guest">
                            <input placeholder="Guests" type="text">
                        </div>
                        <div class="all-stype">
                            <div class="all-stype-base"><span>All types</span><i class="arrow-down"></i></div>
                            <ul>
                                <li><a href="#">House</a></li>
                                <li><a href="#">Apartment</a></li>
                                <li><a href="#">Villa with pool</a></li>
                                <li><a href="#">Cabin</a></li>
                                <li><a href="#">Studio</a></li>
                                <li><a href="#">Villa</a></li>
                                <li><a href="#">Beach House</a></li>
                            </ul>
                        </div>
                        <div class="price-range">
                            <span>Price range</span>
                            <input class="range" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]" type="text">
                            <div class="range-diff">
                                <strong class="range-left">$67</strong><strong class="range-right">$3598</strong>
                            </div>
                        </div>
                        <div class="badroom-wrap">
                            <div class="badroom-list">
                                <div class="badroom-left">
                                    <span>Bedrooms</span>
                                </div>
                                <div class="badroom-right">
                                    <a href="#" class="btn-minus btn-add">—</a>
                                    <div class="value-disc">2</div>
                                    <a href="#" class="btn-plus btn-add">+</a>
                                </div>
                            </div>
                            <div class="badroom-list">
                                <div class="badroom-left">
                                    <span>Beds</span>
                                </div>
                                <div class="badroom-right">
                                    <a href="#" class="btn-minus btn-add">—</a>
                                    <div class="value-disc">4</div>
                                    <a href="#" class="btn-plus btn-add">+</a>
                                </div>
                            </div>
                            <div class="badroom-list">
                                <div class="badroom-left">
                                    <span>Bedrooms</span>
                                </div>
                                <div class="badroom-right">
                                    <a href="#" class="btn-minus btn-add">—</a>
                                    <div class="value-disc">0</div>
                                    <a href="#" class="btn-plus btn-add">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="amen-wrap">
                            <div class="amen-left">
                                <span>Amenities</span>
                            </div>
                            <div class="amen-right">
                                <a href="#">See all <i class="arrow-blue"></i></a>
                            </div>
                        </div>
                    </div>
					</form>
                    <div class="filterxs-footer">
                        <button class="btn-update">Update filters</button>
                    </div>
                </div>
            </div>
        </header>

        <!-- End Header -->