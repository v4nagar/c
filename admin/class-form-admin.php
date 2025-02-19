<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://anurag.com
 * @since      1.0.0
 *
 * @package    Form
 * @subpackage Form/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Form
 * @subpackage Form/admin
 * @author     anurag <anurag@gmail.com>
 */
class Form_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/form-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/form-admin.js', array( 'jquery' ), $this->version, false );
		$params = array(
			'wp_admin_ajax_url' => admin_url("admin-ajax.php"),
		);
		wp_localize_script($this->plugin_name, 'childParams', $params);
	}

	public function my_custom_admin_menu() {
		add_menu_page(
			'Fee Portal Settings',        // Page title
			'Fee Portal',             // Menu title
			'manage_options',           // Capability
			'custom-admin-page',        // Menu slug
			array($this,'my_custom_admin_page'),     // Function
			'dashicons-admin-generic',  // Icon URL (optional)
			90                          // Position (optional)
		);
	}
	function my_custom_admin_page() {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Process the form data
			$collegeName = $_POST['college_name'];
			$collegeAddress = $_POST['college_address'];
			$logoUrl = $_POST['logo_url'];
			$degreeTitle = $_POST['degree_title'];
			$degreeFee = $_POST['degree_fee'];
			$degreeActive = isset($_POST['degree_active']) ? 'Yes' : 'No';
			$degreeTitle2 = $_POST['degree_title_2'];
			$degreeFee2 = $_POST['degree_fee_2'];
			$degreeActive2 = isset($_POST['degree_active_2']) ? 'Yes' : 'No';
			$tcCcTitle = $_POST['tc_cc_title'];
			$tcCcFee = $_POST['tc_cc_amount'];
			$tcCcActive = isset($_POST['tc_cc_active']) ? 'Yes' : 'No';
			$scTitle = $_POST['certificate_title'];
			$scFee = $_POST['certificate_amount'];
			$scActive = isset($_POST['certificate_active']) ? 'Yes' : 'No';
			$cdcTitle = $_POST['cdc_form_title'];
			$cdcFee = $_POST['cdc_form_amount'];
			$cdcActive = isset($_POST['cdc_form_active']) ? 'Yes' : 'No';
			$cdcGeoTitle = $_POST['geo_form_title'];
			$cdcGeoFee = $_POST['geo_form_amount'];
			$cdcGeoActive = isset($_POST['geo_form_active']) ? 'Yes' : 'No';

			// For demonstration, let's output the values
			// echo "<h2>Form Data Received:</h2>";
			// echo "College Name: $collegeName<br>";
			// echo "College Address: $collegeAddress<br>";
			// echo "Logo URL: $logoUrl<br>";
			//echo "Degree Form - Title: $degreeTitle, Fee Amount: $degreeFee, Active: $degreeActive<br>";
			// echo "TC CC Form - Title: $tcCcTitle, Fee Amount: $tcCcFee, Active: $tcCcActive<br>";
			// echo "Studying Certificate Form - Title: $scTitle, Fee Amount: $scFee, Active: $scActive<br>";
			// echo "CDC Form - Title: $cdcTitle, Fee Amount: $cdcFee, Active: $cdcActive<br>";
			// echo "CDC Geography Form - Title: $cdcGeoTitle, Fee Amount: $cdcGeoFee, Active: $cdcGeoActive<br>";	
			$fee = [
				'degree'=>array(
					"id"=>"degree_form",
					"title"=>$degreeTitle,
					"fees"=>$degreeFee,
					"active"=> $degreeActive,
		
			),
			
				'degree_2'=>array(
					"id"=>"degree_form_2",
					"title"=>$degreeTitle2,
					"fees"=>$degreeFee2,
					"active"=> $degreeActive2,
		
			),

				'tt_cc'=>array(
					"id"=>"tt_cc_form",
					"title"=>$tcCcTitle,
					"fees"=>$tcCcFee,
					//"fees"=>1,
					"active"=>$tcCcActive,
				
			),
				'studying_certificate'=>array(
					"id"=>"studying_certificate_form",
					"title"=>$scTitle,
					"fees"=>$scFee,
					//"fees"=>1,
					"active"=>$scActive,
				
			),
				'cdc_fee'=>array(
					"id"=>"cdc_fee_form",
					"title"=>$cdcTitle,
					"fees"=>$cdcFee,
					//"fees"=>1,
					"active"=>$cdcActive,
				
			),
				'cdc_fee_geography'=>array(
					"id"=>"cdc_fee_geography_form",
					"title"=>$cdcGeoTitle,
					"fees"=>$cdcGeoFee,
					//"fees"=>1,
					"active"=>$cdcGeoActive,
				
			),
			];
			$fee_portal_setting = [
				'collegeName'    => $collegeName,
				'collegeAddress' => $collegeAddress,
				'logoUrl'        => $logoUrl,
				'fee'            => $fee,
			];

        // echo json_encode($fee_portal_setting); exit;
			

		update_option('fee_portal_settings',$fee_portal_setting);
		}
		$option = get_option('fee_portal_settings');
		//echo json_encode($option); exit;




    ?>
    <div class="wrap">
        <h1>My Custom Admin Page</h1>
		<br>
	</div>
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css"
		>
		
		<style>
					body {
						font-family: Arial, sans-serif;
						margin: 20px;
					}
					.field.is-horizontal {
						display: flex;
						align-items: center;
						margin-bottom: 15px;
					}
					.field.is-horizontal > div {
						margin-right: 10px;
					}
					.label {
						width: 150px;
					}
					.control input[type="text"] {
						width: 200px;
						padding: 8px;
						box-sizing: border-box;
					}
		</style>
			
        <form method="post" >
		<div>
			<div class="field is-horizontal">
				<div>
					<label class="label">College Name</label>
				</div>	
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="college_name" value="<?= $option["collegeName"] ?>" type="text" placeholder="College Name">
					</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div >
					<label class="label">College Address</label>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="college_address" value="<?= $option["collegeAddress"] ?>" type="text" placeholder="College Address">
					</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div>
					<label class="label">Logo URL</label>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="logo_url" value="<?= $option["logoUrl"] ?>" type="text" placeholder="Logo URL">
					</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div>
					<label class="label">Degree Form 2011</label>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="degree_title" value="<?= $option["fee"]["degree"]["title"] ?>" type="text" placeholder="Title">
					</div>
					</div>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="degree_fee" value="<?= $option["fee"]["degree"]["fees"] ?>" type="text" placeholder="Fee Amount">
					</div>
					</div>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<label class="checkbox">
								<input name="degree_active" <? echo $option["fee"]["degree"]["active"]=="Yes"?"checked":""; ?> type="checkbox" />
									Active
							</label>
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div>
					<label class="label">Degree Form 2012</label>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="degree_title_2" value="<?= $option["fee"]["degree_2"]["title"] ?>" type="text" placeholder="Title">
					</div>
					</div>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="degree_fee_2" value="<?= $option["fee"]["degree_2"]["fees"] ?>" type="text" placeholder="Fee Amount">
					</div>
					</div>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<label class="checkbox">
								<input name="degree_active_2" <? echo $option["fee"]["degree_2"]["active"]=="Yes"?"checked":""; ?> type="checkbox" />
									Active
							</label>
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div>
					<label class="label">TC CC Form</label>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="tc_cc_title" value="<?= $option["fee"]["tt_cc"]["title"] ?>" type="text" placeholder="Title">
					</div>
					</div>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="tc_cc_amount" value="<?= $option["fee"]["tt_cc"]["fees"] ?>" type="text" placeholder="Fee Amount">
					</div>
					</div>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<label class="checkbox">
								<input name="tc_cc_active" <? echo $option["fee"]["tt_cc"]["active"]=="Yes"?"checked":""; ?> type="checkbox" />
									Active
							</label>
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div>
					<label class="label">Studying Certificate Form</label>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="certificate_title" value="<?= $option["fee"]["studying_certificate"]["title"] ?>" type="text" placeholder="Title">
					</div>
					</div>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="certificate_amount" value="<?= $option["fee"]["studying_certificate"]["fees"] ?>" type="text" placeholder="Fee Amount">
					</div>
					</div>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<label class="checkbox">
								<input name="certificate_active" <? echo $option["fee"]["studying_certificate"]["active"]=="Yes"?"checked":""; ?> type="checkbox" />
									Active
							</label>
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div>
					<label class="label">CDC Form</label>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="cdc_form_title" value="<?= $option["fee"]["cdc_fee"]["title"] ?>" type="text" placeholder="Title">
					</div>
					</div>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="cdc_form_amount" value="<?= $option["fee"]["cdc_fee"]["fees"] ?>" type="text" placeholder="Fee Amount">
					</div>
					</div>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<label class="checkbox">
								<input name="cdc_form_active" <? echo $option["fee"]["cdc_fee"]["active"]=="Yes"?"checked":""; ?>  type="checkbox" />
									Active
							</label>
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div>
					<label class="label">CDC Geography Form</label>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="geo_form_title" value="<?= $option["fee"]["cdc_fee_geography"]["title"] ?>" type="text" placeholder="Title">
					</div>
					</div>
				</div>
				<div class="field-body">
					<div class="field">
					<div class="control">
						<input name="geo_form_amount" value="<?= $option["fee"]["cdc_fee_geography"]["fees"] ?>" type="text" placeholder="Fee Amount">
					</div>
					</div>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<label class="checkbox">
								<input name="geo_form_active" <? echo $option["fee"]["cdc_fee_geography"]["active"]=="Yes"?"checked":""; ?> type="checkbox" />
									Active
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="submit">
				<input type="submit" name="submit" id="submit" class="button button-primary" value="Update File">
				<span class="spinner"></span>
			</div>
        </form>
    </div>

	
	
		
	
    <?php
	}
	
	public function add_meta_boxes_edit_order_page() {
		
			add_meta_box( 'bt_fee_portal_order_meta_box', __( 'Fee Form' ),
				array( $this, 'custom_metabox_content' ), 'woocommerce_page_wc-orders', 'side', 'high');
		}

	public function add_meta_boxes_edit_order_page_form() {
		
			add_meta_box( 'bt_fee_portal_order_form_meta_box', __( 'fee Form' ),
				array( $this, 'custom_metabox_form' ), 'woocommerce_page_wc-orders', 'normal', 'high');
		}

	public function fee_portal_handler(){
		$value = get_option('fee_portal_settings');
		// echo json_encode($value); exit;
		define( 'MLV_FORMS_ARRAY', $value['fee']);


		if (isset($_GET["download_form"]) && isset($_GET["order_id"]) && isset($_GET["type"])) {
			// var_dump($_GET["order_id"]); die;
			$from_data = get_post_meta($_GET["order_id"])['form_data'];
			$from_data = unserialize($from_data[0]);
			$order_id = sanitize_text_field($_GET["order_id"]);
			$type = sanitize_text_field($_GET["type"]);

			$tc_sno = Form::college_get_order_meta($order_id, 'tc_form_serial_number',true);
			$cc_sno = Form::college_get_order_meta($order_id, 'cc_form_serial_number',true);
			
			$tc_cc_count = Form::college_get_order_meta($order_id, 'tc_cc_count',true);
			$tc_cc_count++;
			$cc_count = Form::college_get_order_meta($order_id, 'cc_count',true);
			$cc_count++;
		
			if($type=="cc"){
				include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/print-cc-form-templet.php';
				$count = Form::college_update_order_meta($order_id, 'cc_count',$cc_count);
			}elseif($type=="tc_cc"){
				$tc_cc_count = Form::college_update_order_meta($order_id, 'tc_cc_count',$tc_cc_count);
				include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/print-tc-cc-form-templet.php';
			}
		}
		
	}
	
	public function custom_metabox_content() {
			$post_id = isset($_GET['id']) ? $_GET['id'] : false;
			
			if (! $post_id) return;
			$url = wc_get_order($post_id);
			$key = $url->get_order_key();
	
			
	
			echo '<a href="/checkout/order-received/'.$post_id.'/?key='.$key.'">View Application</a>';
		}
		
	public function custom_metabox_form() {

		$post_id = isset($_GET['id']) ? $_GET['id'] : false;
		$form_name=Form::college_get_order_meta($post_id, 'form_name',true);
		//echo ($form_name);

		if($form_name =="degree_form"){
			
			$form_data = Form::college_get_order_meta($post_id, "form_data", true);
			//echo json_encode($form_data);
			$radio=$form_data['student'];
			echo ($radio);


			?>
			<div>
				<link
					rel="stylesheet"
					href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css"
				>
				<style>
					body {
						font-family: Arial, sans-serif;
						margin: 20px;
					}
					.field.is-horizontal {
						display: flex;
						align-items: center;
						margin-bottom: 15px;
					}
					.field.is-horizontal > div {
						margin-right: 10px;
					}
					.label {
						width: 150px;
					}
					.control input[type="text"] {
						width: 200px;
						padding: 8px;
						box-sizing: border-box;
					}
				</style>

				<form class="mt-5 degree_form" method="POST" id="save_degree_form" action="">
					<?php wp_nonce_field('degree_form'); ?>

					<input id="hidden_input_degree_form" type="hidden" name="action" value="degree_form_data">

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="name">Name :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input class="input" value="<?php echo $form_data['name']; ?>" type="text" id="name" name="name" placeholder="Enter your name" minlength="3" maxlength="80" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="f_name">Father's name :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input class="input" value="<?php echo $form_data['f_name']; ?>" type="text" id="f_name" name="f_name" placeholder="Enter your father's name" minlength="3" maxlength="80" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="appeared_in">Appeared in :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input class="input"  value="<?php echo $form_data['appeared']; ?>" type="text" id="appeared_in" name="appeared_in" placeholder="Enter class" minlength="1" maxlength="10" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="name_exam">Name of examination with year :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['exam']; ?>" class="input" type="text" id="name_exam" name="name_exam" placeholder="Exam name with year" minlength="1" maxlength="20" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="roll_no">Roll No. :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['roll_no']; ?>" class="input" type="number" id="roll_no" name="roll_no" placeholder="Enter roll number" minlength="2" maxlength="15" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label">Regular/Ex/Non-collegiate :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<label class="radio">
										<input type="radio" value="Regular Student" id="regular_st" name="r_e_n_collegiate" <?php echo ($form_data["student"] == "Regular Student") ? "checked" : ""; ?> required> Regular Student
									</label>
									<label class="radio">
										<input type="radio" value="Ex Student" id="ex_st" name="r_e_n_collegiate" <?php echo ($form_data["student"] == "Ex Student") ? "checked" : ""; ?>> Ex Student
									</label>
									<label class="radio">
										<input type="radio" value="Non-collegiate" id="non_coll" name="r_e_n_collegiate" <?php echo ($form_data["student"] == "Non-collegiate") ? "checked" : ""; ?>> Non-collegiate
									</label>
								</div>
							</div>
						</div>
					</div>


					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="pass_div">Enter passing division :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['pass']; ?>" class="input" type="text" id="pass_div" name="pass_div" placeholder="Enter passing division" minlength="1" maxlength="2" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="full_address">Full address :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['address']; ?>" class="input" type="text" id="full_address" name="full_address" placeholder="Enter your full address" minlength="10" maxlength="300" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="email_id">Email Id :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['email']; ?>" class="input" type="email" id="email_id" name="email_id" placeholder="Enter your email address" minlength="3" maxlength="100" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="mobile_no">Mobile No. :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['mobile']; ?>" class="input" type="tel" id="mobile_no" name="mobile_no" placeholder="Enter your mobile number" minlength="10" maxlength="10" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="aadhaar_no">AADHAAR No :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['aadhaar']; ?>" class="input" type="text" id="aadhaar_no" name="aadhaar_no" placeholder="Enter your aadhaar number" minlength="12" maxlength="12" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field">
						<div class="control">
							<button id="save_degree_form" style="width:100%" type="submit" class="button is-primary" data-value="Pay for order">Update Form</button>
						</div>
					</div>
				</form>
			</div>

		<?php
		}

		else if($form_name =="tt_cc_form"){

			$form_data = Form::college_get_order_meta($post_id, "form_data", true);


			?>
			<div>
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
				<style>
					body {
						font-family: Arial, sans-serif;
						margin: 20px;
					}
					.form-container {
						max-width: 800px;
						margin: auto;
					}
					.table input {
						width: 100%;
						box-sizing: border-box;
					}
				</style>

				<form class="form-container mt-5" method="POST" id="save_tc_cc_form" action="">
					<?php wp_nonce_field('tc_cc_form'); ?>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="tc_full_name">Full Name:</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['name']; ?>" class="input" type="text" id="tc_full_name" name="tc_full_name" placeholder="Enter your full name" minlength="3" maxlength="80" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="tc_father_name">Father's Name:</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['father']; ?>" class="input" type="text" id="tc_father_name" name="tc_father_name" placeholder="Enter your father's name" minlength="3" maxlength="80" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="tc_mother_name">Mother's Name:</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['mother']; ?>" class="input" type="text" id="tc_mother_name" name="tc_mother_name" placeholder="Enter your mother's name" minlength="3" maxlength="80" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="tc_name_class_faculty">Name of Class & Faculty in which admitted:</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['faculty']; ?>" class="input" type="text" id="tc_name_class_faculty" name="tc_name_class_faculty" placeholder="Enter class and faculty" minlength="3" maxlength="50" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="tc_date_admission">Date of admission in the College:</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['d_admission']; ?>" class="input" type="date" id="tc_date_admission" name="tc_date_admission" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="tc_d_exam_pass">Details of examination last pass out:</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['d_exam']; ?>" class="input" type="text" id="tc_d_exam_pass" name="tc_d_exam_pass" placeholder="Enter details of examination" minlength="3" maxlength="30" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="tc_dob">Date of Birth:</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['dob']; ?>" class="input" type="date" id="tc_dob" name="tc_dob" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="tc_permanent_address">Permanent Address:</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['per_address']; ?>" class="input" type="text" id="tc_permanent_address" name="tc_permanent_address" placeholder="Enter your permanent address" minlength="3" maxlength="300" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="tc_present_address">Present Address:</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['pre_address']; ?>" class="input" type="text" id="tc_present_address" name="tc_present_address" placeholder="Enter your present address" minlength="3" maxlength="300" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="tc_mobile_no">Mobile No.:</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['mobile']; ?>" class="input" type="tel" id="tc_mobile_no" name="tc_mobile_no" placeholder="Enter your mobile number" minlength="10" maxlength="10" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="tc_aadhaar_no">AADHAAR No:</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['aadhaar']; ?>" class="input" type="text" id="tc_aadhaar_no" name="tc_aadhaar_no" placeholder="Enter your aadhaar number" minlength="12" maxlength="12" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label class="label" for="tc_email_id">E-mail Id:</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['email']; ?>" class="input" type="email" id="tc_email_id" name="tc_email_id" placeholder="Enter your email address" minlength="3" maxlength="100" required>
								</div>
							</div>
						</div>
					</div>

					<h5 class="m-5 has-text-centered">Academic Record</h5>

					<table class="table is-fullwidth academic_record_table">
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
								<td><input value="<?php echo $form_data['s_one']; ?>" class="input" id="tc_session_one" type="text" name="tc_session_one" required></td>
								<td><input value="<?php echo $form_data['c_one']; ?>" class="input" id="tc_class_one" type="text" name="tc_class_one" required></td>
								<td><input value="<?php echo $form_data['rn_one']; ?>" class="input" id="tc_roll_no_one" type="text" name="tc_roll_no_one" required></td>
								<td><input value="<?php echo $form_data['pf_one']; ?>" class="input" id="tc_result_one" type="text" name="tc_result_one" required></td>
							</tr>
							<tr>
								<td><input value="<?php echo $form_data['s_two']; ?>" class="input" id="tc_session_two" type="text" name="tc_session_two"></td>
								<td><input value="<?php echo $form_data['c_two']; ?>" class="input" id="tc_class_two" type="text" name="tc_class_two"></td>
								<td><input value="<?php echo $form_data['rn_two']; ?>" class="input" id="tc_roll_no_two" type="text" name="tc_roll_no_two"></td>
								<td><input value="<?php echo $form_data['pf_two']; ?>" class="input" id="tc_result_two" type="text" name="tc_result_two"></td>
							</tr>
							<tr>
								<td><input value="<?php echo $form_data['s_three']; ?>" class="input" id="tc_session_three" type="text" name="tc_session_three"></td>
								<td><input value="<?php echo $form_data['c_three']; ?>" class="input" id="tc_class_three" type="text" name="tc_class_three"></td>
								<td><input value="<?php echo $form_data['rn_three']; ?>" class="input" id="tc_roll_no_three" type="text" name="tc_roll_no_three"></td>
								<td><input value="<?php echo $form_data['pf_three']; ?>" class="input" id="tc_result_three" type="text" name="tc_result_three"></td>
							</tr>
							<tr>
								<td><input value="<?php echo $form_data['s_four']; ?>" class="input" id="tc_session_four" type="text" name="tc_session_four"></td>
								<td><input value="<?php echo $form_data['c_four']; ?>" class="input" id="tc_class_four" type="text" name="tc_class_four"></td>
								<td><input value="<?php echo $form_data['rn_four']; ?>" class="input" id="tc_roll_no_four" type="text" name="tc_roll_no_four"></td>
								<td><input value="<?php echo $form_data['pf_four']; ?>" class="input" id="tc_result_four" type="text" name="tc_result_four"></td>
							</tr>
							<tr>
								<td><input value="<?php echo $form_data['s_five']; ?>" class="input" id="tc_session_five" type="text" name="tc_session_five"></td>
								<td><input value="<?php echo $form_data['c_five']; ?>" class="input" id="tc_class_five" type="text" name="tc_class_five"></td>
								<td><input value="<?php echo $form_data['rn_five']; ?>" class="input" id="tc_roll_no_five" type="text" name="tc_roll_no_five"></td>
								<td><input value="<?php echo $form_data['pf_five']; ?>" class="input" id="tc_result_five" type="text" name="tc_result_five"></td>
							</tr>
						</tbody>
					</table>
					
					<div class="field">
						<div class="control">
							<button id="save_tc_cc_form" style="width:100%" type="submit" class="button is-primary">Update Form</button>
						</div>
					</div>
						
					
				</form>
			</div>



		<?php
		}

		else if($form_name =="studying_certificate_form"){

			$form_data = Form::college_get_order_meta($post_id, "form_data", true);


			?>
			<div>
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
				<style>
					body {
						font-family: Arial, sans-serif;
						margin: 20px;
					}
					.form-container {
						max-width: 800px;
						margin: auto;
					}
					.table input {
						width: 100%;
						box-sizing: border-box;
					}
					
					/* .field.is-horizontal .field-label {
						justify-content: flex-end;
					} */
				</style>

				<div class="form-container">
					<form class="mt-5 studing_form" method="POST" id="save_studing_form" action="">
						<?php wp_nonce_field('studing_form'); ?>

						<div class="field is-horizontal">
							<div class="field-label is-normal">
								<label class="label" for="studing_full_name">Full Name :</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<input value="<?php echo $form_data['name']; ?>" type="text" class="input" id="studing_full_name" name="studing_full_name" placeholder="Enter your name" minlength="3" maxlength="80" required>
									</div>
								</div>
							</div>
						</div>

						<div class="field is-horizontal">
							<div class="field-label is-normal">
								<label class="label" for="studing_father_name">Father's Name :</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<input value="<?php echo $form_data['father']; ?>" type="text" class="input" id="studing_father_name" name="studing_father_name" placeholder="Enter your father's name" minlength="3" maxlength="80" required>
									</div>
								</div>
							</div>
						</div>

						<div class="field is-horizontal">
							<div class="field-label is-normal">
								<label class="label" for="studing_mother_name">Mother's Name :</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<input value="<?php echo $form_data['mother']; ?>" type="text" class="input" id="studing_mother_name" name="studing_mother_name" placeholder="Enter your mother's name" minlength="3" maxlength="80" required>
									</div>
								</div>
							</div>
						</div>

						<div class="field is-horizontal">
							<div class="field-label is-normal">
								<label class="label" for="studing_name_class_faculty">Name of class & faculty in which admitted :</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<input value="<?php echo $form_data['faculty']; ?>" type="text" class="input" id="studing_name_class_faculty" name="studing_name_class_faculty" placeholder="Enter your class and faculty" minlength="3" maxlength="30" required>
									</div>
								</div>
							</div>
						</div>

						<div class="field is-horizontal">
							<div class="field-label is-normal">
								<label class="label" for="studing_date_admission">Date of admission in the college :</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<input value="<?php echo $form_data['d_admission']; ?>" type="date" class="input" id="studing_date_admission" name="studing_date_admission" placeholder="Select admission date" required>
									</div>
								</div>
							</div>
						</div>

						<div class="field is-horizontal">
							<div class="field-label is-normal">
								<label class="label" for="studing_d_exam_pass">Name of examination last passed out :</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<input value="<?php echo $form_data['d_exam']; ?>" type="text" class="input" id="studing_d_exam_pass" name="studing_d_exam_pass" placeholder="Enter name of examination last passed out" minlength="3" maxlength="30" required>
									</div>
								</div>
							</div>
						</div>

						<div class="field is-horizontal">
							<div class="field-label is-normal">
								<label class="label" for="studing_dob">Date of Birth :</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<input value="<?php echo $form_data['dob']; ?>" type="date" class="input" id="studing_dob" name="studing_dob" placeholder="Select date of birth" required>
									</div>
								</div>
							</div>
						</div>

						<div class="field is-horizontal">
							<div class="field-label is-normal">
								<label class="label" for="studing_permanent_address">Permanent Address :</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<input value="<?php echo $form_data['per_address']; ?>" type="text" class="input" id="studing_permanent_address" name="studing_permanent_address" placeholder="Enter your permanent address" minlength="3" maxlength="300" required>
									</div>
								</div>
							</div>
						</div>

						<div class="field is-horizontal">
							<div class="field-label is-normal">
								<label class="label" for="studing_present_address">Present Address :</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<input value="<?php echo $form_data['pre_address']; ?>" type="text" class="input" id="studing_present_address" name="studing_present_address" placeholder="Enter your present address" minlength="3" maxlength="300" required>
									</div>
								</div>
							</div>
						</div>

						<div class="field is-horizontal">
							<div class="field-label is-normal">
								<label class="label" for="studing_mobile_no">Mobile No. :</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<input value="<?php echo $form_data['mobile']; ?>" type="tel" class="input" id="studing_mobile_no" name="studing_mobile_no" placeholder="Enter your mobile number" minlength="10" maxlength="10" required>
									</div>
								</div>
							</div>
						</div>

						<div class="field is-horizontal">
							<div class="field-label is-normal">
								<label class="label" for="studing_aadhaar_no">Aadhaar No :</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<input value="<?php echo $form_data['aadhaar']; ?>" type="text" class="input" id="studing_aadhaar_no" name="studing_aadhaar_no" placeholder="Enter your aadhaar number" minlength="12" maxlength="12" required>
									</div>
								</div>
							</div>
						</div>

						<div class="field is-horizontal">
							<div class="field-label is-normal">
								<label class="label" for="studing_email_id">E-mail Id :</label>
							</div>
							<div class="field-body">
								<div class="field">
									<div class="control">
										<input value="<?php echo $form_data['email']; ?>" type="email" class="input" id="studing_email_id" name="studing_email_id" placeholder="Enter your email address" minlength="3" maxlength="100" required>
									</div>
								</div>
							</div>
						</div>

						<h5 class="m-5 has-text-centered">Academic Record</h5>

							<table class="table is-fullwidth academic_record_table">
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
										<td><input value="<?php echo $form_data['s_one']; ?>" id="studing_session_one" name="studing_session_one" type="text" required></td>
										<td><input value="<?php echo $form_data['c_one']; ?>" id="studing_class_one" name="studing_class_one" type="text" required></td>
										<td><input value="<?php echo $form_data['rn_one']; ?>" id="studing_roll_no_one" name="studing_roll_no_one" type="text" required></td>
										<td><input value="<?php echo $form_data['pf_one']; ?>" id="studing_result_one" name="studing_result_one" type="text" required></td>
									</tr>
									<tr>
										<td><input value="<?php echo $form_data['s_two']; ?>" id="studing_session_two" name="studing_session_two" type="text" required></td>
										<td><input value="<?php echo $form_data['c_two']; ?>" id="studing_class_two" name="studing_class_two" type="text" required></td>
										<td><input value="<?php echo $form_data['rn_two']; ?>" id="studing_roll_no_two" name="studing_roll_no_two" type="text" required></td>
										<td><input value="<?php echo $form_data['pf_two']; ?>" id="studing_result_two" name="studing_result_two" type="text" required></td>
									</tr>
									<tr>
										<td><input value="<?php echo $form_data['s_three']; ?>" id="studing_session_three" name="studing_session_three" type="text" required></td>
										<td><input value="<?php echo $form_data['c_three']; ?>" id="studing_class_three" name="studing_class_three" type="text" required></td>
										<td><input value="<?php echo $form_data['rn_three']; ?>" id="studing_roll_no_three" name="studing_roll_no_three" type="text" required></td>
										<td><input value="<?php echo $form_data['pf_three']; ?>" id="studing_result_three" name="studing_result_three" type="text" required></td>
									</tr>
									<tr>
										<td><input value="<?php echo $form_data['s_four']; ?>" id="studing_session_four" name="studing_session_four" type="text" required></td>
										<td><input value="<?php echo $form_data['c_four']; ?>" id="studing_class_four" name="studing_class_four" type="text" required></td>
										<td><input value="<?php echo $form_data['rn_four']; ?>" id="studing_roll_no_four" name="studing_roll_no_four" type="text" required></td>
										<td><input value="<?php echo $form_data['pf_four']; ?>" id="studing_result_four" name="studing_result_four" type="text" required></td>
									</tr>
									<tr>
										<td><input value="<?php echo $form_data['s_five']; ?>" id="studing_session_five" name="studing_session_five" type="text" required></td>
										<td><input value="<?php echo $form_data['c_five']; ?>" id="studing_class_five" name="studing_class_five" type="text" required></td>
										<td><input value="<?php echo $form_data['rn_five']; ?>" id="studing_roll_no_five" name="studing_roll_no_five" type="text" required></td>
										<td><input value="<?php echo $form_data['pf_five']; ?>" id="studing_result_five" name="studing_result_five" type="text" required></td>
									</tr>
								</tbody>
							</table>

							<div class="field">
								<div class="control">
									<button id="save_studing_form" style="width:100%" type="submit" class="button is-link">Update Form</button>
								</div>
							</div>
					</form>
				</div>
			</div>





		<?php
		}

		else if($form_name =="cdc_fee_form"){

			$form_data = Form::college_get_order_meta($post_id, "form_data", true);


			?>
			<div>
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
				<style>
					body {
						font-family: Arial, sans-serif;
						margin: 20px;
					}
					.field.is-horizontal .field-label {
						align-items: center;
						display: flex;
						justify-content: flex-end;
						margin-right: 20px;
					}
				</style>

				<form class="mt-5 cdc_form" method="POST" id="save_cdc_form" action="">
					<?php wp_nonce_field('cdc_form'); ?>
					
					<div class="field is-horizontal">
						<div class="field-label">
							<label for="cdc_full_name" class="label">Full Name :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['name']; ?>" type="text" class="input" id="cdc_full_name" name="cdc_full_name" placeholder="Enter your full name" minlength="3" maxlength="80" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="cdc_father_name" class="label">Father's Name :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['father']; ?>" type="text" class="input" id="cdc_father_name" name="cdc_father_name" placeholder="Enter your father's name" minlength="3" maxlength="80" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="cdc_mother_name" class="label">Mother's Name :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['mother']; ?>" type="text" class="input" id="cdc_mother_name" name="cdc_mother_name" placeholder="Enter your mother's name" minlength="3" maxlength="80" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="cdc_dob" class="label">Date of Birth :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['dob']; ?>" type="date" class="input" id="cdc_dob" name="cdc_dob" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="cdc_name_class" class="label">Name of Class for which examination form filled :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['class_name']; ?>" type="text" class="input" id="cdc_name_class" name="cdc_name_class" placeholder="Enter the name of class for which examination form filled" minlength="3" maxlength="30" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="cdc_date_submission" class="label">Date of submission in the college :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['d_submission']; ?>" type="date" class="input" id="cdc_date_submission" name="cdc_date_submission" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="cdc_u_exam_f_no" class="label">University examination form number :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['form_no']; ?>" type="text" class="input" id="cdc_u_exam_f_no" name="cdc_u_exam_f_no" placeholder="Enter your university examination form number" minlength="3" maxlength="30" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="cdc_permanent_address" class="label">Permanent Address :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['per_address']; ?>" type="text" class="input" id="cdc_permanent_address" name="cdc_permanent_address" placeholder="Enter your permanent address" minlength="3" maxlength="300" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="cdc_present_address" class="label">Present Address :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['pre_address']; ?>" type="text" class="input" id="cdc_permanent_address" name="cdc_permanent_address" placeholder="Enter your present address" minlength="3" maxlength="300" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="cdc_mobile_no" class="label">Mobile No. :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['mobile']; ?>" type="tel" class="input" id="cdc_mobile_no" name="cdc_mobile_no" placeholder="Enter your mobile number" minlength="10" maxlength="10" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="cdc_aadhaar_no" class="label">AADHAAR No :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['aadhaar']; ?>" type="text" class="input" id="cdc_aadhaar_no" name="cdc_aadhaar_no" placeholder="Enter your aadhaar number" minlength="12" maxlength="12" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label">
							<label for="cdc_email_id" class="label">E-mail Id :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['email']; ?>" type="email" class="input" id="cdc_email_id" name="cdc_email_id" placeholder="Enter your email address" minlength="3" maxlength="100" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field">
						<div class="control">
							<button id="save_cdc_form" style="width:100%" type="submit" class="button is-primary" data-value="Pay for order">Update Form</button>
						</div>
					</div>
				</form>
			</div>


		<?php
		}

		else if($form_name =="cdc_fee_geography_form"){

			$form_data = Form::college_get_order_meta($post_id, "form_data", true);


			?>
			<div>
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
				<style>
					body {
						font-family: Arial, sans-serif;
						margin: 20px;
					}
					.field-label {
						justify-content: flex-end;
						padding-right: 10px;
					}
					.input, .select, .textarea {
						max-width: 300px;
					}
				</style>

				<form class="mt-5 cdc_geo_form" method="POST" id="save_cdc_geo_form" action="">
					<?php wp_nonce_field('cdc_geo_form'); ?>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label for="cdc_geo_full_name" class="label">Full Name :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['name']; ?>" type="text" class="input" id="cdc_geo_full_name" name="cdc_geo_full_name" placeholder="Enter your full name" minlength="3" maxlength="80" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label for="cdc_geo_father_name" class="label">Father's Name :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['father']; ?>" type="text" class="input" id="cdc_geo_father_name" name="cdc_geo_father_name" placeholder="Enter your father's name" minlength="3" maxlength="80" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label for="cdc_geo_mother_name" class="label">Mother's Name :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['mother']; ?>" type="text" class="input" id="cdc_geo_mother_name" name="cdc_geo_mother_name" placeholder="Enter your mother's name" minlength="3" maxlength="80" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label for="cdc_geo_dob" class="label">Date of Birth :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['dob']; ?>" type="date" class="input" id="cdc_geo_dob" name="cdc_geo_dob" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label for="cdc_geo_name_class" class="label">Name of Class :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['class_name']; ?>"  type="text" class="input" id="cdc_geo_name_class" name="cdc_geo_name_class" placeholder="Enter the name of class for which examination form filled" minlength="3" maxlength="30" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label for="cdc_geo_date_submission" class="label">Date of Submission :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['d_submission']; ?>"  type="date" class="input" id="cdc_geo_date_submission" name="cdc_geo_date_submission" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label for="cdc_geo_u_exam_f_no" class="label">University Exam No. :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['form_no']; ?>" type="text" class="input" id="cdc_geo_u_exam_f_no" name="cdc_geo_u_exam_f_no" placeholder="Enter your university examination form number" minlength="3" maxlength="30" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label for="cdc_geo_mobile_no" class="label">Mobile No. :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['mobile']; ?>" type="tel" class="input" id="cdc_geo_mobile_no" name="cdc_geo_mobile_no" placeholder="Enter your mobile number" minlength="10" maxlength="10" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label for="cdc_geo_aadhaar_no" class="label">AADHAAR No :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['aadhaar']; ?>" type="text" class="input" id="cdc_geo_aadhaar_no" name="cdc_geo_aadhaar_no" placeholder="Enter your aadhaar number" minlength="12" maxlength="12" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label for="cdc_geo_email_id" class="label">E-mail Id :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['email']; ?>" type="email" class="input" id="cdc_geo_email_id" name="cdc_geo_email_id" placeholder="Enter your email address" minlength="3" maxlength="120" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label for="cdc_geo_present_address" class="label">Present Address :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['pre_address']; ?>" type="text" class="input" id="cdc_geo_present_address" name="cdc_geo_present_address" placeholder="Enter your present address" minlength="3" maxlength="300" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<label for="cdc_geo_permanent_address" class="label">Permanent Address :</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input value="<?php echo $form_data['per_address']; ?>" type="text" class="input" id="cdc_geo_permanent_address" name="cdc_geo_permanent_address" placeholder="Enter your permanent address" minlength="3" maxlength="300" required>
								</div>
							</div>
						</div>
					</div>

					<div class="field">
						<div class="control">
							<button id="save_cdc_geo_form" style="width:100%" type="submit" class="button is-primary" data-value="Pay for order">Update Form</button>
						</div>
					</div>
				</form>
			</div>



		<?php
		}


		}
		public function custom_shop_order_column($columns){
			$reordered_columns = array();
			foreach( $columns as $key => $column){
				$reordered_columns[$key] = $column;
				if( $key ==  'order_status' ){
					$reordered_columns['mlv-tc-cc-status'] = 'Download';
				}
			}
			return $reordered_columns;
		}
		public function custom_orders_list_column_content_hpos( $column, $order ){
			$this->custom_orders_list_column_content($column,$order->get_id());
		}
		public function custom_orders_list_column_content( $column, $order_id ){
			switch ( $column )
			{
				case 'mlv-tc-cc-status' :
					echo "<div class='mlv-tc-cc-status-" . esc_attr($order_id) . "'>";
					include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/mlv-tc-cc-status.php';
					echo "</div>" ;
					
					break;
			}
		}


		public function rudr_order_filter($post_type, $which) {
			if ('shop_order' !== $post_type) {
				return;
			}

			// Get the selected filter value from the query form_name
			$form_name = isset($_GET['form_name']) ? sanitize_text_field($_GET['form_name']) : '';
			?>
			<select name="form_name">
				<option value=""><?php esc_html_e('Select', 'textdomain'); ?></option>
				<option value="tt_cc_form" <?php selected($form_name, 'tt_cc_form'); ?>>
					<?php esc_html_e('TC and CC', 'textdomain'); ?>
				</option>
			</select>
			<?php
		}

		public function add_filter_in_order_list($query_args) {
			if (isset($_GET['form_name']) && !empty($_GET['form_name'])) {
				$query_args['meta_query'][] = array(
					'key'     => 'form_name',
					'value'   => sanitize_text_field($_GET['form_name']),
					'compare' => 'LIKE'
				);
		// 			echo "<pre>"; print_r($query_args); die;

			}

			return $query_args;
		}
		
}
