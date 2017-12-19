jQuery(document).ready(function($){
	/*if(pagenow=='edit-themetera_location'){		
		$('#tag-slug').closest('.form-field').remove();
		$('#slug').closest('.form-field').remove();
		$('#tag-description').closest('.form-field').remove();
		$('#description').closest('.form-field').remove();
	}*/
	if(pagenow=='edit-themetera_location'){
	  $('#tag-name,#name').blur();
	  $('#tag-name,#name').blur(function() {
		  	searchMap(makeLocationSearchString());
			
		});
		
		$('#parent').change(function() {
		  	searchMap(makeLocationSearchString());
			
		});
		
		$(window).bind("load", function() { 
			var lat_lang=$('input[name="lat_long"]:first').val();
				if($.trim(lat_lang)!='')
					showLocation(lat_lang);
		});
	}
	
	if(pagenow=='themetera_property'){
		
		$('#_address').blur(function() {			
		  	searchMap(makeAddress());			
		});
		$('#location_id').blur(function() {			
		  	searchMap(makeAddress());			
		});
		$(window).bind("load", function() { 
			var lat_lang=$('input[name="lat_long"]:first').val();
				if($.trim(lat_lang)!='')
					showLocation(lat_lang);
		});
		
		$('a[href=#location]').on('click', function() {
			setTimeout(function(){
				google.maps.event.trigger(map, 'resize');
				var lat_lang=$('input[name="lat_long"]:first').val();
				if($.trim(lat_lang)!='')
					showLocation(lat_lang);
			}, 50);
		});
		
		
	}
		
	
	  $('body').on('click', '.themetera-upload', function(e){
		var elem=$(this);
        e.preventDefault();
            var button = $(this),
                custom_uploader = wp.media({
            title: 'Insert image',
            library : { 
                type : 'image'
            },
            button: {
                text: 'Use this image' // button label text
            },
            multiple: false // for multiple image selection set to true
        }).on('select', function() { // it also has "open" and "close" events 
            var attachment = custom_uploader.state().get('selection').first().toJSON();
			elem.siblings('input[type="text"]').val(attachment.url);
			elem.siblings('input[type="hidden"]').val(attachment.id);
			
        })
        .open();
    });
	
	$(".cmb2_select").chosen();
});