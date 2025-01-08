<?php
    $form = MLV_FORMS_ARRAY['cdc_fee_geography'];
?>
<div class="container">

    <!-- <img src='/wp-content/plugins/form/public/partials/images/mlv.jpg' alt='MLV Gov. College'>

    <h5 class="mt-3 text-center">CDC Fee Form</h5> -->
    <h2 class="bt_form_heading">
        <?php echo $form["title"] ?> 
    </h2>
    <div class="mlv_loading_btn spinner-border d-none" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>

    <form class="mt-5 cdc_geo_form" method="POST" id="save_cdc_geo_form" action="">
        <?php wp_nonce_field('cdc_geo_form'); ?>
        <div class="mb-3">
            <label for="cdc_geo_full_name" class="form-label">Full Name :</label>
            <input type="text" class="form-control form-control-sm" id="cdc_geo_full_name" placeholder="Enter your name"
                minlength="3" maxlength="80" required>
        </div>

        <div class="mb-3">
            <label for="cdc_geo_father_name" class="form-label">Father's Name :</label>
            <input type="text" class="form-control form-control-sm" id="cdc_geo_father_name"
                placeholder="Enter your father's name" minlength="3" maxlength="80" required>
        </div>

        <div class="mb-3">
            <label for="cdc_geo_mother_name" class="form-label">Mother's Name :</label>
            <input type="text" class="form-control form-control-sm" id="cdc_geo_mother_name"
                placeholder="Enter your mother's name" minlength="3" maxlength="80" required>
        </div>

        <div class="mb-3">
            <label for="cdc_geo_dob" class="form-label">Date of Birth :</label>
            <input type="date" class="form-control form-control-sm" id="cdc_geo_dob" placeholder="" minlength=""
                maxlength="" required>
        </div>

        <div class="mb-3">
            <label for="cdc_geo_name_class" class="form-label">Name of Class for which examination form filled :</label>
            <input type="text" class="form-control form-control-sm" id="cdc_geo_name_class" placeholder="Enter name of Class for which examination form filled"
                minlength="3" maxlength="30" required>
        </div>

        <div class="mb-3">
            <label for="cdc_geo_date_submission" class="form-label">Date of submission in the College :</label>
            <input type="date" class="form-control form-control-sm" id="cdc_geo_date_submission" placeholder="" minlength=""
                maxlength="" required>
        </div>

        <div class="mb-3">
            <label for="cdc_geo_u_exam_f_no" class="form-label">University Examination Form No. :</label>
            <input type="text" class="form-control form-control-sm" id="cdc_geo_u_exam_f_no" placeholder="Enter university examination form number"
                minlength="3" maxlength="30" required>
        </div>

        <div class="mb-3">
            <label for="cdc_geo_mobile_no" class="form-label">Mobile No. :</label>
            <input type="tel" class="form-control form-control-sm" id="cdc_geo_mobile_no" placeholder="Enter your mobile number" minlength="10"
                maxlength="10" required>
        </div>

        <div class="mb-3">
            <label for="cdc_geo_aadhaar_no" class="form-label">AADHAAR No :</label>
            <input type="text" class="form-control form-control-sm" id="cdc_geo_aadhaar_no" placeholder="Enter your aadhaar number" minlength="12"
                maxlength="12" required>
        </div>

        <div class="mb-3">
            <label for="cdc_geo_email_id" class="form-label">E-mail Id :</label>
            <input type="email" class="form-control form-control-sm" id="cdc_geo_email_id" placeholder="Enter your email address" minlength="3"
                maxlength="120" required>
        </div>

        <div class="mb-3">
            <label for="cdc_geo_present_address" class="form-label">Present Address :</label>
            <input type="text" class="form-control form-control-sm" id="cdc_geo_present_address" placeholder="Enter your present address"
                minlength="3" maxlength="300" required>
        </div>

        <div class="mb-3">
            <label for="cdc_geo_permanent_address" class="form-label">Permanent Address :</label>
            <input type="text" class="form-control form-control-sm" id="cdc_geo_permanent_address" placeholder="Enter your permanent address"
                minlength="3" maxlength="300" required>
        </div>
        
        <div class="mb-3">
            <button style="width:100%" type="submit" class="button" data-value="Pay for order">Proceed and Pay ₹<?php echo $form["fees"] ?>/-</button>
        </div>

    </form>
</div>