<?php
include plugin_dir_path(dirname(__FILE__)) . '/../lib/phpqrcode/qrlib.php';

$form_data = Form::college_get_order_meta($order_id, "form_data", true);
$form_name = Form::college_get_order_meta($order_id, "form_name", true);
$form = MLV_FORMS_ARRAY['degree'];

if ($form_name == MLV_FORMS_ARRAY['degree_2']['id']) {
	$form = MLV_FORMS_ARRAY['degree_2'];
}
$transaction_id = $order->get_transaction_id();
$order = wc_get_order($order_id);

$upload = wp_upload_dir();
$upload_dir = $upload['basedir'];
$upload_dir = $upload_dir . '/mlv_fee_portal/';
if (! is_dir($upload_dir)) {
   mkdir( $upload_dir, 0700 );
}
$upload_dir = $upload_dir . $form_name . '/';
if (! is_dir($upload_dir)) {
   mkdir( $upload_dir, 0700 );
}

$path = $upload_dir;
$text ='Name :' .$form_data['name']  ." ". 'Order Id :' . $order_id . '/' . $transaction_id ." ". 'Aadhaar No :' . $form_data['aadhaar'];
$file_name = $order_id . ".png";
$file = $path . $file_name;
$fileurl = $upload['baseurl'] . '/mlv_fee_portal/' . $form_name . '/' . $file_name;
$ecc = 'L';
$pixel_Size = 10;
$frame_Size = 10;
if (file_exists($file)) {
    $url = $fileurl;
} else {
    QRcode::png($text, $file, $ecc, $pixel_Size, 2);
    $url = $fileurl;
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

$option = get_option('fee_portal_settings');

?>
<div class="MLV_gobv_form fontsize">
	<img src='<?= $option["logoUrl"]?>'>
	<div class="row pt-1">
		<div class="col-12">
            <h4 class="text-center">
				<!-- Sh. MLV Govt. College, Bhilwara<br> -->
				<?= $form['title'] ?>
			</h4>
        </div> 
		<div class="col-8 pt-3">
			<p class="col m-0  text">Ref No. :
				<?= $order_id ?>/<?=  $transaction_id  ?>
			</p>
			<p class="col m-0  text">Paid Amount :
				<?= wc_price($order->get_total()); ?>
			</p>
			<p class="col m-0  text">Date :
				<?= $istDateCreated ?>
			</p>
			<p class="col m-0  text">Paid Through :
				<?= $order->get_payment_method(); ?>
			</p>
		</div>
		<div class="col-4 pt-3">
			<img class="form_QR_code" src='<?= $url ?>' style="width: 100px;float:right">
		</div>
	</div>
	<div class="mb-4 form_heading d-flex justify-content-end">

	</div>
	<p class=' text'>I <b class="bt_border_bottom">
			<?= strtoupper(esc_html($form_data['name'])) ?>
		</b> S/o or D/o <b class="bt_border_bottom">
			<?= strtoupper(esc_html($form_data['f_name'])) ?>
		</b> solemnly declare that I appeared in <b class="bt_border_bottom">
			<?= strtoupper(esc_html($form_data['appeared'])) ?>
		</b> (Class) main/supplementary <b class="bt_border_bottom">
			<?= strtoupper(esc_html($form_data['exam'])) ?>
		</b> (name of Examination with Year) of the Mohanlal Sukhadia University, Udaipur with Roll No. <b class="bt_border_bottom">
			<?= strtoupper(esc_html($form_data['roll_no'])) ?>
		</b> from Maharana Pratap Govt. PG College, Chittorgarh center as <b class="bt_border_bottom">
			<?= strtoupper(esc_html($form_data['student'])) ?>
		</b> (Regular/Ex/Non-collegiate) candidate and have been declared successful in <b class="bt_border_bottom">
			<?= strtoupper(esc_html($form_data['pass'])) ?>
		</b> (Pass/Division).
	</p>
	<div class='py-5 row border-bottom border-dark border-2 '>
		<div class='col-6'>
			<section class='mb-4 p-2 border border-dark border-2' style="display:none">
				<p class=' text'>
					His/Her signature given below in my presence is attested. He/She is the right claimant for obtaining the degree.
				</p>
				<br><br><br>
				<p class=' text text-end'>
					Signature with seal of Class I Magistrate /<br>
					Notary Public / Gazetted Officer. 
				</p>
			</section>
			<section class='p-2 border border-dark border-2'>
				<p class=' text'>Information given above are verified.</p>
				<br><br>
				<p class=' text text-end'>Signature <br> Academic Section Staff</p>
			</section>
		</div>
		<div class='col-6'>
			<section class='p-3  text'>
				<br><br>
				<p class="text-end">Signature of the Candidate with Date</p>
				<br>
				<p class="text-end">Name :- <b class="bt_border_bottom" class='text-right'>
						<?= strtoupper(esc_html($form_data['name'])) ?>
					</b> </p>
				<p class="text-end">Full Address :- <b class="bt_border_bottom" class='text-right'>
						<?= strtoupper(esc_html($form_data['address'])) ?>
					</b> </p>
				<p class="text-end">Mobile No. :- <b class="bt_border_bottom" class='text-right'>
						<?= strtoupper(esc_html($form_data['mobile'])) ?>
					</b> </p>
				<p class="text-end">Email Id :- <b class="bt_border_bottom" class='text-right'>
						<?= strtoupper(esc_html($form_data['email'])) ?>
					</b> </p>
				<p class="text-end">AADHAAR No. :- <b class="bt_border_bottom" class='text-right'>
						<?= strtoupper(esc_html($form_data['aadhaar'])) ?>
					</b> </p>
			</section>
		</div>
	</div>

	<p><b>Note:- Attach Photocopy of Mark Sheet of Final Year Examination of UG/PG and AADHAAR Card.</b></p>
	<hr/>
	<p class="text">Powered by Bitss Techniques, Bhilwara </p>
	<button onclick='window.print()'>Print</button> 
</div>
<style>
.woocommerce-order > ul,
.woocommerce-order > section,
.footer-nav-widgets-wrapper {
  display: none;
}
.woocommerce-order > p:first-of-type {
  display: none;
}
.woocommerce-order > p:last-of-type {
  padding: 15px 0px;
}
.woocommerce-order-received table tr {
  height: 25px !important;
}
.woocommerce-order > p:nth-child(2) {
  display: none;
}
</style>