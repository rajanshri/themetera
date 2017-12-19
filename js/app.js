/* 
    Theme Name: MapWp    
    Author: Webinsane
    Developer: WeAreDevelopers
    Version: 1.0
    Author URI: https://www.WeAreDevelopers.in
*/

(function($){

	var window_height = $(window).height();

	jQuery(document).ready(function($){
		initbanner();
		jQuery('header nav').meanmenu();

		$('.datepicker').datepicker({
	        format: 'dd/M',
	    	startDate: '+1d',
	    	// endDate: '+7d',
	        multidate: 2,
	        orientation: 'top auto'
    	});
		
		var today = new Date();
		var tomorrow = new Date(today.getTime() + (24 * 60 * 60 * 1000));
		var search_start_picker = $('#search_start_date').pickadate({
			editable: false
			,format:'dd/mm/yyyy'
			,min: tomorrow
			//,disable: reserved_dates
			,onSet: function(date) {
				//$('#booking_check_out').pickadate('picker').set('min', new Date(date.select + (24 * 60 * 60 * 1000)));			
			}
		});
		var search_end_picker = $('#search_end_date').pickadate({
			editable: false
			,format:'dd/mm/yyyy'
			,min: tomorrow
			//,disable: reserved_dates
			,onSet: function(date) {
				//$('#booking_check_out').pickadate('picker').set('min', new Date(date.select + (24 * 60 * 60 * 1000)));			
			}
		});
		

    	$(".range").slider({
			slide: function(event, ui) {
                 // update(2,ui.value); //changed
				 console.log(ui.value);
              }
		});

    	$('.menu-main nav > ul > li').hover(function(){
    		$(this).find('.sublist').toggle();
    		$(this).toggleClass('active');
    	});

    	$('.all-stype-base').click(function(){
    		$(this).parent().find('ul').slideToggle();
    		$(this).parent().toggleClass('active');
    	})

    	$('.bar').click(function(){
    		$('#search-filterxs').slideDown();
    		$('body').addClass('hidden-body');
    	});

    	$('.filter-close').click(function(){
    		$('.filterxs').slideUp();
    		$('body').removeClass('hidden-body');
    	});

    	$('.desktop-book-hide').click(function(){
    		$('#booknow-filterxs').slideDown();
    		$('body').addClass('hidden-body');
    	});

    	$('.slider-single').slick({
    		autoplay: true,
  			autoplaySpeed: 2000,
  			adaptiveHeight: true,
  			infinite: true,
  			arrows: true,
  			dots: false,
    	});

        if ($('.rent-wrap').length > 0) { 
            $('.deto-col-right .sidebar-right').scrollToFixed({
            marginTop: $('.header-part').outerHeight(true) + 10,
            limit : $('.rent-wrap').offset().top - $('.deto-col-right .sidebar-right').outerHeight(true) - 10,
            });
        }

        $('.desktop-book-hide').scrollToFixed( {
            bottom: 0,
            limit: $('.footer-part').offset().top - 50,
        });

        var header_space = $('.header-part').outerHeight();
        $('.main-part').css('padding-top',header_space);

        checkWidth();

        $('.list-map-common').on('click',function(){
            if($(this).data('id')=="search-list"){
                $("#search-list").addClass('open');
                $('.list-show').removeClass('open');

                $('.map-show').addClass('open');
                $('#search-map').removeClass('open');
            }else{
                $("#search-list").removeClass('open');
                $('.list-show').addClass('open');

                $('.map-show').removeClass('open');
                $('#search-map').addClass('open');

                setTimeout(function(){
                    $(window).trigger('resize');
                },1000);
            }
        });
	});

	$(window).load(function(){
		equalheight('.rent-list');
		initfixheader();

        if($(".filter-pack").length){
            var $container = $('.filter-blog');
            $container.isotope({
                layoutMode: 'packery',
                itemSelector: '.msrItem',
                packery: {
                  
                },
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false                
                }
            });
     
            $('.filter-tab a').click(function(){
                $('.filter-tab .current').removeClass('current');
                $(this).addClass('current');
         
                var selector = $(this).attr('data-filter');
                $container.isotope({
                    layoutMode: 'packery',
                    itemSelector: '.msrItem',
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false                    
                    }
                });
                return false;
            });
        }
	});

	$(window).resize(function(){
		initbanner();
		equalheight('.rent-list');
		var header_space = $('.header-part').outerHeight();
        $('.main-part').css('padding-top',header_space);
        checkWidth();
	});

    function checkWidth() {
        var $window = $(window);
        var windowsize = $window.width();
        var widnow_outerheight = $(window).height() - 60;
        if (windowsize < 768) {
            $('.search-right-col').css('height',widnow_outerheight);
        }
    }

	function initbanner(){
		$('.bg-banner').each(function () {
	        var background = $(this).data('background');
	        $(this).css('background-image', 'url("' + background + '")');
	    });

	    $('.home-banner').each(function () {
	        var background = $(this).data('background');
	        $(this).css('background-image', 'url("' + background + '")');
	    });

	    var header_height = $('.header-part').outerHeight();
	    $('.home-banner').height(window_height - header_height);
	}
	
	
	$('.search-list-wrap').infiniteLoad({
			'navSelector':'.loadmore-pagination',
			'contentSelector':'.search-list-wrap',
			'nextSelector':'.loadmore-pagination .next.page-numbers',
			'itemSelector':'.themetera_property',
			'loadingImage':themetera.themeurl+'/images/load.png',
			//'loadingFinishedText':pix_infiniteload.loadingFinishedText,
		});
	

})(jQuery);

/* Equal height div for dynamic generated by js */

equalheight = function(container){

var currentTallest = 0,
    currentRowStart = 0,
    rowDivs = new Array(),
    $el,
    topPosition = 0;
 	jQuery(container).each(function() {
	   $el = jQuery(this);
	   jQuery($el).height('auto')
	   topPostion = $el.position().top;

	   if (currentRowStart != topPostion) {
	     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
	       rowDivs[currentDiv].height(currentTallest);
	     }
	     rowDivs.length = 0; // empty the array
	     currentRowStart = topPostion;
	     currentTallest = $el.height();
	     rowDivs.push($el);
	   } else {
	     rowDivs.push($el);
	     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
	  }
	   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
	     rowDivs[currentDiv].height(currentTallest);
	   }
	 });
}

jQuery(window).scroll(function(){
	initfixheader();	
});

function initfixheader(){
	var header_fix = jQuery('.header-part').outerHeight();

    if (jQuery(window).scrollTop() >= header_fix) {
       jQuery('.header-part').addClass('fixed-header');
    }
    else {
       jQuery ('.header-part').removeClass('fixed-header');
    }
}