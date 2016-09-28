<?php
/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Exemplo de uso:
 *
 * <?php
 * $thumb = get_post_thumbnail_id();
 * $image = vt_resize($thumb, '', 140, 110, true);
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
*/
if ( ! function_exists( 'vt_resize' ) )
{
	/**
	 * @param null $attach_id
	 * @param null $img_url
	 * @param int $width
	 * @param int $height
	 * @param bool $crop
	 *
	 * @return array
	 */
	function vt_resize( $attach_id = null, $img_url = null, $width = 0, $height = 0, $crop = false )
	{

		if ( $attach_id ) {
			$img_url = wp_get_attachment_url( $attach_id );
		}
		$image =  mr_image_resize( $img_url, $width, $height, true , 'c' , false );


		if( is_array( $image ) && !empty( $image['url'] ) ){
			return $image;
		}
		else{
			return array(
				'url'    => $img_url,
				'width'  => $width,
				'height' => $height
			);
		}

	}
}
