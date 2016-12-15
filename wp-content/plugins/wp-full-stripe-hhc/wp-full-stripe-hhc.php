<?php
/**
 * Plugin Name: WP Full Stripe HHC
 * Description: This plugin adds extra fields to WP Full Stripe Payment Form.
 * Version: 1.0.1
 * License: GPL2
 */
 
define( 'PLUGIN_VERSION', '1.0.1' );

include( dirname( __FILE__ ).'/libs/simple_html_dom.php');

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

global $hhc_payments_db_version;
$hhc_payments_db_version = '1.0';

function alter_hhc_payments_table() {
	global $wpdb;
	global $hhc_payments_db_version;

	$table_name = $wpdb->prefix . 'fullstripe_payments';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE " . $table_name . " (
	paymentID INT NOT NULL AUTO_INCREMENT,
	eventID VARCHAR(100) NOT NULL,
	description VARCHAR(255) NOT NULL,
	paid TINYINT(1),
	livemode TINYINT(1),
	currency VARCHAR(3) NOT NULL,
	amount INT NOT NULL,
	fee INT NOT NULL,
	addressLine1 VARCHAR(500) NOT NULL,
	addressLine2 VARCHAR(500) NOT NULL,
	addressCity VARCHAR(500) NOT NULL,
	addressState VARCHAR(255) NOT NULL,
	addressZip VARCHAR(100) NOT NULL,
	addressCountry VARCHAR(100) NOT NULL,
	created DATETIME NOT NULL,
	stripeCustomerID VARCHAR(100),
	name VARCHAR(100),
	email VARCHAR(255) NOT NULL,
	formId INT,
	formType VARCHAR(30),
	hhc_address VARCHAR(255) NOT NULL,
	hhc_gift TINYINT(1),
	hhc_by_post TINYINT(1),
	hhc_by_email TINYINT(1),
	UNIQUE KEY paymentID (paymentID)
	);";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'hhc_payments_db_version', $hhc_payments_db_version );
}

register_activation_hook( __FILE__, 'alter_hhc_payments_table' );


add_filter( 'fullstripe_insert_payment_data', 'fix_insert_payment_data', 10, 2 );
function fix_insert_payment_data( $data )
{
	$data['hhc_address'] = sanitize_text_field($_POST['fullstripe_address']);
	$data['hhc_gift'] = abs((int)sanitize_text_field( $_POST['fullstripe_gift']));
	$data['hhc_by_email'] = abs((int)sanitize_text_field( $_POST['fullstripe_opt_in_by_email']));
	$data['hhc_by_post'] = abs((int)sanitize_text_field( $_POST['fullstripe_opt_in_by_post']));
	return $data;
}

