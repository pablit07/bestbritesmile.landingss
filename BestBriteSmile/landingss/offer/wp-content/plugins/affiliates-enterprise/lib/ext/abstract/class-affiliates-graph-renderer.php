<?php
	
/**
 * Copyright (c) "kento" Karim Rahimpur www.itthinx.com
 * 
 * This code is provided subject to the license granted.
 *
 * UNAUTHORIZED USE AND DISTRIBUTION IS PROHIBITED.
 *
 * See COPYRIGHT.txt and LICENSE.txt
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * This header and all notices must be kept intact.
 */

	
 abstract class Affiliates_Graph_Renderer implements I_Affiliates_Graph_Renderer { protected static $IXAP100 = array( 'from_date' => null, 'thru_date' => null, 'days_back' => null, 'interval' => null, 'legend' => true, 'render' => 'graph' ); protected static $IXAP101; protected static $IXAP102 = 7; protected static $IXAP103 = 7; protected static $IXAP104 = 1100; public static function init() { self::$IXAP101 = date( 'Y-m-d', time() ); } static function render_graph( $IXAP105 = array() ) { global $affiliates_db, $IXAP106; $IXAP106++; self::init(); $IXAP62 = ''; $IXAP24 = Affiliates_Affiliate_WordPress::get_user_affiliate_id(); if ( $IXAP24 === false ) { return $IXAP62; } $IXAP107 = isset( $IXAP105['interval'] ) && ( $IXAP105['interval'] !== null ) ? $IXAP105['interval'] : null; $IXAP108 = isset( $IXAP105['render'] ) ? $IXAP105['render'] : self::$IXAP100['render']; switch( $IXAP108 ) { case 'graph' : case 'hits' : case 'visits' : case 'referrals' : case 'accepted' : case 'closed' : case 'pending' : case 'rejected' : break; default : $IXAP108 = self::$IXAP100['render']; } $IXAP109 = isset( $IXAP105['legend'] ) && ( ( $IXAP105['legend'] === true ) || ( $IXAP105['legend'] === 'true' ) ); if ( $IXAP109 ) { $IXAP110 = 'true'; } else { $IXAP110 = 'false'; } $IXAP111 = isset( $IXAP105['days_back'] ) && ( $IXAP105['days_back'] !== null ) ? $IXAP105['days_back'] : self::$IXAP103; if ( $IXAP111 < self::$IXAP103 ) { $IXAP111 = self::$IXAP103; } if ( $IXAP111 > self::$IXAP104 ) { $IXAP111 = self::$IXAP104; } $IXAP36 = isset( $IXAP105['from_date'] ) && ( $IXAP105['from_date'] !== null ) ? $IXAP105['from_date'] : null; $IXAP38 = isset( $IXAP105['thru_date'] ) && ( $IXAP105['thru_date'] !== null ) ? $IXAP105['thru_date'] : null; switch( $IXAP107 ) { case 'month' : $IXAP36 = date( 'Y-m-d', strtotime( 'first day of' ) ); $IXAP38 = date( 'Y-m-d', strtotime( 'last day of' ) ); $IXAP111 = 1 + ( strtotime( $IXAP38 ) - strtotime( $IXAP36 ) ) / ( 3600 * 24 ); break; case 'year' : $IXAP36 = date( 'Y-m-d', strtotime( 'first day of January' ) ); $IXAP38 = date( 'Y-m-d', strtotime( 'last day of December' ) ); $IXAP111 = 1 + ( strtotime( $IXAP38 ) - strtotime( $IXAP36 ) ) / ( 3600 * 24 ); break; } if ( empty( $IXAP38 ) ) { $IXAP38 = self::$IXAP101; } if ( empty( $IXAP36 ) ) { $IXAP36 = date( 'Y-m-d', strtotime( $IXAP38 ) - $IXAP111 * 3600 * 24 ); } $IXAP47 = $affiliates_db->get_tablename( 'affiliates' ); $IXAP112 = $affiliates_db->get_tablename( 'hits' ); $IXAP49 = $affiliates_db->get_tablename( 'referrals' ); $IXAP98 = "SELECT date, sum(count) as hits FROM $IXAP112 WHERE date >= %s AND date <= %s AND affiliate_id = %d GROUP BY date"; $IXAP113 = $affiliates_db->get_objects( $IXAP98, $IXAP36, $IXAP38, intval( $IXAP24 ) ); $IXAP114 = array(); foreach( $IXAP113 as $IXAP115 ) { $IXAP114[$IXAP115->date] = $IXAP115->hits; } $IXAP98 = "SELECT count(DISTINCT IP) visits, date FROM $IXAP112 WHERE date >= %s AND date <= %s AND affiliate_id = %d GROUP BY date"; $IXAP116 = $affiliates_db->get_objects( $IXAP98, $IXAP36, $IXAP38, intval( $IXAP24 ) ); $IXAP117 = array(); foreach( $IXAP116 as $IXAP118 ) { $IXAP117[$IXAP118->date] = $IXAP118->visits; } $IXAP98 = "SELECT count(referral_id) referrals, date(datetime) date FROM $IXAP49 WHERE status = %s AND date(datetime) >= %s AND date(datetime) <= %s AND affiliate_id = %d GROUP BY date"; $IXAP55 = $affiliates_db->get_objects( $IXAP98, AFFILIATES_REFERRAL_STATUS_ACCEPTED, $IXAP36, $IXAP38, intval( $IXAP24 ) ); $IXAP119 = array(); foreach( $IXAP55 as $IXAP15 ) { $IXAP119[$IXAP15->date] = $IXAP15->referrals; } $IXAP55 = $affiliates_db->get_objects( $IXAP98, AFFILIATES_REFERRAL_STATUS_CLOSED, $IXAP36, $IXAP38, intval( $IXAP24 ) ); $IXAP120 = array(); foreach( $IXAP55 as $IXAP15 ) { $IXAP120[$IXAP15->date] = $IXAP15->referrals; } $IXAP55 = $affiliates_db->get_objects( $IXAP98, AFFILIATES_REFERRAL_STATUS_PENDING, $IXAP36, $IXAP38, intval( $IXAP24 ) ); $IXAP121 = array(); foreach( $IXAP55 as $IXAP15 ) { $IXAP121[$IXAP15->date] = $IXAP15->referrals; } $IXAP55 = $affiliates_db->get_objects( $IXAP98, AFFILIATES_REFERRAL_STATUS_REJECTED, $IXAP36, $IXAP38, intval( $IXAP24 ) ); $IXAP122 = array(); foreach( $IXAP55 as $IXAP15 ) { $IXAP122[$IXAP15->date] = $IXAP15->referrals; } $IXAP123 = array(); $IXAP124 = array(); $IXAP125 = array(); $IXAP126 = array(); $IXAP127 = array(); $IXAP128 = array(); $IXAP129 = array(); $IXAP130 = array(); for ( $IXAP131 = -$IXAP111; $IXAP131 <= 0; $IXAP131++ ) { $IXAP132 = date( 'Y-m-d', strtotime( $IXAP38 ) + $IXAP131 * 3600 * 24 ); $IXAP130[$IXAP131] = $IXAP132; if ( isset( $IXAP119[$IXAP132] ) ) { $IXAP123[] = array( $IXAP131, intval( $IXAP119[$IXAP132] ) ); } if ( isset( $IXAP121[$IXAP132] ) ) { $IXAP124[] = array( $IXAP131, intval( $IXAP121[$IXAP132] ) ); } if ( isset( $IXAP122[$IXAP132] ) ) { $IXAP125[] = array( $IXAP131, intval( $IXAP122[$IXAP132] ) ); } if ( isset( $IXAP120[$IXAP132] ) ) { $IXAP126[] = array( $IXAP131, intval( $IXAP120[$IXAP132] ) ); } if ( isset( $IXAP114[$IXAP132] ) ) { $IXAP127[] = array( $IXAP131, intval( $IXAP114[$IXAP132] ) ); } if ( isset( $IXAP117[$IXAP132] ) ) { $IXAP128[] = array( $IXAP131, intval( $IXAP117[$IXAP132] ) ); } if ( $IXAP111 <= ( self::$IXAP102 + self::$IXAP103 ) ) { $IXAP133 = date( 'm-d', strtotime( $IXAP132 ) ); $IXAP129[] = array( $IXAP131, $IXAP133 ); } else if ( $IXAP111 <= 91 ) { $IXAP31 = date( 'd', strtotime( $IXAP132 ) ); if ( $IXAP31 == '1' || $IXAP31 == '15' ) { $IXAP133 = date( 'm-d', strtotime( $IXAP132 ) ); $IXAP129[] = array( $IXAP131, $IXAP133 ); } } else { if ( date( 'd', strtotime( $IXAP132 ) ) == '1' ) { if ( date( 'm', strtotime( $IXAP132 ) ) == '1' ) { $IXAP133 = '<strong>' . date( 'Y', strtotime( $IXAP132 ) ) . '</strong>'; } else { $IXAP133 = date( 'm-d', strtotime( $IXAP132 ) ); } $IXAP129[] = array( $IXAP131, $IXAP133 ); } } } $IXAP134 = json_encode( $IXAP123 ); $IXAP135 = json_encode( $IXAP124 ); $IXAP136 = json_encode( $IXAP125 ); $IXAP137 = json_encode( $IXAP126 ); $IXAP138 = json_encode( $IXAP127 ); $IXAP139 = json_encode( $IXAP128 ); $IXAP140 = json_encode( array( array( intval( -$IXAP111 ), 0 ), array( 0, 0 ) ) ); $IXAP141 = json_encode( $IXAP129 ); $IXAP142 = json_encode( $IXAP130 ); $IXAP143 = isset( $IXAP105['class'] ) ? $IXAP105['class'] : 'affiliate-graph'; $IXAP144 = isset( $IXAP105['id'] ) ? $IXAP105['id'] : 'affiliate-graph-' . $IXAP106; $IXAP145 = isset( $IXAP105['style'] ) ? $IXAP105['style'] : ''; ob_start(); $IXAP146 = $IXAP111 <= 61 ? 'true' : 'false'; ?>
		<div id="<?php echo $IXAP144; ?>" class="<?php echo $IXAP143; ?>" style="<?php echo $IXAP145; ?>"></div>
		<script type="text/javascript">
			(function($){
				$(document).ready(function(){
					var data = [
						<?php if ( $IXAP108 == 'graph' || $IXAP108 == 'hits' ) : ?>
						{
							label : "<?php _e( 'Hits', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP138; ?>,
							lines : { show : true },
							points : { show : <?php echo $IXAP146; ?> },
							yaxis : 2,
							color : '#ccddff'
						},
						<?php endif; ?>
						<?php if ( $IXAP108 == 'graph' || $IXAP108 == 'visits' ) : ?>
						{
							label : "<?php _e( 'Visits', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP139; ?>,
							lines : { show : true },
							points : { show : <?php echo $IXAP146; ?> },
							yaxis : 2,
							color : '#ffddcc'
						},
						<?php endif; ?>
						<?php if ( $IXAP108 == 'graph' || $IXAP108 == 'accepted' || $IXAP108 == 'referrals' ) : ?>
						{
							label : "<?php _e( 'Accepted', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP134; ?>,
							color : '#009900',
							bars : { align : "center", show : true, barWidth : 1 },
							hoverable : true,
							yaxis : 1
						},
						<?php endif; ?>
						<?php if ( $IXAP108 == 'graph' || $IXAP108 == 'pending' || $IXAP108 == 'referrals' ) : ?>
						{
							label : "<?php _e( 'Pending', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP135; ?>,
							color : '#0000ff',
							bars : { align : "center", show : true, barWidth : 0.6 },
							yaxis : 1
						},
						<?php endif; ?>
						<?php if ( $IXAP108 == 'graph' || $IXAP108 == 'rejected' || $IXAP108 == 'referrals' ) : ?>
						{
							label : "<?php _e( 'Rejected', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP136; ?>,
							color : '#ff0000',
							bars : { align : "center", show : true, barWidth : .3 },
							yaxis : 1
						},
						<?php endif; ?>
						<?php if ( $IXAP108 == 'graph' || $IXAP108 == 'closed' || $IXAP108 == 'referrals' ) : ?>
						{
							label : "<?php _e( 'Closed', AFFILIATES_PLUGIN_DOMAIN ); ?>",
							data : <?php echo $IXAP137; ?>,
							color : '#333333',
							points : { show : true },
							yaxis : 1
						},
						<?php endif; ?>
						{
							data : <?php echo $IXAP140; ?>,
							lines : { show : false },
							yaxis : 1
						}
					];
	
					var options = {
						xaxis : {
							ticks : <?php echo $IXAP141; ?>
						},
						yaxis : {
							min : 0,
							tickDecimals : 0
						},
						yaxes : [
							{},
							{ position : 'right' }
						],
						grid : {
							hoverable : true
						},
						legend : {
							show : <?php echo $IXAP110; ?>,
							position : 'nw'
						}
					};
	
					$.plot($("#<?php echo $IXAP144; ?>"),data,options);
	
					function statsTooltip(x, y, contents) {
						$('<div id="<?php echo $IXAP144; ?>-tooltip">' + contents + '</div>').css( {
							position: 'absolute',
							display: 'none',
							top: y + 5,
							left: x + 5,
							border: '1px solid #333',
							'border-radius' : '4px',
							padding: '6px',
							'background-color': '#ccc',
							opacity: 0.90
						}).appendTo("body").fadeIn(200);
					}
	
					var tooltipItem = null;
					var statsDates = <?php echo $IXAP142; ?>;
					$("#<?php echo $IXAP144; ?>").bind("plothover", function (event, pos, item) {
						if (item) {
							if (tooltipItem === null || item.dataIndex != tooltipItem.dataIndex || item.seriesIndex != tooltipItem.seriesIndex) {
								tooltipItem = item;
								$("#<?php echo $IXAP144; ?>-tooltip").remove();
								var x = item.datapoint[0];
									y = item.datapoint[1];
								statsTooltip(
									item.pageX,
									item.pageY,
									item.series.label + " : " + y +  '<br/>' + statsDates[x] 
								);
							}
						} else {
							$("#<?php echo $IXAP144;?>-tooltip").remove();
							tooltipItem = null;
						}
					});
				});
			})(jQuery);
		</script>
		<?php
 $IXAP62 .= ob_get_contents(); ob_end_clean(); return $IXAP62; } static function render_hits( $IXAP105 = array() ) { self::init(); $IXAP105['render'] = 'hits'; return self::render_graph( $IXAP105 ); } static function render_visits( $IXAP105 = array() ) { self::init(); $IXAP105['render'] = 'visits'; return self::render_graph( $IXAP105 ); } static function render_referrals( $IXAP105 = array() ) { self::init(); $IXAP105['render'] = 'referrals'; return self::render_graph( $IXAP105 ); } static function render_totals( $IXAP105 = array() ) { self::init(); } } 