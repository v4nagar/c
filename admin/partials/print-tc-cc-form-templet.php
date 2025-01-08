

<?php
  $date          = date('d-m-y'); 
  $serial_no     = $order_id;
  $class_name    = $order_id;
  $name          = $from_data['name'];
  $perent_name   = $from_data['father'];
  $mother        = $from_data['mother'];
  $faculty       = $from_data['faculty'];
  $d_admission   = $from_data['d_admission'];
  $d_exam        = $from_data['d_exam'];
  $dob           = $from_data['dob'];
  $per_address   = $from_data['per_address'];
  $pre_address   = $from_data['pre_address'];
  $mobile        = $from_data['mobile'];
  $aadhaar       = $from_data['aadhaar'];
  $email         = $from_data['email'];
  $s_one         = $from_data['s_one'];
  $c_one         = $from_data['c_one'];
  $rn_one        = $from_data['rn_one'];
  $pf_one        = $from_data['pf_one'];
?>

    <style>
        @media print {
            .print-button button{
                display: none;
            }
            .certificate {
                page-break-after: always;
            }
            .certificate:last-of-type {
                page-break-after: auto;
            }
        }



        .certificate {
            width: 210mm; /* A4 width */
            height: 260mm; /* A4 height */
            margin: 0 auto;
            padding: 40px 50px;
            box-sizing: border-box;
            border: 1px solid #000;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
        }

        .header h2 {
            font-size: 18px;
            margin: 5px 0;
        }

        .header h3 {
            font-size: 16px;
            margin: 5px 0;
        }

        .content {
            flex: 1;
            line-height: 2.5;
        }

        .content p {
            margin: 0;
            font-size: 16px;
            text-align: justify;
        }

        .footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .footer p {
            font-size: 16px;
            font-weight: bold;
        }

        .print-button {
            display: block;
            margin: 20px auto;
            text-align: center;
        }

        .print-button button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-button button:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="print-button">
        <button onclick="window.print()">Print Certificates</button>
    </div>

    <!-- First Certificate -->
    <div class="certificate">
        <div class="header">
            <h1>Maharana Pratap Government Post Graduate College</h1>
            <h2>Chittorgarh-312001</h2>
            <h3>NAAC Accredited 'A' Grade</h3>
            <h3>Transfer Certificate</h3>
        </div>

        <div class="content">
            <p><strong>No:</strong> <span class=""><strong><?php echo esc_html($tc_sno); ?></strong></span></p>
            <p>
                This is to certify that Shri/Kumari <span class=""><strong><?php echo esc_html($name); ?></strong></span>, 
                Son/Daughter of Shri <span class=""><strong><?php echo esc_html($perent_name); ?></strong></span>, was admitted 
                to this College on <span class=""><strong><?php echo esc_html($d_admission); ?></strong></span> in the <span class=""><strong><?php echo esc_html($class_name); ?></strong></span> Class.
            </p>
            <p>
                He/She is now leaving this college after having 
                <strong>passed</strong>/<strong>failed</strong>/admitted only 
                the <span class=""><strong><?php echo esc_html($d_exam); ?></strong></span> Examination of <span class=""><strong><?php echo esc_html($name); ?></strong></span>.
            </p>
            <p>
                His/Her conduct, as far as known to the undersigned, was 
                <span class="">Good</span>. He/She has paid all the college dues 
                up to <span class=""><strong><?php echo esc_html($date); ?></strong></span>.
            </p>
        </div>

        <div class="footer">
            <div class="date">
                <p><strong>Date:</strong> <span class=""><strong><?php echo esc_html($date); ?></strong></span></p>
            </div>
            <div class="principal">
                <p><strong>Principal</strong></p>
            </div>
        </div>
    </div>

    <!-- Second Certificate -->
    <div class="certificate">
        <div class="header">
            <h1>Maharana Pratap</h1>
            <h2>Government Postgraduate College</h2>
            <h3>Chittorgarh (Raj.)</h3>
            <h3>Accredited 'A' Grade by NAAC</h3>
            <h3>Character Certificate</h3>
        </div>

        <div class="content">
            <div style="display:flex; justify-content:space-between;">
                <p><strong>Serial No.:</strong><?php echo esc_html($tc_sno); ?></p>
                <p><strong>Date:</strong><?php echo esc_html($date); ?></p>
            </div>
            <p>
                This is to certify that Mr. / Ms. <span class=""><strong><?php echo esc_html($name); ?></strong></span>
            </p>
            <p>
                Son / Daughter of Mr. <span class=""><strong><?php echo esc_html($perent_name); ?></strong></span>
            </p>
            <p>
                was a regular student of this college in Class <span class=""><strong><?php echo esc_html($class_name); ?></strong></span>,
                during the session <span class=""><strong><?php echo esc_html($d_admission); ?></strong></span>.
            </p>
            <p>As far as I know, during this time their character has been <span class=""><strong>Good</strong></span>.</p>
        </div>

        <div class="footer">
            <p>Principal</p>
        </div>
    </div>
