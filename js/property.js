jQuery(document).ready(function($){
	
	var today = new Date();
	var tomorrow = new Date(today.getTime() + (24 * 60 * 60 * 1000));
	var week = new Date(today.getTime() + (7 * 24 * 60 * 60 * 1000));
	
	var reserved_dates = [];
		var booking_array=JSON.parse(themetera.booking_array);
		$.each(booking_array, function(k, v) {			
			reserved_dates.push(new Date(v));
		  });
	
	var booking_start_picker = $('#booking_check_in').pickadate({
		editable: false
		,format:'dd/mm/yyyy'
		,min: tomorrow
		,disable: reserved_dates
		,onSet: function(date) {
			$('#booking_check_out').pickadate('picker').set('min', new Date(date.select + (24 * 60 * 60 * 1000)));			
		}
	});
	var booking_end_picker = $('#booking_check_out').pickadate({
		editable: false
		,format:'dd/mm/yyyy'
		,disable: reserved_dates
		,min: 1
	});
	$(document).on('change','#booking_check_in',function(){
		calculate_booking_cost();
	});
	
	$(document).on('change','#booking_check_out',function(){
		calculate_booking_cost();
	});
	
	$(document).on('click','#submit_booking',function(){
		var fromdate, todate, property_id,guests;
		property_id         =   jQuery("#property_id").val();
		fromdate            =   jQuery("#booking_check_in").val();
		todate              =   jQuery("#booking_check_out").val();
		guests              =   jQuery("#guests").val();
		
		if(fromdate=='' || todate=='')
			return false;
		
		jQuery.ajax({
			type: 'POST',
			url: themetera.ajaxurl,
			data: {
				'action'            :   'themetera_save_booking',
				'fromdate'          :   fromdate,
				'todate'            :   todate,
				'property_id'       :   property_id,
				'guests'       		:   guests
			},
			success: function (data) {
				jQuery('#booking_result').html(data);
				jQuery("#booking_check_in").val('');
				jQuery("#booking_check_out").val('');
				jQuery("#guests").val("").change();
			},
			error: function (errorThrown) {
			}
		});
		
		
	});
	
	
});

function calculate_booking_cost() {
	var fromdate, todate, property_id;
	property_id         =   jQuery("#property_id").val();
	fromdate            =   jQuery("#booking_check_in").val();
	todate              =   jQuery("#booking_check_out").val();
	
	if(fromdate=='' || todate=='')
		return false;
	
	jQuery.ajax({
		type: 'POST',
		url: themetera.ajaxurl,
		data: {
			'action'            :   'themetera_calculate_booking_cost',
			'fromdate'          :   fromdate,
			'todate'            :   todate,
			'property_id'       :   property_id
		},
		success: function (data) {
			jQuery('#calculated-info').html(data);
		},
		error: function (errorThrown) {
		}
	});
}