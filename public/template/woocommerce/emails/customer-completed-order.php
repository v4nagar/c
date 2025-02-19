<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get the original date created (assuming it returns a date string)
$dateCreated = $order->get_date_created(); 

// Convert to DateTime object
$date = new DateTime($dateCreated);

// Set the time zone to IST (Indian Standard Time)
$istTimezone = new DateTimeZone('Asia/Kolkata');
$date->setTimezone($istTimezone);

// Format the date in your desired format
$istDateCreated = $date->format("l jS F Y h:i:s A");

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer first name */ ?>

<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>
<?php /* translators: %s: Order number */ ?>

<?php 
	$order_id = $order->get_id();
    $transaction_id = $order->get_transaction_id();
	//echo json_encode($transaction_id); exit;
	$amount = wc_price($order->get_total());
	$date = $istDateCreated;
	$key = $order->get_order_key();
	$url = site_url("/checkout/order-received/$order_id/?key=$key");

    $form_name = Form::college_get_order_meta($order_id, "form_name", true);

	if ($form_name == MLV_FORMS_ARRAY['degree']['id']) {
		$form_name =  MLV_FORMS_ARRAY['degree']['title'];
	}
	if ($form_name == MLV_FORMS_ARRAY['tt_cc']['id']) {
		$form_name =  MLV_FORMS_ARRAY['tt_cc']['title'];
	}
	if ($form_name == MLV_FORMS_ARRAY['studying_certificate']['id']) {
		$form_name =  MLV_FORMS_ARRAY['studying_certificate']['title'];
	}
	if ($form_name == MLV_FORMS_ARRAY['cdc_fee']['id']) {
		$form_name =  MLV_FORMS_ARRAY['cdc_fee']['title'];
	}
	if ($form_name == MLV_FORMS_ARRAY['cdc_fee_geography']['id']) {
		$form_name =  MLV_FORMS_ARRAY['cdc_fee_geography']['title'];
	}


?>
<p>	Your '<?= esc_html($form_name) ?>' has been successfully submitted. The amount of <?= $amount ?> has been received by us. </p>
<p> Here are transaction details. </p>
<p> Date: <?= esc_html( $date ) ?> </p>
<p> Transaction Id: <?= $order_id ?>/<?= $transaction_id ?> </p>
<p>Next steps:<br>
Take print out of the application form and submit it to the college along with the required documents.
</p>

<a href="<?= $url ?>">Click here to view/print application form</a>

<?php
//esc_html( $order->get_order_number() )

?>
<?php

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
