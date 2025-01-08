<?php
    if (isset($_GET['type'])) {
        // Get the value from the URL
        $value = $_GET['type'];

        // Check if the value is equal to a specific value
        if ($value == '1') {
            $form = MLV_FORMS_ARRAY['degree'];
        } else {
            $form = MLV_FORMS_ARRAY['degree_2'];
        }
    } else {
        wp_redirect(home_url());
        exit;
    }


    //$form = MLV_FORMS_ARRAY['degree'];

?>
<div class="container">

        <!-- <img src='/wp-content/plugins/form/public/partials/images/mlv.jpg' alt='MLV Gov. College'>  <h5 class="mt-3 text-center">Degree Form</h5> -->
        <h2 class="bt_form_heading">
            <?php echo $form["title"] ?> 
        </h2>
  
    <div class="mlv_loading_btn spinner-border d-none" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>

    <form class="mt-5 degree_form" method="POST" id="save_degree_form" action="">
        <?php wp_nonce_field('degree_form'); ?>

        <input id="hidden_input_degree_form" type="hidden" name="action" value="degree_form_data">
		<input type="hidden" id="_value" name="_value" value="<?= $value?>">

        <div class="mb-3">
            <label for="name" class="form-label">Name :</label>
            <input type="text" class="form-control form-control-sm" id="name" placeholder="Enter your name" minlength="3"
                maxlength="80" required>
        </div>

        <div class="mb-3">
            <label for="f_name" class="form-label">Father's name :</label>
            <input type="text" class="form-control form-control-sm" id="f_name" placeholder="Enter your father's name"
                minlength="3" maxlength="80" required>
        </div>

        <div class="mb-3">
            <label for="appeared_in" class="form-label">Appeared in :</label>
            <input type="text" class="form-control form-control-sm" id="appeared_in" placeholder="Enter class"
                minlength="1" maxlength="10" required>
        </div>

        <div class="mb-3">
            <label for="name_exam" class="form-label">Name of examination with year :</label>
            <input type="text" class="form-control form-control-sm" id="name_exam" placeholder="Exam name with year"
                minlength="1" maxlength="20" required>
        </div>

        <div class="mb-3">
            <label for="roll_no" class="form-label">Roll No. :</label>
            <input type="number" class="form-control form-control-sm" id="roll_no" placeholder="Enter roll number" minlength="2"
                maxlength="15" required>
        </div>

        <div class="mb-3 row">
            <label for="r_e_n_collegiate" class="form-label">Regular/Ex/Non-collegiate :</label>
            <div class="form-check col-md-4">
                <input class="form-check-input" type="radio" value="Regular Student" id="regular_st" name="fav_language"
                    required>
                <label class="form-check-label" for="regular_st">
                    Regular Student
                </label>
            </div>
            <div class="form-check col-md-4">
                <input class="form-check-input" type="radio" value="Ex Student" id="ex_st" name="fav_language">
                <label class="form-check-label" for="ex_st">
                    Ex Student
                </label>
            </div>
            <div class="form-check col-md-4">
                <input class="form-check-input" type="radio" value="Non-collegiate" id="non_coll" name="fav_language">
                <label class="form-check-label" for="non_coll">
                    Non-collegiate
                </label>
            </div>
        </div>

        <div class="mb-3">
            <label for="pass_div" class="form-label">Enter passing division :</label>
            <input type="text" class="form-control form-control-sm" id="pass_div" placeholder="Enter passing division" minlength="1" maxlength="2"
                required>
        </div>

        <div class="mb-3">
            <label for="full_address" class="form-label">Full address :</label>
            <input type="text" class="form-control form-control-sm" id="full_address" placeholder="Enter your full address"
                minlength="10" maxlength="300" required>
        </div>

        <div class="mb-3">
            <label for="email_id" class="form-label">Email Id :</label>
            <input type="email" class="form-control form-control-sm" id="email_id" placeholder="Enter your email address" minlength="3"  maxlength="100" required>
        </div>

        <div class="mb-3">
            <label for="mobile_no" class="form-label">Mobile No. :</label>
            <input type="tel" class="form-control form-control-sm" id="mobile_no" placeholder="Enter your mobile number" minlength="10"
                maxlength="10" required>
        </div>

        <div class="mb-3">
            <label for="aadhaar_no" class="form-label">AADHAAR No :</label>
            <input type="text" class="form-control form-control-sm" id="aadhaar_no" placeholder="Enter your aadhaar number" minlength="12"
                maxlength="12" required>
        </div>

        <div class="mb-3">
        <button style="width:100%" type="submit" class="button" data-value="Pay for order">Proceed and Pay ₹<?php echo $form["fees"] ?>/-</button>
        </div>

      
    </form>
</div>