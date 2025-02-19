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
$form_name = Form::college_get_order_meta($order_id, 'form_name', true);
// var_dump($form_name);
$tc_cc_count = Form::college_get_order_meta($order_id, 'tc_cc_count',true);
$cc_count = Form::college_get_order_meta($order_id, 'cc_count',true);
if($tc_cc_count){
    $t_count = '('.$tc_cc_count.')';
}
if($cc_count){
    $c_count = '('.$cc_count.')';
}

$option = MLV_FORMS_ARRAY;
// echo "<pre>"; print_r($option); die;

$match = current(array_filter($option, function($value) use ($form_name) {
    return $value['id'] === $form_name;
}));

$title = $match['title'] ?? $form_name;
?>
<div><?php echo $title; ?></div>
<?php if ($form_name === 'tt_cc_form') {
    ?>
    <div class="button-container">
        <div>
            <a href="<?php echo esc_url(add_query_arg([
                'download_form' => 1,
                'order_id' => $order_id,
                'type' => 'cc'
            ], admin_url('admin.php'))); ?>" target="_blank" class="custom-button">
                CC <?php echo esc_html($c_count); ?>
            </a>
        </div>
        <div>
            <a href="<?php echo esc_url(add_query_arg([
                'download_form' => 1,
                'order_id' => $order_id,
                'type' => 'tc_cc'
            ], admin_url('admin.php'))); ?>" target="_blank" class="custom-button">
                TC&CC <?php echo esc_html($t_count); ?>
            </a>
        </div>
    </div>
        <?php }?>


