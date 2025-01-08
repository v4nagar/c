<style>
    /* Container styles */
    .button-container {
        display:flex;
        gap: 5px; /* Space between buttons */
        margin: 5px;
    }

    /* Button styles */
    .custom-button {
        padding: 2px 4px;
        border: none;
        background: #c6e1c6;
        cursor: pointer;
    }

    /* Hover effect */
    .custom-button:hover {
        background: #c6e1c6;
    }

</style>

<?php
$form_name = get_post_meta($order_id, 'form_name', true);
var_dump($form_name);
$tc_cc_count = get_post_meta($order_id, 'tc_cc_count',true);
$cc_count = get_post_meta($order_id, 'cc_count',true);
if($tc_cc_count){
    $t_count = '('.$tc_cc_count.')';
}
if($cc_count){
    $c_count = '('.$cc_count.')';
}
?>
    <?php
    if($form_name == 'tt_cc_form'){
        ?>
        <div>TC & CC Form</div>
        <div class="button-container">
            <div>
                <a href="<?php echo esc_url(add_query_arg([
                'download_form' => 1,
                'order_id' => $order_id,
                'type' => 'cc'
                ], admin_url('admin.php'))); ?>" target="_blank" class="custom-button">CC <?php echo $c_count ?></a>
            </div>
            <div>
                <a href="<?php echo esc_url(add_query_arg([
                'download_form' => 1,
                'order_id' => $order_id,
                'type' => 'tc_cc'
                ], admin_url('admin.php'))); ?>" target="_blank" class="custom-button">TC&CC <?php echo $t_count ?></a>
            </div>
        </div>
    <?php }elseif($form_name=='degree_form'){ ?>
        <div>Degree Form</div>
    <?php }elseif($form_name=='studying_certificate_form'){ ?>
        <div>Studying Certificate Form</div>
    <?php }elseif($form_name=='cdc_fee_form'){ ?>
        <div>CDC Fee Form</div>
    <?php }elseif($form_name=='cdc_fee_geography_form'){ ?>
        <div>CDC Fee Geography Form</div>
    <?php } ?>




    <?php 