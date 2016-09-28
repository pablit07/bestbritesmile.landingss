/**
 * affiliates-pro.js
 * 
 * Copyright 2011 - 2015 "kento" Karim Rahimpur - www.itthinx.com
 * 
 * This code is provided subject to the license granted.
 * Unauthorized use and distribution is prohibited.
 * See COPYRIGHT.txt and LICENSE.txt
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * This header and all notices must be kept intact.
 * 
 * @author Karim Rahimpur
 * @package affiliates-pro
 * @since affiliates-pro 1.0.0
 */
jQuery(document).ready(function(){
	/* columns toggle */
	jQuery('#columns-toggle').click(function(){
		var ajaxing = jQuery('#columns-toggle').data('ajaxing');
		if (!(typeof ajaxing === 'undefined' || !ajaxing)) {
			return;
		}
		jQuery('#columns-toggle').data('ajaxing',true);
		jQuery('#columns-container').toggle();
		var visible = jQuery('#columns-container').is(':visible');
		if (visible) {
			jQuery(this).addClass('on');
			jQuery(this).removeClass('off');
		} else {
			jQuery(this).addClass('off');
			jQuery(this).removeClass('on');
		}
		if (
			( typeof ajaxurl !== 'undefined' ) &&
			( typeof affiliates_ajax_nonce !== 'undefined' )
		) {
			var data = {
				action: 'affiliates_set_option',
				affiliates_ajax_nonce: affiliates_ajax_nonce,
				key: 'show_columns',
				value: JSON.stringify(visible)
			};
			jQuery.ajax({
				type   : 'POST',
				async  : false,
				url    : ajaxurl,
				data   : data
			});
		}
		jQuery('#columns-toggle').data('ajaxing',false);
	});

	jQuery('.column-toggle').click(function(event){

		var ajaxing = jQuery(this).data('ajaxing');
		if (!(typeof ajaxing === 'undefined' || !ajaxing)) {
			return;
		}
		jQuery(this).data('ajaxing',true);

		// hide/show column
		event.stopPropagation();
		var value = jQuery(this).val();
		jQuery('th.'+value).toggle();
		var visible = jQuery('th.'+value).is(':visible');
		if ( visible ) {
			jQuery('td.'+value).show();
		} else {
			jQuery('td.'+value).hide();
		}
		// adjust column span
		var columns = jQuery('#affiliates-overview-table > thead > tr > th:visible');
		jQuery('td.dynamic-colspan').attr('colspan',columns.length);

		// save visibility for column
		if (
			( typeof ajaxurl !== 'undefined' ) &&
			( typeof affiliates_ajax_nonce !== 'undefined' ) &&
			( typeof affiliates_overview_columns !== 'undefined' )
		) {
			affiliates_overview_columns[jQuery(this).val()] = visible;
			var data = {
				action: 'affiliates_set_option',
				affiliates_ajax_nonce: affiliates_ajax_nonce,
				key   : 'affiliates_overview_columns',
				value : JSON.stringify(affiliates_overview_columns)
			};
			jQuery.ajax({
				type     : 'POST',
				dataType : 'json',
				async    : false,
				url      : ajaxurl,
				data     : data
			});
		}

		jQuery(this).data('ajaxing',false);
	});

});
