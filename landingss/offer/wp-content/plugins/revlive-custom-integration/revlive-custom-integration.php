<?php
/*
Plugin Name: Rev Live Custom Integration
Plugin URI: http://www.easy-development.com
Description: Rev Live Custom Integration - Task 16908 on codeable.
Version: 1.0.0
Author: Andrei-Robert Rusu
Author URI: http://www.easy-development.com
*/

/**
 * Class RevLiveCustomIntegration
 * !!!!!! In case you're doing any modifications :
 * Make sure that all the static params are url-encoded.
 */
class RevLiveCustomIntegration {

  private $_apiCallLink      = 'http://launch.revlive.net/oapi/create_pixel';
  private $_staticParameters = array(
    'user_id'         => 567,
    'password'        => '%40p1f1r5tpr0', // The actual value is : @p1f1r5tpr0
    'action'          => 'create',
    'client_id'       => 162,
    'brand_id'        => 146,
    'status_type_id'  => 1
  );

  private $_triggerAction = 'woocommerce_order_status_changed';
  private $_markParam     = 'revlive_custom_integration_marker';

  public function __construct() {
    add_action($this->_triggerAction, array($this, '_wooCommerceNewOrderAction'));
  }

  public function _wooCommerceNewOrderAction($order_id) {
    if(get_post_meta($order_id, $this->_markParam, true) == 1)
      return;

    $orderInformation = new WC_Order($order_id);
    $dynamicRequestInformation = array(
      'client_customer_id'    => urlencode($orderInformation->billing_email),
      'client_transaction_id' => urlencode($orderInformation->id),
      'total'                 => urlencode($orderInformation->get_total()),
      'subtotal'              => urlencode($orderInformation->get_subtotal()),
      'bill_fname'            => urlencode($orderInformation->billing_first_name),
      'bill_lname'            => urlencode($orderInformation->billing_last_name),
      'bill_country'          => urlencode($orderInformation->billing_country),
      'bill_telephone'        => urlencode($orderInformation->billing_phone),
      'bill_email'            => urlencode($orderInformation->billing_email),
      'date_ordered'          => urlencode(date("Y-m-d"))
    );

    $apiCallDestination  = $this->_getBaseAPICallDestination();
    $apiCallDestination .= '&' . $this->_arrayKeyValueImplode("=", '&', $dynamicRequestInformation);

    $response = wp_remote_get( $apiCallDestination );

    update_post_meta($order_id, $this->_markParam, 1);
  }

  private function _getBaseAPICallDestination() {
    return $this->_apiCallLink . '?' . $this->_arrayKeyValueImplode("=", '&', $this->_staticParameters);
  }

  /**
   * Implode an array with the key and value pair giving
   * a glue, a separator between pairs and the array
   * to implode.
   * @param string $glue The glue between key and value
   * @param string $separator Separator between pairs
   * @param array $array The array to implode
   * @return string The imploded array
   */
  private function _arrayKeyValueImplode( $glue, $separator, $array ) {
    if ( ! is_array( $array ) ) return $array;
    $string = array();
    foreach ( $array as $key => $val ) {
      if ( is_array( $val ) )
        $val = implode( ',', $val );
      $string[] = "{$key}{$glue}{$val}";

    }
    return implode( $separator, $string );
  }

}

$revLiveInstance = new RevLiveCustomIntegration();