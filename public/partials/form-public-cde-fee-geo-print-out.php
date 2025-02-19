<?php
include plugin_dir_path(dirname(__FILE__)) . '/../lib/phpqrcode/qrlib.php';

$form_data = Form::college_get_order_meta($order_id, "form_data", true);
$form_name = Form::college_get_order_meta($order_id, "form_name", true);
$transaction_id = $order->get_transaction_id();
$order = wc_get_order($order_id);
$form = MLV_FORMS_ARRAY['cdc_fee_geography'];
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
$text = 'Name :' . $form_data['name'] . " " . 'Order Id :' . $order_id . '/' . $transaction_id . " " . 'Aadhaar No :' . $form_data['aadhaar'];
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
    <img src='<?= $option["logoUrl"] ?>'>
    <div class="row">
        <div class="col-12 mb-3">
            <h4 class="text-center">
                <!-- Sh. MLV Govt. College, Bhilwara<br> -->
                <?= $form['title'] ?>
            </h4>
        </div>
        <div class="col-6">
            <p class="col m-0  text">Ref No. :
                <?= $order_id ?>/
                <?= $transaction_id ?>
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
        <div class="col-6">
            <div class="mb-4 form_heading d-flex justify-content-end">
                <img class="form_QR_code" src='<?= $url ?>' style="width: 100px">
            </div>
        </div>
    </div>

    <div id="app_body" class="row mt-2">
        <div class="col-12">
            <p class="">
                <b>Dear Sir,</b><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please accept the <b>Hard Copy of
                    Examination Form</b> & oblige.<br>
                Details are given below.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thanking
                you.
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
                <td class="p-1 border border-1 border-dark" scope="row">1.</td>
                <td class="p-1 border border-1 border-dark">Full Name</td>
                <td class="p-1 border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['name'])) ?>
                </td>
            </tr>
            <tr>
                <td class="p-1 border border-1 border-dark" scope="row">2.</td>
                <td class="p-1 border border-1 border-dark">Father's Name</td>
                <td class="p-1 border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['father'])) ?>
                </td>
            </tr>
            <tr>
                <td class="p-1 border border-1 border-dark" scope="row">3.</td>
                <td class="p-1 border border-1 border-dark">Mother's Name</td>
                <td class="p-1 border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['mother'])) ?>
                </td>
            </tr>
            <tr>
                <td class="p-1 border border-1 border-dark" scope="row">4.</td>
                <td class="p-1 border border-1 border-dark">Date of Birth</td>
                <td class="p-1 border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['dob'])) ?>
                </td>
            </tr>
            <tr>
                <td class="p-1 border border-1 border-dark" scope="row">5.</td>
                <td class="p-1 border border-1 border-dark">Name of Class for which examination form filled</td>
                <td class="p-1 border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['class_name'])) ?>
                </td>
            </tr>
            <tr>
                <td class="p-1 border border-1 border-dark" scope="row">6.</td>
                <td class="p-1 border border-1 border-dark">Date of submission of the form</td>
                <td class="p-1 border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['d_submission'])) ?>
                </td>
            </tr>
            <tr>
                <td class="p-1 border border-1 border-dark" scope="row">7.</td>
                <td class="p-1 border border-1 border-dark">University Examination Form No.</td>
                <td class="p-1 border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['form_no'])) ?>
                </td>
            </tr>
            <tr>
                <td class="p-1 border border-1 border-dark" scope="row">8.</td>
                <td class="p-1 border border-1 border-dark">Mobile No.</td>
                <td class="p-1 border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['mobile'])) ?>
                </td>
            </tr>
            <tr>
                <td class="p-1 border border-1 border-dark" scope="row">9.</td>
                <td class="p-1 border border-1 border-dark">AADHAAR No.</td>
                <td class="p-1 border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['aadhaar'])) ?>
                </td>
            </tr>
            <tr>
                <td class="p-1 border border-1 border-dark" scope="row">10.</td>
                <td class="p-1 border border-1 border-dark">E-mail ID</td>
                <td class="p-1 border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['email'])) ?>
                </td>
            </tr>
            <tr>
                <td class="p-1 border border-1 border-dark" scope="row">11.</td>
                <td class="p-1 border border-1 border-dark">Present Address</td>
                <td class="p-1 border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['pre_address'])) ?>
                </td>
            </tr>
            <tr>
                <td class="p-1 border border-1 border-dark" scope="row">12.</td>
                <td class="p-1 border border-1 border-dark">Permanent Address</td>
                <td class="p-1 border border-1 border-dark">
                    <?= strtoupper(esc_html($form_data['per_address'])) ?>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row mt-2 border-bottom border-dark border-2">
        <div class="col mt-5">
            <p class="text text-end">
                Signature of the Candidate<br>
                Name :- <?= strtoupper(esc_html($form_data['name'])) ?> 
            </p>
        </div>
        <div class="col-12">
            <p class="mt-5 mb-3">Cashier's Signature </p>
        </div>
        <div class='col mb-3'>Signature Academic section Staff </div>
        <div class='col mb-3 text-end'>Principal </div>
    </div>
    <p><b>Note:- Attach this format with examination form.</b></p>
    <button class="m-2" onclick='window.print()'>Print</button>
</div>
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
</style>