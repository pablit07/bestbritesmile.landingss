/**
 * affiliates-campaigns.js
 *
 * Copyright (c) 2010 - 2015 "kento" Karim Rahimpur www.itthinx.com
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
 * @package affiliates
 * @since affiliates 2.8.0
 */

/**
 * All checkboxes checked toggle based on header and footer checkboxes.
 */
(function($) {
	$(document).ready(function(){
		$('.campaigns-table thead th.check-column').find(':checkbox').click(function(e){
			var checked = $(this).prop('checked');
			$('.campaign-cb:not([disabled])').prop('checked',checked);
			$('.campaigns-table tfoot th.check-column').find(':checkbox').prop('checked',checked);
		});
	});
}(jQuery));
