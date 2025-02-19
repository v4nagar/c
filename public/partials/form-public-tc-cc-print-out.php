<?php
include plugin_dir_path(dirname(__FILE__)) . '/../lib/phpqrcode/qrlib.php';

$form_data = Form::college_get_order_meta($order_id, "form_data", true);
$form_name = Form::college_get_order_meta($order_id, "form_name", true);
$transaction_id = $order->get_transaction_id();
$order = wc_get_order($order_id);
$form = MLV_FORMS_ARRAY['tt_cc'];
$upload = wp_upload_dir();
$upload_dir = $upload['basedir'];
$upload_dir = $upload_dir . '/mlv_fee_portal/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0700);
}
$upload_dir = $upload_dir . $form_name . '/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0700);
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

<div id="MLV_gobv_tc_cc_form" class="MLV_gobv_form fontsize">
	<img src='<?= $option["logoUrl"] ?>'>
    <div class="row">
        <h4 class="text-center">
				<!-- Sh. MLV Govt. College, Bhilwara<br> -->
				<?= $form['title'] ?>
			</h4> 
        <div class="col-8 ">
            <p class="col m-0 text">Ref No. :
                <?= $order_id ?>/
                <?= $transaction_id ?>
            </p>
            <p class="col m-0 text">Paid Amount :
                <?= wc_price($order->get_total()); ?>
            </p>
            <p class="col m-0 text">Date :
                <?= $istDateCreated ?>
            </p>
            <p class="col m-0 text">Paid Through :
                <?= $order->get_payment_method(); ?>
            </p>
        </div>
        <div class="col-4">
            <div class="form_heading d-flex justify-content-end">
                <img class="form_QR_code" src='<?= $url ?>' style="width: 100px">
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-12">
            <p class="m-0">
                <b>Dear Sir,</b><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please issue my <b>TC/CC</b> & oblige.<br> Details are given below.<br> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thanking you.
            </p>
        </div>
    </div>

    <table class=" p-0 m-0">
        <thead>
            <tr>
                <th class="border border-1 border-dark" scope="col">S.No.</th>
                <th class="border border-1 border-dark" scope="col">Particulars</th>
                <th class="border border-1 border-dark" scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-1 border-dark" scope="row">1.</td>
                <td class="border border-1 border-dark">Full Name</td>
                <td class="border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['name'])) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-1 border-dark" scope="row">2.</td>
                <td class="border border-1 border-dark">Father's Name</td>
                <td class="border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['father'])) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-1 border-dark" scope="row">3.</td>
                <td class="border border-1 border-dark">Mother's Name</td>
                <td class="border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['mother'])) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-1 border-dark" scope="row">4.</td>
                <td class="border border-1 border-dark">Name of Class & Faculty in Which Admitted</td>
                <td class="border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['faculty'])) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-1 border-dark" scope="row">5.</td>
                <td class="border border-1 border-dark">Date of Admission in the College</td>
                <td class="border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['d_admission'])) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-1 border-dark" scope="row">6.</td>
                <td class="border border-1 border-dark">Name of Examination Last Passed Out</td>
                <td class="border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['d_exam'])) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-1 border-dark" scope="row">7.</td>
                <td class="border border-1 border-dark">Date of Birth</td>
                <td class="border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['dob'])) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-1 border-dark" scope="row">8.</td>
                <td class="border border-1 border-dark">Mobile No.</td>
                <td class="border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['mobile'])) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-1 border-dark" scope="row">9.</td>
                <td class="border border-1 border-dark">AADHAAR No.</td>
                <td class="border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['aadhaar'])) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-1 border-dark" scope="row">10.</td>
                <td class="border border-1 border-dark">E-mail ID</td>
                <td class="border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['email'])) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-1 border-dark" scope="row">11.</td>
                <td class="border border-1 border-dark">Present Address</td>
                <td class="border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['pre_address'])) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-1 border-dark" scope="row">12.</td>
                <td class="border border-1 border-dark">Permanent Address</td>
                <td class="border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['per_address'])) ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="row m-0 p-0">        
        <p class="text text-end mb-0">
            <br>Signature of the Candidate with Date<br>
            Name :- <?= strtoupper(esc_html($form_data['name'])) ?> 
        </p>
    </div>

    <p class=' m-0 text-center'>Academic Record</p>
    <table class=" m-0 border border-1 border-dark">
        <thead>
            <tr>
                <th class="border border-dark border-1" scope="col">S.NO.</th>
                <th class="border border-dark border-1" scope="col">Session</th>
                <th class="border border-dark border-1" scope="col">Class</th>
                <th class="border border-dark border-1" scope="col">Roll No.</th>
                <th class="border border-dark border-1" scope="col">Result <br>Pass/Fail</th>
                <th class="border border-dark border-1" scope="col">Date of Leaving the College <br>(to be filled in by the College office)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-dark border-1" scope="col">1.</td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['s_one']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['c_one']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['rn_one']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['pf_one']) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-dark border-1" scope="col">2.</td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['s_two']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['c_two']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['rn_two']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['pf_two']) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-dark border-1" scope="col">3.</td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['s_three']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['c_three']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['rn_three']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['pf_three']) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-dark border-1" scope="col">4.</td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['s_four']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['c_four']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['rn_four']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['pf_four']) ?>
                </td>
            </tr>
            <tr>
                <td class="border border-dark border-1" scope="col">5.</td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['s_five']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['c_five']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['rn_five']) ?>
                </td>
                <td class="border border-dark border-1" scope="col">
                    <?= esc_html($form_data['pf_five']) ?>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <div class="row ">
        <div class="col-8">Cashier's Signature <br> TC/CC No. (To be filled in by the College office) </div>
        <div class="col">Date </div>
    </div>
    <br>
    <div class="row ">
        <div class="col-10">Signature (Academic Section Staff) </div>
        <div class="col">Principal </div>
    </div>
    <p class="m-0 p-0 text"><b>Note:- Attach Photocopies of Mark Sheets (All University Examinations) & AADHAAR Card.</b>
    </p>
	<hr/>
	<p class="text">Powered by Bitss Techniques, Bhilwara </p>
    <button onclick='window.print()'>Print</button>
</div>
<!-- <div id="editor"></div> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<button id='download_tc_cc'>Download pdf</button> 

<style>
    .woocommerce-order>ul,
    .woocommerce-order>section,
    .footer-nav-widgets-wrapper {
        display: none;
    }

    .woocommerce-order>p:first-of-type {
        display: none;
    }

    .woocommerce-order>p:last-of-type {
        padding: 15px 0px;
    }

    .woocommerce-order-received table tr {
        height: 25px !important;
    }

    .woocommerce-order>p:nth-child(2) {
        display: none;
    }
	 .academic_record_table th{
      font-size:12px !important;
    }
	 @media print {
        .fontsize {
            font-size: 10px;
        }
    }
    .bt_form_heading{
        text-align: center;
        font-size: 20px !important;
    }
</style>