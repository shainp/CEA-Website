var contheight;
function cs_amimate(id){
	$("#"+id).animate({
		height: 'toggle'
		}, 1000, function() {
		// Animation complete.
	});
}
 function hide_all(id){
  contheight = $('.page-opts').height();
  //var widthvr = $('.page-opts').outerWidth(true);
  var popd = $("#"+id).height();
  $("#"+id).css("top", popd);
  $("#"+id).css("display", "block");
  $.scrollTo( '#normal-sortables', 800, {easing:'swing'} );
  $(".poped-up").css("height", popd);
  $(".page-opts").css("height", popd);
  $("#"+id).animate({
   top: 0,
  }, 500, function() {
   // Animation complete.
  });
  
 };
 function show_all(id){
	
  $(".page-opts").css("height", "auto");
  //var widthvr = $('.page-opts').outerHeight();
  $("#"+id).animate({
   top: contheight,
  }, 500, function() {
  // Animation complete.
  });
  $.scrollTo( '#normal-sortables', 800, {easing:'swing'} );
  $("#"+id).hide(500).delay(500);
  contheight = 0;
 };
 function addtrack(id){
  contheight = $('.page-opts').height();
  //var widthvr = $('.page-opts').outerWidth(true);
  var popd = $("#"+id).height();
  $("#"+id).css("top", popd);
  $("#"+id).css("display", "block");
  $(".poped-up").css("height", popd);
  $(".page-opts").css("height", popd);
  $("#"+id).animate({
   top: 0,
  }, 500, function() {
   // Animation complete.
  });
  $.scrollTo( '#normal-sortables', 800, {easing:'swing'} );
 };
 function closetrack(id){
  $(".page-opts").css("height", "auto");
  //var widthvr = $('.page-opts').outerHeight();
  $("#"+id).animate({
   top: contheight + 100,
  }, 500, function() {
  // Animation complete.
  });
  $("#"+id).hide(500).delay(500);
	$.scrollTo( '#normal-sortables', 800, {easing:'swing'} );
 };


	function update_title(id){
		var val;
		val = jQuery('#subject_title'+id).val();
		jQuery('#album-title'+id).html(val);
	}
	function gll_search_map(){
		var vals;
		vals = jQuery('#loc_address').val();
		vals = vals + ", " + jQuery('#loc_city').val();
		vals = vals + ", " + jQuery('#loc_postcode').val();
		vals = vals + ", " + jQuery('#loc_region').val();
		vals = vals + ", " + jQuery('#loc_country').val();
		jQuery('.gllpSearchField').val(vals);
	}
	function hide_custom_color_scheme(id){
		if (id == "custom") {
			jQuery("#cs_color_scheme").show("slow");
		}
		else jQuery("#cs_color_scheme").hide("slow");
	}
	function update_logo(){
		var src;
		src = $('#cs_logo').val();
		$('#cs_logo_img').attr('src', src);
	}
	function remove_logo(){
		$('#cs_logo_img').attr('src', '');
		$('#cs_logo').val('');
	}
	function track_toggle(id){
		title = jQuery('#album_track_title'+id).val();
		jQuery('#album-title'+id).html(title);
		jQuery('#edit_track_form'+id).toggle("slow");
	}
	function tab_close(){
		jQuery(".form-msgs").slideUp("slow");
	}
	function slideout(){
		setTimeout(function(){
			jQuery(".form-msgs").slideUp("slow", function () {
			});
		}, 5000);
	}
	function slideout_msgs(){
		setTimeout(function(){
			jQuery("#newsletter_mess").slideUp("slow", function () {
			});
		}, 5000);
	}	
	function cs_div_remove(id){
		jQuery("#"+id).remove();
	}
	function cs_toggle(id){
		jQuery("#"+id).toggle("slow");
	}
	function toggle_with_value(id, value){
		if ( value == 0 ) jQuery("#"+id).hide("slow");
		else  jQuery("#"+id).show("slow");
	}
	function cs_toggle_tog(id){
		jQuery("#"+id).toggleClass("no-display");
		var newheight = $('.poped-up').height();
		$(".poped-up").css("height", newheight);
		$(".page-opts").css("height", newheight);
	}
	function cs_toggle_height(value,id){
		if (value == "Nivo Slider"){
			jQuery("#"+id).addClass("no-display");
		}
		else {
			jQuery("#"+id).removeClass("no-display");
		}
			var newheight = $('.poped-up').height();
			$(".poped-up").css("height", newheight);
			$(".page-opts").css("height", newheight);
	}
	function show_sidebar(id){
		jQuery('input[name="cs_layout"]').change(function(){
			jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
			jQuery(this).siblings("label").children("#check-list").addClass("check-list");
		});
		if ( id == 'left'){
			jQuery("#sidebar_right").hide();
			jQuery("#sidebar_left").show();
		}
		else if ( id == 'right'){
			jQuery("#sidebar_left").hide();
			jQuery("#sidebar_right").show();
		}
		else if ( id == 'both'){
			jQuery("#sidebar_left").show();
			jQuery("#sidebar_right").show();
		}
		else if ( id == 'none'){
			jQuery("#sidebar_left").hide();
			jQuery("#sidebar_right").hide();
		}
	}