add_action( 'wp_enqueue_scripts', 'full_stripe_hhc_styles' );
function full_stripe_hhc_styles() 
{
	wp_enqueue_style( 'hhc-form-style', plugin_dir_url( __FILE__ ).'css/form-style.css', null, PLUGIN_VERSION );
}
 
 
add_filter( 'fullstripe_payment_form_output', 'fix_payment_form_output', 10, 2 );
function fix_payment_form_output( $content )
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
					$strExtraFields .= '<textarea class="input-xlarge fullstripe-form-input" name="fullstripe_address" id="fullstripe_address__'.$strFormName.'" data-stripe="address"></textarea>';
				$strExtraFields .= '</div>';
			$strExtraFields .= '</div>';
		}

		if(esc_attr( get_option('hhc_add_gift_declaration') ) == 1)
		{
			$strExtraFields .= '<div class="control-group">';
				$strExtraFields .= '<label class="control-label fullstripe-form-label">Gift Aid Declaration</label>';
				$strExtraFields .= '<div class="controls">';
					$strExtraFields .= '<input type="checkbox" class="input-xlarge fullstripe-form-input" value="1" name="fullstripe_gift" id="fullstripe_gift__'.$strFormName.'">';
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
					$strExtraFields .= '<input type="checkbox" class="input-xlarge fullstripe-form-input" value="1" name="fullstripe_opt_in_by_email" id="fullstripe_opt_in_by_email__'.$strFormName.'">';
				$strExtraFields .= '</div>';
			$strExtraFields .= '</div>';


			$strExtraFields .= '<div class="control-group">';
				$strExtraFields .= '<label class="control-label fullstripe-form-label">By post</label>';
				$strExtraFields .= '<div class="controls">';
					$strExtraFields .= '<input type="checkbox" class="input-xlarge fullstripe-form-input" value="1" name="fullstripe_opt_in_by_post" id="fullstripe_opt_in_by_post__'.$strFormName.'">';
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
	add_menu_page('Full Stripe HHC Preview', 'Full Stripe Payments Preview', 'administrator', 'full-stripe-hhc-preview', 'full_stripe_hhc_preview_page', 'dashicons-admin-generic');
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

function full_stripe_hhc_preview_page() 
{
?>
			<div class="" id="payments">
				<h2>
					Full Stripe Payments Preview
				</h2>
				<form method="get">
					<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
					<label><?php _e( 'Customer: ', 'wp-full-stripe' ); ?></label><input type="text" name="customer" size="35" placeholder="<?php _e( 'Enter name, email address, or stripe ID', 'wp-full-stripe' ); ?>" value="<?php echo isset( $_REQUEST['customer'] ) ? $_REQUEST['customer'] : ''; ?>">
					<label><?php _e( 'Payment: ', 'wp-full-stripe' ); ?></label><input type="text" name="payment" placeholder="<?php _e( 'Enter charge ID', 'wp-full-stripe' ); ?>" value="<?php echo isset( $_REQUEST['payment'] ) ? $_REQUEST['payment'] : ''; ?>">
					<label><?php _e( 'Mode: ', 'wp-full-stripe' ); ?></label>
					<select name="mode">
						<option value="" <?php echo ! isset( $_REQUEST['mode'] ) || $_REQUEST['mode'] == '' ? 'selected' : ''; ?>><?php _e( 'All', 'wp-full-stripe' ); ?></option>
						<option value="live" <?php echo isset( $_REQUEST['mode'] ) && $_REQUEST['mode'] == 'live' ? 'selected' : ''; ?>><?php _e( 'Live', 'wp-full-stripe' ); ?></option>
						<option value="test" <?php echo isset( $_REQUEST['mode'] ) && $_REQUEST['mode'] == 'test' ? 'selected' : ''; ?>><?php _e( 'Test', 'wp-full-stripe' ); ?></option>
					</select>
					<span class="wpfs-search-actions">
						<button class="button button-primary"><?php _e( 'Search', 'wp-full-stripe' ); ?></button> <?php _e( 'or', 'wp-full-stripe' ); ?>
						<a href="<?php echo admin_url( 'admin.php?page=fullstripe-payments' ); ?>"><?php _e( 'Reset', 'wp-full-stripe' ); ?></a>
					</span>
					<?php
					
					$fullStripePaymentsPreview = new WPFS_Named_Payments_Table();

					$fullStripePaymentsPreview->prepare_items();
					$fullStripePaymentsPreview->display();
					?>
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




class WPFS_Base_Table extends WP_List_Table {

	const HTTPS_DASHBOARD_STRIPE_COM = "https://dashboard.stripe.com/";
	const PATH_TEST = "test/";
	const PATH_CUSTOMERS = 'customers/';
	const PATH_CHARGES = 'charges/';

	/**
	 * @param $title
	 *
	 * @param $aggregated_columns
	 *
	 * @return string
	 */
	protected function format_column_header_title( $title, array $aggregated_columns = null ) {
		$column_label = "<b>{$title}</b>";
		if ( ! empty( $aggregated_columns ) ) {
			$size = sizeof( $aggregated_columns );
			$column_label .= '<br>';
			foreach ( $aggregated_columns as $key => $value ) {
				$column_label .= $value;
				if ( $key < $size - 1 ) {
					$column_label .= ' / ';
				}
			}
		}

		return $column_label;
	}

	/**
	 * @param $stripe_customer_id
	 * @param $live_mode
	 *
	 * @return string
	 */
	protected function build_stripe_customer_link( $stripe_customer_id, $live_mode ) {
		$href = $this->build_stripe_base_url( $live_mode );
		$href .= self::PATH_CUSTOMERS . $stripe_customer_id;

		return $href;
	}

	protected function build_stripe_charge_link( $stripe_charge_id, $live_mode ) {
		$href = $this->build_stripe_base_url( $live_mode );
		$href .= self::PATH_CHARGES . $stripe_charge_id;

		return $href;
	}

	/**
	 * @param $live_mode
	 *
	 * @return string
	 */
	protected function build_stripe_base_url( $live_mode ) {
		$href = self::HTTPS_DASHBOARD_STRIPE_COM;
		if ( $live_mode == 0 ) {
			$href .= self::PATH_TEST;
		}

		return $href;
	}

	/**
	 * Add extra markup in the toolbars before or after the list
	 *
	 * @param string $which , helps you decide if you add the markup after (bottom) or before (top) the list
	 */
	protected function extra_tablenav( $which ) {
		if ( $which == "top" ) {
			echo '<div class="wrap">';
		}
		if ( $which == "bottom" ) {
			echo '</div>';
		}
	}

}


class WPFS_Named_Payments_Table extends WPFS_Base_Table {

	public function __construct() {
		parent::__construct( array(
			'singular' => __( 'Payment!', 'wp-full-stripe' ),
			'plural'   => __( 'Payments!', 'wp-full-stripe' ),
			'ajax'     => false
		) );
	}

	/**
	 * Prepare the table with different parameters, pagination, columns and table elements
	 */
	public function prepare_items() {
		global $wpdb;

		$query = "SELECT paymentID,eventID,description,paid,livemode,currency,amount,fee,addressLine1,addressLine2,addressCity,addressState,addressZip,addressCountry,created,stripeCustomerID,name,email,formId,formType,hhc_address,hhc_gift,hhc_by_email,hhc_by_post FROM {$wpdb->prefix}fullstripe_payments";

		$where_statement = null;

		$customer = ! empty( $_REQUEST["customer"] ) ? esc_sql( trim( $_REQUEST["customer"] ) ) : null;
		$payment  = ! empty( $_REQUEST["payment"] ) ? esc_sql( trim( $_REQUEST["payment"] ) ) : null;
		$mode     = ! empty( $_REQUEST["mode"] ) ? esc_sql( trim( $_REQUEST["mode"] ) ) : null;

		if ( isset( $customer ) ) {
			if ( ! isset( $where_statement ) ) {
				$where_statement = ' WHERE ';
			} else {
				$where_statement .= ' AND ';
			}
			$where_statement .= sprintf( "(LOWER(name) LIKE LOWER('%s') OR LOWER(email) LIKE LOWER('%s') OR stripeCustomerID LIKE '%s')", "%$customer%", "%$customer%", "%$customer%" );
		}

		if ( isset( $payment ) ) {
			if ( ! isset( $where_statement ) ) {
				$where_statement = ' WHERE ';
			} else {
				$where_statement .= ' AND ';
			}
			$where_statement .= sprintf( "(eventID LIKE '%s')", "%$payment%" );
		}

		if ( isset( $mode ) ) {
			if ( ! isset( $where_statement ) ) {
				$where_statement = ' WHERE ';
			} else {
				$where_statement .= ' AND ';
			}
			$where_statement .= sprintf( '(livemode = %d)', $mode == 'live' ? 1 : 0 );
		}

		if ( isset( $where_statement ) ) {
			$query .= $where_statement;
		}

		$order_by = ! empty( $_REQUEST["orderby"] ) ? esc_sql( $_REQUEST["orderby"] ) : 'created';
		$order    = ! empty( $_REQUEST["order"] ) ? esc_sql( $_REQUEST["order"] ) : ( empty( $_REQUEST['orderby'] ) ? 'DESC' : 'ASC' );
		if ( ! empty( $order_by ) && ! empty( $order ) ) {
			$query .= ' ORDER BY ' . $order_by . ' ' . $order;
		}

		$total_items = $wpdb->query( $query );
		$per_page    = 10;
		$total_pages = ceil( $total_items / $per_page );
		$this->set_pagination_args( array(
			"total_items" => $total_items,
			"total_pages" => $total_pages,
			"per_page"    => $per_page,
		) );
		$current_page = $this->get_pagenum();
		if ( ! empty( $current_page ) && ! empty( $per_page ) ) {
			$offset = ( $current_page - 1 ) * $per_page;
			$query .= ' LIMIT ' . (int) $offset . ',' . (int) $per_page;
		}

		$columns               = $this->get_columns();
		$hidden                = array();
		$sortable              = $this->get_sortable_columns();
		$this->_column_headers = array( $columns, $hidden, $sortable );

		$this->items = $wpdb->get_results( $query );
	}

	/**
	 * Define the columns that are going to be used in the table
	 * @return array $columns, the array of columns to use with the table
	 */
	public function get_columns() {
		return array(
			'customer'       => $this->format_column_header_title( __( 'Customer', 'wp-full-stripe' ), array(
				__( 'Name', 'wp-full-stripe' ),
				__( 'E-mail', 'wp-full-stripe' )
			) ),
			'payment'        => $this->format_column_header_title( __( 'Payment', 'wp-full-stripe' ), array(
				__( 'Amount', 'wp-full-stripe' ),
				__( 'ID', 'wp-full-stripe' )
			) ),
			'payment_status' => $this->format_column_header_title( __( 'Status', 'wp-full-stripe' ), array(
				__( 'Paid', 'wp-full-stripe' ),
				__( 'Mode', 'wp-full-stripe' )
			) ),
			'hhc_address' => $this->format_column_header_title( __( 'Address', 'wp-full-stripe' ) ),
			'hhc_gift' => $this->format_column_header_title( __( 'Gift Aid Declaration', 'wp-full-stripe' ) ),
			'hhc_by_email' => $this->format_column_header_title( __( 'By email', 'wp-full-stripe' ) ),
			'hhc_by_post' => $this->format_column_header_title( __( 'By post', 'wp-full-stripe' ) ),
			'created'        => __( 'Date', 'wp-full-stripe' )
		);
	}

	/**
	 * Decide which columns to activate the sorting functionality on
	 * @return array $sortable, the array of columns that can be sorted by the user
	 */
	protected function get_sortable_columns() {
		return array(
			'created' => array( 'created', false )
		);
	}

	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	public function display_rows() {
		$items = $this->items;

		list( $columns, $hidden ) = $this->get_column_info();

		if ( ! empty( $items ) ) {
			foreach ( $items as $item ) {
				$currency_symbol = MM_WPFS::get_currency_symbol_for( $item->currency );
				$row             = '';
				$row .= "<tr id=\"record_{$item->paymentID}\">";
				foreach ( $columns as $column_name => $column_display_name ) {
					$class = "class=\"$column_name column-$column_name\"";
					$style = "";
					if ( in_array( $column_name, $hidden ) ) {
						$style = " style=\"display:none;\"";
					}
					$attributes = "{$class} {$style}";

					switch ( $column_name ) {
						case "customer":
							$href                 = $this->build_stripe_customer_link( $item->stripeCustomerID, $item->livemode );
							$stripe_customer_link = "<a href=\"{$href}\" target=\"_blank\">{$item->email}</a>";
							$name                 = $item->name;
							if ( ! empty( $name ) ) {
								$name_label = stripslashes( $name );
							} else {
								$name_label = __( '&lt;Not specified&gt;', 'wp-full-stripe' );
							}
							$row .= "<td {$attributes}><b>{$name_label}</b><br/>{$stripe_customer_link}</td>";
							break;
						case "payment":
							$href               = $this->build_stripe_charge_link( $item->eventID, $item->livemode );
							$stripe_charge_link = "<a href=\"{$href}\" target=\"_blank\">{$item->eventID}</a>";
							$amount_label       = sprintf( '%s%0.2f', $currency_symbol, $item->amount / 100 );
							$row .= "<td {$attributes}><b>{$amount_label}</b><br/>{$stripe_charge_link}</td>";
							break;
						case "payment_status":
							$is_paid_label   = $item->paid == 1 ? __( 'Paid', 'wp-full-stripe' ) : __( 'Not Paid', 'wp-full-stripe' );
							$live_mode_label = $item->livemode == 0 ? __( 'Test', 'wp-full-stripe' ) : __( 'Live', 'wp-full-stripe' );
							$row .= "<td $attributes><b>$is_paid_label</b><br/>$live_mode_label</td>";
							break;
						case "hhc_address":
							$row .= "<td $attributes><b>$item->hhc_address</b></td>";
							break;
						case "hhc_gift":
							$isChecked = $item->hhc_gift == 1 ? 'Yes' : 'No';
							$row .= "<td $attributes><b>$isChecked</b></td>";
							break;
						case "hhc_by_email":
							$isChecked = $item->hhc_by_email == 1 ? 'Yes' : 'No';
							$row .= "<td $attributes><b>$isChecked</b></td>";
							break;
						case "hhc_by_post":
							$isChecked = $item->hhc_by_email == 1 ? 'Yes' : 'No';
							$row .= "<td $attributes><b>$isChecked</b></td>";
							break;
						case "created":
							$row .= "<td {$attributes}>" . date( 'F jS Y H:i', strtotime( $item->created ) ) . "</td>";
							break;
						case "action":
							$row .= "<td {$attributes}><button class=\"button delete\" data-id=\"{$item->paymentID}\" data-type=\"payment\" title=\"" . __( 'Delete (local)', 'wp-full-stripe' ) . "\"><i class=\"fa fa-trash-o fa-fw\"></i></button></td>";
							break;
					}

				}

				$row .= '</tr>';

				echo $row;
			}
		}
	}

	private function format_address(
		$rec
	) {
		if ( $rec->addressLine1 == "" ) {
			return "";
		}

		$address = $rec->addressLine1 . ( $rec->addressLine2 == "" ? "" : ", $rec->addressLine2" );
		$address .= $rec->addressCity == "" ? "" : ", $rec->addressCity";
		$address .= $rec->addressState == "" ? "" : ", $rec->addressState";
		$address .= $rec->addressZip == "" ? "" : ", $rec->addressZip";
		$address .= $rec->addressCountry == "" ? "" : ", $rec->addressCountry";

		return $address;

	}

	public function no_items() {
		_e( 'No payments found.', 'wp-full-stripe' );
	}

}
