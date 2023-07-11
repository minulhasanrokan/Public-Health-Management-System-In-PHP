<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';
    include_once __DIR__.'/../TCPDF/tcpdf.php';
    include_once __DIR__.'/Appointment.php';
    include_once __DIR__.'/Setting.php';
    include_once __DIR__.'/Doctor.php';
    include_once __DIR__.'/Report.php';

    $appointment = new Appointment();
    $doctor = new Doctor();
    $report = new Report();

    $appointment_id = $_GET['id'];

    $id = 0;
    if(isset($_SESSION['patientId'])){
        $id = $_SESSION['patientId'];
    }

    $appointment_details = $appointment->get_all_appointment_details($ofset=null, $limit=null,$appointment_id=$appointment_id, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$accept_status=1,$date_con=null,$need_to_admit=null,$next_visit_date=null,$admit_id=null);

    $appointment_details = mysqli_fetch_array($appointment_details);

    $single_doctor = $doctor ->get_single_doctor($appointment_details['doctor_id']);

    $single_doctor = mysqli_fetch_array($single_doctor);

    $bday = new DateTime( $appointment_details['birth_date']);
    $today = new Datetime(date('m.d.y'));

    $diff = $today->diff($bday);

    $birth_date = $diff->y.' years '.$diff->m.' month '.$diff->d.' days';

	class PDF extends TCPDF{

        public function Header(){

            $setting = new Setting();
            $appointment = new Appointment();

            $system_data = $setting->get_system_data(1);

            $system_data = mysqli_fetch_array($system_data);

            $appointment_id = $_GET['id'];

            $appointment_details = $appointment->get_all_appointment_details($ofset=null, $limit=null,$appointment_id=$appointment_id, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$accept_status=1,$date_con=null,$need_to_admit=null,$next_visit_date=null,$admit_id=null);
            $appointment_details = mysqli_fetch_array($appointment_details);

            //$this->Image(K_PATH_IMAGES.'logo.png', 10, 10, 30, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);

            $this->Ln(4);
            $this->setFont('helvetica','B',12);
            $this->Cell(189,5,$system_data['name'],0,1,'C');

            $this->setFont('helvetica','B',8);
            $this->Cell(189,5,"Address: ".strip_tags($system_data['address']),0,1,'C');
            $this->Cell(189,5,"Mobile: ".$system_data['phone'],0,1,'C');
            $this->Cell(189,5,"E-mail: ".$system_data['email'],0,1,'C');
            $this->Cell(189,5,"Appointment Details Report",0,1,'C');
            $this->Cell(189,5,"Appointment Number: ".$appointment_details['appointment_number'],0,1,'C');
            $this->Cell(189,5,"Appointment Date: ".$appointment_details['shedule_date'],0,1,'C');
            $this->Cell(189,5,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0,1,'C');
        }
	}

    // create new PDF document
    $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->setFooterData(array(0,64,0), array(0,64,128));

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->setFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();

    $pdf->setFillColor('224','235','255');
    $pdf->Ln(21);
    $pdf->Cell(90,5,'Doctor Name: '.$single_doctor['name'],1,0,'',1);
    $pdf->Cell(90,5,'Patient Name: '.$appointment_details['patient_name'],1,0,'',1);

    $pdf->Ln(5);
    $pdf->Cell(90,5,'Doctor Email: '.$single_doctor['email'],1,0,'',1);
    $pdf->Cell(90,5,'Patient Email: '.$appointment_details['patient_email'],1,0,'',1);

    $pdf->Ln(5);
    $pdf->Cell(90,5,'Doctor Mobile: '.$single_doctor['mobile'],1,0,'',1);
    $pdf->Cell(90,5,'Patient Mobile: '.$appointment_details['patient_mobile'],1,0,'',1);

    $pdf->Ln(5);
    $pdf->Cell(90,5,'Doctor Speciality: '.$single_doctor['speciality'],1,0,'',1);
    $pdf->Cell(90,5,'Patient Age: '.$birth_date,1,0,'',1);

    $pdf->Cell(189,5,"",0,1,'C');

    $pdf->Ln(5);
    $pdf->Cell(180,5,'Problems Details',1,0,'C',1);

    $pdf->Ln(5);
    $pdf->writeHTML($appointment_details['description'], true, false, true, false, '');

    $pdf->Ln(5);
    $pdf->Cell(180,5,'Doctor Comments',1,0,'C',1);

    $pdf->Ln(5);
    $pdf->writeHTML($appointment_details['doctor_comment'], true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output($appointment_details['appointment_number'].'.pdf', 'I');


    