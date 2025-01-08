<?php
include plugin_dir_path(dirname(__FILE__)) . '/../lib/phpqrcode/qrlib.php';

$form_data = $created_at;
$form_name = $name;
$transaction_id = $fid;
$mobile_num = $mo_number;
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
//$text = 'Name :' . $form_data['name'] . " " . 'Order Id :' . $mobile_num . '/' . $transaction_id . " " . 'Aadhaar No :' . $form_data['aadhaar'];
$file_name = $mobile_num . ".png";
$file = $path . $file_name;
$fileurl = $upload['baseurl'] . '/mlv_fee_portal/' . $form_name . '/' . $file_name;
$ecc = 'L';
$pixel_Size = 10;
$frame_Size = 10;
// if (file_exists($file)) {
//     $url = $fileurl;
// } else {
//     QRcode::png($text, $file, $ecc, $pixel_Size, 2);
//     $url = $fileurl;
// }

// Get the original date created (assuming it returns a date string)
$dateCreated = $created_at; 

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
    <style>
        .MLV_gobv_form {
            font-size: 14px; /* Increased font size */
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid black; /* Add border to the form */
            padding: 20px;
            margin: 15px;
        }
        .MLV_gobv_form .row {
            width: 100%;
            margin: 8px 0;
            display: flex;
            justify-content: space-between;
        }
        .MLV_gobv_form table {
            width: 80%; /* Adjusted table width to be smaller */
            border-collapse: collapse;
            margin: 8px 0;
        }
        .MLV_gobv_form table, .MLV_gobv_form th, .MLV_gobv_form td {
            border: 3px solid lightgray; /* Light border color */
            padding: 10px; /* Added padding */
        }
        .MLV_gobv_form th, .MLV_gobv_form td {
            text-align: left;
            font-size: 16px; /* Increased font size for table fields */
        }
        .MLV_gobv_form h4, .MLV_gobv_form p, .MLV_gobv_form .row .col {
            text-align: center;
            padding: 5px;
        }
        .MLV_gobv_form .col {
            flex: 1;
        }
        .MLV_gobv_form .left-align {
            text-align: left;
            padding-left: 20px;
        }
        .MLV_gobv_form .right-align {
            text-align: right;
            padding-right: 20px;
        }
        .MLV_gobv_form button {
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 14px; /* Increased font size */
        }
    </style>
    <img src='<?= $option["logoUrl"] ?>'>
    <div class="row">
        <p class="left-align" style="flex: 1;">Ref No. : <!-- <?= $order_id ?>/ --><?= $fid ?></p>
        <p class="right-align" style="flex: 1;">Date : <?= $created_at ?></p>
    </div>
    <h4 class="text-center">
        <!-- Sh. MLV Govt. College, Bhilwara<br> -->
        Application Form of Refund For Duplicate Payment
    </h4>
    <table>
        <tr>
            <td style="padding:10px !important;">Student Name :</td>
            <td><?= $name ?></td>
        </tr>
        <tr>
            <td style="padding:10px !important;">Mobile Number :</td>
            <td><?= $mo_number ?></td>
        </tr>
        <tr>
            <td style="padding:10px !important;">1st Payment reference number :</td>
            <td><?= $payment_ref ?></td>
        </tr>
        <tr>
            <td style="padding:10px !important;">2nd Payment Reference Number :</td>
            <td><?= $dup_payment_ref ?></td>
        </tr>
        <tr>
            <td style="padding:10px !important;">2nd Payment Date :</td>
            <td><?= $p_date ?></td>
        </tr>
        <tr>
            <td style="padding:10px !important;">2nd Paid For :</td>
            <td><?= $paid_for ?></td>
        </tr>
        <tr>
            <td style="padding:10px !important;">2nd Paid Amount :</td>
            <td><?= $paid_amount ?></td>
        </tr>
        <tr>
            <td style="padding:10px !important;">Reason For Refund :</td>
            <td><?= $reason_refund ?></td>
        </tr>
    </table>
    <br>
    <div class="row">
        <div class="left-align">Cashier's Signature</div>
        <div class="right-align">Date</div>
    </div>
    <br>
    <div class="row">
        <div class="left-align">Signature (Academic Section Staff)</div>
        <div class="right-align">Principal</div>
    </div>
    <p class="m-0 p-0 text"><b>Note:- Attach PrintOut of Both Payment Receipt</b></p>
	<hr/>
	<p class="text">Powered by Bitss Techniques, Bhilwara </p>
    <button onclick="window.print()">Print</button>
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