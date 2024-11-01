<?php
function turbo_sms_send_sms($mobilenumber, $smsbodytext){
	$options = get_option( 'turbo_sms_settings' );
	$body = array(
    'recipient' => $mobilenumber,
    'sender' => $options['turbo_sms_api_mask'],
    'body' => $smsbodytext,
    'userid' => $options['turbo_sms_api_user_name'],
    'password' => $options['turbo_sms_api_password']
	);

	$args = array(
	    'body' => $body,
	    'timeout' => '5',
	    'redirection' => '5',
	    'httpversion' => '1.0',
	    'blocking' => true,
	    'headers' => array(),
	    'cookies' => array()
	);

	if ($options['turbo_sms_select_provider'] == 'turbosms_top') {
		$apikey = $options['turbo_sms_api_key'];
		$response = wp_remote_post( 'http://turbosms.top/smsapi?api_key='.$apikey.'&type=text&contacts='.$mobilenumber.'&msg='.$smsbodytext.'&senderid='.$options['turbo_sms_api_mask'] );

	}


	return false;
}
