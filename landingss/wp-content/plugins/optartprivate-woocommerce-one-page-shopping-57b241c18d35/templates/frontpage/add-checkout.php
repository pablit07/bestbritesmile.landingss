<?php
/*
 * Template adds the checkout into product page
 * @param string $plugin_identifier
 */
?>

<section class="one-page-shopping-section" id="one-page-shopping-checkout">
	<div class="lv_checkout_header">
    <h1 class="one-page-shopping-header" id="one-page-shopping-checkout-header">
        <?php _e( 'Final Step', 'woocommerce' ); ?>        
    </h1>
    <p>Payment Information</p>
    </div>
    <div id="one-page-shopping-checkout-content">
        <?php require('checkout.php'); ?>
    </div>
</section>