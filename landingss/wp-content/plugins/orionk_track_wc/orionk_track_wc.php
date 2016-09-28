<?php
/**
 * Plugin Name: WC Pixel Tracking
 * Description: Tracking pixel
 * Version: 1.1
 * Author: Orioni
 * Author URI: http://www.codeable.io
 */



	add_action('woocommerce_thankyou','orionk_tracking');
	function orionk_tracking($order_id){
		
	?>
		<iframe src="https://turtletrx.com/p.ashx?o=866&e=150&t=<?php echo $order_id;?>" height="1" width="1" frameborder="0"></iframe>
		<iframe src="https://turtletrx.com/p.ashx?o=926&e=150&t=<?php echo $order_id;?>" height="1" width="1" frameborder="0"></iframe>
		<iframe src="https://turtletrx.com/p.ashx?o=927&e=150&t=<?php echo $order_id;?>" height="1" width="1" frameborder="0"></iframe>
		<iframe width='1' height='1' frameborder='0' src='https://affiliate.mediaclicktrker.com/rd/ipx.php?hid=<?php echo $_GET["click_id"]; ?>&sid=1775&transid=<?php echo $order_id;?>'></iframe>
	<?php

	} //end orionk_tracking