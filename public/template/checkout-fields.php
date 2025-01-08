<!-- Fixed issue of z-index on checkout page -->
<style>
    form.checkout.woocommerce-checkout {position:relative !important; z-index: 10;}
    main#main {z-index: 101;}
    input#billing_table {cursor: not-allowed;color: #999;background-color: #eaeded;}
</style>

<h5>
    <?php
    if($selected_shipping==="eathere"){
        echo "<h2>Contactless Ordering</h2>";
    }elseif($selected_shipping==="local_pickup"){
        echo "<h2>Pickup Details</h2>";
        //echo "When do you want to pickup?";
    } else{
        echo "<h2>Delivery Details</h2>";
        //echo "When do we send it to you?";
    }
    ?>

</h5>

<?php
if($selected_shipping == 'eathere') {
    if(isset( WC()->session ) && !empty($qr_table = WC()->session->get('qr_table'))) {
        $table_object = explode('__', $qr_table);
    ?>
        <script>
            var session_outlet = '<?php echo str_replace('_', ' ', $table_object[0]) ?>';
            var session_table_no = '<?php echo $table_object[2] ?>';
            jQuery(document).ready(function() {
                if(jQuery('input#billing_table').length == 0) {
                    jQuery( '#customer_details .woocommerce-billing-fields #billing_email_field' ).before( '<p class="form-row validate-required" id="billing_table_field" data-priority="">' +
                        '<label for="billing_table" class="">Location <abbr class="required" title="required">*</abbr></label>' +
                        '<span class="woocommerce-input-wrapper">' +
                        '<input type="text" class="input-text" id="billing_table" placeholder="" value="'+session_table_no+' - '+session_outlet+'">' +
                        '</span></p>' );
                }
            });
        </script>

    <?php } ?>
<script>
    <?php
    if(isset( WC()->session ) && !empty($qr_table = WC()->session->get('qr_table'))) {
        $table_object = explode('__', $qr_table);
    }
    ?>
    var session_outlet = '<?php echo str_replace('_', ' ', $table_object[0]) ?>';
    var session_table_no = '<?php echo $table_object[2] ?>';
    var qr_table = session_table_no + ' - '+ session_outlet;
    console.log('qr_table', qr_table);
    jQuery(document).ready(function() {
        //set default table from session; taken from qr code
        if (qr_table != null || qr_table != '') {
            jQuery('input[name="billing_table"]').val(qr_table);
        }
    });
</script>
<?php
    return;
}
?>

<div class="slot-unavailable">
    <div class="message"></div>
    <div class="next-availability"></div>
</div>

<p class="form-row form-row-wide validate-required <?php echo (WC()->session->get('fdoe_shipping') == 'eathere') ? 'ksetup-hide': '';?>">
    <span class="woocommerce-input-wrapper">
        <label for="later_dates" class=""><?php echo $selected_shipping==="local_pickup"?"Pickup":"Delivery"; ?> Date <abbr class="required" title="required">*</abbr></label>
        <select id ="later_dates" name="later_dates">
            <option value = "">Select Date </option>
        </select>
    </span>
</p>


<p class="form-row form-row-wide validate-required <?php echo (WC()->session->get('fdoe_shipping') == 'eathere') ? 'ksetup-hide': '';?>">
    <span id ="span_later_time" class="woocommerce-input-wrapper">
        <label for="later_time" class="">Time <abbr class="required" title="required">*</abbr></label>
        <select id ="later_time" name="later_time">
            <option value = "">Select Time </option>
        </select>
    </span>
</p>


