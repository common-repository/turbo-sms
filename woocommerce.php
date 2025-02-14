<?php
/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    // the woocommerce_new_order callback
	function turbo_sms_action_woocommerce_new_order($order_id) {
		$order = wc_get_order( $order_id );
		$options = get_option( 'turbo_sms_settings' );
		$customerphonenumber = $order->get_billing_phone();
		$smsbody = $options['turbo_sms_template_order_placed'];
		$smsbody = str_replace("{{ordernumber}}", $order_id, $smsbody);
		$smsbody = str_replace("{{customername}}", $order->get_billing_first_name(), $smsbody);
		if ($options['turbo_sms_enable_sms'] == 1 && $options['turbo_sms_check_order_placed'] == 1) {
			turbo_sms_send_sms($customerphonenumber, $smsbody);
		}
	};
	add_action( 'woocommerce_new_order', 'turbo_sms_action_woocommerce_new_order', 10, 3 );

	// the woocommerce_order_processing callback
	function turbo_sms_action_woocommerce_order_processing($order_id) {
		$order = wc_get_order( $order_id );
		$options = get_option( 'turbo_sms_settings' );
		$customerphonenumber = $order->get_billing_phone();
		$smsbody = $options['turbo_sms_template_order_processing'];
		$smsbody = str_replace("{{ordernumber}}", $order_id, $smsbody);
		$smsbody = str_replace("{{customername}}", $order->get_billing_first_name(), $smsbody);
		if ($options['turbo_sms_enable_sms'] == 1 && $options['turbo_sms_check_order_processing'] == 1) {
			turbo_sms_send_sms($customerphonenumber, $smsbody);
		}
	};
	add_action( 'woocommerce_order_status_processing', 'turbo_sms_action_woocommerce_order_processing', 10, 3 );

	// the woocommerce_ordercompleted callback
	function turbo_sms_action_woocommerce_order_completed($order_id) {
		$order = wc_get_order( $order_id );
		$options = get_option( 'turbo_sms_settings' );
		$customerphonenumber = $order->get_billing_phone();
		$smsbody = $options['turbo_sms_template_order_completed'];
		$smsbody = str_replace("{{ordernumber}}", $order_id, $smsbody);
		$smsbody = str_replace("{{customername}}", $order->get_billing_first_name(), $smsbody);
		if ($options['turbo_sms_enable_sms'] == 1 && $options['turbo_sms_check_order_completed'] == 1) {
			turbo_sms_send_sms($customerphonenumber, $smsbody);
		}
	};
	add_action( 'woocommerce_order_status_completed', 'turbo_sms_action_woocommerce_order_completed', 10, 3 );

}
