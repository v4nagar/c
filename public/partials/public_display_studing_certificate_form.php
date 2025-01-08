<?php
    $form = MLV_FORMS_ARRAY['studying_certificate'];
?>
<div class="container">

    <!-- <img src='/wp-content/plugins/form/public/partials/images/mlv.jpg' alt='MLV Gov. College'>

    <h5 class="mt-3 text-center">Studing Certificate Form</h5> -->
    <h2 class="bt_form_heading">
            <?php echo $form["title"] ?> 
    </h2>
    <div class="mlv_loading_btn spinner-border d-none" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>

    <form class="mt-5 studing_form" method="POST" id="save_studing_form" action="">
        <?php wp_nonce_field('studing_form'); ?>
        <div class="mb-3">
            <label for="studing_full_name" class="form-label">Full Name :</label>
            <input type="text" class="form-control form-control-sm" id="studing_full_name" placeholder="Enter your name"
                minlength="3" maxlength="80" required>
        </div>

        <div class="mb-3">
            <label for="studing_father_name" class="form-label">Father's Name :</label>
            <input type="text" class="form-control form-control-sm" id="studing_father_name"
                placeholder="Enter your father's name" minlength="3" maxlength="80" required>
        </div>

        <div class="mb-3">
            <label for="studing_mother_name" class="form-label">Mother's Name :</label>
            <input type="text" class="form-control form-control-sm" id="studing_mother_name"
                placeholder="Enter your mother's name" minlength="3" maxlength="80" required>
        </div>

        <div class="mb-3">
            <label for="studing_name_class_faculty" class="form-label">Name of class & faculty in which admitted
                :</label>
            <input type="text" class="form-control form-control-sm" id="studing_name_class_faculty"
                placeholder="Enter your class and faculty" minlength="3" maxlength="30" required>
        </div>

        <div class="mb-3">
            <label for="studing_date_admission" class="form-label">Date of admission in the college :</label>
            <input type="date" class="form-control form-control-sm" id="studing_date_admission" placeholder="Select admission date"
                minlength="" maxlength="" required>
        </div>

        <div class="mb-3">
            <label for="studing_d_exam_pass" class="form-label">Name of examination last passed out :</label>
            <input type="text" class="form-control form-control-sm" id="studing_d_exam_pass"
                placeholder="Enter name of examination last passed out " minlength="3" maxlength="30" required>
        </div>

        <div class="mb-3">
            <label for="studing_dob" class="form-label">Date of Birth :</label>
            <input type="date" class="form-control form-control-sm" id="studing_dob" placeholder="Select date of birth" minlength=""
                maxlength="" required>
        </div>

        <div class="mb-3">
            <label for="studing_permanent_address" class="form-label">Permanent Address :</label>
            <input type="text" class="form-control form-control-sm" id="studing_permanent_address"
                placeholder="Enter your permanent address" minlength="3" maxlength="300" required>
        </div>

        <div class="mb-3">
            <label for="studing_present_address" class="form-label">Present Address :</label>
            <input type="text" class="form-control form-control-sm" id="studing_present_address" placeholder="Enter your present address"
                minlength="3" maxlength="300" required>
        </div>

        <div class="mb-3">
            <label for="studing_mobile_no" class="form-label">Mobile No. :</label>
            <input type="tel" class="form-control form-control-sm" id="studing_mobile_no" placeholder="Enter your mobile number" minlength="10"
                maxlength="10" required>
        </div>

        <div class="mb-3">
            <label for="studing_aadhaar_no" class="form-label">Aadhaar No :</label>
            <input type="text" class="form-control form-control-sm" id="studing_aadhaar_no" placeholder="Enter your aadhaar number" minlength="12"
                maxlength="12" required>
        </div>

        <div class="mb-3">
            <label for="studing_email_id" class="form-label">E-mail Id :</label>
            <input type="email" class="form-control form-control-sm" id="studing_email_id" placeholder="Enter your email address" minlength="3"
                maxlength="100" required>
        </div>

        <h5 class="m-5 text-center">Academic Record</h5>

        <table class="table academic_record_table">
            <thead>
                <tr>
                    <th>Session</th>
                    <th>Class</th>
                    <th>Roll No.</th>
                    <th>Result (pass/fail)</th>
                </tr>
            </thead>
            <tbody>    
                <tr>
                    <td>
                        <input id="studing_session_one" type="text" required>
                    </td>
                    <td>
                        <input id="studing_class_one" type="text" required>
                    </td>
                    <td>
                        <input id="studing_roll_no_one" type="text" required>
                    </td>
                    <td>
                        <input id="studing_result_one" type="text" required>
                    </td>             
                </tr>
                <tr>
                    <td>
                        <input id="studing_session_two" type="text">
                    </td>
                    <td>
                        <input id="studing_class_two" type="text">
                    </td>
                    <td>
                        <input id="studing_roll_no_two" type="text">
                    </td>
                    <td>
                        <input id="studing_result_two" type="text">
                    </td>             
                </tr>
                <tr>
                    <td>
                        <input id="studing_session_three" type="text">
                    </td>
                    <td>
                        <input id="studing_class_three" type="text">
                    </td>
                    <td>
                        <input id="studing_roll_no_three" type="text">
                    </td>
                    <td>
                        <input id="studing_result_three" type="text">
                    </td>              
                </tr>
                <tr>
                    <td>
                        <input id="studing_session_four" type="text">
                    </td>
                    <td>
                        <input id="studing_class_four" type="text">
                    </td>
                    <td>
                        <input id="studing_roll_no_four" type="text">
                    </td>
                    <td>
                        <input id="studing_result_four" type="text">
                    </td>              
                </tr>
                <tr>
                    <td>
                        <input id="studing_session_five" type="text">
                    </td>
                    <td>
                        <input id="studing_class_five" type="text">
                    </td>
                    <td>
                        <input id="studing_roll_no_five" type="text">
                    </td>
                    <td>
                        <input id="studing_result_five" type="text">
                    </td>              
                </tr>
            </tbody>
        </table>

        <div class="mb-3">
            <button style="width:100%" type="submit" class="button" data-value="Pay for order">Proceed and Pay ₹<?php echo $form["fees"] ?>/-</button>
        </div>
    </form>
</div>