<?php
function turbo_sms_scripts() {
    wp_enqueue_style( 'turbo_sms_style',  plugin_dir_url( __FILE__ ) . "/css/style.css");
}

add_action( 'admin_print_styles', 'turbo_sms_scripts' );

add_action( 'admin_menu', 'turbo_sms_add_admin_menu' );
add_action( 'admin_init', 'turbo_sms_settings_init' );


function turbo_sms_add_admin_menu(  ) {

	add_options_page( 'Turbo SMS', 'Turbo SMS', 'manage_options', 'turbo_sms', 'turbo_sms_options_page' );

}


function turbo_sms_settings_init(  ) {

	register_setting( 'pluginPage', 'turbo_sms_settings' );

	add_settings_section(
		'turbo_sms_pluginPage_api_section',
		__( 'API SETTINGS', 'turbo-sms' ),
		'turbo_sms_settings_api_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'turbo_sms_enable_sms',
		__( 'SMS Notification:', 'turbo-sms' ),
		'turbo_sms_enable_sms_render',
		'pluginPage',
		'turbo_sms_pluginPage_api_section'
	);

	add_settings_field(
		'turbo_sms_select_provider',
		__( 'Select SMS Provider', 'turbo_sms' ),
		'turbo_sms_select_provider_render',
		'pluginPage',
		'turbo_sms_pluginPage_api_section'
	);

  add_settings_field(
		'turbo_sms_api_key',
		__( 'API Key:', 'turbo-sms' ),
		'turbo_sms_api_key_render',
		'pluginPage',
		'turbo_sms_pluginPage_api_section'
	);

	add_settings_field(
		'turbo_sms_api_user_name',
		__( 'User Name:', 'turbo-sms' ),
		'turbo_sms_api_user_name_render',
		'pluginPage',
		'turbo_sms_pluginPage_api_section'
	);


	add_settings_field(
		'turbo_sms_api_password',
		__( 'Password:', 'turbo-sms' ),
		'turbo_sms_api_password_render',
		'pluginPage',
		'turbo_sms_pluginPage_api_section'
	);

	add_settings_field(
		'turbo_sms_api_mask',
		__( 'Sender ID:', 'turbo-sms' ),
		'turbo_sms_api_mask_render',
		'pluginPage',
		'turbo_sms_pluginPage_api_section'
	);


	add_settings_section(
		'turbo_sms_pluginPage_section',
		__( 'SMS TEMPLATES', 'turbo-sms' ),
		'turbo_sms_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'turbo_sms_check_order_placed',
		__( 'New Order:', 'turbo-sms' ),
		'turbo_sms_check_order_placed_render',
		'pluginPage',
		'turbo_sms_pluginPage_section'
	);

	add_settings_field(
		'turbo_sms_template_order_placed',
		__( 'SMS Template:', 'turbo-sms' ),
		'turbo_sms_template_order_placed_render',
		'pluginPage',
		'turbo_sms_pluginPage_section'
	);

	add_settings_field(
		'turbo_sms_check_order_processing',
		__( 'Order Processing:', 'turbo-sms' ),
		'turbo_sms_check_order_processing_render',
		'pluginPage',
		'turbo_sms_pluginPage_section'
	);

	add_settings_field(
		'turbo_sms_template_order_processing',
		__( 'SMS Template:', 'turbo-sms' ),
		'turbo_sms_template_order_processing_render',
		'pluginPage',
		'turbo_sms_pluginPage_section'
	);

	add_settings_field(
		'turbo_sms_check_order_completed',
		__( 'Order Complete:', 'turbo-sms' ),
		'turbo_sms_check_order_completed_render',
		'pluginPage',
		'turbo_sms_pluginPage_section'
	);

	add_settings_field(
		'turbo_sms_template_order_completed',
		__( 'SMS Template:', 'turbo-sms' ),
		'turbo_sms_template_order_completed_render',
		'pluginPage',
		'turbo_sms_pluginPage_section'
	);


}


function turbo_sms_enable_sms_render(  ) {

	$options = get_option( 'turbo_sms_settings' );
	?>
	<input type='checkbox' name='turbo_sms_settings[turbo_sms_enable_sms]' <?php checked( $options['turbo_sms_enable_sms'], 1 ); ?> value='1'> Enable
	<?php

}


function turbo_sms_select_provider_render(  ) {

	$options = get_option( 'turbo_sms_settings' );
	?>
	<select name='turbo_sms_settings[turbo_sms_select_provider]'>
    <option value='turbosms_top' <?php selected( $options['turbo_sms_select_provider'], 'turbosms_top' ); ?>>turbosms.top</option>
    
	</select>
	<?php

}

