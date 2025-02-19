<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://anurag.com
 * @since      1.0.0
 *
 * @package    Form
 * @subpackage Form/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Form
 * @subpackage Form/public
 * @author     anurag <anurag@gmail.com>
 */
class Form_Public
{

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/form-public.css', array(), $this->version, 'all');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/form-public.js', array('jquery'), $this->version, false);
		$params = array(
			'wp_admin_ajax_url' => admin_url("admin-ajax.php"),
		);
		wp_localize_script($this->plugin_name, 'childParams', $params);
	}

	function wpbootstrap_enqueue_styles()
	{
		wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css');
	}

	public function display_degree_form()
	{
		
		ob_start();
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/public_display_degree_form.php';
		$page = ob_get_contents();
		ob_end_clean();
		return $page;
	}

	public function hey()
	{
		//error_reporting(E_ALL);
		//ini_set('display_errors', '1');
		//error_reporting(E_ALL);
		//ini_set('display_errors', '1');
		$fid = $_GET["fid"];
		$form_id=2;
		$sid = $this->get_submission_id_by_sequence_number($form_id,$fid );
		 // Get the submission by sequence number
		 $submission = Ninja_Forms()->form( 2)->get_sub($sid);
	
		//$submission = Ninja_Forms()->submisssions->get_submission( 2, $fid );
		$select = $submission->get_field_value("refund_type_1719556523631");
		// echo json_encode($select);
		//  exit;
		 //Check if the submission exists
		 if (empty($submission)) {
		 	return 'Submission not found.';
		 }

		 if ($select=="admission-fees") 
		 {
			//echo ("kaam ho gya bhai");
			$submission_id = $submission->get_id();
			$fields = $submission->get_field_values();
			$title = $submission->get_field_value("refund_type_1719556523631");
			$name = $submission->get_field_value( "student_name_1718355131147" );
			$mo_number = $submission->get_field_value( "mobile_number_1718355165724" );
			$fname = $submission->get_field_value( "father_s_name_1719555482437" );
			$class = $submission->get_field_value( "class_1719555506411" );
			$app_id = $submission->get_field_value( "application_id_number_1719555542675" );
			$amount = $submission->get_field_value( "amount_1719555569587" );
			$bank_name = $submission->get_field_value( "bank_name_1719555581715" );
			$bank_ac_num = $submission->get_field_value( "bank_a_c_number_1719555617442" );
			$ifsc = $submission->get_field_value( "ifsc_code_1719555630033" );
			$acc_holder_name = $submission->get_field_value( "account_holder_name_1719555654235" );
// 			$test = $submission->get_extra_value('date_created');
// 			echo json_encode($submission);
// 			exit;

			$created_at = date('d-m-Y');
// 			echo ($created_at);exit;


			//print_r( $submission ); exit;
			ob_start();
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/form-public-admission-refund-print-out.php';
			$page = ob_get_contents();
			ob_end_clean();
			return $page;
			return json_encode( $submission );
			//return 'hello,how' . $fid;
		}
		else
		{
			// // Retrieve the first submission (there should be only one)
		
			$submission_id = $submission->get_id();
			$fields = $submission->get_field_values();
			$title = $submission->get_field_value("refund_type_1719556523631");
			$name = $submission->get_field_value( "student_name_1718355131147" );
			$mo_number = $submission->get_field_value( "mobile_number_1718355165724" );
			$reason_refund = $submission->get_field_value( "reason_for_refund_1720185623612" );
			$payment_ref = $submission->get_field_value( "payment_reference_number_1718450467567" );
			$dup_payment_ref = $submission->get_field_value( "duplicate_payment_reference_number_1718450478021" );
			$p_date = $submission->get_field_value( "date_1718449993080" );
			$paid_for = $submission->get_field_value( "paid_for_1718450498083" );
			$paid_amount = $submission->get_field_value( "paid_amount_1718450509554" );
			$remark = $submission->get_field_value( "remarks_1718355714034" );

			$created_at = date('d-m-Y', strtotime($submission->get_extra_value('date')));
			//echo($created_at);exit;

			//print_r( $submission ); exit;
			ob_start();
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/form-public-duplicate_refund-print-out.php';
			$page = ob_get_contents();
			ob_end_clean();
			return $page;
			return json_encode( $submission );
			//return 'hello,how' . $fid;
		}	
	}
	function get_submission_id_by_sequence_number($form_id, $sequence_number) {
		// Ensure Ninja Forms is loaded
		if (!class_exists('NF_Database_Models_Submission')) {
			return 'Ninja Forms is not installed or activated.';
		}
	
		// Retrieve all submissions for the specified form ID
		$submissions = Ninja_Forms()->form($form_id)->get_subs();
	
		// Check if there are any submissions
		if (empty($submissions)) {
			return 'No submissions found for this form.';
		}
	
		// Find the submission with the matching sequence number
		foreach ($submissions as $submission) {
			if ($submission->get_seq_num() == $sequence_number) {
				// Return the submission ID
				return $submission->get_id();
			}
		}
	
		return 'No submission found with the specified sequence number.';
	}
	public function display_tc_cc_form()
	{
		ob_start();
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/public_display_tc_cc_form.php';
		$page = ob_get_contents();
		ob_end_clean();
		return $page;
	}
	public function display_studing_certificate_form()
	{
		ob_start();
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/public_display_studing_certificate_form.php';
		$page = ob_get_contents();
		ob_end_clean();
		return $page;
	}
	public function display_cdc_fee_form()
	{
		ob_start();
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/public_display_cdc_fee_form.php';
		$page = ob_get_contents();
		ob_end_clean();
		return $page;
	}
	public function display_cdc_fee_form_geo()
	{
		ob_start();
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/public_display_cdc_fee_form_geo.php';
		$page = ob_get_contents();
		ob_end_clean();
		return $page;
	}

	public function display_reprint_form()
	{
		$otp_sent = false;
		$mobile_number = null;
		$otp_verify_status = "";
		$action = "";
		if(isset($_POST['mobile_number']) && wp_verify_nonce($_POST['_wpnonce'],'reprint_form')){

			$mobile_number = $_POST['mobile_number'];
			$mobile_number = $this->clean_phone_number($mobile_number);
			if($_POST['action']=='sendotp'){
				$action = $_POST['action'];
				if(class_exists('Otpfy_For_Wordpress')){

					$server_arr = get_transient('send_otp_' . $value);
					if (false === $server_arr) {
						Otpfy_For_Wordpress::send_otp($mobile_number);
						set_transient('send_otp_' . $value, true, 30);
					}
					$otp_sent = true;
					
					
				}else{
					echo "Request failed, please contact admin.";
					exit;
				}
			} else if($_POST['action']=='verifyotp'){
				$user_otp = $_POST['otp'];
				$action = $_POST['action'];
				if(class_exists('Otpfy_For_Wordpress')){

					$res= Otpfy_For_Wordpress::verify_otp($mobile_number,$user_otp );
	
					if($res){
						$action = "verified";
						$ar_args   = array(
							'billing_phone' => $mobile_number,
							'return'        => 'ids',
						);
						$ar_orders = wc_get_orders( $ar_args );
						//print_r($ar_orders );
						//exit;
					}else{
						$otp_verify_status = "Invalid OTP, please try again.";
					}
	
				}
			}
		}
		ob_start();
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/display_reprint_form.php';
		$page = ob_get_contents();
		ob_end_clean();
		return $page;
	}

	function clean_phone_number($phone_no){
		return substr( preg_replace('/^\+?1|\|1|\D/', '', $phone_no), -10);
	}

	public function init_shorcodes()
	{
		add_shortcode('degree_form', array($this, 'display_degree_form'));
		add_shortcode('tc_cc_form', array($this, 'display_tc_cc_form'));
		add_shortcode('studing_certificate_form', array($this, 'display_studing_certificate_form'));
		add_shortcode('cdc_fee_form', array($this, 'display_cdc_fee_form'));
		add_shortcode('cdc_fee_form_geo', array($this, 'display_cdc_fee_form_geo'));
		add_shortcode('reprint_form', array($this, 'display_reprint_form'));
		add_shortcode('why', array($this, 'hey'));

	}

	public function send_degree_form_data()
	{
		$value = $_POST['data']['_value'];
		if($value ==1){
			$form = MLV_FORMS_ARRAY['degree'];
		}
		else{
			$form = MLV_FORMS_ARRAY['degree_2'];
		}

		$resp = array(
			"redirect_url" => "",
			"status" => false,
			"message" => "",
		);

		//token verify
		$nonce = $_POST['_wpnonce'];
	
		if (!wp_verify_nonce($nonce, 'degree_form')) {
			$resp = array(
				"redirect_url" => "",
				"status" => false,
				"message" => "Invalid Request " . $nonce ,

			);
			wp_send_json($resp);
			die();
		}

		if(isset($_POST['data']) && isset($_POST['data']['order_id'])){
			$form_data = $_POST['data'];
			Form::college_update_order_meta($_POST['data']['order_id'], 'form_data', $form_data);
			$resp = array(
				"redirect_url" =>"",
				"status" => true,
				"message" => "",
				"error" => ""
			);
		}

		else if (isset($_POST['data'])) {

			$form_data = $_POST['data'];

			//loop through all fields of form_data and sanitize every field.
			foreach ($form_data as $key => $val) {
				$form_data[$key] = sanitize_text_field($val);
			}

			//sleep(5);
			
			if( strlen($form_data['name'])<3 ){
				$resp = array(
					"redirect_url" => "",
					"status" => false,
					"message" => "Invalid name",	
				);
				wp_send_json($resp);
				die();
			}

			// create Fee object
			$fee = new WC_Order_Item_Product();
			$fee->set_name($form["title"] );
			$fee->set_quantity(1);
			$fee->set_product_id(0);
			//$fee->set_amount($form["fees"] );
			$fee->set_subtotal($form["fees"] );
			$fee->set_total($form["fees"] );

			// add to order
			$order = wc_create_order();
			$order->add_item($fee);
			$order->calculate_totals();
			// add billing and shipping addresses
			$address = array(
				'first_name' => $form_data['name'],
				// 'last_name' => 'Rudrastyh',
				// 'company' => 'rudrastyh.com',
				'email' => $form_data['email'],
				'phone' => $form_data['mobile'],
				'address_1' => $form_data['address'],
				// 'address_2' => '',
				// 'city' => 'Tbilisi',
				// 'state' => '',
				// 'postcode' => '0108',
				// 'country' => 'GE'
			);

			$order->set_address($address, 'billing');

			$order->save();

			Form::college_update_order_meta($order->get_id(), 'form_data', $form_data);
			Form::college_update_order_meta($order->get_id(), 'form_name', $form['id']);

			$resp = array(
				"redirect_url" => $order->get_checkout_payment_url(),
				"status" => true,
				"message" => "",
				"error" => ""
			);

		}
		wp_send_json($resp);
		die();
	}

	public function send_tc_cc_form_data()
	{
		$form = MLV_FORMS_ARRAY['tt_cc'];
		// echo "<pre>"; print_r($form); die;
		$resp = array(
			"redirect_url" => "",
			"status" => false,
			"message" => "",
		);

		//token verify
		$nonce = $_POST['_wpnonce'];
		if (!wp_verify_nonce($nonce, 'tc_cc_form')) {
			$resp = array(
				"redirect_url" => "",
				"status" => false,
				"message" => "Invalid Request",

			);
			wp_send_json($resp);
			die();
		}

		if(isset($_POST['data']) && isset($_POST['data']['order_id'])){
			$form_data = $_POST['data'];
			Form::college_update_order_meta($_POST['data']['order_id'], 'form_data', $form_data);
			$resp = array(
				"redirect_url" =>"",
				"status" => true,
				"message" => "",
				"error" => ""
			);
		}

		else if (isset($_POST['data'])) {

			$form_data = $_POST['data'];

			//loop through all fields of form_data and sanitize every field.
			foreach ($form_data as $key => $val) {
				$form_data[$key] = sanitize_text_field($val);
			}

			// create Fee object
			$fee = new WC_Order_Item_Product();
			$fee->set_name($form["title"] );
			$fee->set_quantity(1);
			$fee->set_product_id(0);
			//$fee->set_amount($form["fees"] );
			$fee->set_subtotal($form["fees"] );
			$fee->set_total($form["fees"] );

			// add to order
			$order = wc_create_order();
			$order->add_item($fee);
			$order->calculate_totals();

			// add billing and shipping addresses
			$address = array(
				'first_name' => $form_data['name'],
				'email' => $form_data['email'],
				'phone' => $form_data['mobile'],
				'address_1' => $form_data['per_address'],
			);

			$order->set_address($address, 'billing');

			$order->save();

			Form::college_update_order_meta($order->get_id(), 'form_data', $form_data);
			Form::college_update_order_meta($order->get_id(), 'form_name', $form['id']);
			$this->update_tc_cc_serial_number($order->get_id());

			$resp = array(
				"redirect_url" => $order->get_checkout_payment_url(),
				"status" => true,
				"message" => "",
				"error" => ""
			);

		}
		wp_send_json($resp);
		die();
	}

	public function send_studing_certificate_form_data()
	{
		$form = MLV_FORMS_ARRAY['studying_certificate'];
		$resp = array(
			"redirect_url" => "",
			"status" => false,
			"message" => "",
		);

		//token verify
		$nonce = $_POST['_wpnonce'];
		if (!wp_verify_nonce($nonce, 'studing_form')) {
			$resp = array(
				"redirect_url" => "",
				"status" => false,
				"message" => "Invalid Request",

			);
			wp_send_json($resp);
			die();
		}

		if(isset($_POST['data']) && isset($_POST['data']['order_id'])){
			$form_data = $_POST['data'];
			Form::college_update_order_meta($_POST['data']['order_id'], 'form_data', $form_data);
			$resp = array(
				"redirect_url" =>"",
				"status" => true,
				"message" => "",
				"error" => ""
			);
		}

		else if (isset($_POST['data'])) {

			$form_data = $_POST['data'];

			//loop through all fields of form_data and sanitize every field.
			foreach ($form_data as $key => $val) {
				$form_data[$key] = sanitize_text_field($val);
			}

			// create Fee object
			$fee = new WC_Order_Item_Product();
			$fee->set_name($form["title"] );
			$fee->set_quantity(1);
			$fee->set_product_id(0);
			//$fee->set_amount($form["fees"] );
			$fee->set_subtotal($form["fees"] );
			$fee->set_total($form["fees"] );

			// add to order
			$order = wc_create_order();
			$order->add_item($fee);
			$order->calculate_totals();

			// add billing and shipping addresses
			$address = array(
				'first_name' => $form_data['name'],
				'email' => $form_data['email'],
				'phone' => $form_data['mobile'],
				'address_1' => $form_data['per_address'],
			);

			$order->set_address($address, 'billing');

			$order->save();

			Form::college_update_order_meta($order->get_id(), 'form_data', $form_data);
			Form::college_update_order_meta($order->get_id(), 'form_name', $form['id']);

			$resp = array(
				"redirect_url" => $order->get_checkout_payment_url(),
				"status" => true,
				"message" => "",
				"error" => ""
			);

		}
		wp_send_json($resp);
		die();
	}

	public function send_cde_fee_form_data()
	{
		$form = MLV_FORMS_ARRAY['cdc_fee'];
		$resp = array(
			"redirect_url" => "",
			"status" => false,
			"message" => "",
		);

		//token verify
		$nonce = $_POST['_wpnonce'];
		if (!wp_verify_nonce($nonce, 'cdc_form')) {
			$resp = array(
				"redirect_url" => "",
				"status" => false,
				"message" => "Invalid Request",

			);
			wp_send_json($resp);
			die();
		}

		if(isset($_POST['data']) && isset($_POST['data']['order_id'])){
			$form_data = $_POST['data'];
			Form::college_update_order_meta($_POST['data']['order_id'], 'form_data', $form_data);
			$resp = array(
				"redirect_url" =>"",
				"status" => true,
				"message" => "",
				"error" => ""
			);
		}

		else if (isset($_POST['data'])) {

			$form_data = $_POST['data'];

			//loop through all fields of form_data and sanitize every field.
			foreach ($form_data as $key => $val) {
				$form_data[$key] = sanitize_text_field($val);
			}

			$fee = new WC_Order_Item_Product();
			$fee->set_name($form["title"] );
			$fee->set_quantity(1);
			$fee->set_product_id(0);
			//$fee->set_amount($form["fees"] );
			$fee->set_subtotal($form["fees"] );
			$fee->set_total($form["fees"] );

			// add to order
			$order = wc_create_order();
			$order->add_item($fee);
			$order->calculate_totals();

			// add billing and shipping addresses
			$address = array(
				'first_name' => $form_data['name'],
				'email' => $form_data['email'],
				'phone' => $form_data['mobile'],
				'address_1' => $form_data['per_address'],
			);

			$order->set_address($address, 'billing');

			$order->save();

			Form::college_update_order_meta($order->get_id(), 'form_data', $form_data);
			Form::college_update_order_meta($order->get_id(), 'form_name', $form['id']);

			$resp = array(
				"redirect_url" => $order->get_checkout_payment_url(),
				"status" => true,
				"message" => ""
			);

		}
		wp_send_json($resp);
		die();
	}

	public function send_cde_geo_fee_form_data()
	{
		$form = MLV_FORMS_ARRAY['cdc_fee_geography'];
		$resp = array(
			"redirect_url" => "",
			"status" => false,
			"message" => "",
		);

		//token verify
		$nonce = $_POST['_wpnonce'];
		if (!wp_verify_nonce($nonce, 'cdc_geo_form')) {
			$resp = array(
				"redirect_url" => "",
				"status" => false,
				"message" => "Invalid Request",
			);
			wp_send_json($resp);
			die();
		}

		if(isset($_POST['data']) && isset($_POST['data']['order_id'])){
			$form_data = $_POST['data'];
			Form::college_update_order_meta($_POST['data']['order_id'], 'form_data', $form_data);
			$resp = array(
				"redirect_url" =>"",
				"status" => true,
				"message" => "",
				"error" => ""
			);
		}

		else if (isset($_POST['data'])) {

			$form_data = $_POST['data'];

			//loop through all fields of form_data and sanitize every field.
			foreach ($form_data as $key => $val) {
				$form_data[$key] = sanitize_text_field($val);
			}

			// create Fee object
			$fee = new WC_Order_Item_Product();
			$fee->set_name($form["title"] );
			$fee->set_quantity(1);
			$fee->set_product_id(0);
			//$fee->set_amount($form["fees"] );
			$fee->set_subtotal($form["fees"] );
			$fee->set_total($form["fees"] );

			// add to order
			$order = wc_create_order();
			$order->add_item($fee);
			$order->calculate_totals();

			// add billing and shipping addresses
			$address = array(
				'first_name' => $form_data['name'],
				'email' => $form_data['email'],
				'phone' => $form_data['mobile'],
				'address_1' => $form_data['per_address'],
			);

			$order->set_address($address, 'billing');

			$order->save();

			Form::college_update_order_meta($order->get_id(), 'form_data', $form_data);
			Form::college_update_order_meta($order->get_id(), 'form_name', $form['id']);

			$resp = array(
				"redirect_url" => $order->get_checkout_payment_url(),
				"status" => true,
				"message" => ""
			);

		}
		wp_send_json($resp);
		die();
	}

	public function bbloomer_add_content_thankyou($order_id)
	{
		$order = wc_get_order( $order_id );
		
		$order_status  = $order->get_status();
		if($order_status!='processing' && $order_status!='completed') return;
		wc_clear_notices();
		$form_data = Form::college_get_order_meta($order_id, "form_data", true);
		$form_name = Form::college_get_order_meta($order_id, "form_name", true);

		if ($form_name == MLV_FORMS_ARRAY['degree']['id']) {
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/form-public-degree-print-out.php';
		}
		if ($form_name == MLV_FORMS_ARRAY['degree_2']['id']) {
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/form-public-degree-print-out.php';
		}
		if ($form_name == MLV_FORMS_ARRAY['tt_cc']['id']) {
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/form-public-tc-cc-print-out.php';
		}
		if ($form_name == MLV_FORMS_ARRAY['studying_certificate']['id']) {
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/form-public-studing-certificate-print-out.php';
		}
		if ($form_name == MLV_FORMS_ARRAY['cdc_fee']['id']) {
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/form-public-cde-fee-print-out.php';
		}
		if ($form_name == MLV_FORMS_ARRAY['cdc_fee_geography']['id']) {
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/form-public-cde-fee-geo-print-out.php';
		}
	}

	
	public function update_tc_cc_serial_number($order_id) {
		// Form::college_update_order_meta( $order_id, 'tc_and_cc_filter_query', 'tc_cc_form' );

		$current_date = date('Ymd');
		$cc_serial_number_array = get_option('college_cc_serial_nubmer_array', array());
	
		// Ensure it's an array
		if (!is_array($cc_serial_number_array)) {
			$cc_serial_number_array = array();
		}
	
		// Ensure the structure for the current date
		if (isset($cc_serial_number_array[$current_date]) && is_array($cc_serial_number_array[$current_date])) {
			// Check if the order_id already exists
			$order_exists = false;
			foreach ($cc_serial_number_array[$current_date]['tc'] as $tc) {
				if ($tc['order_id'] == $order_id) {
					$order_exists = true;
					break;
				}
			}
			foreach ($cc_serial_number_array[$current_date]['cc'] as $cc) {
				if ($cc['order_id'] == $order_id) {
					$order_exists = true;
					break;
				}
			}
	
			if (!$order_exists) {
				$max_tc_sno = max(array_column($cc_serial_number_array[$current_date]['tc'], 'sno')) ?: 0;
				$max_cc_sno = max(array_column($cc_serial_number_array[$current_date]['cc'], 'sno')) ?: 0;
	
				$cc_serial_number_array[$current_date]['tc'][] = [
					'order_id' => $order_id,
					'sno' => $max_tc_sno + 1,
				];
	
				$cc_serial_number_array[$current_date]['cc'][] = [
					'order_id' => $order_id,
					'sno' => $max_cc_sno + 1,
				];
				Form::college_update_order_meta($order_id, 'tc_form_serial_number',$max_tc_sno+1);
				Form::college_update_order_meta($order_id, 'cc_form_serial_number',$max_cc_sno+1);
			}
		} else {
			$cc_serial_number_array[$current_date] = [
				'tc' => [
					[
						'order_id' => $order_id,
						'sno' => 1,
					],
				],
				'cc' => [
					[
						'order_id' => $order_id,
						'sno' => 1,
					],
				],
			];
			Form::college_update_order_meta($order_id, 'tc_form_serial_number',1);
			Form::college_update_order_meta($order_id, 'cc_form_serial_number',1);
		}
		update_option('college_cc_serial_nubmer_array', $cc_serial_number_array);
	}

	public function intercept_wc_template($template, $template_name, $template_path) {
		$plugin_path  = untrailingslashit( plugin_dir_path( __FILE__ ) )  . '/template/woocommerce/';

		if ($template_name == 'emails/customer-processing-order.php') {
			$template = $plugin_path . $template_name;
		}
		if ($template_name == 'emails/customer-completed-order.php') {
			$template = $plugin_path . $template_name;
		}
		if ($template_name == 'emails/admin-cancelled-order.php') {
			$template = $plugin_path . $template_name;
		}
		return $template;
	}
}