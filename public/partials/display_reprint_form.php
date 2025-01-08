<?php
  
?>
<div class="container">

    <!-- <img src='/wp-content/plugins/form/public/partials/images/mlv.jpg' alt='MLV Gov. College'>

    <h5 class="m-5 text-center">TC/CC Form</h5> -->
    <h2 class="bt_form_heading">
           Check Status & Reprint
    </h2>
    <div class="mlv_loading_btn spinner-border d-none" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>

    <form class="mt-5" method="POST" action="">
        <?php wp_nonce_field('reprint_form'); ?>

        <?php if($action == "") : ?>
            <input type="hidden" name="action" value="sendotp"/>
            <div class="mb-3">
                <label for="mobile_number" class="form-label">Mobile Number :</label>
                <input type="text" class="form-control form-control-sm" name="mobile_number" placeholder="Enter your mobile number"
                    minlength="10" maxlength="10" required>
            </div>
            <div class="mb-3">
            <button style="width:100%" type="submit" class="button" >Send OTP</button>
            </div>
        <?php elseif($action == "sendotp" || $action == "verifyotp") : ?>
            <input type="hidden" name="action" value="verifyotp"/>
            <input type="hidden" name="mobile_number" value="<?= $mobile_number ?>"/>
            <div class="mb-3">
                <label for="otp" class="form-label">We've sent a code to <?= $mobile_number ?></label>
                <input type="text" class="form-control form-control-sm" name="otp" placeholder="Enter OTP received on your mobile"
                    minlength="4" maxlength="4" required>
            </div>
            <div class="mb-3">
                <?= $otp_verify_status ?>
            </div>
            <div class="mb-3">
            <button style="width:100%" type="submit" class="button" >Verify OTP</button>
        <?php elseif($action == "verified") :?>
            <table>
                <?php foreach ($ar_orders as $order_id) : 
                    $order = wc_get_order( $order_id ); 
                    $key = $order->get_order_key(); 
                    $transaction_id = $order->get_transaction_id();
                    $url = '<a href="/checkout/order-received/'.$order_id.'/?key='.$key.'">View/Print</a>'; 

                    $form_name = "-";
                    foreach( $order->get_items() as $order_item ) {
                        $form_name =  $order_item ->get_name();
                        break;
                    }
                    ?>
                <tr>
                    <td>
                    <?= $order_id ?>/<?= $transaction_id ?>
                    </td>
                    <td>
                        <?= $form_name  ?>
                    </td>
                    <td>
                        <?= wc_price($order->get_total()); ?>
                    </td>
                    <td>
                        <?= wc_get_order_status_name($order->get_status()); ?>
                    </td>
                    <td>
                        <?= $order->get_status()=="completed"? $url : "-" ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </table>
            <?php if(sizeof($ar_orders)<1) : ?>
                -- No record found for this mobile number --
            <?php endif ?>
        <?php endif ?>



    </form>
</div>