(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(window).bind("pageshow", function(event) {
		$( "button, input" ).prop( "disabled", false );
		$(".mlv_loading_btn").addClass("d-none");
	});

	$(document).ready(function() {
		//var doc = new jsPDF();
		var specialElementHandlers = {
			'#editor': function (element, renderer) {
				return true;
			}
		};
		$('#save_degree_form').on('submit', function(e){
			e.preventDefault();
			$( "button, input" ).prop( "disabled", true );
			$(".mlv_loading_btn").removeClass("d-none");
			add_degree_form_data_to_obj();
		});

		$('#save_tc_cc_form').on('submit', function(e){
			e.preventDefault();
			$( "button, input" ).prop( "disabled", true );
			$(".mlv_loading_btn").removeClass("d-none");
			add_tc_cc_form_data_to_obj();
		});
		$('#download_tc_cc').click(function() {
			doc.fromHTML($('#main').html(), 15, 15, {
				'width': 170,
				'elementHandlers': specialElementHandlers
			});
			setTimeout(function () {
				doc.save('save_file.pdf');
			}, 5000); 
			
		})

		$('#save_studing_form').on('submit', function(e){			
			e.preventDefault();
			$( "button, input" ).prop( "disabled", true );
			$(".mlv_loading_btn").removeClass("d-none");
			add_studing_form_data_to_obj();
		});	

		$('#save_cdc_form').on('submit', function(e){			
			e.preventDefault();
			$( "button, input" ).prop( "disabled", true );
			$(".mlv_loading_btn").removeClass("d-none");
			add_cde_fee_form_data_to_obj();
		});		

		$('#save_cdc_geo_form').on('submit', function(e){			
			e.preventDefault();
			$( "button, input" ).prop( "disabled", true );
			$(".mlv_loading_btn").removeClass("d-none");
			add_cde_geo_fee_form_data_to_obj();
		});		
		
	});

	function add_degree_form_data_to_obj() {
		// alert("add to obj");
		
		var name = $("#name").val();
		var f_name = $("#f_name").val();
		var appeared = $("#appeared_in").val();
		var exam = $("#name_exam").val();
		var roll_no = $("#roll_no").val();

		let checked = "";
		if ($('#regular_st').is(':checked') ) {
			checked = 'Regular Student';
		} else if ($('#ex_st').is(':checked') ) {
			checked = 'Ex Student';
		} else if ($('#non_coll').is(':checked') ) {
			checked = 'Non-collegiate';
		}
		var st_status = checked;
		var pass_div = $("#pass_div").val();
		var address = $("#full_address").val();
		var mobile = $("#mobile_no").val();
		var email = $("#email_id").val();
		var aadhaar = $("#aadhaar_no").val();

		var nonce = $("#_wpnonce").val();
		var _value = $("#_value").val();
		var obj = {
			name: name,
			f_name: f_name,
			appeared: appeared,
			exam: exam,
			roll_no: roll_no,
			student: st_status,
			pass: pass_div,
			address: address,
			mobile: mobile,
			email: email,
			aadhaar: aadhaar,
			_value:_value
		};

		// console.log(obj);
		save_and_payment(obj, "degree_form_data", nonce);
	}

	function add_tc_cc_form_data_to_obj() {
		
		var name = $("#tc_full_name").val();
		var father = $("#tc_father_name").val();
		var mother = $("#tc_mother_name").val();
		var faculty = $("#tc_name_class_faculty").val();
		var d_admission = $("#tc_date_admission").val();
		var d_exam = $("#tc_d_exam_pass").val();
		var dob = $("#tc_dob").val();
		var per_address = $("#tc_permanent_address").val();
		var pre_address = $("#tc_present_address").val();
		var mobile = $("#tc_mobile_no").val();
		var aadhaar = $("#tc_aadhaar_no").val();
		var email = $("#tc_email_id").val();

		var s_one = $("#tc_session_one").val();
		var s_two = $("#tc_session_two").val();
		var s_three = $("#tc_session_three").val();
		var s_four = $("#tc_session_four").val();
		var s_five = $("#tc_session_five").val();

		var c_one = $("#tc_class_one").val();
		var c_two = $("#tc_class_two").val();
		var c_three = $("#tc_class_three").val();
		var c_four = $("#tc_class_four").val();
		var c_five = $("#tc_class_five").val();

		var rn_one = $("#tc_roll_no_one").val();
		var rn_two = $("#tc_roll_no_two").val();
		var rn_three = $("#tc_roll_no_three").val();
		var rn_four = $("#tc_roll_no_four").val();
		var rn_five = $("#tc_roll_no_five").val();

		var pf_one = $("#tc_result_one").val();
		var pf_two = $("#tc_result_two").val();
		var pf_three = $("#tc_result_three").val();
		var pf_four = $("#tc_result_four").val();
		var pf_five = $("#tc_result_five").val();	

		var nonce = $("#_wpnonce").val();

		var obj = {
			name: name,
			father: father,
			mother: mother,
			faculty: faculty,
			d_admission: d_admission,
			d_exam: d_exam,
			dob: dob,
			per_address: per_address,
			pre_address: pre_address,
			mobile: mobile,
			aadhaar: aadhaar,
			email: email,

			s_one: s_one,
			c_one: c_one,
			rn_one: rn_one,
			pf_one: pf_one,

			s_two: s_two,
			c_two: c_two,
			rn_two: rn_two,
			pf_two: pf_two,
			
			s_three: s_three,
			c_three: c_three,
			rn_three: rn_three,
			pf_three: pf_three,          
			
			s_four: s_four,
			c_four: c_four,
			rn_four: rn_four,
			pf_four: pf_four,
			
			s_five: s_five,
			c_five: c_five,
			rn_five: rn_five,			
			pf_five: pf_five,

			// d_one: d_one,
			// d_two: d_two,
			// d_three: d_three, 
			// d_four: d_four,
			// d_five: d_five,

		};

		// console.log(obj);
		save_and_payment(obj, "tc_cc_form_data", nonce);
	}
	 
	function add_studing_form_data_to_obj() {
		
		var name = $("#studing_full_name").val();
		var father = $("#studing_father_name").val();
		var mother = $("#studing_mother_name").val();

		var faculty = $("#studing_name_class_faculty").val();
		var d_admission = $("#studing_date_admission").val();
		var d_exam = $("#studing_d_exam_pass").val();
		var dob = $("#studing_dob").val();
		var per_address = $("#studing_permanent_address").val();
		var pre_address = $("#studing_present_address").val();
		var mobile = $("#studing_mobile_no").val();
		var aadhaar = $("#studing_aadhaar_no").val();
		var email = $("#studing_email_id").val();

		var s_one = $("#studing_session_one").val();
		var s_two = $("#studing_session_two").val();
		var s_three = $("#studing_session_three").val();
		var s_four = $("#studing_session_four").val();
		var s_five = $("#studing_session_five").val();

		var c_one = $("#studing_class_one").val();
		var c_two = $("#studing_class_two").val();
		var c_three = $("#studing_class_three").val();
		var c_four = $("#studing_class_four").val();
		var c_five = $("#studing_class_five").val();

		var rn_one = $("#studing_roll_no_one").val();
		var rn_two = $("#studing_roll_no_two").val();
		var rn_three = $("#studing_roll_no_three").val();
		var rn_four = $("#studing_roll_no_four").val();
		var rn_five = $("#studing_roll_no_five").val();

		var pf_one = $("#studing_result_one").val();
		var pf_two = $("#studing_result_two").val();
		var pf_three = $("#studing_result_three").val();
		var pf_four = $("#studing_result_four").val();
		var pf_five = $("#studing_result_five").val();

		var nonce = $("#_wpnonce").val();
		

		var obj = {
			name: name,
			father: father,
			mother: mother,
			faculty: faculty,
			d_admission: d_admission,
			d_exam: d_exam,
			dob: dob,
			per_address: per_address,
			pre_address: pre_address,
			mobile: mobile,
			aadhaar: aadhaar,
			email: email,

			s_one: s_one,
			s_two: s_two,
			s_three: s_three,
			s_four: s_four,
			s_five: s_five,
			
			c_one: c_one,
			c_two: c_two,
			c_three: c_three,
			c_four: c_four,
			c_five: c_five,
			
			rn_one: rn_one,
			rn_two: rn_two,
			rn_three: rn_three,
			rn_four: rn_four,
			rn_five: rn_five,
			
			pf_one: pf_one,
			pf_two: pf_two,
			pf_three: pf_three,          
			pf_four: pf_four,
			pf_five: pf_five,

		};
		
		// console.log(obj);
		// return;
		save_and_payment(obj, "studing_certificate_form_data", nonce);
	}

	function add_cde_fee_form_data_to_obj() {
		
		var name = $("#cdc_full_name").val();
		var father = $("#cdc_father_name").val();
		var mother = $("#cdc_mother_name").val();
		var dob = $("#cdc_dob").val();
		var class_name = $("#cdc_name_class").val();
		var d_submission = $("#cdc_date_submission").val();
		var form_no = $("#cdc_u_exam_f_no").val();
		var per_address = $("#cdc_permanent_address").val();
		var pre_address = $("#cdc_present_address").val();
		var mobile = $("#cdc_mobile_no").val();
		var aadhaar = $("#cdc_aadhaar_no").val();
		var email = $("#cdc_email_id").val();

		var nonce = $("#_wpnonce").val();

		var obj = {
			name: name,
			father: father,
			mother: mother,
			class_name: class_name,
			d_submission: d_submission,
			form_no: form_no,
			dob: dob,
			per_address: per_address,
			pre_address: pre_address,
			mobile: mobile,
			aadhaar: aadhaar,
			email: email,
		};
		
		// console.log(obj);
		save_and_payment(obj, "cde_fee_form_data", nonce);
	}

	function add_cde_geo_fee_form_data_to_obj() {
		
		var name = $("#cdc_geo_full_name").val();
		var father = $("#cdc_geo_father_name").val();
		var mother = $("#cdc_geo_mother_name").val();
		var dob = $("#cdc_geo_dob").val();
		var class_name = $("#cdc_geo_name_class").val();
		var d_submission = $("#cdc_geo_date_submission").val();
		var form_no = $("#cdc_geo_u_exam_f_no").val();
		var per_address = $("#cdc_geo_permanent_address").val();
		var pre_address = $("#cdc_geo_present_address").val();
		var mobile = $("#cdc_geo_mobile_no").val();
		var aadhaar = $("#cdc_geo_aadhaar_no").val();
		var email = $("#cdc_geo_email_id").val();

		var nonce = $("#_wpnonce").val();

		var obj = {
			name: name,
			father: father,
			mother: mother,
			class_name: class_name,
			d_submission: d_submission,
			form_no: form_no,
			dob: dob,
			per_address: per_address,
			pre_address: pre_address,
			mobile: mobile,
			aadhaar: aadhaar,
			email: email,
		};
		
		console.log(obj);
		save_and_payment(obj, "cde_geo_fee_form_data", nonce);
	}

	function save_and_payment (obj, action_name, nonce) {
 
		jQuery.post(childParams.wp_admin_ajax_url,{ action: action_name, data:obj, _wpnonce:nonce },function(data) {
			
			if (data.status) {
				window.location = data.redirect_url;
			}
			else {
				$( "button, input" ).prop( "disabled", false );
				$(".mlv_loading_btn").addClass("d-none");
				alert(data.message);
			}	
			
		});
	}
	
})( jQuery );
