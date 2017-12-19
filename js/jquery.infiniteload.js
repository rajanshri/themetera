(function ( $,window, document ) {
 
    $.fn.infiniteLoad = function(options) {
		
         var settings = $.extend({   
			navSelector: '', //Navigation selector/Pagination selector e.g. "nav.navigation"
            contentSelector: '',//Main content element selector e.g. #main
            nextSelector: '',//Navigation next element selector e.g. nav.navigation a.next
			itemSelector: '',//Item container element in loop e.g. article.post
			loadingImage:'',//Loading image url.Default null
			loadingFinishedText: 'No More Posts Available',//Text to show when loading is finished.Default "No More Posts Available"
        }, options );
		
		var loading=false;
		var loaded=false;
		var url=false;
		var infiniteHtml='';
		var moreHtml='';
		
		// Iterate and reformat each matched element.
		return this.each(function() {
	 
			var _init=function()
			{
				//check if all the elements given are correct
				if($(settings.navSelector).length && $(settings.contentSelector).length && $(settings.nextSelector).length && $(settings.itemSelector).length)
				{				
					url=$(settings.nextSelector).attr( 'href' );
					_setup_element();				
				}
				else
				{
					return false;
				}	
			}
			
			var _setup_element=function(){
				
				$(settings.navSelector).hide();
				
				infiniteHtml=((settings.loadingImage!='')?'<img src="'+settings.loadingImage+'" />':'');
				
				
				$(settings.navSelector).before('<div class="pix-wrapper pix-loader" style="display:none;">'+infiniteHtml+'</div>');		
			
			}
			
			var _load=function(){
				
				//check if url exixts
				if(!url)
				return false;
				
				loading = true;
				
				 var lastElem   = $( settings.contentSelector ).find( settings.itemSelector ).last();
				 
				 //custom trigger when start loading
				 $(document).trigger('pix_infinite_load_start');			
				
				// ajax call
				$.ajax({
					// params
					url         : url,
					dataType    : 'html',
					success     : function (response) {

					loading = false;
					
					$('.pix-loader').hide();
					
					
					 var obj  = $(response),
							elem = obj.find( settings.itemSelector ),
							next = obj.find( settings.nextSelector );
					
					lastElem.after( elem );	
					 
					 //custom trigger when successfully loaded
					 $(document).trigger('pix_infinite_load_success');
					
						if( next.length ) {
							url = next.attr( 'href' );
						}
						else {
						   loaded=true;
						   
							//custom trigger when successfully loaded all pages
							$(document).trigger('pix_infinite_load_complete');
						 
						}
					
					}
				});
				
			};
			
			$(window).on('scroll',function(){
									   
				if(! loading && ! loaded  && $(window).scrollTop() >= $(settings.itemSelector).last().offset().top + $(settings.itemSelector).last().outerHeight() - window.innerHeight)	
				{
				   _load();
				}	
			});
		
		
		
		$(document).on('pix_infinite_load_start',function(){
			$('.pix-wrapper').show();												   
		});
		
		$(document).on('pix_infinite_load_success',function(){
			$('.pix-wrapper').hide();
		});
		
		$(document).on('pix_infinite_load_complete',function(){	
			 $('.pix-wrapper').html(settings.loadingFinishedText).show();
		});
			
		_init();
	 
		});
		
		
    };
 
}( jQuery,window, document ));