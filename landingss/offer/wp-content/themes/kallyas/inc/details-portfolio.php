<?php
$zn_sp_client = get_post_meta( get_the_ID(), 'zn_sp_client', true );
$zn_sp_year = get_post_meta( get_the_ID(), 'zn_sp_year', true );
$zn_sp_services = get_post_meta( get_the_ID(), 'zn_sp_services', true );
$sp_col = get_post_meta( get_the_ID(), 'zn_sp_col', true );
if ( ! empty ( $zn_sp_client ) || ! empty ( $zn_sp_year ) || ! empty ( $zn_sp_services ) || ! empty ( $sp_col ) ) {

	echo '<ul class="portfolio-item-details clearfix">';

	if ( ! empty ( $zn_sp_client ) ) {
		echo '
									<li class="portfolio-item-details-client clearfix">
										<span class="portfolio-item-details-label">' . __( "CLIENT ", 'zn_framework' ) . '</span>
										<span class="portfolio-item-details-item">' . $zn_sp_client . '</span>
									</li>';
	}

	if ( ! empty ( $zn_sp_year ) ) {
		echo '
									<li class="portfolio-item-details-year clearfix">
										<span class="portfolio-item-details-label">' . __( "YEAR ", 'zn_framework' ) . '</span>
										<span class="portfolio-item-details-item">' . $zn_sp_year . '</span>
									</li>';
	}

	if ( ! empty ( $zn_sp_services ) ) {
		echo '
									<li class="portfolio-item-details-services clearfix">
										<span class="portfolio-item-details-label">' . __( "WE DID ", 'zn_framework' ) . '</span>
										<span class="portfolio-item-details-item">' . $zn_sp_services . '</span>
									</li>';
	}

	if ( ! empty ( $sp_col ) ) {
		echo '
									<li class="portfolio-item-details-partners clearfix">
										<span class="portfolio-item-details-label">' . __( "PARTNERS ", 'zn_framework' ) . '</span>
										<span class="portfolio-item-details-item">' . $sp_col . '</span>
									</li>';
	}

	echo '
								<li class="portfolio-item-details-cat clearfix">
									<span class="portfolio-item-details-label">' . __( "CATEGORY ", 'zn_framework' ) . '</span>
									<span class="portfolio-item-details-item">' . get_the_term_list( get_the_ID(), 'project_category', '', ' , ', '' ) . '</span>
								</li>';

	echo '</ul>';
}
?>
<div class="portfolio-item-otherdetails clearfix">
	<?php

	// Social Sharing
	$sp_show_social = get_post_meta( get_the_ID(), 'zn_sp_show_social', true );
	if ( ! empty ( $sp_show_social ) && $sp_show_social == 'yes' ) {
		?>
		<div class="portfolio-item-share clearfix" data-share-title="SHARE:">
			<?php

			$encoded_url = urlencode( get_permalink() );
			$share_text = htmlspecialchars( urlencode( __( "Check out - ", 'zn_framework' ) . get_the_title() ), ENT_COMPAT, 'UTF-8');

			$mail_subject = htmlspecialchars( __( "Check out this awesome project: ", 'zn_framework' ) .get_the_title() );
			$mail_body = htmlspecialchars( __( "You can see it live here ", 'zn_framework' ) .$encoded_url.'%3Futm_source%3Dsharemail .'."\n\n". __( " Made by ", 'zn_framework' ) . get_bloginfo() . ' ' . get_site_url() );

			$socialicons = array();
			$socialicons['twitter'] = array(
				'url' => 'https://twitter.com/intent/tweet?text='.$share_text.'&amp;url='.$encoded_url.'%3Futm_source%3Dsharetw',
				'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue82f')
			);
			$socialicons['facebook'] = array(
				'url' => 'https://www.facebook.com/sharer/sharer.php?display=popup&amp;u='.$encoded_url.'%3Futm_source%3Dsharefb',
				'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue83f')
			);
			$socialicons['gplus'] = array(
				'url' => 'https://plus.google.com/share?url='.$encoded_url.'%3Futm_source%3Dsharegp',
				'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue808')
			);
			$socialicons['pinterest'] = array(
				'url' => 'http://pinterest.com/pin/create/button?description='.$share_text.'&amp;url='.$encoded_url.'%3Futm_source%3Dsharepi',
				'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue80e')
			);
			$socialicons['mail'] = array(
				'url' => 'mailto:?body='.$mail_body.'&amp;subject='.$mail_subject,
				'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue836')
			);

			foreach ($socialicons as $key => $value) {
				echo '<a href="'.$value['url'].'" title="' . __( "SHARE ON", 'zn_framework' ) . ' '.strtoupper($key).'" class=" portfolio-item-share-'.$key.'">';
				echo '<span '. zn_generate_icon( $value['icon'] ) .'></span>';
				echo '</a>';
			}

			?>

		</div><!-- social links -->
		<?php
	}

	$sp_link = get_post_meta( get_the_ID(), 'zn_sp_link', true );
	if ( ! empty ( $sp_link['url'] ) ) {

		$button_text = get_post_meta( get_the_ID(), 'zn_sp_link_text', true );
		$button_text = ! empty( $button_text ) ? $button_text : __( "PROJECT LIVE PREVIEW", 'zn_framework' );


		echo '
					<div class="portfolio-item-livelink">
						<a class="btn btn-lined lined-custom" href="' . $sp_link['url'] . '" target="' . $sp_link['target'] . '" title="' . $sp_link['title'] . '" >
							<span class="visible-sm visible-xs visible-lg">' . $button_text . '</span>
							<span class="visible-md">' . __( "PREVIEW", 'zn_framework' ) . '</span>
						</a>
					</div>';
	}
	?>

</div><!-- /.portfolio-item-otherdetails -->