function turbo_sms_api_key_render(  ) {

	$options = get_option( 'turbo_sms_settings' );
	?>
	<input type='text' name='turbo_sms_settings[turbo_sms_api_key]' value='<?php echo esc_html( $options ['turbo_sms_api_key'] ); ?>'>
  <p><i>If you use API KEY, You don't have to enter user name and password.</i></p>
	<?php

}

function turbo_sms_api_user_name_render(  ) {

	$options = get_option( 'turbo_sms_settings' );
	?>
	<input type='text' name='turbo_sms_settings[turbo_sms_api_user_name]' value='<?php echo esc_html( $options['turbo_sms_api_user_name'] ); ?>'>
	<?php

}


function turbo_sms_api_password_render(  ) {

	$options = get_option( 'turbo_sms_settings' );
	?>
	<input type='password' name='turbo_sms_settings[turbo_sms_api_password]' value='<?php echo esc_html( $options['turbo_sms_api_password'] ); ?>'>
	<?php

}


function turbo_sms_api_mask_render(  ) {

	$options = get_option( 'turbo_sms_settings' );
	?>
	<input type='text' name='turbo_sms_settings[turbo_sms_api_mask]' value='<?php echo esc_html( $options['turbo_sms_api_mask'] ); ?>'>
	<?php

}


function turbo_sms_check_order_placed_render(  ) {

	$options = get_option( 'turbo_sms_settings' );
	?>
	<input type='checkbox' name='turbo_sms_settings[turbo_sms_check_order_placed]' <?php checked( $options['turbo_sms_check_order_placed'], 1 ); ?> value='1'> Enable SMS
	<?php

}


function turbo_sms_template_order_placed_render(  ) {

	$options = get_option( 'turbo_sms_settings' );
	?>
	<textarea cols='40' rows='5' name='turbo_sms_settings[turbo_sms_template_order_placed]'><?php echo esc_textarea( $options['turbo_sms_template_order_placed'] ); ?></textarea>
	<?php

}


function turbo_sms_check_order_processing_render(  ) {

	$options = get_option( 'turbo_sms_settings' );
	?>
	<input type='checkbox' name='turbo_sms_settings[turbo_sms_check_order_processing]' <?php checked( $options['turbo_sms_check_order_processing'], 1 ); ?> value='1'> Enable SMS
	<?php

}


function turbo_sms_template_order_processing_render(  ) {

	$options = get_option( 'turbo_sms_settings' );
	?>
	<textarea cols='40' rows='5' name='turbo_sms_settings[turbo_sms_template_order_processing]'><?php echo esc_textarea( $options['turbo_sms_template_order_processing'] ); ?></textarea>
	<?php

}


function turbo_sms_check_order_completed_render(  ) {

	$options = get_option( 'turbo_sms_settings' );
	?>
	<input type='checkbox' name='turbo_sms_settings[turbo_sms_check_order_completed]' <?php checked( $options['turbo_sms_check_order_completed'], 1 ); ?> value='1'> Enable SMS
	<?php

}


function turbo_sms_template_order_completed_render(  ) {

	$options = get_option( 'turbo_sms_settings' );
	?>
	<textarea cols='40' rows='5' name='turbo_sms_settings[turbo_sms_template_order_completed]'><?php echo esc_textarea( $options['turbo_sms_template_order_completed'] ); ?></textarea>
	<?php

}


function turbo_sms_settings_section_callback(  ) {

	echo __( 'Please enter your sms body text you want to send. <p>Use <span>{{ordernumber}}</span> <span>{{customername}}</span> for dynamic information.</p>', 'turbo-sms' );

}

function turbo_sms_settings_api_section_callback(  ) {

	echo __( 'Please enter your SMS API information of Turbo SMS', 'turbo-sms' );

}


function turbo_sms_options_page(  ) {

		?>
		<div class="turbo_sms_settings_page">
			<div class="turbo_sms_settings_page_inner">
				<div class="turbo_sms_settings_page_header">

					<div class="turbo_sms_settings_page_header_info">
						<h2><?php echo __("Turbo SMS - Super Speed Bulk SMS Marketing");?></h2>
					</div>
				</div>
				<div class="turbo_sms_settings_page_body">
					<form action='options.php' method='post'>
						<?php
						settings_fields( 'pluginPage' );
						do_settings_sections( 'pluginPage' );
						submit_button();
						?>
					</form>
				</div>
				<div class="turbo_sms_settings_page_footer">
					<h4><strong><?php echo __("This plugin will only work with the Turbo SMS API. To get your API key go to <strong>turbosms.top/Developers</strong><br>Please visit <strong>www.turbosms.net</strong> if you don't have any API key. <br>You will get free SMS API with our every package");?></h4>
					<p>Developed by: <a href="https://turbosms.net" target="_blank"><?php echo __("Turbo SMS Technical Department");?></a></p>
				</div>
			</div>
		</div>

		<?php

}
