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

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer first name */ ?>

<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>
<?php /* translators: %s: Order number */ ?>

<?php 
	$order_id = $order->get_id();
	$form_name = Form::college_get_order_meta($order_id, "form_name", true);
	$amount = $order->get_total(); 
	$date = date( 'm.d.Y', strtotime( $order->get_date_created() ) );
	$key = $order->get_order_key();
	$url = site_url("/checkout/order-received/$order_id/?key=$key");

?>
<p>	Your <?= esc_html( $form_name) ?> has been successfully submitted. The amount of Rs. <?= esc_html( $amount ) ?> has been received by us. </p>
<p> Here are transaction details. </p>
<p> Date: <?= esc_html( $date ) ?> </p>
<p> Transaction Id: <?= esc_html( $order_id ) ?> </p>

<a href="<?= $url ?>">Click here to view/print application form</a>

<?php
//esc_html( $order->get_order_number() )

?>
<?php

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
