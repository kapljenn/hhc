<?php
/**
 * Plugin Name: WP Full Stripe HHC
 * Description: This plugin adds extra fields to WP Full Stripe Payment Form.
 * Version: 1.0.0
 * License: GPL2
 */
 
define( 'PLUGIN_VERSION', '1.0.0' );

include( dirname( __FILE__ ).'/libs/simple_html_dom.php');

add_action( 'wp_enqueue_scripts', 'full_stripe_hhc_styles' );
function full_stripe_hhc_styles() 
{
	wp_enqueue_style( 'hhc-form-style', plugin_dir_url( __FILE__ ).'css/form-style.css', null, PLUGIN_VERSION );
}
 
 
add_filter( 'fullstripe_payment_form_output', 'test_fix_pp', 10, 2 );
function test_fix_pp( $content )
{
	$objDom = new simple_html_dom();
	$objDom->load($content);
	
	$fullStripeFormAttribute = 'data-form-id';	
	$strFormName = $objDom->find('.payment-form', 0)->$fullStripeFormAttribute;

	$arrAllowedForms = array_map('trim', explode("\n", esc_attr( get_option('hhc_enabled_forms') )));

	if(in_array($strFormName, $arrAllowedForms))
	{	
		$arrElements = $objDom->find('.control-group');
		$intElements = count($arrElements);

		$strExtraFields = '';

		if(esc_attr( get_option('hhc_add_address') ) == 1)
		{
			$strExtraFields .= '<div class="control-group">';
				$strExtraFields .= '<label class="control-label fullstripe-form-label">Address</label>';
				$strExtraFields .= '<div class="controls">';
					$strExtraFields .= '<textarea class="input-xlarge fullstripe-form-input" name="fullstripe_address" id="fullstripe_address__'.$strFormName.'"></textarea>';
				$strExtraFields .= '</div>';
			$strExtraFields .= '</div>';
		}

		if(esc_attr( get_option('hhc_add_gift_declaration') ) == 1)
		{
			$strExtraFields .= '<div class="control-group">';
				$strExtraFields .= '<label class="control-label fullstripe-form-label">Gift Aid Declaration</label>';
				$strExtraFields .= '<div class="controls">';
					$strExtraFields .= '<input type="checkbox" class="input-xlarge fullstripe-form-input" name="fullstripe_gift" id="fullstripe_gift__'.$strFormName.'">';
				$strExtraFields .= '</div>';
			$strExtraFields .= '</div>';
		}

		if(esc_attr( get_option('hhc_add_opt_in') ) == 1)
		{
			$strExtraFields .= '<div class="control-group label-group">';
				$strExtraFields .= '<p>Opt in to receiving updates about how your donation is transforming lives</p>';
			$strExtraFields .= '</div>';
			
			$strExtraFields .= '<div class="control-group">';
				$strExtraFields .= '<label class="control-label fullstripe-form-label">By email</label>';
				$strExtraFields .= '<div class="controls">';
					$strExtraFields .= '<input type="checkbox" class="input-xlarge fullstripe-form-input" name="fullstripe_opt_in_by_email" id="fullstripe_opt_in_by_email__'.$strFormName.'">';
				$strExtraFields .= '</div>';
			$strExtraFields .= '</div>';


			$strExtraFields .= '<div class="control-group">';
				$strExtraFields .= '<label class="control-label fullstripe-form-label">By post</label>';
				$strExtraFields .= '<div class="controls">';
					$strExtraFields .= '<input type="checkbox" class="input-xlarge fullstripe-form-input" name="fullstripe_opt_in_by_post" id="fullstripe_opt_in_by_post__'.$strFormName.'">';
				$strExtraFields .= '</div>';
			$strExtraFields .= '</div>';
		}		
	

		$strExtraFields .= str_replace('class="controls"', 'class="controls btn-controls"', $arrElements[$intElements-1]);

		$objDom->find('.control-group', ($intElements-1))->innertext = $strExtraFields;
	}
		
	return $objDom;
}



add_action('admin_menu', 'full_stripe_hhc_menu');
function full_stripe_hhc_menu() {
	add_menu_page('Full Stripe HHC Settings', 'Full Stripe HHC', 'administrator', 'full-stripe-hhc-settings', 'full_stripe_hhc_settings_page', 'dashicons-admin-generic');
}

function full_stripe_hhc_settings_page() {
?>
<div class="wrap">
<h2>Full Stripe Payment Form - HHC Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'full-stripe-hhc-settings-form' ); ?>
    <?php do_settings_sections( 'full-stripe-hhc-settings-form' ); ?>
    <table class="form-table">
        <tr valign="top">
			<th scope="row">Enabled Forms<br /><em>(each form name in new line)</em></th>
			<td>
				<textarea name="hhc_enabled_forms" cols="50" rows="10"><?php echo esc_attr( get_option('hhc_enabled_forms') ); ?></textarea>
			</td>
        </tr>

        <tr valign="top">
			<th scope="row">Add address textarea</th>
			<td>
				<input type="checkbox" name="hhc_add_address" value="1" <?php if( esc_attr( get_option('hhc_add_address') ) == 1) { echo 'checked="checked"'; } ?> />
			</td>
        </tr>

        <tr valign="top">
			<th scope="row">Add Gift Aid Declaration</th>
			<td>
				<input type="checkbox" name="hhc_add_gift_declaration" value="1" <?php if( esc_attr( get_option('hhc_add_gift_declaration') ) == 1) { echo 'checked="checked"'; } ?> />
			</td>
        </tr>

        <tr valign="top">
			<th scope="row">Add Opt in options</th>
			<td>
				<input type="checkbox" name="hhc_add_opt_in" value="1" <?php if( esc_attr( get_option('hhc_add_opt_in') ) == 1) { echo 'checked="checked"'; } ?> />
			</td>
        </tr>

         
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php
}

add_action( 'admin_init', 'full_stripe_hhc_settings' );

function full_stripe_hhc_settings() {
	register_setting( 'full-stripe-hhc-settings-form', 'hhc_enabled_forms' );
	register_setting( 'full-stripe-hhc-settings-form', 'hhc_add_address' );
	register_setting( 'full-stripe-hhc-settings-form', 'hhc_add_gift_declaration' );
	register_setting( 'full-stripe-hhc-settings-form', 'hhc_add_opt_in' );
}