<script>
    var FirstTimeChange = true;
    <?php
		$_ajax = admin_url('admin-ajax.php');
	?>
    jQuery(document).ready(function(){

        jQuery('#later_dates').html("<option selected>Please wait...</option>");
        jQuery('#later_dates').attr('disabled','disabled');
		jQuery('#later_time').html("<option selected>Select a date...</option>");
		jQuery('#later_time').attr('disabled','disabled');

        var data = {action: 'kaarot_get_schedule_date'};

        jQuery.post('<?php echo($_ajax); ?>', data, function(response) {
			jQuery('#later_dates').html("");
			if(response!=null){

				response= JSON.parse(response);
				//console.log(response.schedule_dates);

				//jQuery('#later_dates').append("<option value =''>Select a date</option>");
				jQuery.each( response.schedule_dates, function( key, value ) {
                    var option = "<option value ='"+key+"'>"+value+"</option>"

                    jQuery('#later_dates').append(option);
                    jQuery('#later_dates').removeAttr('disabled');
                });
                jQuery("#later_dates").trigger("change");
			}

		});

    });
    jQuery('#later_dates').change(function(){
		jQuery('#later_time').html("<option selected>Please wait...</option>");
        jQuery('#later_time').attr('disabled','disabled');
        var selected_date = jQuery('#later_dates').val();
        // if(selected_date!="asap"){
        //     jQuery('#span_later_time').show();
        // }else{
        //     jQuery('#span_later_time').hide();
        // }



		var data = {
			action: 'kaarot_get_schedule_time',
			selected_date: selected_date
		};

		jQuery.post('<?php echo($_ajax); ?>', data, function(response) {

			jQuery('#later_time').html("");
			if(response!=null)
			{
                response= JSON.parse(response);
                if(response.schedule_time.length<1){
                    var option = "<option value =''>No Slots Available</option>";
                    jQuery('#later_time').append(option);
                    if(FirstTimeChange == true){
                        if(response.enable_store_close_popup) {

                            //display store close popup only if the date selector is on the screen
                            if(jQuery('.button.argmc-next').length) {
                                jQuery('.button.argmc-next, .argmc-tab-item').on('click', function () {
                                    setTimeout(function () {
                                        if (jQuery('.argmc-billing-shipping-step').hasClass("current")) {
                                            openModal('storeClosed');
                                        }
                                    }, 500);
                                })
                            } else {
                                openModal('storeClosed');
                            }

                            if (response.next_schedule_time != null) {
                                var slot_message = jQuery('.slot-message').html();
                                jQuery('.slot-unavailable .message').html(slot_message);

                                var next_time = Object.keys(response.next_schedule_time)[0];
                                var slot_text = 'N/A';
                                if(next_time != null) {
                                    slot_text = "<strong>" + next_time + " " + response.next_schedule_time[next_time] + "</strong>";

                                    //this will auto select the next avaialble time in select option
                                    if(jQuery("#later_dates option[value="+next_time+"]").length > 0) {
                                        jQuery("#later_dates option[value="+next_time+"]").prop('selected', true);
                                        jQuery("#later_dates").trigger("change");
                                    }
                                }

                                jQuery('#storeClosed .modal-body .next_time, .slot-unavailable .next-availability')
                                .html("<p>Next available slot: "+slot_text+"</p>");

                            }
                        }
                    }
                }else{
                    if(Object.keys(response.schedule_time)[0] != 'asap' && FirstTimeChange == true){
                        if(response.enable_store_close_popup) {

                            //display store close popup only if the date selector is on the screen
                            if(jQuery('.button.argmc-next').length) {
                                jQuery('.button.argmc-next, .argmc-tab-item').on('click', function () {
                                    setTimeout(function () {
                                        if (jQuery('.argmc-billing-shipping-step').hasClass("current")) {
                                            openModal('storeClosed');
                                        }
                                    }, 500);
                                })
                            } else {
                                openModal('storeClosed');
                            }

                            if (response.next_schedule_time != null) {
                                var slot_message = jQuery('.slot-message').html();
                                jQuery('.slot-unavailable .message').html(slot_message);

                                var next_time = Object.keys(response.next_schedule_time)[0];
                                var slot_text = 'NA';
                                if(next_time != null) {
                                    slot_text = "<strong>" + next_time + " " + response.next_schedule_time[next_time] + "</strong>";
                                }

                                jQuery('#storeClosed .modal-body .next_time, .slot-unavailable .next-availability')
                                .html("<p>Next available slot: "+slot_text+" </p>");
                            }
                        }
                    }

                     jQuery.each( response.schedule_time, function( key, value ) {
                        var option = "<option value ='"+key+"'>"+value+"</option>";
                        jQuery('#later_time').append(option);
                        jQuery('#later_time').removeAttr('disabled');
                    });


                }
                FirstTimeChange = false;
			}
		});

	});

    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        var span = document.getElementsByClassName("closeModal")[0];
        modal.style.display = "block";
        span.onclick = function() {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
</script>

<!-- The Modal -->
<div id="storeClosed" class="modal">
    <div class="modal-content">
        <div class="modal-body">
            <div id="messageContent">
                <div class="message-check">
                    <?php
                    if(!empty(get_option( 'site_icon' ))) {
                        $custom_logo_id = get_option( 'site_icon' );
                        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                        echo '<img src="'.$image[0].'" class="rounded-circle"/>';
                    } else {
                        // Use site title if no image is provided.
                        echo '<span id="kstore-name" class="bg-success text-white">' . get_bloginfo( 'name', 'display' ) . '</span>';
                    }
                    ?>
                </div>
                <div class="message-title">
                    <div class="slot-message">
                        <?php echo get_option('kaarot_printer_settings_slot_unavailable_warning_text','The store is currently closed. Please select the next available time for delivery/ pickup.'); ?>
                    </div>
                    <div class='next_time'></div>
                </div>
                <button type="button" class="kmodal-btn kmodal-btn-success closeModal">OK</button>
            </div>
        </div>
    </div>
</div>

<style>
    .ksetup-hide {
        display: none;
    }
    #messageContent {
        position: relative;
    }
    #messageContent .message-check {
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    #messageContent .message-check img {
        max-width:60px;
        box-shadow: 1px 2px 10px #666;
        border-radius: 50%!important;
    }
    #kstore-name {
        border-radius: 50%;
        font-weight: 500;
        width: 70px;
        display: inline-block;
        height: 70px;
        line-height: 70px;
        text-align: center;
        font-size: 14px;
        overflow: hidden;
        padding: 0 7px;
        box-shadow: 1px 2px 8px #666;
        color: #fff;
        background-color: #DF6423 !important;
    }
    .message-title {
        padding-top: 20px !important;
        margin: 20px 0 !important;
        font-size: 18px;
        font-weight: 300;
        line-height: 1.5;
        color: #444;
    }
    .kmodal-btn {
        display: block;
        width: 100%;
        padding: .25rem .5rem;
        font-size: 14px;
        line-height: 1.5;
        border-radius: .2rem;
        border: 1px solid transparent;
        text-align: center;
        vertical-align: middle;
        font-weight: 400;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .kmodal-btn-success {
        color: #fff;
        background-color: #DF6423;
        border-color: #DF6423;
    }
    .kmodal-btn-success:hover {
        color: #fff;
        background-color: #e65d14;
        border-color: #e65d14;
    }
    .modal {transition: opacity .15s linear;display: none;position: fixed;z-index: 100;padding-top: 100px;left: 0;top: 0;width: 100%;height: 100%;overflow: auto;background-color: rgb(0,0,0);background-color: rgba(0,0,0,0.5);}
    .modal-content {position: relative;background-color: #fefefe;margin: auto;width: 80%;padding: 0;border: 1px solid #888;    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0,0,0,.2);
        border-radius: .3rem;
        outline: 0;
        color: #212529;
    }
    .modal-body {
        font-size: 16px;
        line-height: 1.6;
        min-height: 100px;
        padding: 10px;
    }
    .next_time {
        margin-top: 20px;
    }

    @media (min-width: 992px)  {
        .modal-content {max-width: 25%}
    }
    @-webkit-keyframes animatetop {
        from {top:-600px; opacity:0}
        to {top:0; opacity:1}
    }
    @keyframes animatetop {
        from {top:-600px; opacity:0}
        to {top:0; opacity:1}
    }
    .cart-timeslots select {
        max-width: 200px;
        margin-left: auto !important;
    }
</style>
