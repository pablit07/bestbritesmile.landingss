<form method="get" class="woocommerce-product-search gensearch__form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'zn_framework' ); ?></label>
	<input type="search" class="search-field inputbox gensearch__input" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'zn_framework' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'zn_framework' ); ?>" />
	<button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'zn_framework' ); ?>" class="gensearch__submit glyphicon glyphicon-search"></button>
	<input type="hidden" name="post_type" value="product" />
</form>
