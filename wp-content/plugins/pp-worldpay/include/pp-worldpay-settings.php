<?php

function pp_init_settings() {
?>
<div class="wrap">
<h2>PP WorldPay - Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'pp-worldpay-settings' ); ?>
    <?php do_settings_sections( 'pp-worldpay-settings' ); ?>
    <table class="form-table">
        <tr valign="top">
			<th scope="row" colspan="2">API MODE</em></th>
        </tr>

		<tr>
			<td width="150px">
				Enable TEST MODE
			</td>
			<td>
				<input type="checkbox" name="pp_worldpay_api_mode" value="1" <?php if( esc_attr( get_option('pp_worldpay_api_mode') ) == 1) { echo 'checked="checked"'; } ?> />
			</td>
		</tr>


        <tr valign="top">
			<th scope="row" colspan="2">TEST API KEYS</em></th>
        </tr>
			
		<tr>
			<td>
				Service key
			</td>
			<td>
				<input type="text" name="pp_worldpay_service_key_test" value="<?php echo esc_attr( get_option('pp_worldpay_service_key_test') ); ?>" />
			</td>
		</tr>

		<tr>
			<td>
				Client key
			</td>
			<td>
				<input type="text" name="pp_worldpay_client_key_test" value="<?php echo esc_attr( get_option('pp_worldpay_client_key_test') ); ?>" />
			</td>
		</tr>


        <tr valign="top">
			<th scope="row" colspan="2">LIVE API KEYS</em></th>
        </tr>
			
		<tr>
			<td>
				Service key
			</td>
			<td>
				<input type="text" name="pp_worldpay_service_key_live" value="<?php echo esc_attr( get_option('pp_worldpay_service_key_live') ); ?>" />
			</td>
		</tr>

		<tr>
			<td>
				Client key
			</td>
			<td>
				<input type="text" name="pp_worldpay_client_key_live" value="<?php echo esc_attr( get_option('pp_worldpay_client_key_live') ); ?>" />
			</td>
		</tr>
         
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php
}	


add_action( 'admin_init', 'pp_worldpay_page_settings' );

function pp_worldpay_page_settings() {
	register_setting( 'pp-worldpay-settings', 'pp_worldpay_api_mode' );

	register_setting( 'pp-worldpay-settings', 'pp_worldpay_service_key_test' );
	register_setting( 'pp-worldpay-settings', 'pp_worldpay_client_key_test' );

	register_setting( 'pp-worldpay-settings', 'pp_worldpay_service_key_live' );
	register_setting( 'pp-worldpay-settings', 'pp_worldpay_client_key_live' );

}

