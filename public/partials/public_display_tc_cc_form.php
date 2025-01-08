<?php
    $form = MLV_FORMS_ARRAY['tt_cc'];
?>
<div class="container">

    <!-- <img src='/wp-content/plugins/form/public/partials/images/mlv.jpg' alt='MLV Gov. College'>

    <h5 class="m-5 text-center">TC/CC Form</h5> -->
    <h2 class="bt_form_heading">
            <?php echo $form["title"] ?> 
    </h2>
    <div class="mlv_loading_btn spinner-border d-none" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>

    <form class="mt-5" method="POST" id="save_tc_cc_form" action="">
        <?php wp_nonce_field('tc_cc_form'); ?>
        <div class="mb-3">
            <label for="tc_full_name" class="form-label">Full Name :</label>
            <input type="text" class="form-control form-control-sm" id="tc_full_name" placeholder="Enter your full name"
                minlength="3" maxlength="80" required>
        </div>

        <div class="mb-3">
            <label for="tc_father_name" class="form-label">Father's Name :</label>
            <input type="text" class="form-control form-control-sm" id="tc_father_name" placeholder="Enter your father's name"
                minlength="3" maxlength="80" required>
        </div>

        <div class="mb-3">
            <label for="tc_mother_name" class="form-label">Mother's Name :</label>
            <input type="text" class="form-control form-control-sm" id="tc_mother_name" placeholder="Enter your mother's name"
                minlength="3" maxlength="80" required>
        </div>

        <div class="mb-3">
            <label for="tc_name_class_faculty" class="form-label">Name of Class & Faculty in which admitted :</label>
            <input type="text" class="form-control form-control-sm" id="tc_name_class_faculty"
                placeholder="Enter class and faculty" minlength="3" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label for="tc_date_admission" class="form-label">Date of admission in the College :</label>
            <input type="date" class="form-control form-control-sm" id="tc_date_admission" placeholder="" minlength=""
                maxlength="" required>
        </div>

        <div class="mb-3">
            <label for="tc_d_exam_pass" class="form-label">Details of examination last pass out :</label>
            <input type="text" class="form-control form-control-sm" id="tc_d_exam_pass"
                placeholder="Enter details of examination" minlength="3" maxlength="30" required>
        </div>

        <div class="mb-3">
            <label for="tc_dob" class="form-label">Date of Birth :</label>
            <input type="date" class="form-control form-control-sm" id="tc_dob" placeholder="" minlength="" maxlength=""
                required>
        </div>

        <div class="mb-3">
            <label for="tc_permanent_address" class="form-label">Permanent Address :</label>
            <input type="text" class="form-control" id="tc_permanent_address" placeholder="Enter your permanent address"
                minlength="3" maxlength="300" required>
        </div>

        <div class="mb-3">
            <label for="tc_present_address" class="form-label">Present Address :</label>
            <input type="text" class="form-control" id="tc_present_address" placeholder="Enter your present address"
                minlength="3" maxlength="300" required>
        </div>

        <div class="mb-3">
            <label for="tc_mobile_no" class="form-label">Mobile No. :</label>
            <input type="tel" class="form-control" id="tc_mobile_no" placeholder="Enter your mobile number" minlength="10"
                maxlength="10" required>
        </div>

        <div class="mb-3">
            <label for="tc_aadhaar_no" class="form-label">AADHAAR No :</label>
            <input type="text" class="form-control" id="tc_aadhaar_no" placeholder="Enter your aadhaar number" minlength="12"
                maxlength="12" required>
        </div>

        <div class="mb-3">
            <label for="tc_email_id" class="form-label">E-mail Id :</label>
            <input type="email" class="form-control" id="tc_email_id" placeholder="Enter your email address" minlength="3"
                maxlength="100" required>
        </div>

        <h5 class="m-5 text-center">Academic Record</h5>

        <table class="table fs-5 academic_record_table">
            <thead>
                <tr>
                    <th scope="col">Session</th>
                    <th scope="col">Class</th>
                    <th scope="col">Roll No.</th>
                    <th scope="col">Result (pass/fail)</th>
                 
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input id="tc_session_one" type="text" required>
                    </td>
                    <td>
                        <input id="tc_class_one" type="text" required>
                    </td>
                    <td>
                        <input id="tc_roll_no_one" type="text" required>
                    </td>
                    <td>
                        <input id="tc_result_one" type="text" required>
                    </td>
                
                </tr>
                <tr>
                    <td>
                        <input id="tc_session_two" type="text">
                    </td>
                    <td>
                        <input id="tc_class_two" type="text">
                    </td>
                    <td>
                        <input id="tc_roll_no_two" type="text">
                    </td>
                    <td>
                        <input id="tc_result_two" type="text">
                    </td>
                
                </tr>
                <tr>
                    <td>
                        <input id="tc_session_three" type="text">
                    </td>
                    <td>
                        <input id="tc_class_three" type="text">
                    </td>
                    <td>
                        <input id="tc_roll_no_three" type="text">
                    </td>
                    <td>
                        <input id="tc_result_three" type="text">
                    </td>
                  
                </tr>
                <tr>
                    <td>
                        <input id="tc_session_four" type="text">
                    </td>
                    <td>
                        <input id="tc_class_four" type="text">
                    </td>
                    <td>
                        <input id="tc_roll_no_four" type="text">
                    </td>
                    <td>
                        <input id="tc_result_four" type="text">
                    </td>
                  
                </tr>
                <tr>
                    <td>
                        <input id="tc_session_five" type="text">
                    </td>
                    <td>
                        <input id="tc_class_five" type="text">
                    </td>
                    <td>
                        <input id="tc_roll_no_five" type="text">
                    </td>
                    <td>
                        <input id="tc_result_five" type="text">
                    </td>
                  
                </tr>
            </tbody>
        </table>

        <div class="mb-3">
        <button style="width:100%" type="submit" class="button" data-value="Pay for order">Proceed and Pay ₹<?php echo $form["fees"] ?>/-</button>
        </div>
    </form>
</div>