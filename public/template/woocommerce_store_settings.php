
    <input type="hidden" value='<?= stripslashes($kaarot_store_slots); ?>' name="kaarot_store_slots_json" id="kaarot_store_slots_json">
    <input type="hidden" value='<?= stripslashes($kaarot_store_holidays); ?>' name="kaarot_store_holidays_json" id="kaarot_store_holidays_json">

    <div id="main">
        <input style="display:none" id="tab3" type="radio" name="tabs" checked>
        <label for="tab3">General Settings</label>

        <input style="display:none" id="tab1" type="radio" name="tabs" >
        <label for="tab1">Slots</label>

        <input style="display:none"  id="tab2" type="radio" name="tabs">
        <label for="tab2">Holidays</label>

        <input style="display:none"  id="tab4" type="radio" name="tabs">
        <label for="tab4">Printer Settings</label>

        <input style="display:none"  id="tab5" type="radio" name="tabs">
        <label for="tab5">Printer Status</label>

        <section id="content1">
                        <table>
                            <tr>
                                <td>
                                Method    <br>
                        <select id="ship">
                            <option value="">Select shipping method</option>
                                <?php
                                    foreach ($shipping_methods as $key => $value) {
                                    ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php
                                    }
                                ?>
                        </select>
                                </td>
                                <td>
                                Day <br>
                        <select id="day">
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                                </td>
                                <td>
                                Start Time <br>
                        <select id ="start">
                        <?php
                            $start=strtotime('00:00');
                            $end=strtotime('23:30');
                            for ($halfhour=$start;$halfhour<=$end;$halfhour=$halfhour+30*60) {
                                printf('<option value="%s">%s</option>',date('H:i',$halfhour),date('H:i',$halfhour));
                            }
                        ?>
                        </select>
                                </td>
                                <td>
                                End Time<br>
                        <select id="end">
                        <?php
                            $start=strtotime('00:00');
                            $end=strtotime('23:30');
                            for ($halfhour=$start;$halfhour<=$end;$halfhour=$halfhour+30*60) {
                                printf('<option value="%s">%s</option>',date('H:i',$halfhour),date('H:i',$halfhour));
                            }
                        ?>
                        </select>
                                </td>
                                <td>
                                <input type="button" name="add" value="Add" id="add">
                                </td>
                            </tr>
                        </table>

                        <script>
                            jQuery(document).ready(function(){
                                load_hours_table();
                                var shipid = 0;

                                jQuery('#add').click(function(e){
                                    e.preventDefault();

                                    var shipid = jQuery('#ship').val();
                                    var ship = jQuery('#ship').find('option:selected').text();
                                    var day = jQuery('#day').val();
                                    var start = jQuery('#start').val();
                                    var end = jQuery('#end').val();

                                    var obj= {
                                        smid:shipid,
                                        sm:ship,
                                        day:day,
                                        st:start,
                                        et:end
                                    };

                                    var hours=getHours();

                                    hours.push(obj);

                                    jQuery('#kaarot_store_slots_json').val(JSON.stringify(hours));
                                    load_hours_table();
                                });
                                jQuery('#hours_table tbody').on('click', '.delete-hour', function(e) {
                                    e.preventDefault();
                                    var index= jQuery(this).attr("data-index");
                                    var hours=getHours();
                                    hours.splice(index,1);
                                    jQuery('#kaarot_store_slots_json').val(JSON.stringify(hours));
                                    load_hours_table();

                                });
                            });

                            function load_hours_table(){
                                var hours=getHours();
                                jQuery('#hours_table tbody').html("");
                                for (let index = 0; index < hours.length; index++) {
                                    const h = hours[index];
                                    var row="<tr><td>"+(index+1)+"</td><td>"+h.sm+"</td><td>"+h.day+"</td><td>"+h.st+"</td><td>"+h.et+"</td><td><button type='button' class='delete-hour' data-index='"+index+"'>D</button></td></tr>";

                                    jQuery('#hours_table tbody').append(row);
                                }
                            }

                            function getHours(){
                                var hours_json= jQuery('#kaarot_store_slots_json').val();
                                if(hours_json==""||hours_json==null){
                                    return  [];
                                }
                                try{
                                    var h= JSON.parse(hours_json);
                                    if(h==null)
                                        return [];
                                    else
                                        return h;
                                }catch{
                                    return [];
                                }
                            }
                        </script>
                        <br>
                        <br>
                        <table id="hours_table" border="1" style="width:50%;" >
                            <thead>
                            <tr>
                                <th>S.no.</th>
                                <th>Method</th>
                                <th>Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>

        </section>

        <section id="content2">
            <table>
                <tr>
                    <td>
                        Name<br>
                        <input name="holiday_name" id="holiday_name" value="" >
                    </td>
                    <td>
                        From<br>
                        <input name="holiday_from_date" id="holiday_from_date" value="" class="datepicker" >
                    </td>
                    <td>
                        To<br>
                        <input name="holiday_to_date" id="holiday_to_date" value="" class="datepicker" >
                    </td>
                    <td>
                        <input type="button" value="Add" id="add_holiday">
                    </td>
                </tr>
            </table>
            <table id="holidays_table" border="1" style="width:50%;" >
                            <thead>
                            <tr>
                                <th>S.no.</th>
                                <th>Name</th>
                                <th>From</th>
                                <th>To</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
            </table>
            <script>
                            jQuery(document).ready(function(){

                                load_holidays_table();
                                var shipid = 0;

                                jQuery('#add_holiday').click(function(e){
                                    e.preventDefault();

                                    var holiday_name = jQuery('#holiday_name').val();
                                    var holiday_from_date = jQuery('#holiday_from_date').val();
                                    var holiday_to_date = jQuery('#holiday_to_date').val();

                                    var obj= {
                                        hn:holiday_name,
                                        hfd:holiday_from_date,
                                        htd:holiday_to_date
                                    };

                                    var holidays=getholidays();

                                    holidays.push(obj);

                                    jQuery('#kaarot_store_holidays_json').val(JSON.stringify(holidays));
                                    load_holidays_table();
                                });
                                jQuery('#holidays_table tbody').on('click', '.delete-holiday', function(e) {
                                    e.preventDefault();
                                    var index= jQuery(this).attr("data-index");
                                    var holidays=getholidays();
                                    holidays.splice(index,1);
                                    jQuery('#kaarot_store_holidays_json').val(JSON.stringify(holidays));
                                    load_holidays_table();

                                });
                            });

                            function load_holidays_table(){
                                var holidays=getholidays();
                                jQuery('#holidays_table tbody').html("");
                                for (let index = 0; index < holidays.length; index++) {
                                    const h = holidays[index];
                                    var row="<tr><td>"+(index+1)+"</td><td>"+h.hn+"</td><td>"+h.hfd+"</td><td>"+h.htd+"</td><td><button type='button' class='delete-holiday' data-index='"+index+"'>D</button></td></tr>";

                                    jQuery('#holidays_table tbody').append(row);
                                }
                            }

                            function getholidays(){
                                var holidays_json= jQuery('#kaarot_store_holidays_json').val();
                                if(holidays_json==""||holidays_json==null){
                                    return  [];
                                }
                                try{
                                    var h= JSON.parse(holidays_json);
                                    if(h==null)
                                        return [];
                                    else
                                        return h;
                                }catch{
                                    return [];
                                }
                            }

                        </script>
            <script>

                jQuery(document).ready(function($) {

                    $('.datepicker').datepicker({
                        dateFormat : 'dd-M-yy'
                    });
                });
            </script>
        </section>

        <section id="content3">
            <script>
                jQuery(document).ready(function(){
                    jQuery('#disable_timeslot_display_category').select2();
                    <?php if(!empty($kaarot_printer_settings_disable_timeslot_category)) { ?>
                    jQuery('#disable_timeslot_display_category').val(<?php  echo json_encode($kaarot_printer_settings_disable_timeslot_category); ?>).trigger('change');
                    <?php } ?>
                });
            </script>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th>
                            Enable Checkout fields
                        </th>
                        <td>
                            <select name="kaarot_store_fields_enable" class="">
                                <option <?php echo $kaarot_store_fields_enable==="yes"?"selected":""; ?> value="yes">Yes</option>
                                <option <?php echo $kaarot_store_fields_enable==="no"?"selected":""; ?> value="no">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Disable Time slot selection at checkout for following categories
                        </th>
                        <td>
                            <?php
                            $args = array(
                                'class'       => 'select-submit2',
                                'hide_empty'  => false,
                                'name'        => 'disable_timeslot_display_category[]',
                                'id'          => 'disable_timeslot_display_category',
                                'orderby'     => 'NAME',
                                'order'       => 'ASC',
                                'show_option_none'   => __('None','wpestate'),
                                'taxonomy'    => 'product_cat',
                                'hierarchical'=> true,
                                'echo'        => 0,
                            );

                            /** get the dropdown **/
                            $dropdown = wp_dropdown_categories( $args );
                            $dropdown = str_replace('id=', 'multiple="multiple" id=', $dropdown);

                            /** insert "multiple" using str_replace **/
                            $multi = str_replace( '<select', '<select multiple ', $dropdown );

                            /** output result **/
                            echo $multi;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Checkout Fields Position <br>
                            <small>
                                Where should the date and time fields show on the checkout page?
                            </small>
                        </th>
                        <td>
                            <select name="kaarot_store_fields_position" class="">
                                <option <?php echo $kaarot_store_fields_position==="woocommerce_checkout_before_customer_details"?"selected":""; ?> value="woocommerce_checkout_before_customer_details">Before Customer Details</option>
                                <option <?php echo $kaarot_store_fields_position==="woocommerce_checkout_billing"?"selected":""; ?> value="woocommerce_checkout_billing">Within Billing Fields</option>
                                <option <?php echo $kaarot_store_fields_position==="woocommerce_checkout_shipping"?"selected":""; ?> value="woocommerce_checkout_shipping">Within Shipping Fields</option>
                                <option <?php echo $kaarot_store_fields_position==="woocommerce_checkout_after_customer_details"?"selected":""; ?> value="woocommerce_checkout_after_customer_details">After Customer Details</option>
                                <option <?php echo $kaarot_store_fields_position==="woocommerce_checkout_before_order_review"?"selected":""; ?> value="woocommerce_checkout_before_order_review">Before Order Review</option>
                                <option <?php echo $kaarot_store_fields_position==="woocommerce_checkout_order_review"?"selected":""; ?> value="woocommerce_checkout_order_review">Within Order Review</option>
                                <option <?php echo $kaarot_store_fields_position==="woocommerce_review_order_after_shipping"?"selected":""; ?> value="woocommerce_review_order_after_shipping">Within Order Review After Shipping</option>
                                <option <?php echo $kaarot_store_fields_position==="woocommerce_checkout_after_order_review"?"selected":""; ?> value="woocommerce_checkout_after_order_review">After Order Review</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Checkout Fields Position Priority <br>
                            <small>Enter a number of priority, e.g. 10 is early/before, 50 is late/after</small>
                        </th>
                        <td>
                            <input type="text" name="kaarot_store_fields_position_priority" value="<?php echo $kaarot_store_fields_position_priority; ?>" placeholder="" class="regular-text ">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Enable multi user login in Online Ordering App?<br>
                            <small>This will allow to login multiple users at the same time in the store.</small>
                        </th>
                        <td>
                            <input type="checkbox" name="kaarot_printer_settings_enable_multiuser_login" <?php echo $kaarot_printer_settings_enable_multiuser_login == "on" ? "checked":""; ?> >
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Enable auto accept order in Online Ordering App?<br>
                            <small>If enabled, all the newly placed order will be accepted status by default.</small>
                        </th>
                        <td>
                            <input type="checkbox"
                                   id="enable_auto_accept_order"
                                   name="kaarot_printer_settings_enable_auto_accept_order"
                                   onchange="displayDetailsOnCheckBox('#enable_auto_accept_order', '#auto_accept_time')"
                                <?php echo $kaarot_printer_settings_enable_auto_accept_order == "on" ? "checked":""; ?> >
                        </td>
                    </tr>
                    <tr id="auto_accept_time" style="display: none;">
                        <th scope="row">
                            Order Ready Time <br>
                            <small>
                                Order preparation time in minutes
                            </small>
                        </th>
                        <td>
                            <input type="text" name="kaarot_printer_settings_enable_auto_accept_time" value="<?php echo $kaarot_printer_settings_enable_auto_accept_time; ?>" placeholder="" class="regular-text ">
                        </td>
                    </tr>

                    <?php
                    $wc_statuses = wc_get_order_statuses();
                    $wc_statuses = array('wc-do_not_change' => 'Do not change') + $wc_statuses;    //Add custom status to ignore this settings
                    ?>

                    <tr>
                        <th>Order status after <u>Order Accepted</u> in app</th>
                        <td>
                            <select id="kaarot_printer_settings_order_status_for_accept" name="kaarot_printer_settings_order_status_for_accept" class="wc-enhanced-select">
                                <?php
                                foreach ( $wc_statuses as $status => $status_name ) {
                                    $status = str_replace("wc-","",$status);
                                    echo '<option value="' . esc_attr( $status ) . '" ' . selected( $status, ($kaarot_printer_settings_order_status_for_accept) ? $kaarot_printer_settings_order_status_for_accept : 'processing', false ) . ' >' . esc_html( $status_name ) . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Order status after <u>Order Cancelled</u> in app</th>
                        <td>
                            <select id="kaarot_printer_settings_order_status_for_cancelled" name="kaarot_printer_settings_order_status_for_cancelled" class="wc-enhanced-select">
                                <?php
                                foreach ( $wc_statuses as $status => $status_name ) {
                                    $status = str_replace("wc-","",$status);
                                    echo '<option value="' . esc_attr( $status ) . '" ' . selected( $status, ($kaarot_printer_settings_order_status_for_cancelled) ? $kaarot_printer_settings_order_status_for_cancelled : 'cancelled', false ) . ' >' . esc_html( $status_name ) . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Order status after marked <u>Order Ready</u> in app</th>
                        <td>
                            <select id="kaarot_printer_settings_order_status_for_ready" name="kaarot_printer_settings_order_status_for_ready" class="wc-enhanced-select">
                                <?php
                                foreach ( $wc_statuses as $status => $status_name ) {
                                    $status = str_replace("wc-","",$status);
                                    echo '<option value="' . esc_attr( $status ) . '" ' . selected( $status, ($kaarot_printer_settings_order_status_for_ready) ? $kaarot_printer_settings_order_status_for_ready : 'completed', false ) . ' >' . esc_html( $status_name ) . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <script>
                jQuery(document).ready(function(){
                    if(jQuery("#enable_auto_accept_order").is(':checked')) {
                        jQuery("#auto_accept_time").show();
                    }
                });

                function displayDetailsOnCheckBox(checkBox, displayElement) {
                    if(jQuery(checkBox).is(":checked")) {
                        jQuery(displayElement).show();
                    } else {
                        jQuery(displayElement).hide();
                    }
                }
                </script>
        </section>

        <section id="content4">
        <table class="form-table">
                <tbody>
                    <tr>
                        <th>
                            Printer Type
                        </th>
                        <td>
                            <select name="kaarot_printer_type" class="">
                                <option <?php echo $kaarot_printer_type==="smart_printer"?"selected":""; ?> value="smart_printer">Smart Printer</option>
                                <option <?php echo $kaarot_printer_type==="android_printer"?"selected":""; ?> value="android_printer">Android Printer</option>
                                <?php if(sizeof($pos_outlets)>0) : ?>
                                    <option <?php echo $kaarot_printer_type==="pos_app_printer"?"selected":""; ?> value="pos_app_printer">POS App</option>
                                <?php endif ?>
                            </select>
                        </td>
                    </tr>
                    <?php if(sizeof($pos_outlets)>0) : ?>
                        <tr>
                            <th scope="row">
                                Send Online Orders to this Register<br>
                                <small>
                                    For POS App Only.
                                </small>
                            </th>
                            <td>
                                <select name="kaarot_printer_pos_selected_register" class="">
                                   <?php foreach ($pos_outlets as $key => $outlet) : ?>
                                        <optgroup label="<?php echo $outlet["name"] ?>">
                                            <?php foreach ($outlet["registers"] as $key2 => $register) : ?>
                                                <option <?php echo $kaarot_printer_pos_selected_register==$register->ID?"selected":""; ?> value="<?php echo $register->ID; ?>"><?php echo $register->name ?></option>
                                            <?php endforeach ?>
                                        </optgroup>
                                   <?php endforeach ?>
                                </select>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <th></th>
                            <td>
                                <input type="hidden" value="<?php echo $kaarot_printer_pos_selected_register; ?>" name="kaarot_printer_pos_selected_register">
                            </td>
                        </tr>
                    <?php endif ?>
                    <tr>
                        <th scope="row">
                            How many orders to sync <br>
                            <small>
                                For Android Printer Only.
                            </small>
                        </th>
                        <td>
                        <input type="number" name="kaarot_printer_smart_sync_x_orders" value="<?php echo $kaarot_printer_smart_sync_x_orders; ?>" placeholder="" class="regular-text ">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            When shall we send scheduled orders to printer <br>
                            <small>
                                Instantly or specific time before scheduled date and time.
                            </small>
                        </th>
                        <td>
                            <select name="kaarot_printer_schedule_orders_print_minutes" class="">
                                <option <?php echo $kaarot_printer_schedule_orders_print_minutes==="0"?"selected":""; ?> value="0">As soon as order is placed</option>
                                <option <?php echo $kaarot_printer_schedule_orders_print_minutes==="15"?"selected":""; ?> value="15">15 mins before scheduled time</option>
                                <option <?php echo $kaarot_printer_schedule_orders_print_minutes==="30"?"selected":""; ?> value="30">30 mins before scheduled time</option>
                                <option <?php echo $kaarot_printer_schedule_orders_print_minutes==="45"?"selected":""; ?> value="45">45 mins before scheduled time</option>
                                <option <?php echo $kaarot_printer_schedule_orders_print_minutes==="60"?"selected":""; ?> value="60">1 hour before scheduled time</option>
                                <option <?php echo $kaarot_printer_schedule_orders_print_minutes==="120"?"selected":""; ?> value="120">2 hours before scheduled time</option>

                            </select>

                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Printer last contact threshold in seconds:  <br>
                            <small>Printer will be treated as offline after threshold.</small>
                        </th>
                        <td>
                            <input type="text" name="kaarot_printer_settings_offline_threshold_seconds" value="<?php echo $kaarot_printer_settings_offline_threshold_seconds; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Show warning and prevent orders if printer is offline:   <br>
                            <small>If printer is offline, online ordering will be disabled.</small>
                        </th>
                        <td>
                            <input type="checkbox" name="kaarot_printer_settings_prevent_orders" <?php echo $kaarot_printer_settings_prevent_orders=="on"?"checked":""; ?> >
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Warning text to show when printer is offline:   <br>
                            <small>Write a custom message when printer is offline. HTML supported</small>
                        </th>
                        <td>
                            <textarea style="width:500px;height:200px;" name="kaarot_printer_settings_offline_warning_text"  ><?= stripslashes($kaarot_printer_settings_offline_warning_text); ?> </textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Enable accepting orders even if the store is closed.<br>
                            <small>Check if you want to accept orders even if the store not opening.</small>
                        </th>
                        <td>
                            <input type="checkbox" name="kaarot_printer_settings_accept_order_while_store_closed" <?php echo $kaarot_printer_settings_accept_order_while_store_closed=="on"?"checked":""; ?> >
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Enable store closed warning popup.<br>
                            <small>Do you want to display popup if the is closed at that time.</small>
                        </th>
                        <td>
                            <input type="checkbox" name="kaarot_printer_settings_slot_unavailable_warning_enable" <?php echo $kaarot_printer_settings_slot_unavailable_warning_enable=="on"?"checked":""; ?> >
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Store closed warning Message<br>
                            <small>Message to display if store is closed or no time slot for the day during checkout. HTML supported</small>
                        </th>
                        <td>
                            <textarea style="width:500px;height:200px;" name="kaarot_printer_settings_slot_unavailable_warning_text"  ><?= stripslashes($kaarot_printer_settings_slot_unavailable_warning_text); ?> </textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Send an email notification, if printer is offline for more than:   <br>
                            <small>Send an email if printer is offline</small>
                        </th>
                        <td>
                            <select name="kaarot_printer_settings_offline_email_threshold_minutes" class="">
                                <option <?php echo $kaarot_printer_settings_offline_email_threshold_minutes==="0"?"selected":""; ?> value="0">Do not send any notification</option>
                                <option <?php echo $kaarot_printer_settings_offline_email_threshold_minutes==="15"?"selected":""; ?> value="15">15 mins</option>
                                <option <?php echo $kaarot_printer_settings_offline_email_threshold_minutes==="30"?"selected":""; ?> value="30">30 mins</option>
                                <option <?php echo $kaarot_printer_settings_offline_email_threshold_minutes==="45"?"selected":""; ?> value="45">45 mins</option>
                                <option <?php echo $kaarot_printer_settings_offline_email_threshold_minutes==="60"?"selected":""; ?> value="60">1 hour</option>
                                <option <?php echo $kaarot_printer_settings_offline_email_threshold_minutes==="120"?"selected":""; ?> value="120">2 hours</option>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Email addresses for sending offline notifications:   <br>
                            <small>Enter comma saperated email addresses</small>
                        </th>
                        <td>
                            <input type="text" name="kaarot_printer_settings_offline_email_addresses" value="<?php echo $kaarot_printer_settings_offline_email_addresses; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Store Opening Hours:   <br>
                            <small>(DEPRECATED) Donot use for new stores. </small>
                        </th>
                        <td>
                            <textarea style="width:500px;height:200px;" name="kaarot_printer_settings_store_opening_hours"  ><?= stripslashes($kaarot_printer_settings_store_opening_hours); ?> </textarea>
                        </td>
                    </tr>
                    <tr>
                      <th scope="row">
                        Android App New Order Ring for no of minutes:   <br>
                        <small>How much time it will continually ring when a new order comes </small>
                      </th>
                      <td>
                        <input type="text" placeholder="e.g: 2 for 2 minutes" name="kaarot_printer_settings_mobile_app_order_ring_time" value="<?php echo $kaarot_printer_settings_mobile_app_order_ring_time; ?>" >
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">
                        Android App New Order Re-Ring Wait time <br>
                        <small>How many minutes it will be wait for re-ring bail in app.</small>
                      </th>
                      <td>
                        <input type="text" placeholder="e.g: 3 for 3 minute" name="kaarot_printer_settings_mobile_app_order_rering_wait_for" value="<?php echo $kaarot_printer_settings_mobile_app_order_rering_wait_for; ?>" >
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">
                        Total no of times the ring should be repeat:   <br>
                        <small></small>
                      </th>
                      <td>
                        <input type="text" placeholder="e.g: 4 for 4 times" name="kaarot_printer_settings_mobile_app_order_ring_repeat" value="<?php echo $kaarot_printer_settings_mobile_app_order_ring_repeat; ?>" >
                      </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section id="content5">
          <table style="max-width:1000px;width:100%;">
            <?php if($kaarot_printer_type==="smart_printer") { ?>
              <tr>
                <td>Line No</td>
                <td>Param</td>
                <td>Value</td>
              </tr>
              <tr>
                <td>5</td>
                <td>RES ID</td>
                <td><?php echo $rest_id; ?></td>
              </tr>
              <tr>
                <td>8</td>
                <td>IP</td>
                <td>
                    <?php echo $site_url; ?>
                </td>
              </tr>
              <tr>
                <td>9</td>
                <td>Port</td>
                <td>
                  80
                </td>
              </tr>
              <tr>
                <td>36</td>
                <td>File Path (Old System)</td>
                <td>   <?php echo $get_url; ?> </td>
              </tr>
              <tr>
                <td>36</td>
                <td>File Path (New System)</td>
                <td>   <?php echo $get_url_new; ?> </td>
              </tr>
              <tr>
                <td>37</td>
                <td>Callback URL</td>
                <td>   <?php echo $update_url; ?> </td>
              </tr>
              <tr>
                <td>58</td>
                <td>Login Web User Name</td>
                <td>kaarot_online_printer</td>
              </tr>
              <tr>
                <td>59</td>
                <td>Login Web Password</td>
                <td>123456</td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan=3 style="text-align:left">
                <div>
                  <h1 id="printer_status">
                    Status : <span id="currentStatus">
                                <?php echo $printer_status ; ?>
                             </span>
                  </h1>
                  <span>
                    Last contact <span id="lastUpdateTime"><?php echo time_elapsed_string($printer_last_request_Date, true); ?></span>
                        <a href="#" onclick="location.reload();">refresh</a>
                    </span>
                </div>
              </td>
            </tr>
          </table>

          <script>
              var site_url = "<?php echo site_url( '', 'https' ); ?>";
              jQuery(document).ready(function(){
                  startTimer();
              });

              function startTimer(){
                  setTimeout(() => {
                      get_printer_status();
                  }, 5000);
              }

              function get_printer_status(){
                  jQuery.getJSON(site_url+"/wp-json/kaarot_online_printer_status/v1/online_printer_status",
                      function(response) {
                          jQuery('#lastUpdateTime').html(response.last_updated_time);
                          jQuery('#currentStatus').html(response.printer_status).css('color', response.text_color);
                          console.log(response);
                      });
                  startTimer();
              }
          </script>

        </section>
    </div>
