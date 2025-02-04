<?php
class Page extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('PersonnelModel');
		$this->load->model('Page_model');
		$this->load->model('SGODModel');

		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	function districts()
	{
		$result['data'] = $this->Page_model->districts();
		$this->load->view('districts', $result);
	}

	public function smea()
	{
		$currentYear = date('Y');
		$schoolID = $this->session->userdata('username');
		$quarter = $this->input->get('quarter');
		$data['quarter'] = $quarter;

		$query = $this->db->get_where('smea', [
			'schoolID' => $schoolID,
			'sQtr' => $quarter,
			'sYear' => $currentYear,
		]);
		$existingRecord = $query->row();


		if ($existingRecord) {
			
			$data = [
				'sYear' => $existingRecord->sYear,
				'sQtr' => $existingRecord->sQtr,
				'sPhyTargets' => $existingRecord->sPhyTargets,
				'sAchieved' => $existingRecord->sAchieved,
				'sAccomplishmentsPercentage' => $existingRecord->sAccomplishmentsPercentage,
				'sGain' => $existingRecord->sGain,
				'sGainPercentage' => $existingRecord->sGainPercentage,
				'sGapBalance' => $existingRecord->sGapBalance,
				'sGapPercentage' => $existingRecord->sGapPercentage,
				'sFundAllocation' => $existingRecord->sFundAllocation,
				'sFundsUtilized' => $existingRecord->sFundsUtilized,
				'sUtilizationPercentage' => $existingRecord->sUtilizationPercentage,
				'sGapAmount' => $existingRecord->sGapAmount,
				'sGapPercentageUtilize' => $existingRecord->sGapPercentageUtilize,

				'fundsAllocatedQtr' => $existingRecord->fundsAllocatedQtr,
				'fundsUtilized' => $existingRecord->fundsUtilized,

				'fundsUtilizedPercentage' => $existingRecord->fundsUtilizedPercentage,
				'gapUtilizedAmount' => $existingRecord->gapUtilizedAmount,

				'gapUtilizedPercentage' => $existingRecord->gapUtilizedPercentage,
				'valueAdded' => $existingRecord->valueAdded,

				'reasons' => $existingRecord->reasons,
			];
		}

		
		if (!$existingRecord && $quarter) {
			$data['quarter'] = $quarter;  
		}

		if ($this->input->post('submit')) {
			$dataToSave = [
				'schoolID' => $schoolID,
				'sYear' => $this->input->post('sYear', true),
				'sQtr' => $this->input->post('sQtr', true),
				'sPhyTargets' => $this->input->post('sPhyTargets', true),
				'sAchieved' => $this->input->post('sAchieved', true),
				'sAccomplishmentsPercentage' => $this->input->post('sAccomplishmentsPercentage', true),
				'sGain' => $this->input->post('sGain', true),
				'sGainPercentage' => $this->input->post('sGainPercentage', true),
				'sGapBalance' => $this->input->post('sGapBalance', true),
				'sGapPercentage' => $this->input->post('sGapPercentage', true),
				'sFundAllocation' => $this->input->post('sFundAllocation', true),
				'sFundsUtilized' => $this->input->post('sFundsUtilized', true),
				'sUtilizationPercentage' => $this->input->post('sUtilizationPercentage', true),
				'sGapAmount' => $this->input->post('sGapAmount', true),
				'sGapPercentageUtilize' => $this->input->post('sGapPercentageUtilize', true),

				'fundsAllocatedQtr' => $this->input->post('fundsAllocatedQtr', true),
				'fundsUtilized' => $this->input->post('fundsUtilized', true),

				'fundsUtilizedPercentage' => $this->input->post('fundsUtilizedPercentage', true),
				'gapUtilizedAmount' => $this->input->post('gapUtilizedAmount', true),

				'gapUtilizedPercentage' => $this->input->post('gapUtilizedPercentage', true),
				'valueAdded' => $this->input->post('valueAdded', true),

				'reasons' => $this->input->post('reasons', true),
			];

			// If record exists, update it
			if ($existingRecord) {
				$this->db->where(['schoolID' => $schoolID, 'sQtr' => $quarter]);
				$this->db->update('smea', $dataToSave);
				$this->session->set_flashdata('success', 'Record updated successfully!');
			} else {
				// Insert data into the database if no record exists
				if ($this->db->insert('smea', $dataToSave)) {
					$this->session->set_flashdata('success', 'Record saved successfully!');
				} else {
					$this->session->set_flashdata('error', 'Failed to save the record. Please try again.');
				}
			}

			// Redirect to the same page or another page
			redirect('Page/smea');
		}

		// Load the view and pass flash data to display messages in the view
		$this->load->view('smea', $data);
	}






	public function view_sip()
	{
		$schoolID = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->view_sip($schoolID);
		$this->load->view('ip_sip', $result);
	}

	public function view_sip_admin()
	{
		$school_id = $this->uri->segment(3);
		$result['data'] = $this->SGODModel->one_cond('school_imp_plans', 'schoolID', $school_id);
		$this->load->view('ip_sip', $result);
	}

	public function school_allocations()
	{
		if ($this->session->position == "School") {
			redirect(base_url());
		}
		$result['data'] = $this->PersonnelModel->school_allocations();
		$result['bs'] = $this->SGODModel->no_cond('sgod_settings_bs');
		$result['school'] = $this->Common->no_cond_order_by('schools', 'schoolName', 'ASC');
		$result['district'] = $this->Common->no_cond_order_by('district', 'discription', 'ASC');
		$result['last'] = $this->SGODModel->get_last_record('sgod_school_allocation');
		$this->load->view('school_allocation', $result);
	}

	public function school_allocations2()
	{
		$schoolID = $this->session->userdata('username');
		$result['st'] = $this->SGODModel->one_cond_row('schools', 'schoolID', $this->session->username);
		$result['bs'] = $this->SGODModel->no_cond('sgod_settings_bs');
		$result['last'] = $this->SGODModel->get_last_record('sgod_school_allocation');
		$result['data'] = $this->PersonnelModel->school_allocations2($schoolID);
		$this->load->view('school_allocation2', $result);
	}

	public function school_allocation_edit()
	{
		$result['st'] = $this->SGODModel->one_cond_row('sgod_school_allocation', 'id', $this->uri->segment(3));
		$result['last'] = $this->SGODModel->get_last_record('sgod_school_allocation');
		$result['bs'] = $this->SGODModel->no_cond('sgod_settings_bs');
		$this->load->view('school_allocation_update', $result);
	}

	function systemFeedback()
	{
		$this->load->view('system_feedback');
		if ($this->input->post('submit')) {
			$system_user = $this->session->userdata('username');
			$position = $this->session->userdata('position');
			$q1Ans = $this->input->post('q1Ans');
			$q2Ans = $this->input->post('q2Ans');
			$q3Ans = $this->input->post('q3Ans');
			$q4Ans = $this->input->post('q4Ans');
			$q5Ans = $this->input->post('q5Ans');

			$que = $this->db->query("insert into system_feedback (system_user, position, q1Ans, q2Ans, q3Ans, q4Ans, q5Ans) values('$system_user','$position','$q1Ans','$q2Ans','$q3Ans','$q4Ans','$q5Ans')");
			$this->session->set_flashdata('success', 'Thank you for your feedback.');
			redirect('Page/systemFeedback');
			// redirect(base_url().'leaveApplications/'.$IDNumber);
		}
	}

	function systemFeedbackResults()
	{
		$result['data'] = $this->PersonnelModel->systemFeedbackResults();
		$result['data2'] = $this->PersonnelModel->systemFeedbackResults_Messages();
		$this->load->view('system_feedback_results', $result);
	}


	function schoolInfo()
	{

		$result['district'] = $this->Common->no_cond('district');

		if ($this->session->userdata('position') === 'School') {

			$schoolID = $this->session->userdata('username');
			$result['data'] = $this->PersonnelModel->schoolProfile($schoolID);

			$this->load->view('school_info', $result);
		} else {
			$schoolID = $this->input->get('schoolid');
			$result['data'] = $this->PersonnelModel->schoolProfile($schoolID);
			$this->load->view('school_info', $result);
		}

		if ($this->input->post('submit')) {
			// if ($this->session->userdata('position') === 'School') {
			// $schoolID = $this->session->userdata('username');
			// } else {
			// 	$schoolID = $this->input->get('schoolid');
			// }
			$oldSchoolID = $this->input->post('oldSchoolID');
			$schoolID = $this->input->post('schoolID');
			$schoolName = $this->input->post('schoolName');
			$district = $this->input->post('district');
			$brgy = $this->input->post('brgy');
			$city = $this->input->post('city');
			$province = $this->input->post('province');
			$adminFName = $this->input->post('adminFName');
			$adminMName = $this->input->post('adminMName');
			$adminLName = $this->input->post('adminLName');
			$adminDesignation = $this->input->post('adminDesignation');
			$schoolEmail = $this->input->post('schoolEmail');
			$adminEmail = $this->input->post('adminEmail');
			$adminMobile = $this->input->post('adminMobile');
			$st = $this->input->post('st');
			$electricity = $this->input->post('electricity');
			$internet = $this->input->post('internet');
			$mb = $this->input->post('mb');
			$provider = $this->input->post('provider');

			$que = $this->db->query("update schools set schoolID='$schoolID',schoolName='$schoolName',district='$district',brgy='$brgy',city='$city',province='$province',course='$st',adminFName='$adminFName',adminMName='$adminMName',adminLName='$adminLName',adminLName='$adminLName',adminLName='$adminLName',adminDesignation='$adminDesignation',schoolEmail='$schoolEmail',adminMobile='$adminMobile',adminEmail='$adminEmail',electricity='$electricity',internet='$internet',mb='$mb',provider='$provider' where schoolID='" . $oldSchoolID . "'");
			$que = $this->db->query("update users set username='$schoolID',user_id='$schoolID',fname='$schoolName',mname='',lname='' where username='" . $oldSchoolID . "'");
			$this->session->set_flashdata('success', 'Updated successfully.');
			redirect('Page/schoolProfile?schoolid=' . $schoolID);
		}
	}

	function school_allocation_update()
	{

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_school();
			$this->session->set_flashdata('success', 'Add successfully.');
			redirect(base_url() . 'Page/school_new');
		}
		$id = $this->uri->segment(3);
		$result['data'] = $this->SGODModel->one_cond_row('sgod_school_allocation', 'id', $id);

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('school_allocation_edit', $result);
		$this->load->view('templates/footerv2');
	}

	function school_new()
	{

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_school();
			$this->session->set_flashdata('success', 'Added successfully.');
			redirect(base_url() . 'Page/school_new');
		}

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('school_add');
		$this->load->view('templates/footerv2');
	}



	function fund_update()
	{
		$this->SGODModel->update_fund_allocation();
		$this->session->set_flashdata('success', 'Updated successfully.');
		if ($this->session->position == 'School') {
			redirect(base_url() . 'Page/school_allocations2');
		} else {
			redirect(base_url() . 'Page/school_allocations');
		}
	}

	function fund_add()
	{
		$this->SGODModel->insert_fund_allocation();
		$this->session->set_flashdata('success', 'Added successfully.');
		if ($this->session->position == 'School') {
			redirect(base_url() . 'Page/school_allocations2');
		} else {
			redirect(base_url() . 'Page/school_allocations');
		}
	}

	function systemHelp()
	{
		$this->load->view('system_help');
	}

	function sr_request()
	{
		$IDNumber = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->sr_request_list_emp($IDNumber);
		$this->load->view('service_record_request', $result);
		if ($this->input->post('submit')) {
			$system_user = $this->session->userdata('username');
			$purpose = $this->input->post('purpose');
			$message = $this->input->post('message');

			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$dateReq = date("Y-m-d");

			$que = $this->db->query("insert into doc_request (IDNumber, req_doc, dateReq, purpose, reqStat, message) values('$system_user','Service Record','$dateReq','$purpose', 'Pending','$message')");
			$this->session->set_flashdata('success', 'Thank you! Your request has been submitted.');
			redirect('Page/sr_request');
		}
	}

	function sr_request_list()
	{
		$result['data'] = $this->PersonnelModel->sr_request_list();
		$this->load->view('service_record_request_list', $result);
		// if($this->input->post('submit'))
		// {
		// $system_user=$this->session->userdata('username');
		// $purpose=$this->input->post('purpose');
		// $message=$this->input->post('message');

		// date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		// $dateReq=date("Y-m-d");

		// $que=$this->db->query("insert into doc_request (IDNumber, req_doc, dateReq, purpose, reqStat, message) values('$system_user','Service Record','$dateReq','$purpose', 'Request Submitted','$message')");
		// $this->session->set_flashdata('success', 'Thank you! Your request has been submitted.');
		// redirect('Page/sr_request');
		// }
	}


	function mandatoryDed()
	{
		if ($this->session->userdata('position') === 'user') {
			$IDNumber = $this->session->userdata('username');
			$result['data'] = $this->PersonnelModel->mandatoryDed($IDNumber);
			$this->load->view('emp_mandatory_ded', $result);
		} else {
			echo "Access Denied";
		}
	}
	function Accountant()
	{
		$schoolID = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->count_all_staff($schoolID);
		$result['data1'] = $this->PersonnelModel->count_all_teaching($schoolID);
		$result['data2'] = $this->PersonnelModel->count_all_nonteaching($schoolID);
		$result['data3'] = $this->PersonnelModel->count_all_inactive($schoolID);

		$this->load->view('dashboard_accountant', $result);
	}

	function perPlantillaGroup()
	{
		$result['data'] = $this->PersonnelModel->perPlantillaGroup();
		$this->load->view('by_plantilla_group', $result);
	}


	//Employee List By Department
	function employeelistDepartment()
	{
		$department = $this->input->post('Department');
		// if($this->input->post('submit')){
		$result['data1'] = $this->PersonnelModel->getDepartment();
		$result['data'] = $this->PersonnelModel->employeelistDepartment($department);
		$this->load->view('list_department', $result);
		// }

	}

	function pos_summary()
	{
		$result['data'] = $this->PersonnelModel->personnelCounts();
		$this->load->view('by_position', $result);
	}

	function serviceRecord()
	{

		if ($this->session->userdata('position') === 'Admin') :
			$result['data'] = $this->PersonnelModel->service_Record();
			$result['data1'] = $this->PersonnelModel->searchPersonnel();
		elseif ($this->session->userdata('position') === 'Staff') :
			$result['data'] = $this->PersonnelModel->service_Record();
			$result['data1'] = $this->PersonnelModel->searchPersonnel();
		elseif ($this->session->userdata('position') === 'School') :
			$schoolID = $this->session->userdata('username');
			$result['data'] = $this->PersonnelModel->service_Record_school($schoolID);
			$result['data1'] = $this->PersonnelModel->searchPersonnelSchool($schoolID);
		endif;
		$this->load->view('service_record_admin', $result);
	}

	public function addSR()
	{
		$this->Page_model->insert_sr();
		$this->session->set_flashdata('success', 'One record added successfully!');
		redirect(base_url() . 'Page/' . 'serviceRecord/');
	}

	public function addLC()
	{
		$this->Page_model->insert_lc();
		$this->session->set_flashdata('success', 'One record added successfully!');
		redirect(base_url() . 'Page/' . 'leaveCreditsSummary/');
	}

	function serviceRecordEdit()
	{
		$id = $this->input->get('id');
		$result['data'] = $this->PersonnelModel->service_Record_id($id);
		$this->load->view('service_record_edit', $result);
		if ($this->input->post('submit')) {
			$empID = $this->input->post('empID');
			$appointDate = $this->input->post('appointDate');
			$endDate = $this->input->post('endDate');
			$empPosition = $this->input->post('empPosition');
			$empStatus = $this->input->post('empStatus');
			$salary = $this->input->post('salary');
			$empStation = $this->input->post('empStation');
			$separationDate = $this->input->post('separationDate');
			$separation = $this->input->post('separation');
			$remarks = $this->input->post('remarks');

			$que = $this->db->query("update hris_employment set appointDate='$appointDate',endDate='$endDate',empPosition='$empPosition',empStatus='$empStatus',salary='$salary',empStation='$empStation',separationDate='$separationDate',separation='$separation',remarks='$remarks' where empID='$empID'");
			$this->session->set_flashdata('success', 'Updated successfully.');
			redirect('Page/serviceRecord');
			// redirect(base_url().'leaveApplications/'.$IDNumber);
		}
	}

	function delete_serviceRecord()
	{
		$id = $this->input->get('id');
		$this->db->query("delete  from hris_employment where empID='" . $id . "'");
		$this->Page_model->insert_at('Deleted service record');
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect('Page/serviceRecord');
	}

	function delete_serviceRecordAll()
	{
		$id = $this->input->get('id');
		$this->db->query("delete  from hris_employment where IDNumber='" . $id . "'");
		$this->Page_model->insert_at('Deleted service record');
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect('Page/serviceRecord');
	}


	//Employee List By Position
	function employeelistPosition()
	{
		$position = $this->input->get('position');
		$result['data'] = $this->PersonnelModel->employeelistPosition($position);
		$this->load->view('list_position', $result);
	}

	function sg_summary()
	{
		$result['data'] = $this->PersonnelModel->sg_summary();
		$this->load->view('by_sg', $result);
	}

	function employeelistSG()
	{
		$sg = $this->input->get('sg');
		$result['data'] = $this->PersonnelModel->employeelistSG($sg);
		$this->load->view('list_sg', $result);
	}


	function employeelistv1()
	{
		$result['data'] = $this->PersonnelModel->employeelistv1();
		$this->load->view('list_personnelv1', $result);
	}

	public function printEmployeelistv1()
	{
		$result['data'] = $this->PersonnelModel->employeelistv1();
		$this->load->view('list_personnelv1_print', $result);
	}

	function employeelistv2()
	{
		$result['data'] = $this->PersonnelModel->employeelistv2();
		$this->load->view('list_personnelv2', $result);
	}

	function printEmployeelistv2()
	{
		$result['data'] = $this->PersonnelModel->employeelistv2();
		$this->load->view('list_personnelv2_print', $result);
	}

	//Active Employees with 60-65 years old
	function employeelistv3()
	{
		$que = $this->db->query("update hris_staff set age=(SELECT TIMESTAMPDIFF(YEAR,BirthDate,CURDATE()))");
		$que = $this->db->query("update hris_staff set retirement=DATE_ADD( BirthDate, INTERVAL 65 YEAR ),retYear=YEAR(DATE_ADD( BirthDate, INTERVAL 65 YEAR ))");
		$result['data'] = $this->PersonnelModel->employeelistv3();
		$this->load->view('list_personnelv3', $result);
	}

	//Active Employees with 60-65 years old
	function for_retirement_school()
	{
		$schoolID = $this->session->userdata('username');
		$que = $this->db->query("update hris_staff set age=(SELECT TIMESTAMPDIFF(YEAR,BirthDate,CURDATE()))");
		$que = $this->db->query("update hris_staff set retirement=DATE_ADD( BirthDate, INTERVAL 65 YEAR ),retYear=YEAR(DATE_ADD( BirthDate, INTERVAL 65 YEAR ))");
		$result['data'] = $this->PersonnelModel->for_retirement_school($schoolID);
		$this->load->view('list_personnelv3', $result);
	}

	function liquidation()
	{
		$fys = $this->SGODModel->last_record('sgod_fy', 'id', 'DESC');
		$data['app'] = $this->Common->two_cond_group('sgod_app', 'school_id', $this->session->username, 'fy', $fys->fy, 'b_code');
		$this->load->view('liquidation', $data);
	}

	function l_view()
	{
		$school_id = $this->uri->segment(3);
		$fy = $this->uri->segment(4);
		$bcode = $this->uri->segment(5);
		$mm = $this->uri->segment(6);

		$data['mon'] = $this->uri->segment(6);
		$data['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $bcode);

		$data['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);

		$liq = $this->Common->four_cond_count_row('sgod_liquidation', 'school_id', $school_id, 'bcode', $bcode, 'fy', $fy, 'mm', $mm);

		$bs = $this->SGODModel->one_cond_row('sgod_school_allocation', 'alloc_batch', $bcode);

		if ($liq->num_rows() == 0) {

			if ($bs->fund_type == 0) {
				$data['mr'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'MINOR REPAIR');
				$data['mb'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'MANDATORY BILLS');
				$data['tli'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'TEACHING-LEARNING INSTRUCTION');
				$data['tst'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'TRAININGS/SEMINAR/TRAVEL');
			} else {
				$data['mr'] = $this->SGODModel->aip_category_sned('sgod_aip', $school_id, $fy, $bcode, 'MINOR REPAIR');
				$data['mb'] = $this->SGODModel->aip_category_sned('sgod_aip', $school_id, $fy, $bcode, 'MANDATORY BILLS');
				$data['tli'] = $this->SGODModel->aip_category_sned('sgod_aip', $school_id, $fy, $bcode, 'TEACHING-LEARNING INSTRUCTION');
				$data['tst'] = $this->SGODModel->aip_category_sned('sgod_aip', $school_id, $fy, $bcode, 'TRAININGS/SEMINAR/TRAVEL');
			}

			$this->load->view('liq_view', $data);
		} else {

			$data['mr'] = $this->SGODModel->aip_category_liq('sgod_liquidation', $school_id, $fy, $bcode, 'MINOR REPAIR', $mm);
			$data['mb'] = $this->SGODModel->aip_category_liq('sgod_liquidation', $school_id, $fy, $bcode, 'MANDATORY BILLS', $mm);
			$data['tli'] = $this->SGODModel->aip_category_liq('sgod_liquidation', $school_id, $fy, $bcode, 'TEACHING-LEARNING INSTRUCTION', $mm);
			$data['tst'] = $this->SGODModel->aip_category_liq('sgod_liquidation', $school_id, $fy, $bcode, 'TRAININGS/SEMINAR/TRAVEL', $mm);


			$this->load->view('liq_viewv2', $data);
		}
	}

	function liq_view()
	{

		$data['title'] = 'Title';

		$this->load->view('liq_form', $data);
	}

	function liq_update()
	{

		$data['title'] = 'Title';

		$data['data'] = $this->Common->one_cond_row('sgod_liquidation', 'id', $this->uri->segment(3));
		$data['acc_name'] = $this->Common->no_cond('sgod_liq_acc_name');


		$school_id = $this->input->post('school_id');
		$fy = $this->input->post('fy');
		$mm = $this->input->post('mm');
		$mqty = $this->input->post('mqty');
		$bcode = $this->input->post('bcode');

		if ($this->input->post('submit')) {
			$this->SGODModel->liq_update();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/l_view/' . $school_id . '/' . $fy . '/' . $bcode . '/' . $mm . '/' . $mqty);
		}

		$this->load->view('liq_form_update', $data);
	}

	function liquidation_view()
	{
		$data['title'] = 'Title';
		$data['data'] = $this->SGODModel->show_rca();

		$this->load->view('liq_viewv2', $data);
	}

	function liquidation_insert()
	{
		$data['title'] = 'Title';

		$mm = $this->uri->segment(3);
		$qmm = $this->uri->segment(4);
		$bcode = $this->uri->segment(5);

		$m = 'b.' . $mm; // Constructing the first variable

		$qm = $qmm; // Constructing the second variable

		$cm = $mm; // Constructing the second variable
		$qcm = $qmm; // Constructing the second variable

		// Call the model method and store the result
		$data['data'] = $this->SGODModel->insert_rca($m, $qm, $cm, $qcm, $bcode);

		redirect('Page/liquidation');
	}




	function printEmployeelistv3()
	{
		$que = $this->db->query("update hris_staff set age=(SELECT TIMESTAMPDIFF(YEAR,BirthDate,CURDATE()))");
		$que = $this->db->query("update hris_staff set retirement=DATE_ADD( BirthDate, INTERVAL 65 YEAR ),retYear=YEAR(DATE_ADD( BirthDate, INTERVAL 65 YEAR ))");
		$result['data'] = $this->PersonnelModel->employeelistv3();
		$this->load->view('list_personnelv3_print', $result);
	}

	//For Step Increment
	function step_increment()
	{
		$que = $this->db->query("update hris_staff set sl_after_lastappointment =(SELECT TIMESTAMPDIFF(YEAR,lastAppointmentDate,CURDATE()))");
		$result['data'] = $this->PersonnelModel->step_increment();
		$result['data1'] = $this->PersonnelModel->step_increment1();
		$result['data2'] = $this->PersonnelModel->step_increment2();
		$result['data3'] = $this->PersonnelModel->step_increment3();
		$result['data4'] = $this->PersonnelModel->step_increment4();
		$result['data5'] = $this->PersonnelModel->step_increment5();
		$result['data6'] = $this->PersonnelModel->step_increment6();
		$result['data7'] = $this->PersonnelModel->step_increment7();
		$this->load->view('list_step_increment', $result);
	}

	function step_increment_school()
	{
		$schoolID = $this->session->userdata('username');
		$que = $this->db->query("update hris_staff set sl_after_lastappointment =(SELECT TIMESTAMPDIFF(YEAR,lastAppointmentDate,CURDATE()))");
		$result['data'] = $this->PersonnelModel->step_increment_sc($schoolID);
		$result['data1'] = $this->PersonnelModel->step_increment1_sc($schoolID);
		$result['data2'] = $this->PersonnelModel->step_increment2_sc($schoolID);
		$result['data3'] = $this->PersonnelModel->step_increment3_sc($schoolID);
		$result['data4'] = $this->PersonnelModel->step_increment4_sc($schoolID);
		$result['data5'] = $this->PersonnelModel->step_increment5_sc($schoolID);
		$result['data6'] = $this->PersonnelModel->step_increment6_sc($schoolID);
		$result['data7'] = $this->PersonnelModel->step_increment7_sc($schoolID);
		$this->load->view('list_step_increment_school', $result);
	}

	function step_increment_list()
	{
		$id = $this->input->get('id');
		$result['data'] = $this->PersonnelModel->step_increment_list($id);
		$this->load->view('list_step_increment2', $result);
	}

	function step_increment_list_school()
	{
		$id = $this->input->get('id');
		$schoolID = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->step_increment_list_school($id, $schoolID);
		$this->load->view('list_step_increment2', $result);
	}

	//Active Employees with corresponding number of years in service
	function employeelistv4()
	{
		$que = $this->db->query("update hris_staff set serviceLenght=(SELECT TIMESTAMPDIFF(YEAR,dateHired,CURDATE()))");
		$result['data'] = $this->PersonnelModel->employeelistv4();
		$this->load->view('list_personnelv4', $result);
	}

	function service_lenght()
	{
		$schoolID = $this->session->userdata('username');
		$que = $this->db->query("update hris_staff set serviceLenght=(SELECT TIMESTAMPDIFF(YEAR,dateHired,CURDATE()))");
		$result['data'] = $this->PersonnelModel->service_lenght($schoolID);
		$this->load->view('list_personnelv4', $result);
	}

	function regApplicants()
	{
		$result['data'] = $this->Page_model->get_all_posts('hris_applicant');
		$this->load->view('list_reg_applicants', $result);
	}

	function appPerMun()
	{
		$mun = $this->input->get('mun');
		$jobID = $this->input->get('jobID');
		$result['data'] = $this->PersonnelModel->appPerMun($jobID, $mun);
		$this->load->view('list_applicants_for_evaluation', $result);
	}

	public function hire()
	{

		$password = $this->input->get('bd');
		$hash = password_hash($password, PASSWORD_DEFAULT);

		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$dateHired = date("Y-m-d");

		$id = $this->input->get('id');
		$username = $this->input->get('empEmail');

		$this->db->query("insert into hris_staff (IDNumber, FirstName, MiddleName, LastName, NameExtn, prefix, MaritalStatus, BirthDate, Sex, height, weight, bloodType, gsis, pagibig, philHealth, sssNo, tinNo, resHouseNo, resStreet, resVillage, resCity, resProvince, perStreet, perVillage, perBarangay, perCity, perProvince, empTelNo, empMobile, empEmail, age, citizenship, currentStatus, dateHired, citizenshipCountry) select record_no, FirstName, MiddleName, LastName, NameExtn, prefix, MaritalStatus, BirthDate, Sex, height, weight, bloodType, gsis, pagibig, philHealth, sssNo, tinNo, resHouseNo, resStreet, resVillage, resCity, resProvince, perStreet, perVillage, perBarangay, perCity, perProvince, empTelNo, empMobile, empEmail, age, citizenship, 'Active','" . $dateHired . "','Philippines' from hris_applicant where record_no='" . $id . "'");
		$this->db->query("INSERT INTO users(username, password, position, fname, mname, lname, sex, user_id)SELECT record_no, '$hash', 'user', FirstName, MiddleName, LastName, Sex, record_no FROM hris_applicant where record_no='" . $id . "'");
		$this->session->set_flashdata('success', 'Data of the applicant has been copied successfully!');
		redirect('personnel_profile/' . $id);
	}

	public function delete_regApplicants()
	{
		$id = $this->input->get('id');
		$this->db->query("delete  from hris_applicant where id='" . $id . "'");
		$this->Page_model->insert_at('Deleted applicant profile');
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect('Page/regApplicants');
	}


	//Active Employees ()
	function employeelistv5()
	{
		$stat = 'Active';
		$result['data'] = $this->PersonnelModel->employeelistv5($stat);
		$this->load->view('list_personnelv5', $result);
	}
	//Resigned Employees ()
	public function Resigned()
	{
		$stat = 'Resigned';
		$result['data'] = $this->PersonnelModel->employeelistv5($stat);
		$this->load->view('list_personnelv5', $result);
	}

	//Retired Employees ()
	public function Retired()
	{
		$stat = 'Retired';
		$result['data'] = $this->PersonnelModel->employeelistv5($stat);
		$this->load->view('list_personnelv5', $result);
	}

	//Transferred Employees ()
	public function Transferred()
	{
		$stat = 'Transferred';
		$result['data'] = $this->PersonnelModel->employeelistv5($stat);
		$this->load->view('list_personnelv5', $result);
	}

	//Deceased Employees ()
	public function Deceased()
	{
		$stat = 'Deceased';
		$result['data'] = $this->PersonnelModel->employeelistv5($stat);
		$this->load->view('list_personnelv5', $result);
	}

	//For Retirement Employees ()
	public function retirement()
	{
		$year = date('Y');
		$result['data'] = $this->PersonnelModel->retirement($year);
		$this->load->view('list_retirement', $result);
	}

	public function perAppointmentDate()
	{
		$year = date('Y');
		$result['data'] = $this->PersonnelModel->retirement($year);
		$this->load->view('list_per_appointmentdate', $result);
	}

	public function retirement2()
	{
		$year = $this->input->post('year');
		$que = $this->db->query("update hris_staff set retirement=DATE_ADD( BirthDate, INTERVAL 65 YEAR ),retYear=YEAR(DATE_ADD( BirthDate, INTERVAL 65 YEAR ))");
		$result['data'] = $this->PersonnelModel->retirement($year);
		$this->load->view('list_retirement', $result);
	}

	public function unfilledItems()
	{
		$result['data'] = $this->PersonnelModel->unfilledItems();
		$this->load->view('unfilled_items', $result);
	}

	// Leave Credits
	public function leaveCreditsEmp()
	{
		$IDNumber = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->leaveCreditsEmp($IDNumber);
		$this->load->view('list_leave_credits_emp', $result);
	}


	// Leave Credits
	public function leaveCredits()
	{
		$result['data'] = $this->PersonnelModel->leaveCredits();
		$this->load->view('list_leave_credits', $result);
	}

	public function leaveCreditsMonthly()
	{
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$result['data'] = $this->PersonnelModel->leaveCreditsMonthly($month, $year);
		$this->load->view('list_leave_credits_monthly', $result);
	}

	public function leaveCreditsSummary()
	{
		if ($this->session->userdata('position') === 'Admin') :
			$result['data'] = $this->PersonnelModel->leaveCreditsSummary();
		elseif ($this->session->userdata('position') === 'Human Resource Admin') :
			$result['data'] = $this->PersonnelModel->leaveCreditsSummary();
		elseif ($this->session->userdata('position') === 'Staff') :
			$result['data'] = $this->PersonnelModel->leaveCreditsSummary();
		elseif ($this->session->userdata('position') === 'School') :
			$schoolID = $this->session->userdata('username');
			$result['data'] = $this->PersonnelModel->leaveCreditsSummarySchool($schoolID);
		endif;

		$result['data1'] = $this->PersonnelModel->searchPersonnel();
		$this->load->view('list_leave_credits_v2', $result);

		if ($this->input->post('submit')) {
			$ID = $this->input->post('ID');
			$vlTotal = $this->input->post('vlTotal');
			$slTotal = $this->input->post('slTotal');
			$cocTotal = $this->input->post('cocTotal');

			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$updatedDate = date("Y-m-d");

			$que = $this->db->query("update hris_leaverecords set vlTotal='$vlTotal',slTotal='$slTotal',cocTotal='$cocTotal' where ID='$ID'");
			$this->session->set_flashdata('success', 'Updated successfully.');
			redirect('Page/leaveCreditsSummary');
		}
	}


	public function leaveApplications()
	{
		$IDNumber = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->leaveApplications($IDNumber);
		$this->load->view('list_leave_applications', $result);

		if ($this->input->post('submit')) {
			$leaveType = $this->input->post('leaveType');
			$daysApplied = $this->input->post('daysApplied');
			$dateFrom = $this->input->post('dateFrom');
			$dateTo = $this->input->post('dateTo');

			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$now = date('H:i:s A');
			$appDate = date("Y-m-d");

			$que = $this->db->query("insert into hris_leave (IDNumber, appDate, leaveType, daysApplied, dateFrom, dateTo, leaveStatus) values('$IDNumber','$appDate','$leaveType','$daysApplied','$dateFrom','$dateTo','For Approval')");
			$this->session->set_flashdata('success', 'Encoded successfully.');
			redirect('Page/leaveApplications');
			// redirect(base_url().'leaveApplications/'.$IDNumber);
		}
	}

	public function printLeaveForm()
	{
		// $IDNumber=$this->session->userdata('username');
		$id = $this->input->get('id');
		$result['data'] = $this->PersonnelModel->leaveApplicationsPrint($id);
		$result['data1'] = $this->PersonnelModel->leaveSettings();
		$this->load->view('list_leave_applications_print', $result);
	}

	// Leave Credits
	public function monthlyLeaveCredits()
	{
		$date = date("Y-m-d");
		$year = date('Y');
		$month = date("m");

		$this->db->where('vlMonth', $month);
		$this->db->where('vlYear', $year);
		$query = $this->db->get('hris_leave_credits');
		if (!empty($query->result_array())) {
			$this->session->set_flashdata('danger', 'Duplicate records found.');
			redirect('Page/leaveCredits');
		} else {
			$que = $this->db->query("INSERT INTO hris_leave_credits (IDNumber, dateProcessed, vlMonth, vlYear, vlCredit, slCredit) SELECT IDNumber,'$date','$month','$year','1.25','1.25' FROM hris_staff where currentStatus='Active' and leaveCredits='Yes'");
			$que = $this->db->query("update hris_leaverecords t1, hris_staff t2 set vlTotal=vlTotal+1.25, slTotal=slTotal+1.25 where t2.currentStatus='Active' and t2.leaveCredits='Yes'");

			$this->Page_model->insert_at('Generated Monthly Leave Credits.');
			$this->session->set_flashdata('success', 'Leave credits successfully updated!');
			redirect('Page/leaveCredits');
		}
	}


	function viewfilesAll()
	{
		$result['data'] = $this->PersonnelModel->viewfilesAll();
		$this->load->view('hr_201files', $result);
	}

	function plantillaPositions()
	{
		$result['data'] = $this->PersonnelModel->plantillaPositions();
		$this->load->view('list_plantilla', $result);
	}

	function loyalty()
	{
		$result['data'] = $this->PersonnelModel->loyalty();
		$result['data1'] = $this->PersonnelModel->loyaltyCountsv1();
		$this->load->view('list_for_loyalty', $result);
	}

	function loyaltyList()
	{
		$type = urldecode($this->uri->segment(3));
		$result['data'] = $this->PersonnelModel->loyaltyList($type);
		$this->load->view('list_for_loyalty_group', $result);
	}

	function retiredList()
	{
		$type = urldecode($this->uri->segment(3));
		$result['data'] = $this->PersonnelModel->loyaltyList($type);
		$this->load->view('list_for_loyalty_group', $result);
	}

	function empReports()
	{
		$result['data'] = $this->PersonnelModel->elemCounts();
		$result['data1'] = $this->PersonnelModel->secCounts();
		$result['data2'] = $this->PersonnelModel->shsCounts();
		$result['data3'] = $this->PersonnelModel->loyaltyCounts(); // loyalty
		$result['data4'] = $this->PersonnelModel->retiredCounts(); // retired
		$result['data5'] = $this->PersonnelModel->resignedCounts(); // resigned

		$this->load->view('reports', $result);
	}

	function empGroup()
	{
		$cat = urldecode($this->uri->segment(3));
		$group = urldecode($this->uri->segment(4));
		$result['data'] = $this->PersonnelModel->empGroup($cat, $group);
		$result['data1'] = $this->PersonnelModel->empGroupPosition($cat, $group);
		$this->load->view('empGroup', $result);
	}

	function empGroup2()
	{
		$group = urldecode($this->uri->segment(3));
		$result['data'] = $this->PersonnelModel->empGroup2($group);
		$result['data1'] = $this->PersonnelModel->empGroup2Position($group);
		$result['data2'] = $this->PersonnelModel->empGroup2PositionB($group);
		$this->load->view('empGroupv2', $result);
	}

	function listPerPositionDept()
	{
		$position = urldecode($this->uri->segment(3));
		$group = urldecode($this->uri->segment(4));
		$result['data'] = $this->PersonnelModel->listPerPositionDept($position, $group);
		$this->load->view('list_per_position_dept', $result);
	}

	//System Settings
	function settings()
	{
		// $result['data']=$this->PersonnelModel->employeelistv3();
		$this->load->view('system_settings');

		if ($this->input->post('submit')) {
			// Age Caculation
			$que = $this->db->query("update hris_staff set age=(SELECT TIMESTAMPDIFF(YEAR,BirthDate,CURDATE()))");
			$this->session->set_flashdata('success', 'Updated successfully!');
		} elseif ($this->input->post('retirement')) {
			$que = $this->db->query("update hris_staff set retirement=DATE_ADD( BirthDate, INTERVAL 65 YEAR ),retYear=YEAR(DATE_ADD( BirthDate, INTERVAL 65 YEAR ))");
			$this->session->set_flashdata('success', 'The retirement date for all employees has been updated successfully!');
			// lenght of service
		} elseif ($this->input->post('service')) {
			$que = $this->db->query("update hris_staff set serviceLenght=(SELECT TIMESTAMPDIFF(YEAR,dateHired,CURDATE()))");
			$this->session->set_flashdata('success', 'Successfully updated.');
		} elseif ($this->input->post('increment')) {
			$que = $this->db->query("update hris_staff set sl_after_lastappointment =(SELECT TIMESTAMPDIFF(YEAR,lastAppointmentDate,CURDATE()))");
			$this->session->set_flashdata('success', 'Updated successfully!');
		} elseif ($this->input->post('salaryUpdating')) {
			$que = $this->db->query("update hris_staff t1, payroll_masterlist t2 SET t1.monthlySalary = t2.basicSalary WHERE t1.IDNumber = t2.IDNumber");
			$this->session->set_flashdata('success', 'Updated successfully!');
		} elseif ($this->input->post('loyalty')) {
			$date = date("Y-m-d");
			$que = $this->db->query("update hris_staff set serviceLenght=TIMESTAMPDIFF(YEAR,origAppointmentDate,CURDATE())");
			$que = $this->db->query("delete from hris_loyalty");
			$que = $this->db->query("INSERT INTO hris_loyalty (IDNumber, loyaltyDate, loyaltyType, serviceLenght) SELECT IDNumber,'$date','10th Year', serviceLenght FROM hris_staff where serviceLenght=10");
			$que = $this->db->query("INSERT INTO hris_loyalty (IDNumber, loyaltyDate, loyaltyType, serviceLenght) SELECT IDNumber,'$date','15th Year', serviceLenght FROM hris_staff where serviceLenght=15");
			$que = $this->db->query("INSERT INTO hris_loyalty (IDNumber, loyaltyDate, loyaltyType, serviceLenght) SELECT IDNumber,'$date','20th Year', serviceLenght FROM hris_staff where serviceLenght=20");
			$que = $this->db->query("INSERT INTO hris_loyalty (IDNumber, loyaltyDate, loyaltyType, serviceLenght) SELECT IDNumber,'$date','25th Year', serviceLenght FROM hris_staff where serviceLenght=25");
			$que = $this->db->query("INSERT INTO hris_loyalty (IDNumber, loyaltyDate, loyaltyType, serviceLenght) SELECT IDNumber,'$date','30th Year', serviceLenght FROM hris_staff where serviceLenght=30");
			$que = $this->db->query("INSERT INTO hris_loyalty (IDNumber, loyaltyDate, loyaltyType, serviceLenght) SELECT IDNumber,'$date','35th Year', serviceLenght FROM hris_staff where serviceLenght=35");
			$que = $this->db->query("INSERT INTO hris_loyalty (IDNumber, loyaltyDate, loyaltyType, serviceLenght) SELECT IDNumber,'$date','40th Year', serviceLenght FROM hris_staff where serviceLenght=40");

			$this->session->set_flashdata('success', 'Updated successfully!');
		}
	}

	public function awards()
	{

		$id = $this->input->post('id');

		//get data from the form
		$IDNumber = $this->input->post('IDNumber');
		$award = $this->input->post('award');
		$awardDesc = $this->input->post('awardDesc');
		$awardedBy = $this->input->post('awardedBy');
		$que = $this->db->query("insert into hris_awards(IDNumber, award, awardDesc, awardedBy) values(''$IDNumber','$award','$awardDesc','$awardedBy')");
		$this->session->set_flashdata('success', 'One data added successfully!');
		redirect(base_url() . 'personnel_profile/' . $id);
	}


	function empLoans()
	{
		if ($this->session->userdata('position') === 'user') {
			$IDNumber = $this->session->userdata('username');
			$result['data'] = $this->PersonnelModel->empLoans($IDNumber);
			$this->load->view('emp_loans', $result);
		} else {
			echo "Access Denied";
		}
	}

	function empSalaryHistory()
	{
		if ($this->session->userdata('position') === 'user') {
			$IDNumber = $this->session->userdata('username');
			$result['data'] = $this->PersonnelModel->empSalaryHistory($IDNumber);
			$this->load->view('emp_salary_history', $result);
		} else {
			echo "Access Denied";
		}
	}

	function empBenefits()
	{
		if ($this->session->userdata('position') === 'user') {
			$IDNumber = $this->session->userdata('username');
			$result['data'] = $this->PersonnelModel->empBenefits($IDNumber);
			$this->load->view('emp_benefits', $result);
		} else {
			echo "Access Denied";
		}
	}

	//Employee List
	function employeelist()
	{
		$schoolID = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->displaypersonnel($schoolID);
		$this->load->view('hr_personnel_list', $result);
	}

	function employeelist_active()
	{
		$schoolID = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->school_personnel_active($schoolID);
		$this->load->view('hr_personnel_list', $result);
	}

	function empList()
	{
		$result['data'] = $this->PersonnelModel->employeelist();
		$this->load->view('hr_personnel_list_printing', $result);
	}

	function emp_list_dept()
	{
		$schoolID = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->emp_list_dept($schoolID);
		$this->load->view('hr_personnel_list_printing', $result);
	}

	//School Profile
	function schoolProfile()
	{
		if ($this->session->userdata('position') === 'School') {

			$schoolID = $this->session->userdata('username');
			$result['data'] = $this->PersonnelModel->schoolProfile($schoolID);
			$this->load->view('profile_school', $result);
		} else {
			$schoolID = $this->input->get('schoolid');
			$result['data'] = $this->PersonnelModel->schoolProfile($schoolID);
			$this->load->view('profile_school', $result);
		}
	}
	function schoolDashboard()
	{
		$schoolID = $this->session->userdata('username');
		$id = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->count_all_staff($schoolID);
		$result['data1'] = $this->PersonnelModel->count_all_teaching($schoolID);
		$result['data2'] = $this->PersonnelModel->count_all_nonteaching($schoolID);
		$result['data3'] = $this->PersonnelModel->count_all_inactive($schoolID);
		$result['data4'] = $this->PersonnelModel->announcements_post();
		$result['data5'] = $this->PersonnelModel->school_dashboard($id);
		$this->load->view('school_dashboard', $result);
	}

	function deptDashboard()
	{
		$schoolID = $this->session->userdata('username');
		$id = $this->session->userdata('username');
		// $result['data'] = $this->PersonnelModel->count_all_staff($schoolID);
		// $result['data1'] = $this->PersonnelModel->count_all_teaching($schoolID);
		// $result['data2'] = $this->PersonnelModel->count_all_nonteaching($schoolID);
		// $result['data3'] = $this->PersonnelModel->count_all_inactive($schoolID);
		// $result['data4'] = $this->PersonnelModel->announcements_post();
		// $result['data5'] = $this->PersonnelModel->school_dashboard($id);
		$this->load->view('dashboard_department');
	}




























	function admin()
	{
		//System Administrator Access
		if ($this->session->userdata('level') === 'System Administrator') {
			$id = $this->session->userdata('IDNumber');
			$year = date('Y');
			$result['data'] = $this->PersonnelModel->getLeaveRecords($id);
			$result['data1'] = $this->PersonnelModel->leaveForApproval();
			$result['data2'] = $this->PersonnelModel->forRetirement($year);
			$result['data3'] = $this->PersonnelModel->forLoyalty($year);
			$result['data4'] = $this->PersonnelModel->birthday();
			$result['data5'] = $this->SchoolsModel->schoolCountsMun();
			$result['data6'] = $this->SchoolsModel->schoolCountsType();
			$result['data7'] = $this->SchoolsModel->schoolCountsCongDistric();
			$result['data8'] = $this->PersonnelModel->personnelCounts();
			$result['data9'] = $this->PersonnelModel->departmentcounts();
			$this->load->view('dashboard_system_administrator', $result);
		} else {
			echo "Access Denied";
		}
	}

	function sgodDashboard()
	{
		//School Dashboard
		if ($this->session->userdata('level') === 'SGOD') {
			$year = date('Y');
			$result['data5'] = $this->SchoolsModel->schoolCountsMun();
			$result['data6'] = $this->SchoolsModel->schoolCountsType();
			$result['data7'] = $this->SchoolsModel->schoolCountsCongDistric();
			$this->load->view('dashboard_sgod', $result);
		} else {
			echo "Access Denied";
		}
	}




	function personnel()
	{
		//Allowing access to Personnel only
		if ($this->session->userdata('level') === 'Personnel') {
			$id = $this->session->userdata('IDNumber');
			$year = date('Y');
			$result['data'] = $this->PersonnelModel->getLeaveRecords($id);
			$this->load->view('dashboard_hr_personnel', $result);
		} else {
			echo "Access Denied";
		}
	}

	function school()
	{
		//System Administrator Access
		if ($this->session->userdata('level') === 'System Administrator') {
			$id = $this->session->userdata('IDNumber');
			$year = date('Y');
			$result['data'] = $this->PersonnelModel->getLeaveRecords($id);
			$result['data1'] = $this->PersonnelModel->leaveForApproval();
			$result['data2'] = $this->PersonnelModel->forRetirement($year);
			$result['data3'] = $this->PersonnelModel->forLoyalty($year);
			$result['data4'] = $this->PersonnelModel->birthday();
			$result['data5'] = $this->SchoolsModel->schoolCountsMun();
			$result['data6'] = $this->SchoolsModel->schoolCountsType();
			$result['data7'] = $this->SchoolsModel->schoolCountsCongDistric();
			$result['data8'] = $this->PersonnelModel->personnelCounts();
			$result['data9'] = $this->PersonnelModel->departmentcounts();
			$this->load->view('dashboard_schools', $result);
		} else {
			echo "Access Denied";
		}
	}


	function employeesleave()
	{
		$result['data'] = $this->PersonnelModel->getLeaveAll();
		$this->load->view('hr_employees_leave', $result);
	}







	function employees()
	{
		//Allowing access to HR admin only
		if ($this->session->userdata('level') === 'HR Admin') {
			$departmentVal = $this->input->post('department');
			$positionVal = $this->input->post('position');
			$result['data'] = $this->PersonnelModel->getFilteredPersonnel($departmentVal, $positionVal);
			$result['department'] = $this->PersonnelModel->getDepartment();
			$result['departmentVal'] = $departmentVal;
			$result['positionVal'] = $positionVal;
			$this->load->view('hr_personnel_by_dept', $result);
		} else {
			echo "Access Denied";
		}
	}

	function applicant()
	{
		//Allowing access to Applicant only
		if ($this->session->userdata('level') === 'Applicant') {
			$this->load->view('dashboard_view');
		} else {
			echo "Access Denied";
		}
	}

	function fetch_position()
	{

		if ($this->input->post('department')) {
			$output = '<option value="">Select Position</option>';
			$positions = $this->PersonnelModel->getPosition($this->input->post('department'));
			foreach ($positions as $row) {
				$output .= '<option value ="' . $row->empPosition . '">' . $row->empPosition . '</option>';
			}
			echo $output;
		}
	}


	function employeesummary()
	{
		$result['data'] = $this->PersonnelModel->personnelCounts();
		$this->load->view('hr_personnel_summary', $result);
	}

	function contactdirectory()
	{
		$result['data'] = $this->PersonnelModel->displaypersonnel();
		$this->load->view('hr_directory', $result);
	}

	function hrfiles201()
	{
		$result['data'] = $this->PersonnelModel->displaypersonnel();
		$this->load->view('hr_201files', $result);
	}

	function hr_files_individual()
	{
		// if($this->session->userdata('level')==='Personnel'){
		// $id=$this->session->userdata('username');

		// $result['data']=$this->PersonnelModel->viewfiles($id);
		// //$this->output->cache(3); 
		// $this->load->view('hr_files_individual',$result);
		// } else {
		// $id = $this->input->get('id');

		// $result['data'] = $this->PersonnelModel->viewfiles($id);
		// $this->load->view('hr_files_individual', $result);
		// }
	}


	function profile()
	{
		$id = $this->input->get('id');
		$result['data'] = $this->PersonnelModel->displaypersonnelById($id);
		$this->load->view('personnel_profile', $result);
	}

	function profilepage()
	{
		$id = $this->input->get('id');
		$result['data'] = $this->PersonnelModel->displaypersonnelById($id);
		$result['data1'] = $this->PersonnelModel->viewfiles($id);
		$result['data2'] = $this->PersonnelModel->family($id);
		$result['data3'] = $this->PersonnelModel->education($id);
		$result['data4'] = $this->PersonnelModel->cs($id);
		$result['data5'] = $this->PersonnelModel->personnelTrainings($id);
		$result['data6'] = $this->PersonnelModel->profilepic($id);
		$this->load->view('profile_page', $result);
	}

	//Display all personnel leave
	function leaveapplication()
	{

		$this->load->view('leave-application');
	}

	//Get Personal Leave
	function leaveHistory()
	{
		if ($this->session->userdata('position') === 'Admin') :
			$id = $this->input->get('id');
		elseif ($this->session->userdata('position') === 'user') :
			$id = $this->session->userdata('username');
		endif;

		$result['data'] = $this->PersonnelModel->getLeaveLeaveHistory($id);
		$this->load->view('list_leave_history', $result);
	}

	//Get Personal Leave
	function leaveapplicationview()
	{
		$id = $this->session->userdata('IDNumber');
		$result['data'] = $this->PersonnelModel->getLeaveLeaveHistory($id);
		$this->load->view('leave-application-view', $result);
	}

	function pendingLeave()
	{
		$result['data'] = $this->PersonnelModel->pendingLeave();
		$this->load->view('list_pendingLeave', $result);
	}

	function pendingLeaveEvaluation()
	{
		$empID = $this->input->get('empID');
		$leaveID = $this->input->get('leaveID');
		$result['data'] = $this->PersonnelModel->pendingLeaveEvaluation($empID, $leaveID);
		$this->load->view('list_pendingLeave_eval', $result);

		if ($this->input->post('submit')) {

			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$today = date("Y-m-d");

			$leaveID = $this->input->post('leaveID');
			$IDNumber = $this->input->post('IDNumber');
			$daysApplied = $this->input->post('daysApplied');
			$leaveType = $this->input->post('leaveType');

			$que = $this->db->query("update hris_leave set leaveStatus='Approved',dateApproved='$today' where leaveID='$leaveID'");

			if ($leaveType == "Vacation Leave") {
				$que = $this->db->query("update hris_leaverecords set vlTotal=vlTotal-'$daysApplied' where IDNumber='$IDNumber'");
			} elseif ($leaveType == "Sick Leave") {
				$que = $this->db->query("update hris_leaverecords set slTotal=slTotal-'$daysApplied' where IDNumber='$IDNumber'");
			} else {
				$que = $this->db->query("update hris_leaverecords set cocTotal=cocTotal-'$daysApplied' where IDNumber='$IDNumber'");
			}

			$this->session->set_flashdata('success', 'The selected leave application has been processed successfully.');
			//  redirect('Page/pendingLeave');
		}
	}

	//List of Birthday Celebrants
	function birthdayCelebrants()
	{
		$result['data'] = $this->PersonnelModel->birthdayList();
		$this->load->view('hr_bday_celebrants', $result);
	}
	//For Loyalty Cash Award
	function forLoyaltyList()
	{
		//$year=date('Y');
		$result['data'] = $this->PersonnelModel->forLoyaltyList();
		$this->load->view('hr_loyalty_cash', $result);
	}

	//For Retirement
	function forRetirementList()
	{
		//$year=date('Y');
		$result['data'] = $this->PersonnelModel->forRetirementList();
		$this->load->view('hr_retirement_list', $result);
	}

	function leavecreditsview()
	{
		$id = $this->input->get('id');
		$result['data'] = $this->PersonnelModel->displayleavecredits($id);
		$this->load->view('leave-credits-view', $result);
	}

	function att()
	{
		$this->load->view('authority-to-travel');
	}

	function trainings()
	{
		$this->load->view('trainings');
	}

	function accomplishments()
	{
		$this->load->view('accomplishments');
	}

	function speakership()
	{
		$this->load->view('speakership-summary');
	}

	function pds()
	{
		$this->load->view('pds/pds');
	}

	//Change Password
	function changepassword()
	{
		$this->load->view('change_pass');
	}

	function update_password()
	{

		$this->form_validation->set_rules('currentpassword', 'Current Password', 'required|trim|callback__validate_currentpassword');
		$this->form_validation->set_rules('newpassword', 'New Password', 'required|trim|min_length[8]|alpha_numeric');
		$this->form_validation->set_rules('cnewpassword', 'Confirm New Password', 'required|trim|matches[newpassword]');

		$this->form_validation->set_message('required', "Please fill-up the form completely!");
		if ($this->form_validation->run()) {

			$username = $this->session->userdata('username');
			$newpass = sha1($this->input->post('newpassword'));
			if ($this->PersonnelModel->reset_userpassword($username, $newpass)) {

				$this->session->set_flashdata('success', 'You have changed your password succesfully!');
				$this->load->view('change_pass');
			} else {
				echo "Error";
			}
		} else {
			$this->session->set_flashdata('msg', '');
			$this->load->view('change_pass');
		}
	}

	function _validate_currentpassword()
	{
		$username = $this->session->userdata('username');
		$currentpass = sha1($this->input->post('currentpassword'));
		if ($this->PersonnelModel->is_current_password($username, $currentpass)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('_validate_currentpassword', 'Wrong Current Password');
			return FALSE;
		}
	}

	//applicants pages
	function applicantsprofile()
	{
		$id = $this->input->get('id');
		$result['data'] = $this->ApplicantsModel->displayrecordsById($id);
		$this->load->view('applicants_profile', $result);
	}

	function applicantsrating()
	{
		$this->load->view('applicants_rating');
	}

	//Uploading of Training and Speakership
	function uploadFiles()
	{
		$id = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->personnelTrainings($id);
		$this->load->view('hr_personnel_upload', $result);
	}

	//Processing of Training and Speakership
	public function processUpload()
	{
		$config['upload_path'] = './upload/trainings/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = 15120;
		//$config['max_width'] = 1500;
		//$config['max_height'] = 1500;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('nonoy')) {
			$msg = array('error' => $this->upload->display_errors());

			$this->load->view('uploadFiles', $msg);
		} else {
			$data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$IDNumber = $this->session->userdata('username');
			$filename = $this->upload->data('file_name');
			$trainingTitle = $this->input->post('trainingTitle');
			$dateStarted = $this->input->post('dateStarted');
			$dateFinished = $this->input->post('dateFinished');
			$noHours = $this->input->post('noHours');
			$IdType = $this->input->post('IdType');
			$sponsor = $this->input->post('sponsor');

			$que = $this->db->query("insert into hris_trainings values('','$trainingTitle','$dateStarted','$dateFinished','$noHours','$IdType','$sponsor','$IDNumber','$filename')");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Recorded Succesfully!</b></div>');

			redirect('Page/uploadFiles');
		}
	}
	//Uploading of Personnel 201 Files
	function uploadFiles201()
	{
		$id = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->view201Files($id);
		$this->load->view('hr_personnel_upload_201', $result);
	}

	//Processing of Training and Speakership
	public function processuploadFiles201()
	{
		$config['upload_path'] = './upload/files/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = 15120;
		//$config['max_width'] = 1500;
		//$config['max_height'] = 1500;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('nonoy')) {
			$msg = array('error' => $this->upload->display_errors());

			$this->load->view('uploadFiles', $msg);
		} else {
			$data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$IDNumber = $this->session->userdata('username');
			$filename = $this->upload->data('file_name');
			$docName = $this->input->post('docName');

			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$dateUploaded = date("Y-m-d");

			$que = $this->db->query("insert into hris_files values('','$IDNumber','$docName','$filename','$dateUploaded')");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Recorded Succesfully!</b></div>');

			redirect('Page/uploadFiles201');
		}
	}
	//Uploading of Training and Speakership
	function expertServices()
	{
		$id = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->personnelServices($id);
		$this->load->view('hr_personnel_expert_services', $result);
	}

	//Processing of Training and Speakership
	public function processExpertServices()
	{
		$config['upload_path'] = './upload/expert-services/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = 15120;
		//$config['max_width'] = 1500;
		//$config['max_height'] = 1500;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('nonoy')) {
			$msg = array('error' => $this->upload->display_errors());

			$this->load->view('uploadFiles', $msg);
		} else {
			$data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$IDNumber = $this->session->userdata('username');
			$filename = $this->upload->data('file_name');
			$event = $this->input->post('event');
			$dateStarted = $this->input->post('dateStarted');
			$dateFinished = $this->input->post('dateFinished');

			$que = $this->db->query("insert into hris_expert values('','$event','$dateStarted','$dateFinished','$IDNumber','$filename')");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Recorded Succesfully!</b></div>');

			redirect('Page/expertServices');
		}
	}
	//Uploading of Achievement
	function uploadAchievements()
	{
		$id = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->personnelAchievements($id);
		$this->load->view('hr_personnel_achievements', $result);
	}

	//Processing of Training and Speakership
	public function processuploadAchievements()
	{
		$config['upload_path'] = './upload/achievements/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = 15120;
		//$config['max_width'] = 1500;
		//$config['max_height'] = 1500;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('nonoy')) {
			$msg = array('error' => $this->upload->display_errors());

			$this->load->view('uploadFiles', $msg);
		} else {
			$data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$IDNumber = $this->session->userdata('username');
			$filename = $this->upload->data('file_name');
			$achievement = $this->input->post('achievement');
			$dateAchieved = $this->input->post('dateAchieved');

			$que = $this->db->query("insert into hris_achievements values('','$achievement','$dateAchieved','$IDNumber','$filename')");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Recorded Succesfully!</b></div>');

			redirect('Page/uploadAchievements');
		}
	}

	//Uploading of Achievement
	function uploadOtherDocs()
	{
		$id = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->personnelOtherDocs($id);
		$this->load->view('hr_personnel_upload_docs', $result);
	}

	//Processing of Training and Speakership
	public function processuploadOtherDocs()
	{
		$config['upload_path'] = './upload/files/';
		$config['allowed_types'] = '*';
		$config['max_size'] = 15120;
		//$config['max_width'] = 1500;
		//$config['max_height'] = 1500;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('nonoy')) {
			$msg = array('error' => $this->upload->display_errors());

			$this->load->view('uploadFiles', $msg);
		} else {
			$data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$IDNumber = $this->session->userdata('username');
			$filename = $this->upload->data('file_name');
			$docName = $this->input->post('docName');
			$fileType = $this->input->post('fileType');
			$dateUploaded = $this->input->post('dateUploaded');

			$que = $this->db->query("insert into hris_otherdocs values('','$docName','$fileType','$dateUploaded','$IDNumber','$filename')");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Recorded Succesfully!</b></div>');

			redirect('Page/uploadOtherDocs');
		}
	}

	function personnelEntry()
	{
		$this->load->view('hr_personnel_profile_form');
		if ($this->input->post('submit')) {
			//get data from the form
			$prefix = $this->input->post('prefix');
			$IDNumber = $this->input->post('IDNumber');
			$FirstName = strtoupper($this->input->post('FirstName'));
			$MiddleName = strtoupper($this->input->post('MiddleName'));
			$LastName = strtoupper($this->input->post('LastName'));
			$NameExtn = $this->input->post('NameExtn');
			$completeName = $FirstName . ' ' . $LastName;
			$Sex = $this->input->post('Sex');
			$BirthDate = $this->input->post('BirthDate');
			$age = $this->input->post('age');
			$BirthPlace = $this->input->post('BirthPlace');
			$MaritalStatus = $this->input->post('MaritalStatus');
			$height = $this->input->post('height');
			$weight = $this->input->post('weight');
			$bloodType = $this->input->post('bloodType');
			$empTelNo = $this->input->post('empTelNo');
			$empMobile = $this->input->post('empMobile');
			$empEmail = $this->input->post('empEmail');
			$fb = $this->input->post('fb');
			$skype = $this->input->post('skype');
			$citizenship = $this->input->post('citizenship');
			$dualCitizenship = $this->input->post('dualCitizenship');
			$citizenshipType = $this->input->post('citizenshipType');
			$citizenshipCountry = $this->input->post('citizenshipCountry');
			$empPosition = $this->input->post('empPosition');
			$Department = $this->input->post('Department');
			$empStatus = $this->input->post('empStatus');
			$agencyCode = $this->input->post('agencyCode');
			$dateHired = $this->input->post('dateHired');
			$retYear = $this->input->post('retYear');
			$gsis = $this->input->post('gsis');
			$pagibig = $this->input->post('pagibig');
			$philHealth = $this->input->post('philHealth');
			$sssNo = $this->input->post('sssNo');
			$tinNo = $this->input->post('tinNo');
			$contactName = $this->input->post('contactName');
			$contactRel = $this->input->post('contactRel');
			$contactEmail = $this->input->post('contactEmail');
			$contactNo = $this->input->post('contactNo');
			$contactAddress = $this->input->post('contactAddress');
			$resHouseNo = $this->input->post('resHouseNo');
			$resStreet = $this->input->post('resStreet');
			$resVillage = $this->input->post('resVillage');
			$resBarangay = $this->input->post('resBarangay');
			$resZipCode = $this->input->post('resZipCode');
			$resCity = $this->input->post('resCity');
			$resProvince = $this->input->post('resProvince');
			$stationCode = $this->input->post('stationCode');
			$umid = $this->input->post('umid');
			$csEligibility = $this->input->post('csEligibility');
			$csLevel = $this->input->post('csLevel');
			$currentStatus = $this->input->post('currentStatus');
			$YearsAsJO = $this->input->post('YearsAsJO');
			$workNature1 = $this->input->post('workNature1');
			$workNature2 = $this->input->post('workNature2');
			$employeeNo = $this->input->post('employeeNo');
			$currentItemNo = $this->input->post('currentItemNo');
			$sgNo = $this->input->post('sgNo');
			$authAnSalary = $this->input->post('authAnSalary');
			$actualSalary = $this->input->post('actualSalary');
			$stepNo = $this->input->post('stepNo');
			$origAppointmentDate = $this->input->post('origAppointmentDate');
			$lastAppointmentDate = $this->input->post('lastAppointmentDate');


			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$now = date('H:i:s A');
			$date = date("Y-m-d");
			$Password = sha1($this->input->post('BirthDate'));
			$Encoder = $this->session->userdata('username');

			//check if record exist
			$que = $this->db->query("select * from hris_staff where IDNumber='" . $IDNumber . "'");
			$row = $que->num_rows();
			if ($row) {
				//redirect('Page/notification_error');
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Employee Number is in use.</b></div>');
				redirect('Page/personnelEntry');
			} else {
				//save profile
				$que = $this->db->query("insert into hris_staff values('$IDNumber','$FirstName','$MiddleName','$LastName','$NameExtn','$prefix','','$empPosition','$Department','$MaritalStatus','$empStatus','$BirthDate','$BirthPlace','$Sex','$height','$weight','$bloodType','$gsis','$pagibig','$philHealth','$sssNo','$tinNo','$resHouseNo','$resStreet','$resVillage','$resBarangay','$resCity','$resProvince','$resZipCode','$resHouseNo','$resStreet','$resVillage','$resBarangay','$resCity','$resProvince','$resZipCode','$empTelNo','$empMobile','$empEmail','1','','','$age','$dateHired','','$retYear','$agencyCode','$citizenship','$dualCitizenship','$citizenshipType','$citizenshipCountry','$contactName','$contactRel','$contactEmail','$contactNo','$contactAddress','$fb','$skype','$stationCode','$umid','$csEligibility','$csLevel','$currentStatus','$YearsAsJO','$workNature1','$workNature2','$employeeNo','$currentItemNo','$sgNo','$authAnSalary','$actualSalary','$stepNo','$dateHired','$lastAppointmentDate')");
				$que = $this->db->query("insert into users values('$empEmail','$Password','$FirstName','$MiddleName','$LastName','$NameExtn','$empPosition','$date','avatar.png','Personnel','$empEmail','$IDNumber','active')");
				$que = $this->db->query("insert into atrail values('','Created Personnel Profile and User Account','$date','$now','$Encoder','$IDNumber')");
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><h4 class="m-t-0 header-title mb-4">Profile has been saved successfully.</h4></div>');

				//Email Notification
				$this->load->config('email');
				$this->load->library('email');
				$mail_message = 'Dear ' . $FirstName . ',' . "\r\n";
				$mail_message .= '<br><br>Your profile is now encoded to DepEd MIS. Please take note of the following:' . "\r\n";
				$mail_message .= '<br>Username: <b>' . $empEmail . '</b>' . "\r\n";
				$mail_message .= '<br>Password: <b>' . $BirthDate . '</b>' . "\r\n";

				$mail_message .= '<br><br>Thanks & Regards,';
				$mail_message .= '<br>DepEd MIS Team';

				$this->email->from('no-reply@lxeinfotechsolutions.com', 'DepEd MIS Team')
					->to($empEmail)
					->subject('Account Created')
					->message($mail_message);
				$this->email->send();

				redirect('Page/employeelist');
			}
		}
	}

	//Update Personnel Profile
	function updatePersonnelProfile()
	{
		if ($this->session->userdata('level') === 'System Administrator') {
			$id = $this->input->get('id');
		} elseif ($this->session->userdata('level') === 'School') {
			$id = $this->input->get('id');
		} elseif ($this->session->userdata('level') === 'HR Admin') {
			$id = $this->input->get('id');
		} else {
			$id = $this->session->userdata('IDNumber');
		}

		$result['data'] = $this->PersonnelModel->staffProfile($id);
		$this->load->view('hr_personnel_profile_update_form', $result);
		if ($this->input->post('submit')) {
			//get data from the form
			$OldIDNumber = $this->input->post('OldIDNumber');
			$prefix = $this->input->post('prefix');
			$IDNumber = $this->input->post('IDNumber');
			$FirstName = strtoupper($this->input->post('FirstName'));
			$MiddleName = strtoupper($this->input->post('MiddleName'));
			$LastName = strtoupper($this->input->post('LastName'));
			$NameExtn = $this->input->post('NameExtn');
			$completeName = $FirstName . ' ' . $LastName;
			$Sex = $this->input->post('Sex');
			$BirthDate = $this->input->post('BirthDate');
			$age = $this->input->post('age');
			$BirthPlace = $this->input->post('BirthPlace');
			$MaritalStatus = $this->input->post('MaritalStatus');
			$height = $this->input->post('height');
			$weight = $this->input->post('weight');
			$bloodType = $this->input->post('bloodType');
			$empTelNo = $this->input->post('empTelNo');
			$empMobile = $this->input->post('empMobile');
			$empEmail = $this->input->post('empEmail');
			$fb = $this->input->post('fb');
			$skype = $this->input->post('skype');
			$citizenship = $this->input->post('citizenship');
			$dualCitizenship = $this->input->post('dualCitizenship');
			$citizenshipType = $this->input->post('citizenshipType');
			$citizenshipCountry = $this->input->post('citizenshipCountry');
			$empPosition = $this->input->post('empPosition');
			$Department = $this->input->post('Department');
			$empStatus = $this->input->post('empStatus');
			$agencyCode = $this->input->post('agencyCode');
			$dateHired = $this->input->post('dateHired');
			$retYear = $this->input->post('retYear');
			$gsis = $this->input->post('gsis');
			$pagibig = $this->input->post('pagibig');
			$philHealth = $this->input->post('philHealth');
			$sssNo = $this->input->post('sssNo');
			$tinNo = $this->input->post('tinNo');
			$contactName = $this->input->post('contactName');
			$contactRel = $this->input->post('contactRel');
			$contactEmail = $this->input->post('contactEmail');
			$contactNo = $this->input->post('contactNo');
			$contactAddress = $this->input->post('contactAddress');
			$resHouseNo = $this->input->post('resHouseNo');
			$resStreet = $this->input->post('resStreet');
			$resVillage = $this->input->post('resVillage');
			$resBarangay = $this->input->post('resBarangay');
			$resZipCode = $this->input->post('resZipCode');
			$resCity = $this->input->post('resCity');
			$resProvince = $this->input->post('resProvince');

			$stationCode = $this->input->post('stationCode');

			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$now = date('H:i:s A');
			$date = date("Y-m-d");
			$Password = sha1($this->input->post('BirthDate'));
			$Encoder = $this->session->userdata('username');
			//$description='Updated Personnel Information.  Old ID Number: '.$OldIDNumber.' '.' New IDNumber: '.$IDNumber.; 

			//save profile
			$que = $this->db->query("update hris_staff set IDNumber='$IDNumber',FirstName='$FirstName',MiddleName='$MiddleName',LastName='$LastName',NameExtn='$NameExtn',prefix='$prefix',empPosition='$empPosition',Department='$Department',MaritalStatus='$MaritalStatus',empStatus='$empStatus',BirthDate='$BirthDate',BirthPlace='$BirthPlace',Sex='$Sex',height='$height',weight='$weight',bloodType='$bloodType',gsis='$gsis',pagibig='$pagibig',philHealth='$philHealth',sssNo='$sssNo',tinNo='$tinNo',resHouseNo='$resHouseNo',resStreet='$resStreet',resVillage='$resVillage',resBarangay='$resBarangay',resCity='$resCity',resProvince='$resProvince',resZipCode='$resZipCode',perHouseNo='$resHouseNo',perStreet='$resStreet',perVillage='$resVillage',perBarangay='$resBarangay',perCity='$resCity',perProvince='$resProvince',perZipCode='$resZipCode',empTelNo='$empTelNo',empMobile='$empMobile',empEmail='$empEmail',age='$age',dateHired='$dateHired',retYear='$retYear',agencyCode='$agencyCode',citizenship='$citizenship',dualCitizenship='$dualCitizenship',citizenshipType='$citizenshipType',citizenshipCountry='$citizenshipCountry',contactName='$contactName',contactRel='$contactRel',contactEmail='$contactEmail',contactNo='$contactNo',contactAddress='$contactAddress',fb='$fb',skype='$skype',stationCode='$stationCode' where IDNumber='$OldIDNumber'");
			$que1 = $this->db->query("update users set fName='$FirstName',mName='$MiddleName',lName='$LastName',email='$empEmail',IDNumber='$IDNumber' where IDNumber='$OldIDNumber'");
			$que2 = $this->db->query("insert into atrail values('','Updated Personnel Profile','$date','$now','$Encoder','$OldIDNumber')");
			$this->session->set_flashdata('msg', '<div id="sa-success" class="alert alert-success text-center"><b>Updated successfully.</b></div>');
			if ($this->session->userdata('level') === 'System Administrator') :
				redirect('Page/personnelEntry');
			elseif ($this->session->userdata('level') === 'School') :
				redirect('Schools/schoolDashboard');
			endif;
		}
	}

	public function myApplications()
	{
		if ($this->session->position === 'Admin' || $this->session->position === 'Super Admin' || $this->session->position === 'Human Resource Admin' || $this->session->position === 'HR Staff' || $this->session->position === 'asds') :
			$applicantEmail = $this->input->get('id');
		elseif ($this->session->userdata('position') === 'reg') :
			$applicantEmail = $this->session->userdata('username');
		elseif ($this->session->userdata('position') === 'user') :
			$applicantEmail = $this->session->userdata('username');
		endif;
		$result['rating'] = $this->Page_model->get_single_row_by_id('settings', 'id', 3);
		$result['track'] = $this->Page_model->get_single_row_by_id('settings', 'id', 5);
		$result['data'] = $this->PersonnelModel->myApplications($applicantEmail);
		$this->load->view('my_applications', $result);
	}

	public function ratings()
	{
		$appID = $this->input->get('appID');
		$result['data'] = $this->PersonnelModel->ratings($appID);
		$this->load->view('my_applications_rating', $result);

		if ($this->input->post('submit')) {
			//get data from the form
			$education = $this->input->post('education');
			$training = $this->input->post('training');
			$experience = $this->input->post('experience');
			$let_rating = $this->input->post('let_rating');
			$demo_rating = $this->input->post('demo_rating');
			$tr_rating = $this->input->post('tr_rating');
			$total_points = $this->input->post('total_points');

			$que = $this->db->query("update hris_applications_rating set education='" . $education . "', training='" . $training . "', experience='" . $experience . "', let_rating='" . $let_rating . "', demo_rating='" . $demo_rating . "', tr_rating='" . $tr_rating . "', total_points='" . $total_points . "' where appID='" . $appID . "'");
			$this->session->set_flashdata('success', 'Application rating has been updated successfully.');
			redirect('Page/ratings?appID=' . $appID);
		}
	}


	public function trainingNeeds()
	{
		$user_id = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->trainingNeeds($user_id);
		$result['data1'] = $this->PersonnelModel->tnCategory();
		$this->load->view('my_training_needs', $result);
		if ($this->input->post('submit')) {
			//get data from the form
			$IDNumber = $this->session->userdata('username');
			$trainingNeeds = $this->input->post('trainingNeeds');
			$justification = $this->input->post('justification');
			$trainingCat = $this->input->post('trainingCat');

			$que1 = $this->db->query("insert into hris_training_needs (IDNumber, trainingNeeds, justification, trainingCat) values('$IDNumber','$trainingNeeds','$justification','$trainingCat')");
			$this->session->set_flashdata('success', 'Successfully added!');
			redirect('Page/trainingNeeds');
		}
	}

	public function tnCategory()
	{
		$result['data'] = $this->PersonnelModel->tnCategory();
		$this->load->view('training_needs_cat', $result);
		if ($this->input->post('submit')) {

			$category = $this->input->post('category');

			$que1 = $this->db->query("insert into hris_training_needs_cat (category) values('$category')");
			$this->session->set_flashdata('success', 'Successfully added!');
			redirect('Page/tnCategory');
		}
	}


	public function tnSummary()
	{
		$result['data'] = $this->Page_model->tnSummary();
		$this->load->view('training_needs_summary', $result);
	}

	public function tnHR()
	{
		$trainingCat = $this->input->get('trainingCat');
		$result['data'] = $this->Page_model->tnHR($trainingCat);
		$this->load->view('training_needs', $result);
	}

	public function idHR()
	{
		$result['data'] = $this->Page_model->idHR();
		$this->load->view('individual_development_hr', $result);
	}

	public function individualDevelopment()
	{
		$user_id = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->individualDevelopment($user_id);
		$this->load->view('individual_development', $result);
		if ($this->input->post('submit')) {
			//get data from the form
			$IDNumber = $this->session->userdata('username');
			$targetCompetency = $this->input->post('targetCompetency');
			$priority = $this->input->post('priority');
			$devActivity = $this->input->post('devActivity');
			$supportNeeded = $this->input->post('supportNeeded');
			$trainingProvider = $this->input->post('trainingProvider');
			$sched = $this->input->post('sched');

			$que1 = $this->db->query("insert into hris_ind_devt (IDNumber, targetCompetency, priority, devActivity, supportNeeded, trainingProvider, sched) values('$IDNumber','$targetCompetency','$priority','$devActivity','$supportNeeded','$trainingProvider','$sched')");
			$this->Page_model->insert_at('Added Employee Development Plan');
			$this->session->set_flashdata('success', 'Successfully added!');
			redirect('Page/individualDevelopment');
		}
	}

	public function empServiceRecord()
	{
		if ($this->session->userdata('position') === 'Admin') :
			$user_id = $this->input->get('id');
		elseif ($this->session->userdata('position') === 'user') :
			$user_id = $this->session->userdata('username');
		endif;

		$result['data'] = $this->PersonnelModel->empServiceRecord($user_id);
		$this->load->view('service_record', $result);
	}

	public function announcements()
	{
		$result['data'] = $this->PersonnelModel->announcements();
		$this->load->view('announcement', $result);
	}

	public function del_announcements($param)
	{
		$result['img'] = $this->Page_model->get_single_table_by_id("announcements", 'id', $param);
		$filename = $result['img']['fileAttachment'];
		$id = $result['img']['id'];
		$this->Page_model->delete_group($param, $filename, 'announcements', "announcements");
		$this->session->set_flashdata('danger', ' Deleted successfully!');
		redirect('Page/announcements');
	}

	public function addAnnouncement()

	{
		$config['allowed_types'] = 'png|jpg';
		$config['upload_path'] = './uploads/announcements/';
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('fileAttachment')) {
			//$file = $this->upload->data();
			$id = $this->input->post('id');

			$this->Page_model->insert_announcements();
			$this->session->set_flashdata('success', 'Posted successfully!');
			redirect('Page/announcements');
		} else {
			print_r($this->upload->display_errors());
		}
	}


	public function printServiceRecord()
	{
		if ($this->session->userdata('position') === 'Admin') :
			$user_id = $this->input->get('id');
		elseif ($this->session->userdata('position') === 'Staff') :
			$user_id = $this->input->get('id');
		elseif ($this->session->userdata('position') === 'School') :
			$user_id = $this->input->get('id');
		elseif ($this->session->userdata('position') === 'user') :
			$user_id = $this->session->userdata('username');
		endif;

		$result['data'] = $this->PersonnelModel->empServiceRecord($user_id);
		$result['data1'] = $this->PersonnelModel->mis_settings();
		$this->load->view('service_record_print', $result);
	}

	public function delete_tn()
	{
		$id = $this->input->get('id');
		$this->db->query("delete  from hris_training_needs where tnID='" . $id . "'");
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect('Page/trainingNeeds');
	}

	public function delete_tnCat()
	{
		$id = $this->input->get('id');
		$this->db->query("delete  from hris_training_needs_cat where id='" . $id . "'");
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect('Page/tnCategory');
	}



	public function delete_id()
	{
		$id = $this->input->get('id');
		$this->db->query("delete  from hris_ind_devt where id='" . $id . "'");
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect('Page/individualDevelopment');
	}

	public function viewApplicants()
	{
		$jobID = $this->input->get('jobID');
		$jobTitle = $this->input->get('jobTitle');
		//$result['data'] = $this->PersonnelModel->viewApplicants($jobID);
		$result['data'] = $this->Common->two_cond('hris_applications', 'jobID', $jobID, 'dq', 0);
		$result['job'] = $this->Common->one_cond_row('hris_jobvacancy', 'jobID', $jobID);
		$result['data1'] = $this->PersonnelModel->appCountsPerCity($jobID);
		$this->load->view('list_applicants', $result);

		if ($this->input->post('submit')) {
			//get data from the form
			$jobID = $this->input->post('jobID');
			$empEmail = $this->input->post('empEmail');
			$appStatus = $this->input->post('appStatus');
			$note = $this->input->post('note');


			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$now = date('H:i:s A');
			$date = date("Y-m-d");

			$que = $this->db->query("insert into hris_applications_track (jobID, empEmail, dateSubmitted, appStatus, note, timeSubmitted) values('$jobID','$empEmail','$date','$appStatus','$note','$now')");
			// $que1=$this->db->query("insert into atrail values('','Updated Personnel Profile','$date','$now','$Encoder','$OldIDNumber')");
			// $this->session->set_flashdata('msg', '<div id="sa-success" class="alert alert-success text-center"><b>Updated successfully.</b></div>');
			$this->session->set_flashdata('success', 'Application status has been posted successfully.');
			redirect('Page/viewApplicants?jobID=' . $jobID . '&jobTitle=' . $jobTitle);
		}
	}

	public function appTrack()
	{

		if ($this->session->userdata('position') === 'Admin') :
			$empEmail = $this->input->get('id');
		elseif ($this->session->userdata('position') === 'reg') :
			$empEmail = $this->session->userdata('username');
		endif;

		$jobID = $this->input->get('jobID');
		$result['data'] = $this->PersonnelModel->appTrack($empEmail, $jobID);
		$this->load->view('my_applications_tracking', $result);
	}

	public function jobArchieved()
	{
		$result['data'] = $this->PersonnelModel->jobArchieved();
		$this->load->view('list_jobvacancy_archieved', $result);
	}

	public function jobVacancy()
	{

		$result['data'] = $this->PersonnelModel->JobVancancies();
		$result['lock'] = $this->Common->one_cond_count_row('hris_applicant', 'stat', 0);
		$result['pos_title'] = $this->Common->no_cond_order_by('hris_positions', 'title', 'ASC');


		$this->load->view('list_jobvacancy', $result);

		if ($this->input->post('submit')) {

			$config['allowed_types'] = 'pdf';
			$config['upload_path'] = './uploads/regfile';
			$new_name = time() . 'job' . $_FILES["file_name"]['name'];
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file')) {
				$this->Reg->insert_job();
				$this->session->set_flashdata('success', 'Successfully updated.');
				redirect(base_url() . 'Page/jobVacancy');
			} else {
				$this->session->set_flashdata('danger', $this->upload->display_errors());
				redirect(base_url() . 'Page/jobVacancy');
			}

			// //get data from the form
			// $jobTitle = $this->input->post('jobTitle');
			// $empType = $this->input->post('empType');
			// $department = $this->input->post('department');
			// $qty = $this->input->post('qty');
			// $itemNo = $this->input->post('itemNo');
			// $description = addslashes($this->input->post('description'));
			// $postedBy = $this->session->userdata('username');
			// $sy = $this->input->post('sy');


			// date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			// $now = date('H:i:s A');
			// $date = date("Y-m-d");

			// $que1 = $this->db->query("insert into hris_jobvacancy (jobTitle, empType, department, qty, description, postedBy, datePosted, jvStatus, itemNo, sy) values('$jobTitle','$empType','$department','$qty','$description','$postedBy','$date','Open','$itemNo','$sy')");
			// $this->session->set_flashdata('success', 'Successfully posted!');
			// redirect('Page/jobVacancy');
		}
	}

	public function archive_jv()
	{
		$id = $this->input->get('jobID');
		$this->db->query("update hris_jobvacancy set jvStatus='Closed' where jobID='" . $id . "'");
		$this->Page_model->insert_at('Archieved Job Vacancy.', $id);
		$this->session->set_flashdata('success', 'Archieved successfully!');
		redirect('Page/jobVacancy');
	}

	public function rqa()
	{
		$jobID = $this->input->get('jobID');
		$result['data'] = $this->PersonnelModel->rqa($jobID);
		$result['data1'] = $this->PersonnelModel->rqa_group($jobID);
		$result['data2'] = $this->PersonnelModel->rqa_group_shs($jobID);
		$this->load->view('list_jobvacancy_rqa', $result);
	}

	public function rqa_municipality()
	{
		$jobID = $this->input->get('jobID');
		$result['data1'] = $this->PersonnelModel->rqa_group_mun($jobID);
		$this->load->view('list_jobvacancy_rqa_mun', $result);
	}


	public function rqa_municipality_track()
	{
		$jobID = $this->input->get('id');
		$spec = $this->input->get('spec');
		$result['data1'] = $this->PersonnelModel->rqa_municipality_track($jobID, $spec);
		$this->load->view('list_jobvacancy_rqa_mun_shs', $result);
	}

	public function rqa_municipality_specialization()
	{
		$jobID = $this->input->get('id');
		$spec = $this->input->get('spec');
		$result['data1'] = $this->PersonnelModel->rqa_municipality_spec($jobID, $spec);
		$this->load->view('list_jobvacancy_rqa_mun_spec', $result);
	}


	public function rqa_shs()
	{
		$jobID = $this->input->get('jobID');
		$result['data'] = $this->PersonnelModel->rqa($jobID);
		$result['data1'] = $this->PersonnelModel->rqa_group_shs($jobID);
		$this->load->view('list_jobvacancy_rqa_shs', $result);
	}

	public function rqa_specialization()
	{
		$jobID = $this->input->get('jobID');
		$spe = $this->input->get('spe');
		$result['data'] = $this->PersonnelModel->rqa_specialization($jobID, $spe);
		$this->load->view('list_jobvacancy_rqa_specialization', $result);
	}

	public function rqa_municipality_list()
	{
		$jobID = $this->input->get('jobID');
		$mun = $this->input->get('mun');
		$result['data'] = $this->PersonnelModel->rqa_municipality_list($jobID, $mun);
		$this->load->view('list_jobvacancy_rqa_munlist', $result);
	}

	public function rqa_track()
	{
		$jobID = $this->input->get('jobID');
		$spe = $this->input->get('spe');
		$result['data'] = $this->PersonnelModel->rqa_track($jobID, $spe);
		$this->load->view('list_jobvacancy_rqa_specialization', $result);
	}

	public function submitApplication()
	{
		// $result['data']=$this->PersonnelModel->JobVancancies();
		$this->load->view('job_application');

		if ($this->input->post('submit')) {
			//get data from the form
			// $applicantEmail=$this->input->get('appID');
			$jobID = $this->input->get('jobID');
			$applicantID = $this->input->post('applicantID');
			$docURL = $this->input->post('docURL');
			$note = $this->input->post('note');
			$applicantEmail = $this->session->userdata('username');

			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$now = date('H:i:s A');
			$date = date("Y-m-d");

			$que = $this->db->query("insert into hris_applications (jobID, empEmail, dateSubmitted, docURL, appStatus, note) values('$jobID','$applicantEmail','$date','$docURL','Application Submitted','$note')");
			$que1 = $this->db->query("insert into hris_applications_track (jobID, empEmail, dateSubmitted, appStatus, note,timeSubmitted) values('$jobID','$applicantEmail','$date','Application Submitted','$note','$now')");

			$this->session->set_flashdata('success', 'Your application has been submitted successfully.');

			redirect('Page/jobVacancy');
		}
	}



	//Request
	public function submitRequest()
	{
		$id = $this->session->userdata('username');

		$result['data'] = $this->PersonnelModel->docRequest($id);
		$result['data2'] = $this->PersonnelModel->getTrackingNo();
		$this->load->view('request_submit', $result);

		if ($this->input->post('submit')) {

			$config['upload_path'] = './upload/reqDocs/';
			$config['allowed_types'] = '*';
			$config['max_size'] = 5120;
			//$config['max_width'] = 1500;
			//$config['max_height'] = 1500;

			$this->load->library('upload', $config);
			$this->upload->do_upload('nonoy');
			$data = array('image_metadata' => $this->upload->data());
			$filename = $this->upload->data('file_name');

			$email = $this->input->post('email');
			$IDNumber = $this->input->post('IDNumber');
			$docName = $this->input->post('docName');
			$purpose = $this->input->post('purpose');
			$trackingNo = $this->input->post('trackingNo');
			$pReference = $this->input->post('pReference');
			$trackingNo = $this->input->post('trackingNo');

			$dateReq = date("Y-m-d");
			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$now = date('H:i:s A');

			//check if record exist
			$que = $this->db->query("select * from request where trackingNo='" . $trackingNo . "'");
			$row = $que->num_rows();
			if ($row) {
				//redirect('Page/notification_error');
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Tracking No. is in use.</b></div>');
				redirect('Page/submitRequest');
			} else {

				$que = $this->db->query("insert into request values('$trackingNo','$docName','$purpose','$dateReq','$now','$IDNumber','Open','$pReference','$filename')");
				$que = $this->db->query("insert into request_stat values('','$IDNumber','request submitted','$IDNumber','$dateReq','$now','$trackingNo','Open','','')");
				$que = $this->db->query("insert into atrail values('','Requested a Document','$dateReq','$now','$id','$id')");
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Your request has been submitted.</b></div>');

				//Email Notification
				//$this->load->config('email');
				//$this->load->library('email');
				//$mail_message = 'Dear ' . $fname . ',' . "\r\n"; 
				//$mail_message .= '<br><br>Your request with tracking number <b>' . $trackingNo . ' </b>has been submitted.' . "\r\n"; 
				//$mail_message .= '<br><br>Login to your portal to check the status of your request.' . "\r\n"; 

				//$mail_message .= '<br><br>Thanks & Regards,';
				//$mail_message .= '<br>SRMS - Online';

				//$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
				//->to($email)
				//->subject('Online Request')
				//->message($mail_message);
				//$this->email->send();

				redirect('Page/submitRequest');
			}
		}
	}
	function studentRequestStat()
	{
		$id = $this->input->get('trackingNo');
		$result['data'] = $this->PersonnelModel->studerequestTracking($id);
		$this->load->view('request_status', $result);

		if ($this->input->post('submit')) {
			$config['upload_path'] = './upload/reqDocs/';
			$config['allowed_types'] = '*';
			$config['max_size'] = 5120;
			//$config['max_width'] = 1500;
			//$config['max_height'] = 1500;

			$this->load->library('upload', $config);


			$this->upload->do_upload('nonoy');
			$data = array('image_metadata' => $this->upload->data());
			$filename = $this->upload->data('file_name');

			$StudentNumber = $this->input->post('StudentNumber');
			$trackingNo = $this->input->post('trackingNo');
			$reqStatus = $this->input->post('reqStatus');
			$reqStat = $this->input->post('reqStat');

			$dateReq = date("Y-m-d");
			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$now = date('H:i:s A');

			$que = $this->db->query("update request set reqStat='$reqStat' where trackingNo='$trackingNo'");
			$que = $this->db->query("insert into request_stat values('','$StudentNumber','$reqStatus','$id','$dateReq','$now','$trackingNo','$reqStat','$filename','')");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>New request status has been posted.</b></div>');
		}
	}
	function newRequest()
	{
		$result['data'] = $this->PersonnelModel->getProfile();
		$this->load->view('request_search', $result);
	}
	function requestSummary()
	{
		$result['data'] = $this->PersonnelModel->totalStudeRequest();
		$result['data1'] = $this->PersonnelModel->openRequest();
		$result['data2'] = $this->PersonnelModel->closedRequest();
		$result['data3'] = $this->PersonnelModel->docReqCounts();
		$result['data4'] = $this->PersonnelModel->totalReleased();
		$result['data19'] = $this->PersonnelModel->studeRequestList();
		$this->load->view('dashboard_request', $result);
	}

	function releasedRequest()
	{
		$result['data'] = $this->PersonnelModel->releasedRequest();
		$this->load->view('request_released', $result);
	}

	//delete student's profile
	public function deleteRequest()
	{
		$id = $this->input->get('id');
		$username = $this->session->userdata('username');
		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$now = date('H:i:s A');
		$date = date("Y-m-d");
		$query = $this->db->query("delete from request where trackingNo='" . $id . "'");
		$query = $this->db->query("insert into atrail values('','Deleted Student''s Request','$date','$now','$username','$id')");

		redirect('Page/profileList');
	}

	function openDocRequest()
	{
		$result['data'] = $this->PersonnelModel->openDocRequest();
		$this->load->view('request_open', $result);
	}

	function closedDocRequest()
	{
		$result['data'] = $this->PersonnelModel->closedDocRequest();
		$this->load->view('request_closed', $result);
	}

	function allRequest()
	{
		$result['data'] = $this->StudentModel->allDocRequest();
		$this->load->view('request_all', $result);
	}

	//Change schoolLogo
	function schoolLogo()
	{
		$this->load->view('change-logo');
	}

	public function uploadLogo()
	{
		$config['upload_path'] = './upload/profile/';
		$config['allowed_types'] = 'jpg|gif|png';
		$config['max_size'] = 2048;
		//$config['max_width'] = 1500;
		//$config['max_height'] = 1500;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('nonoy')) {
			$msg = array('error' => $this->upload->display_errors());

			$this->load->view('change-logo', $msg);
		} else {
			$data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$username = $this->session->userdata('username');
			//$filename=$this->input->post('nonoy');
			$filename = $this->upload->data('file_name');

			$que = $this->db->query("update schools set schoolLogo='$filename' where schoolID='$username'");
			$que = $this->db->query("update users set avatar='$filename' where username='$username'");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Uploaded Succesfully!</b></div>');

			$this->load->view('change-logo');
		}
	}
	function serviceRecords()
	{
		$id = $this->session->userdata('username');
		$result['data'] = $this->PersonnelModel->serviceRecords($id);
		$result['data1'] = $this->PersonnelModel->searchPersonnel();
		$this->load->view('hr_personnel_sr', $result);
	}

	//Change Profile Pic
	function changeDP()
	{
		$this->load->view('upload_profile_pic');
	}

	//Change Profile Pic
	function change_app_DP()
	{
		$this->load->view('upload_app_profile');
	}

	public function uploadProfPic()
	{
		$config['upload_path'] = './uploads/profile/';
		$config['allowed_types'] = 'jpg|gif|png';
		$config['max_size'] = 2048;
		//$config['max_width'] = 1500;
		//$config['max_height'] = 1500;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('nonoy')) {
			$msg = array('error' => $this->upload->display_errors());

			$this->load->view('upload_profile_pic', $msg);
		} else {
			$data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$username = $this->session->userdata('username');
			$user = $this->Common->one_cond_row('users', 'username', $username);
			unlink("uploads/profile/" . $user->image);
			//$filename=$this->input->post('nonoy');
			$filename = $this->upload->data('file_name');

			$que = $this->db->query("update users set image='$filename' where username='$username'");
			$this->session->set_flashdata('success', 'The new profile image has been uploaded successfully.  Exit the system, then log in again to check if it works.');
			if ($this->session->position == "reg") {
				redirect(base_url() . 'Pages/ja/' . $this->session->c_id);
			} else {
				redirect(base_url() . 'Pages/view_employee');
			}

			$this->load->view('upload_profile_pic');
		}
	}


	public function createAccount()
	{
		$this->load->view('user_accounts');
		if ($this->input->post('submit')) {
			//get data from the form
			$username = $this->input->post('username');
			$IDNumber = $this->input->post('IDNumber');
			$password = sha1($this->input->post('password'));
			$acctLevel = $this->input->post('acctLevel');
			$fName = $this->input->post('fName');
			$mName = $this->input->post('mName');
			$lName = $this->input->post('lName');
			//$completeName=$fName.' '.$lName;
			$email = $this->input->post('email');
			$dateCreated = date("Y-m-d");

			//check if record exist
			$que = $this->db->query("select * from users where username='" . $username . "'");
			$row = $que->num_rows();
			if ($row) {
				//redirect('Page/notification_error');
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Username is in use.</b></div>');
				redirect('Page/createAccount');
			} else {
				//save user account
				$que = $this->db->query("insert into users values('$username','$password','$fName','$mName','$lName','','','$dateCreated','avatar.png','$acctLevel','$email','$IDNumber','Active')");
				$this->session->set_flashdata('msg', '<div class="alert alert-success data-dismiss=alert text-center"><b>New account has been created successfully.</b></div>');
				redirect('Page/createAccount');
			}
		}
	}
	function viewAccounts()
	{
		$result['data'] = $this->PersonnelModel->viewAccounts();
		$this->load->view('settings_view_users', $result);
	}
	public function deleteUserAccount()
	{
		$id = $this->input->get('id');
		$this->PersonnelModel->deleteUserAccount($id);
		redirect("Page/viewAccounts");
	}

	//update user accounts
	function updateUserAccount()
	{
		$id = $this->input->get('id');
		$result['data'] = $this->PersonnelModel->viewAccountsID($id);

		$this->load->view('user_accounts_update', $result);
		if ($this->input->post('submit')) {
			//get data from the form
			$username = $this->input->post('username');
			$IDNumber = $this->input->post('IDNumber');
			$password = sha1($this->input->post('password'));
			$password2 = $this->input->post('password');
			$acctLevel = $this->input->post('acctLevel');
			$fName = $this->input->post('fName');
			$mName = $this->input->post('mName');
			$lName = $this->input->post('lName');

			$email = $this->input->post('email');
			$date = date("Y-m-d");

			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$now = date('H:i:s A');
			$Encoder = $this->session->userdata('username');

			$que = $this->db->query("update users set password='$password',fName='$fName',mName='$mName',lName='$lName',acctLevel='$acctLevel',IDNumber='$IDNumber',email='$email' where username='$username'");
			$que = $this->db->query("insert into atrail values('','Updated user account','$date','$now','$Encoder','$username')");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>The user account details have been updated successfully. </b></div>');

			redirect('Page/viewAccounts');
		}
	}

	//Submit DepEd Email Request
	function depedEmailRequest()
	{
		$id = $this->session->userdata('username');
		//$result['data']=$this->PersonnelModel->depedEmailRequest();  
		$this->load->view('hr_personnel_depedemail_request');
	}

	//Processing of Training and Speakership
	public function processdepedEmailRequest()
	{

		$IDNumber = $this->session->userdata('username');
		$fname = $this->session->userdata('fName');
		$requestType = $this->input->post('requestType');
		$depedEmail = $this->input->post('depedEmail');
		$personalEmail = $this->input->post('personalEmail');
		$email = $this->input->post('personalEmail');
		$school = $this->input->post('school');
		$district = $this->input->post('district');
		$contactNo = $this->input->post('contactNo');
		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$dateRequested = date("Y-m-d");

		$que = $this->db->query("insert into deped_email_request values('','$IDNumber','$requestType','$depedEmail','$personalEmail','$school','$district','$contactNo','$dateRequested','Open')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Request submitted succesfully!</b></div>');

		//Email Notification
		$this->load->config('email');
		$this->load->library('email');
		$mail_message = 'Dear ' . $fname . ',' . "\r\n";
		$mail_message .= '<br><br>Your request has been submitted.' . "\r\n";

		$mail_message .= '<br><br>You will be notified once processed.' . "\r\n";
		$mail_message .= '<br><br>Thanks & Regards,';
		$mail_message .= '<br>MIS Team';

		$this->email->from('no-reply@lxeinfotechsolutions.com', 'DepEd Davao Oriental - MIS Team')
			->to($email)
			->subject('DepEd Email Request')
			->message($mail_message);
		$this->email->send();

		redirect('Page/depedEmailRequest');
	}
	//DepEd Email - For Processing List 
	function emailReqForProcessing()
	{
		$result['data'] = $this->PersonnelModel->emailReqForProcessing();
		$this->load->view('ict_depedemail_request.php', $result);
	}

	//Update Personnel Profile
	function updateEmailRequest()
	{
		$id = $this->input->get('id');
		$result['data'] = $this->PersonnelModel->processEmailRequest($id);
		$this->load->view('ict_depedemail_request_update', $result);
		if ($this->input->post('submit')) {
			//get data from the form
			$reqID = $this->input->post('reqID');
			$IDNumber = $this->input->post('IDNumber');
			$fname = $this->input->post('FirstName');
			$depedEmail = $this->input->post('depedEmail');
			$personalEmail = $this->input->post('personalEmail');
			$temPass = $this->input->post('temPass');

			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$now = date('H:i:s A');
			$date = date("Y-m-d");

			$que = $this->db->query("insert into deped_email_request_actions values('','$IDNumber','$depedEmail','$date','$temPass')");
			$que = $this->db->query("update deped_email_request set reqStat='Closed' where reqID='$reqID'");
			$this->session->set_flashdata('msg', '<div id="sa-success" class="alert alert-success text-center"><b>Processed successfully.</b></div>');

			//Email Notification
			$this->load->config('email');
			$this->load->library('email');
			$mail_message = 'Dear ' . $fname . ',' . "\r\n";
			$mail_message .= '<br><br>Your request has been processed.  Please take note of the following:' . "\r\n";
			$mail_message .= '<br>DepEd E-mail: <b>' . $depedEmail . '</b>' . "\r\n";
			$mail_message .= '<br>Temporary Password: <b>' . $temPass . '</b>' . "\r\n";

			$mail_message .= '<br><br>Thanks & Regards,';
			$mail_message .= '<br>MIS Team';

			$this->email->from('no-reply@lxeinfotechsolutions.com', 'DepEd Davao Oriental - MIS Team')
				->to($personalEmail)
				->subject('DepEd Email Request')
				->message($mail_message);
			$this->email->send();

			redirect('Page/emailReqForProcessing');
		}
	}

	public function deletecache1()
	{
		$this->output->delete_cache('Page');
	}
	public function deletecache2()
	{
		$this->output->delete_cache('Schools');
	}

	public function delete_lc()
	{
		$id = $this->input->get('id');
		$this->db->query("delete  from hris_leaverecords where ID='" . $id . "'");
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect('Page/leaveCreditsSummary');
	}
	public function leaveCreditsUploading()
	{

		// Check form submit or not 
		if ($this->input->post('upload') != NULL) {
			$data = array();
			if (!empty($_FILES['file']['name'])) {
				// Set preference 
				$config['upload_path'] = 'uploads/leave_credits/';
				$config['allowed_types'] = 'csv';
				$config['max_size'] = '1000'; // max_size in kb 
				$config['file_name'] = $_FILES['file']['name'];

				// Load upload library 
				$this->load->library('upload', $config);

				// File upload
				if ($this->upload->do_upload('file')) {
					// Get data about the file
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];

					// Reading file
					$file = fopen("uploads/leave_credits/" . $filename, "r");
					$i = 0;

					$importData_arr = array();

					while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
						$num = count($filedata);

						for ($c = 0; $c < $num; $c++) {
							$importData_arr[$i][] = $filedata[$c];
						}
						$i++;
					}
					fclose($file);

					$skip = 0;

					// insert import data
					foreach ($importData_arr as $userdata) {
						if ($skip != 0) {
							$this->PersonnelModel->leaveCreditsUploading($userdata);
							$this->session->set_flashdata('success', 'Uploaded successfully.');
						}
						$skip++;
					}
					$data['response'] = '<div class="alert alert-info text-center">Uploaded Successfully.</div>';
				} else {
					$data['response'] = '<div class="alert alert-warning text-center">Failed</div>';
				}
			} else {
				$data['response'] = '<div class="alert alert-warning text-center">Failed</div>';
			}
			// load view 
			$this->load->view('file_uploader_leavecredits', $data);
		} else {
			// load view 
			$this->load->view('file_uploader_leavecredits');
		}
	}

	public function appRatingUploading()
	{

		// Check form submit or not 
		if ($this->input->post('upload') != NULL) {
			$data = array();
			if (!empty($_FILES['file']['name'])) {
				// Set preference 
				$config['upload_path'] = 'uploads/files/';
				$config['allowed_types'] = 'csv';
				$config['max_size'] = '1000'; // max_size in kb 
				$config['file_name'] = $_FILES['file']['name'];

				// Load upload library 
				$this->load->library('upload', $config);

				// File upload
				if ($this->upload->do_upload('file')) {
					// Get data about the file
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];

					// Reading file
					$file = fopen("uploads/files/" . $filename, "r");
					$i = 0;

					$importData_arr = array();

					while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
						$num = count($filedata);

						for ($c = 0; $c < $num; $c++) {
							$importData_arr[$i][] = $filedata[$c];
						}
						$i++;
					}
					fclose($file);

					$skip = 0;

					// insert import data
					foreach ($importData_arr as $userdata) {
						if ($skip != 0) {
							$this->PersonnelModel->appRatingUploading($userdata);
							$this->session->set_flashdata('success', 'Uploaded successfully.');
						}
						$skip++;
					}
					$data['response'] = '<div class="alert alert-info text-center">Uploaded Successfully.</div>';
				} else {
					$data['response'] = '<div class="alert alert-warning text-center">Failed</div>';
				}
			} else {
				$data['response'] = '<div class="alert alert-warning text-center">Failed</div>';
			}
			// load view 
			$this->load->view('file_uploader', $data);
		} else {
			// load view 
			$this->load->view('file_uploader');
		}
	}

	public function serviceRecordUploading()
	{

		// Check form submit or not 
		if ($this->input->post('upload') != NULL) {
			$data = array();
			if (!empty($_FILES['file']['name'])) {
				// Set preference 
				$config['upload_path'] = 'uploads/service_record/';
				$config['allowed_types'] = 'csv';
				$config['max_size'] = '10000'; // max_size in kb 
				$config['file_name'] = $_FILES['file']['name'];

				// Load upload library 
				$this->load->library('upload', $config);

				// File upload
				if ($this->upload->do_upload('file')) {
					// Get data about the file
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];

					// Reading file
					$file = fopen("uploads/service_record/" . $filename, "r");
					$i = 0;

					$importData_arr = array();

					while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
						$num = count($filedata);

						for ($c = 0; $c < $num; $c++) {
							$importData_arr[$i][] = $filedata[$c];
						}
						$i++;
					}
					fclose($file);

					$skip = 0;

					// insert import data
					foreach ($importData_arr as $userdata) {
						if ($skip != 0) {
							$this->PersonnelModel->serviceRecordUploading($userdata);
							$this->session->set_flashdata('success', 'Uploaded successfully.');
						}
						$skip++;
					}
					$data['response'] = '<div class="alert alert-info text-center">Uploaded Successfully.</div>';
				} else {
					$data['response'] = '<div class="alert alert-warning text-center">Failed</div>';
				}
			} else {
				$data['response'] = '<div class="alert alert-warning text-center">Failed</div>';
			}
			// load view 
			$this->load->view('file_uploader_sr', $data);
		} else {
			// load view 
			$this->load->view('file_uploader_sr');
		}
	}

	function uploadEnrolees()
	{
		$result['title'] = "Upload Enrolees";


		// $this->load->view('templates/head');
		// $this->load->view('templates/header');
		// $this->load->view('sbfp_upload', $result);
		// $this->load->view('templates/footer');

		// Check if the form is submitted
		if ($this->input->post('upload') !== NULL) {
			$data = array();

			if (!empty($_FILES['file']['name'])) {
				// Set upload preferences
				$config = array(
					'upload_path'   => 'uploads/enrolees/',
					'allowed_types' => 'csv',
					'max_size'      => '10000', // in kb
					'file_name'     => $_FILES['file']['name']
				);

				// Load upload library
				$this->load->library('upload', $config);

				// Perform file upload
				if ($this->upload->do_upload('file')) {
					// Get file data
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					$filePath = $config['upload_path'] . $filename;

					// Read file
					$importDataArr = array();
					if (($file = fopen($filePath, "r")) !== FALSE) {
						while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
							$importDataArr[] = $filedata;
						}
						fclose($file);
					}

					// Insert import data
					foreach ($importDataArr as $index => $userdata) {
						if ($index > 0) { // Skip header row
							$this->PersonnelModel->enroleesUploading($userdata);
						}
					}
					// $data['response'] = '<div class="alert alert-info text-center">Uploaded Successfully.</div>';
					$this->session->set_flashdata('success', ' Uploaded Successfully.');
				} else {
					$data['response'] = '<div class="alert alert-warning text-center">Upload Failed: ' . $this->upload->display_errors() . '</div>';
				}
			} else {
				$data['response'] = '<div class="alert alert-warning text-center">No file selected.</div>';
			}

			// Load view with data
			$this->load->view('sbfp_upload', $data);
		} else {
			// Load view without data
			$this->load->view('sbfp_upload');
		}
	}


	public function profileUploading()
	{

		// Check form submit or not 
		if ($this->input->post('upload') != NULL) {
			$data = array();
			if (!empty($_FILES['file']['name'])) {
				// Set preference 
				$config['upload_path'] = 'uploads/staff_profile/';
				$config['allowed_types'] = 'csv';
				$config['max_size'] = '10000'; // max_size in kb 
				$config['file_name'] = $_FILES['file']['name'];

				// Load upload library 
				$this->load->library('upload', $config);

				// File upload
				if ($this->upload->do_upload('file')) {
					// Get data about the file
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];

					// Reading file
					$file = fopen("uploads/staff_profile/" . $filename, "r");
					$i = 0;

					$importData_arr = array();

					while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
						$num = count($filedata);

						for ($c = 0; $c < $num; $c++) {
							$importData_arr[$i][] = $filedata[$c];
						}
						$i++;
					}
					fclose($file);

					$skip = 0;

					// insert import data
					foreach ($importData_arr as $userdata) {
						if ($skip != 0) {
							$this->PersonnelModel->profileUploading($userdata);
							$this->session->set_flashdata('success', 'Uploaded successfully.');
						}
						$skip++;
					}
					$data['response'] = '<div class="alert alert-info text-center">Uploaded Successfully.</div>';
				} else {
					$data['response'] = '<div class="alert alert-warning text-center">Failed</div>';
				}
			} else {
				$data['response'] = '<div class="alert alert-warning text-center">Failed</div>';
			}
			// load view 
			$this->load->view('file_uploader_profile', $data);
		} else {
			// load view 
			$this->load->view('file_uploader_profile');
		}
	}





	// From SGOD
	function sgod()
	{
		//Allowing access to Admin only
		if ($this->session->userdata('section') === 'Chief - SGOD') {
			$param = $this->session->userdata('secGroup');
			$result['data'] = $this->SGODModel->count_sec_users('sgod_users', $param);
			$result['data1'] = $this->SGODModel->count_sections('sgod_sections', $param);
			$result['data2'] = $this->SGODModel->count_sec_accomplishments('sgod_accomplishments', $param);
			$result['data3'] = $this->SGODModel->count_table_row('schools');
			$this->load->view('dashboard_admin', $result);
		} else {
			echo "Access Denied";
		}
	}

	//   function School(){
	// 	//Allowing access to Admin only
	// 	if($this->session->userdata('section')==='School'){
	// 		$result['data']=$this->SGODModel->count_table_row('sgod_aip');
	// 		$result['pillar']=$this->SGODModel->count_table_row('sgod_settings_pillar');
	// 		$result['domain']=$this->SGODModel->count_table_row('sgod_settings_domain');
	// 		$result['pias']=$this->SGODModel->count_table_row('sgod_settings_pias');
	// 		$this->load->view('dashboard_school', $result);
	// 	}else{
	// 		echo "Access Denied";
	// 	}
	//   }
	function SMME()
	{
		if ($this->session->userdata('section') === 'School Management Monitoring and Evaluation') {
			$section = $this->session->userdata('section');
			$result['data'] = $this->SGODModel->cPublic();
			$result['data1'] = $this->SGODModel->cPrivate();
			$result['data2'] = $this->SGODModel->aSectionAccomplishments($section);
			$result['data3'] = $this->SGODModel->totalSectionUsers($section);
			$this->load->view('dashboard_SMME', $result);
		} else {
			echo "Access Denied";
		}
	}


	function PESS()
	{
		if ($this->session->userdata('section') === 'Physical Education and Schools Sports') {
			$section = $this->session->userdata('section');
			$result['data'] = $this->SGODModel->cPublic();
			$result['data1'] = $this->SGODModel->cPrivate();
			$result['data2'] = $this->SGODModel->aSectionAccomplishments($section);
			$result['data3'] = $this->SGODModel->totalSectionUsers($section);
			$this->load->view('dashboard_PESS', $result);
		} else {
			echo "Access Denied";
		}
	}

	function DRRM()
	{
		if ($this->session->userdata('section') === 'Disaster Risk Reduction Management (DRRM) Section') {
			$section = $this->session->userdata('section');
			$result['data'] = $this->SGODModel->cPublic();
			$result['data1'] = $this->SGODModel->cPrivate();
			$result['data2'] = $this->SGODModel->aSectionAccomplishments($section);
			$result['data3'] = $this->SGODModel->totalSectionUsers($section);
			$this->load->view('dashboard_drrm', $result);
		} else {
			echo "Access Denied";
		}
	}

	function SHNS()
	{
		if ($this->session->userdata('section') === 'School Health and Nutrition Section') {
			$section = $this->session->userdata('section');
			$result['data'] = $this->SGODModel->cPublic();
			$result['data1'] = $this->SGODModel->cPrivate();
			$result['data2'] = $this->SGODModel->aSectionAccomplishments($section);
			$result['data3'] = $this->SGODModel->totalSectionUsers($section);
			$this->load->view('dashboard_shns', $result);
		} else {
			echo "Access Denied";
		}
	}


	function HRD()
	{
		if ($this->session->userdata('section') === 'Human Resource Development Section') {
			$section = $this->session->userdata('section');
			$result['data'] = $this->SGODModel->cPublic();
			$result['data1'] = $this->SGODModel->cPrivate();
			$result['data2'] = $this->SGODModel->aSectionAccomplishments($section);
			$result['data3'] = $this->SGODModel->totalSectionUsers($section);
			$this->load->view('dashboard_hrd', $result);
		} else {
			echo "Access Denied";
		}
	}

	function EFS()
	{
		if ($this->session->userdata('section') === 'Education Facilities Section') {
			$section = $this->session->userdata('section');
			$result['data'] = $this->SGODModel->cPublic();
			$result['data1'] = $this->SGODModel->cPrivate();
			$result['data2'] = $this->SGODModel->aSectionAccomplishments($section);
			$result['data3'] = $this->SGODModel->totalSectionUsers($section);
			$this->load->view('dashboard_efd', $result);
		} else {
			echo "Access Denied";
		}
	}

	function SMN()
	{
		if ($this->session->userdata('section') === 'Social Mobilization and Networking') {
			$section = $this->session->userdata('section');
			$result['data'] = $this->SGODModel->cPublic();
			$result['data1'] = $this->SGODModel->cPrivate();
			$result['data2'] = $this->SGODModel->aSectionAccomplishments($section);
			$result['data3'] = $this->SGODModel->totalSectionUsers($section);
			$this->load->view('dashboard_smn', $result);
		} else {
			echo "Access Denied";
		}
	}

	function Planning()
	{
		if ($this->session->userdata('section') === 'Planning') {
			$section = $this->session->userdata('section');
			$result['data'] = $this->SGODModel->cPublic();
			$result['data1'] = $this->SGODModel->cPrivate();
			$result['data2'] = $this->SGODModel->aSectionAccomplishments($section);
			$result['data3'] = $this->SGODModel->totalSectionUsers($section);
			$this->load->view('dashboard_planning', $result);
		} else {
			echo "Access Denied";
		}
	}

	function Research()
	{
		if ($this->session->userdata('section') === 'Research') {
			$section = $this->session->userdata('section');
			$result['data'] = $this->SGODModel->cPublic();
			$result['data1'] = $this->SGODModel->cPrivate();
			$result['data2'] = $this->SGODModel->aSectionAccomplishments($section);
			$result['data3'] = $this->SGODModel->totalSectionUsers($section);
			$this->load->view('dashboard_research', $result);
		} else {
			echo "Access Denied";
		}
	}

	function YFP()
	{
		if ($this->session->userdata('section') === 'Youth Formation Program') {
			$section = $this->session->userdata('section');
			$result['data'] = $this->SGODModel->cPublic();
			$result['data1'] = $this->SGODModel->cPrivate();
			$result['data2'] = $this->SGODModel->aSectionAccomplishments($section);
			$result['data3'] = $this->SGODModel->totalSectionUsers($section);
			$this->load->view('dashboard_youth', $result);
		} else {
			echo "Access Denied";
		}
	}


	function app()
	{
		$result['data'] = $this->SGODModel->get_all('app_school');
		$this->load->view('app', $result);
	}


	function app_category()
	{
		$data['title'] = "Category List";
		$data['m_title'] = "Add New Category";
		$data['e_title'] = "Update Category";
		$data['page'] = $this->SGODModel->get_all('sgod_settings_cat');
		$id = $this->input->post('id');
		$data['cat'] = $this->SGODModel->get_data_by_id('sgod_settings_cat', 'id', $id);

		$this->load->view('setting_cat', $data);

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_app_cat();
			redirect(base_url() . 'Page/app_category');
		}

		if ($this->input->post('edit')) {
			//$data['cat'] = $this->SGODModel->get_data_by_id('app_cat', 'id',$id);
			$this->SGODModel->update_app_cat();
			redirect(base_url() . 'Page/app_category');
		}
	}

	public function app_cat_del()
	{
		$this->SGODModel->delete(3, 'id', 'app_cat');
		redirect(base_url() . 'Page/app_category');
	}



	function settings_pillar()
	{
		$data['title'] = "Pillar List";
		$data['m_title'] = "Add New Pillar";
		$data['e_title'] = "Update Pillar";
		$data['label'] = "Pillar Name";
		$data['action'] = "settings_pillar";
		$data['del'] = "setting_pillar_del";
		$r_page = "settings_pillar";

		$data['page'] = $this->SGODModel->get_all('sgod_settings_pillar');
		$id = $this->input->post('id');
		$data['pillar'] = $this->SGODModel->get_data_by_id('sgod_settings_pillar', 'id', $id);
		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('setting_pillar', $data);

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_app_pillar();
			redirect(base_url() . 'Page/' . $r_page);
		}

		if ($this->input->post('edit')) {
			//$data['cat'] = $this->SGODModel->get_data_by_id('app_cat', 'id',$id);
			$this->SGODModel->update_app_pillar();
			redirect(base_url() . 'Page/' . $r_page);
		}
	}
	public function setting_pillar_del()
	{
		$this->SGODModel->delete(3, 'id', 'sgod_settings_pillar');
		redirect(base_url() . 'Page/settings_pillar');
	}

	function settings_domain()
	{
		$data['title'] = "Domain List";
		$data['m_title'] = "Add New Domain";
		$data['e_title'] = "Update Domain";
		$data['label'] = "Domain Name";
		$data['action'] = "settings_domain";
		$data['del'] = "setting_domain_del";
		$r_page = "settings_domain";

		$data['page'] = $this->SGODModel->get_all('sgod_settings_domain');
		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('setting_domain', $data);

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_domain();
			redirect(base_url() . 'Page/' . $r_page);
		}

		if ($this->input->post('edit')) {
			$this->SGODModel->update_domain();
			redirect(base_url() . 'Page/' . $r_page);
		}
	}
	public function setting_domain_del()
	{
		$this->SGODModel->delete(3, 'id', 'sgod_settings_domain');
		redirect(base_url() . 'Page/settings_domain');
	}

	function settings_strand()
	{
		$data['title'] = "Strand List";
		$data['m_title'] = "Add New Strand";
		$data['e_title'] = "Update Strand";
		$data['label'] = "Strand Name";
		$data['action'] = "settings_strand";
		$data['del'] = "setting_strand_del";
		$r_page = "settings_strand";

		$data['page'] = $this->SGODModel->get_all('sgod_settings_strand');
		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('setting_strand', $data);

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_Strand();
			redirect(base_url() . 'Page/' . $r_page);
		}

		if ($this->input->post('edit')) {
			$this->SGODModel->update_Strand();
			redirect(base_url() . 'Page/' . $r_page);
		}
	}
	public function setting_strand_del()
	{
		$this->SGODModel->delete(3, 'id', 'sgod_settings_Strand');
		redirect(base_url() . 'Page/settings_Strand');
	}

	function settings_pias()
	{
		$data['title'] = "PIAs List";
		$data['m_title'] = "Add New PIAs";
		$data['e_title'] = "Update PIAs";
		$data['label'] = "PIAs Name";
		$data['action'] = "settings_pias";
		$data['del'] = "setting_pias_del";
		$r_page = "settings_pias";

		$data['page'] = $this->SGODModel->one_cond('sgod_settings_pias', 'school_id', $this->session->username);
		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('setting_pias', $data);

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_pias();
			redirect(base_url() . 'Page/' . $r_page);
		}

		if ($this->input->post('edit')) {
			$this->SGODModel->update_pias();
			redirect(base_url() . 'Page/' . $r_page);
		}
	}
	public function setting_pias_del()
	{
		$this->SGODModel->delete(3, 'id', 'sgod_settings_pias');
		redirect(base_url() . 'Page/settings_pias');
	}



	function generate_rca()
	{
		$school_id = $this->session->username;
		$fy = $_SESSION['fy'];
		$bcode = $_SESSION['aip'];

		$data['mon'] = $this->input->post('month');
		if (!isset($_SESSION['omt'])) {
			$_SESSION['omt'] = 0;
		}

		$data['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $bcode);

		$data['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);

		$bs = $this->SGODModel->one_cond_row('sgod_school_allocation', 'alloc_batch', $bcode);

		if ($bs->fund_type == 0) {
			$data['mr'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'MINOR REPAIR');
			$data['mb'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'MANDATORY BILLS');
			$data['tli'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'TEACHING-LEARNING INSTRUCTION');
			$data['tst'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'TRAININGS/SEMINAR/TRAVEL');
		} else {
			$data['mr'] = $this->SGODModel->aip_category_sned('sgod_aip', $school_id, $fy, $bcode, 'MINOR REPAIR');
			$data['mb'] = $this->SGODModel->aip_category_sned('sgod_aip', $school_id, $fy, $bcode, 'MANDATORY BILLS');
			$data['tli'] = $this->SGODModel->aip_category_sned('sgod_aip', $school_id, $fy, $bcode, 'TEACHING-LEARNING INSTRUCTION');
			$data['tst'] = $this->SGODModel->aip_category_sned('sgod_aip', $school_id, $fy, $bcode, 'TRAININGS/SEMINAR/TRAVEL');
		}





		$this->load->view('rca_generate', $data);
	}

	function generate_rca_admin()
	{
		$school_id = $this->input->post('sid');
		$fy = $this->input->post('fy');
		$bcode = $this->input->post('bcode');

		$data['mon'] = $this->input->post('month');
		if (!isset($_SESSION['omt'])) {
			$_SESSION['omt'] = 0;
		}

		$data['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);
		$data['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $bcode);


		$data['mr'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'MINOR REPAIR');
		$data['mb'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'MANDATORY BILLS');
		$data['tli'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'TEACHING-LEARNING INSTRUCTION');
		$data['tst'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'TRAININGS/SEMINAR/TRAVEL');
		$this->load->view('rca_generate', $data);
	}

	function rca_view()
	{
		$school_id = $this->uri->segment(3);
		$fy = $this->uri->segment(4);
		$bcode = $this->uri->segment(5);

		$data['mon'] = $this->uri->segment(6);
		$data['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $bcode);

		$data['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);

		$bs = $this->SGODModel->one_cond_row('sgod_school_allocation', 'alloc_batch', $bcode);

		if ($bs->fund_type == 0) {
			$data['mr'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'MINOR REPAIR');
			$data['mb'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'MANDATORY BILLS');
			$data['tli'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'TEACHING-LEARNING INSTRUCTION');
			$data['tst'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'TRAININGS/SEMINAR/TRAVEL');
		} else {
			$data['mr'] = $this->SGODModel->aip_category_sned('sgod_aip', $school_id, $fy, $bcode, 'MINOR REPAIR');
			$data['mb'] = $this->SGODModel->aip_category_sned('sgod_aip', $school_id, $fy, $bcode, 'MANDATORY BILLS');
			$data['tli'] = $this->SGODModel->aip_category_sned('sgod_aip', $school_id, $fy, $bcode, 'TEACHING-LEARNING INSTRUCTION');
			$data['tst'] = $this->SGODModel->aip_category_sned('sgod_aip', $school_id, $fy, $bcode, 'TRAININGS/SEMINAR/TRAVEL');
		}
		$this->load->view('rca_generate', $data);
	}



	function generate_rcav2()
	{
		$school_id = $this->session->username;
		$fy = $_SESSION['fy'];
		$bcode = $_SESSION['aip'];

		$data['mon'] = $this->uri->segment(3);
		if (!isset($_SESSION['omt'])) {
			$_SESSION['omt'] = 0;
		}

		$data['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);

		$data['mr'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'MINOR REPAIR');
		$data['mb'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'MANDATORY BILLS');
		$data['tli'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'TEACHING-LEARNING INSTRUCTION');
		$data['tst'] = $this->SGODModel->aip_category('sgod_aip', $school_id, $fy, $bcode, 'TRAININGS/SEMINAR/TRAVEL');
		$this->load->view('rca_generate', $data);
	}


	function settings_matatag()
	{
		$data['title'] = "Matatag List";
		$data['m_title'] = "Add New";
		$data['e_title'] = "Update";
		$data['label'] = "Name";
		$data['action'] = "settings_matatag";
		$data['del'] = "setting_matatag_del";
		$r_page = "settings_matatag";

		$data['page'] = $this->SGODModel->get_all('sgod_settings_matatag');
		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('setting_matatag', $data);

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_matatag();
			redirect(base_url() . 'Page/' . $r_page);
		}

		if ($this->input->post('edit')) {
			$this->SGODModel->update_matatag();
			redirect(base_url() . 'Page/' . $r_page);
		}
	}
	public function setting_matatag_del()
	{
		$this->SGODModel->delete(3, 'id', 'sgod_settings_matatag');
		redirect(base_url() . 'Page/settings_matatag');
	}


	function sections()
	{
		$result['data'] = $this->SGODModel->viewSections();
		$this->load->view('sections', $result);

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_sections();
			$this->session->set_flashdata('success', ' Added Successfully!');
			redirect('Page/sections');
		}
	}

	function sections_edit()
	{
		$result['data'] = $this->SGODModel->one_cond_row('sgod_sections', 'id', $this->uri->segment(3));
		$this->load->view('sections_edit', $result);

		if ($this->input->post('submit')) {
			$this->SGODModel->update_sections();
			$this->session->set_flashdata('success', ' Updated Successfully!');
			redirect('Page/sections');
		}
	}

	function submission()
	{
		$param = $this->session->userdata('secGroup');
		$result['data'] = $this->SGODModel->viewSectionsChecking($param);

		$result['quarter'] = $this->input->post('quarter');
		$result['year'] = $this->input->post('year');
		$result['week'] = $this->input->post('weekAcc');
		$result['month'] = $this->input->post('month');

		$this->load->view('sc', $result);
	}

	public function delete_sec()
	{
		$id = $this->input->get('id');
		$this->db->query("delete  from sgod_sections where id='" . $id . "'");
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect('Page/sections');
	}


	function viewSecAccomplishments()
	{
		$secGroup = $this->session->userdata('secGroup');
		$section = $this->session->userdata('section');

		if ($this->input->post('submit')) {
			$month = $this->input->post('month');
			$week = $this->input->post('week');
			$year = $this->input->post('year');
			$secGroup = $this->session->userdata('secGroup');
			$section = $this->session->userdata('section');

			$result['data'] = $this->SGODModel->get_accomplishment_by_date($year, $month, $week, $section, $secGroup);
		} else {
			$result['data'] = $this->SGODModel->viewSecAccomplishments($section, $secGroup);
		}

		$this->load->view('sect_accomplishments', $result);
	}

	function copy_acc($param)
	{
		$this->SGODModel->copy_row($param);
		redirect('Page/viewSecAccomplishments');
	}

	function aip()
	{
		$result['title'] = "ANNUAL IMPLEMENTATION PLAN";
		$result['b_label'] = "+ Add New";
		$result['b_link'] = "aip_new";
		$result['fy'] = $_SESSION['fy'];
		$result['bcode'] = $_SESSION['aip'];
		$result['data'] = $this->SGODModel->two_cond('sgod_aip', 'school_id', $this->session->username, 'b_code', $_SESSION['aip']);
		$result['ssa'] = $this->SGODModel->two_cond('sgod_school_allocation', 'schoolID', $this->session->username, 'alloc_year', $_SESSION['fy']);

		$result['alloc'] = $this->SGODModel->two_cond_row('sgod_school_allocation', 'schoolID', $this->session->username, 'alloc_batch', $_SESSION['aip']);


		$result['aip_s'] = $this->SGODModel->two_cond_row('sgod_aip_submit', 'school_id', $this->session->username, 'b_code', $_SESSION['aip']);
		$result['aip_r'] = $this->SGODModel->two_cond_orderby('sgod_aip_request', 'school_id', $this->session->username, 'b_code', $_SESSION['aip'], 'id', 'DESC');


		$result['submit_aip'] = $this->SGODModel->two_cond('sgod_aip_submit', 'b_code', $_SESSION['aip'], 'school_id', $this->session->username);

		$result['pillar'] = $this->SGODModel->get_all('sgod_settings_pillar');
		$result['domain'] = $this->SGODModel->get_all('sgod_settings_domain');
		$result['pias'] = $this->SGODModel->get_all('sgod_settings_pias');
		$result['strand'] = $this->SGODModel->get_all('sgod_settings_strand');

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_view', $result);
	}

	function aip_request()
	{
		$this->SGODModel->request();
		$this->SGODModel->request_insert_track();
		redirect(base_url() . 'Page/aip');
	}

	function aip_filterd()
	{
		$result['title'] = "ANNUAL IMPLEMENTATION PLAN";
		$result['b_label'] = "+ ADD NEW";
		$result['b_link'] = "aip_new";

		$result['pillar'] = $this->SGODModel->get_all('sgod_settings_pillar');
		$result['domain'] = $this->SGODModel->get_all('sgod_settings_domain');
		$result['pias'] = $this->SGODModel->get_all('sgod_settings_pias');
		$result['strand'] = $this->SGODModel->get_all('sgod_settings_strand');

		$result['data'] = $this->SGODModel->get_all_aip_by();
		$this->load->view('aip_view', $result);
	}
	function aip_action()
	{
		$result['title'] = "TAKE ACTION ANNUAL IMPLEMENTATION PLAN";

		$this->load->view('aip_action', $result);

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_aip_action();
			$this->SGODModel->update_aip_action();
			redirect(base_url() . 'Page/aip_action_list');
		}
	}
	function approved_aip()
	{
		$this->SGODModel->aip_approved();
		$this->SGODModel->update_aip_action();
		redirect(base_url() . 'Page/aip_sub');
	}

	function approved_aip_sned()
	{
		$this->SGODModel->aip_approved_sned();
		$this->SGODModel->update_aip_action_sned();
		redirect(base_url() . 'Page/aip_sub_sned');
	}

	function remarks_aip()
	{
		$id = $this->input->post('id');

		$this->SGODModel->aip_remarks();
		redirect(base_url() . 'Page/aip_track/' . $id);
	}

	function open_aip()
	{
		$this->SGODModel->aip_open();
		$this->SGODModel->update_aip_open();
		$this->SGODModel->request_update();
		redirect(base_url() . 'Page/aip_sub');
	}

	function submit_aip()
	{
		$fy = $_SESSION['fy'];
		$id = $this->session->username;
		$bcode = $_SESSION['aip'];

		$this->SGODModel->aip_submit($fy, $id, $bcode);
		$this->SGODModel->aip_track($this->db->insert_id());
		redirect(base_url() . 'Page/aip_action_list');
	}

	function submit_aip_sned()
	{
		$fy = $_SESSION['fy'];
		$id = $this->session->username;
		$bcode = $_SESSION['aip'];

		$this->SGODModel->aip_submit_sned($fy, $id, $bcode);
		$this->SGODModel->aip_track($this->db->insert_id());
		redirect(base_url() . 'Page/aip_action_list');
	}

	function aip_action_list()
	{
		$result['title'] = "ANNUAL IMPLEMENTATION PLAN ACTION LIST";

		$result['data'] = $this->SGODModel->two_cond('sgod_aip_submit', 'school_id', $this->session->username, 'fy', $_SESSION['fy']);

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_action_view', $result);
	}

	function aip_sub()
	{
		$result['title'] = "SUBMITTED PLANS";
		$fys = $this->SGODModel->last_record('sgod_fy', 'id', 'DESC');

		$result['data'] = $this->SGODModel->two_cond('sgod_aip_submit', 'fy', $fys->fy, 'status', 0);

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_action_view', $result);
	}

	function aip_sub_sned()
	{
		$result['title'] = "SUBMITTED PLANS";
		$fys = $this->SGODModel->last_record('sgod_fy', 'id', 'DESC');

		$result['data'] = $this->SGODModel->two_cond('sgod_aip_submit', 'fy', $fys->fy, 'status', 2);

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_action_view_sned', $result);
	}

	function aip_evaluate()
	{
		$result['title'] = "SUBMITTED PLANS";
		$fys = $this->SGODModel->last_record('sgod_fy', 'id', 'DESC');

		$result['data'] = $this->SGODModel->two_cond('sgod_aip_submit', 'fy', $fys->fy, 'status', 0);

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_evaluate', $result);
	}

	// function aip_approved(){
	// 	$result['title'] = "SUBMITTED PLANS";
	// 	$fys = $this->SGODModel->last_record('sgod_fy', 'id', 'DESC');

	// 	$result['data'] = $this->SGODModel->two_cond('sgod_aip_submit', 'fy', $fys->fy,'status',1);

	// 	$this->load->view('templates/head');
	// 	$this->load->view('templates/header');
	// 	$this->load->view('aip_action_view', $result);
	// }

	function aip_approved()
	{
		$result['title'] = "Submission by District";

		$result['data'] = $this->SGODModel->no_cond_group_by('schools', 'district');
		$result['gl'] = $this->SGODModel->no_cond_group_by('schools', 'course');

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_districtv2', $result);
	}




	function aip_requested()
	{
		$result['title'] = "SUBMITTED PLANS";

		$fys = $this->SGODModel->last_record('sgod_fy', 'id', 'DESC');

		$result['data'] = $this->SGODModel->two_cond('sgod_aip_request', 'fy', $fys->fy, 'stat', 0);

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_request', $result);
	}

	function aip_sub_district()
	{
		$result['title'] = "Submission by District";

		$result['data'] = $this->SGODModel->no_cond_group_by('schools', 'district');

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_district', $result);
	}

	function aip_sub_dist_school()
	{
		$result['title'] = "Submission by School";

		$school = urldecode($this->uri->segment('3'));

		$result['data'] = $this->SGODModel->one_cond('schools', 'district', $school);


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_sub_schools', $result);
	}

	function aip_sub_school()
	{
		$result['title'] = "Submition by School";

		$fy = $this->SGODModel->get_last_record('sgod_fy');

		$school_id = $this->uri->segment('3');

		$result['data'] = $this->SGODModel->two_cond('sgod_aip_submit', 'fy', $fy->fy, 'school_id', $school_id);


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_action_view', $result);
	}

	function aip_submitted()
	{
		$result['title'] = "Submission by School";

		$school = urldecode($this->uri->segment('3'));

		$result['data'] = $this->SGODModel->one_cond('schools', 'district', $school);


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_submitted', $result);
	}

	function aip_submitted_approved()
	{
		$result['title'] = "Submission by School";

		$school = urldecode($this->uri->segment('3'));

		$result['data'] = $this->SGODModel->one_cond('schools', 'district', $school);


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_submitted_approved', $result);
	}

	function aip_nsubmitted()
	{
		$result['title'] = "Submission by School";

		$school = urldecode($this->uri->segment('3'));

		$result['data'] = $this->SGODModel->one_cond('schools', 'district', $school);


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_not_submitted', $result);
	}

	function aip_track()
	{
		$result['title'] = "ANNUAL IMPLEMENTATION PLAN ACTION LIST";


		$id = $this->uri->segment(3);

		$result['data'] = $this->SGODModel->one_cond_orderby('sgod_aip_track', 'submit_id', $id, 'id', 'desc');
		$result['aip'] = $this->SGODModel->one_cond_row('sgod_aip_submit', 'id', $id);


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_track_view', $result);
	}

	function aip_noti_track()
	{
		$id = $this->uri->segment(3);
		$this->SGODModel->update_noti();
		redirect(base_url() . 'Page/aip_track/' . $id);
	}

	function fy_setting_school()
	{
		$result['title'] = "FASCAL YEAR";

		$result['label'] = "FASCAL YEAR";

		// if ($this->input->post('submit')) {
		// 	$this->SGODModel->insert_fy();
		// 	$this->session->set_flashdata('success', 'Saved successfully.');

		// 	redirect(base_url() . 'Page/fy_setting');
		// }

		$result['alloc_year'] = $this->Common->no_cond_group('sgod_school_allocation', 'alloc_year');


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('setting_fy_school', $result);
	}



	function fy_setting()
	{
		$result['title'] = "FASCAL YEAR";

		$result['label'] = "FASCAL YEAR";

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_fy();
			$this->session->set_flashdata('success', 'Saved successfully.');

			redirect(base_url() . 'Page/fy_setting');
		}


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('setting_fy', $result);
	}

	function aip_stat_sub()
	{

		$result['title'] = "AIP School Submitted";

		$result['fy'] =  $this->input->post('fy');

		$result['data'] = $this->SGODModel->get_all_orderby('schools', 'district', 'desc');


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_status_list', $result);
	}

	function aip_stat_sub_summary()
	{

		$result['title'] = "AIP School Submitted";

		$result['fy'] =  $this->uri->segment(3);

		$result['data'] = $this->SGODModel->get_all_orderby('schools', 'district', 'desc');


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_status_list', $result);
	}

	function aip_stat_notsub()
	{

		$result['title'] = "AIP School Not Submitted";

		$result['fy'] =  $this->input->post('fy');

		$result['data'] = $this->SGODModel->get_all_orderby('schools', 'district', 'desc');




		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_status_nlist', $result);
	}
	function aip_stat_notsub_summary()
	{

		$result['title'] = "AIP School Not Submitted";

		$result['fy'] =  $this->uri->segment(3);

		$result['data'] = $this->SGODModel->get_all_orderby('schools', 'district', 'desc');




		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_status_nlist', $result);
	}

	function aip_stat()
	{
		$result['title'] = "FASCAL YEAR";

		$result['label'] = "FASCAL YEAR";

		if ($this->input->post('submit')) {
			$this->SGODModel->fys();
			$this->session->set_flashdata('success', 'Saved successfully.');

			redirect(base_url() . 'Page/fy_setting');
		}


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_status', $result);
	}

	function aip_track_delete()
	{
		$id = $this->uri->segment(4);
		$this->SGODModel->delete('3', 'id', 'sgod_aip_track');
		$this->session->set_flashdata('danger', ' Settings was deleted');

		redirect(base_url() . 'Page/aip_track/' . $id);
	}

	function app_percentage()
	{
		if ($this->input->post('total') == 100) {
			if ($this->input->post('id') == 0) {
				$this->SGODModel->insert_app_percentage();
			} else {
				$this->SGODModel->update_app_percentage();
			}

			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/view_app');
		} else {
			$this->session->set_flashdata('danger', 'The encoded percentage breakdown is not equal to 100%.');
			redirect(base_url() . 'Page/view_app');
		}
	}


	function generate_app()
	{
		$result['title'] = " ANNUAL PROCUREMENT PLAN (APP)";
		$result['school_id'] = $this->session->username;
		$result['fy'] = $_SESSION['fy'];
		$result['b_code'] = $_SESSION['aip'];


		$fy = $_SESSION['fy'];
		$b_code = $_SESSION['aip'];
		$school_id = $this->session->username;

		$data['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $b_code);

		$result['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);
		$result['abp'] = $this->SGODModel->one_cond_row('sgod_app_percentage', 'b_code', $_SESSION['aip']);
		$result['ssa'] = $this->SGODModel->three_cond_row('sgod_school_allocation', 'schoolID', $school_id, 'alloc_batch', $b_code, 'alloc_year', $fy);
		$result['aip_submit'] = $this->SGODModel->aip_related_row('sgod_aip_submit', $school_id, $fy, $b_code);
		$result['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $b_code);

		$this->load->view('app_generate', $result);
	}

	function generate_appv2()
	{
		$result['title'] = " ANNUAL PROCUREMENT PLAN (APP)";
		$result['school_id'] = $this->session->username;
		$result['fy'] = $_SESSION['fy'];
		$result['b_code'] = $_SESSION['aip'];


		$fy = $_SESSION['fy'];
		$b_code = $_SESSION['aip'];
		$school_id = $this->session->username;

		$data['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $b_code);

		$result['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);
		$result['abp'] = $this->SGODModel->one_cond_row('sgod_app_percentage', 'b_code', $_SESSION['aip']);
		$result['ssa'] = $this->SGODModel->three_cond_row('sgod_school_allocation', 'schoolID', $school_id, 'alloc_batch', $b_code, 'alloc_year', $fy);
		$result['aip_submit'] = $this->SGODModel->aip_related_row('sgod_aip_submit', $school_id, $fy, $b_code);
		$result['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $b_code);

		$result['ft'] = $this->SGODModel->two_cond_row('sgod_school_allocation', 'schoolID', $this->session->username, 'alloc_batch', $_SESSION['aip']);


		$this->load->view('app_generatev2', $result);
	}

	function generate_ppmp()
	{
		$result['title'] = "PROJECT PROCUREMENT MANAGEMENT PLAN";
		$result['school_id'] = $this->session->username;
		$result['fy'] = $_SESSION['fy'];
		$result['b_code'] = $_SESSION['aip'];


		$fy = $_SESSION['fy'];
		$b_code = $_SESSION['aip'];
		$school_id = $this->session->username;

		$result['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);
		$result['abp'] = $this->SGODModel->one_cond_row('sgod_app_percentage', 'b_code', $_SESSION['aip']);
		$result['ssa'] = $this->SGODModel->three_cond_row('sgod_school_allocation', 'schoolID', $school_id, 'alloc_batch', $b_code, 'alloc_year', $fy);

		$this->load->view('ppmp_generate', $result);
	}

	function generate_ppmp_admin()
	{
		$result['title'] = "PROJECT PROCUREMENT MANAGEMENT PLAN";
		$result['school_id'] = $this->uri->segment(3);
		$result['fy'] = $this->uri->segment(4);
		$result['b_code'] = $this->uri->segment(5);


		$fy = $this->uri->segment(4);
		$b_code = $this->uri->segment(5);
		$school_id = $this->uri->segment(3);

		$result['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $b_code);

		$result['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);
		$result['abp'] = $this->SGODModel->one_cond_row('sgod_app_percentage', 'b_code', $b_code);
		$result['ssa'] = $this->SGODModel->three_cond_row('sgod_school_allocation', 'schoolID', $school_id, 'alloc_batch', $b_code, 'alloc_year', $fy);

		$this->load->view('ppmp_generate', $result);
	}



	function generate_app_admin()
	{
		$result['title'] = " ANNUAL PROCUREMENT PLAN (APP)";
		$result['school_id'] = $this->uri->segment(3);
		$result['fy'] = $this->uri->segment(4);
		$result['b_code'] = $this->uri->segment(5);

		$school_id = $this->uri->segment(3);
		$fy = $this->uri->segment(4);
		$b_code = $this->uri->segment(5);

		$result['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $b_code);

		$result['abp'] = $this->SGODModel->one_cond_row('sgod_app_percentage', 'b_code', $b_code);
		$result['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);
		$result['ssa'] = $this->SGODModel->three_cond_row('sgod_school_allocation', 'schoolID', $school_id, 'alloc_batch', $b_code, 'alloc_year', $fy);

		$this->load->view('app_generate', $result);
	}

	function generate_app_admin_sned()
	{
		$result['title'] = " ANNUAL PROCUREMENT PLAN (APP)";
		$result['school_id'] = $this->uri->segment(3);
		$result['fy'] = $this->uri->segment(4);
		$result['b_code'] = $this->uri->segment(5);

		$school_id = $this->uri->segment(3);
		$fy = $this->uri->segment(4);
		$b_code = $this->uri->segment(5);

		$result['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $b_code);

		$result['abp'] = $this->SGODModel->one_cond_row('sgod_app_percentage', 'b_code', $b_code);
		$result['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);
		$result['ssa'] = $this->SGODModel->three_cond_row('sgod_school_allocation', 'schoolID', $school_id, 'alloc_batch', $b_code, 'alloc_year', $fy);

		$result['ft'] = $this->SGODModel->two_cond_row('sgod_school_allocation', 'schoolID', $school_id, 'alloc_batch', $b_code);

		$this->load->view('app_generatev2', $result);
	}

	function view_app()
	{
		$result['title'] = "ANNUAL PROCUREMENT PLAN (APP)";
		$result['data'] = $this->SGODModel->two_cond('sgod_app', 'b_code', $_SESSION['aip'], 'bs', 'MOOE');
		$result['ssa'] = $this->SGODModel->two_cond('sgod_school_allocation', 'schoolID', $this->session->username, 'alloc_year', $_SESSION['fy']);

		$result['ft'] = $this->SGODModel->two_cond_row('sgod_school_allocation', 'schoolID', $this->session->username, 'alloc_batch', $_SESSION['aip']);


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('app_view', $result);

		if ($this->input->post('submit')) {
			$this->SGODModel->reupdate_app();
			$this->session->set_flashdata('success', 'Saved successfully.');

			redirect(base_url() . 'Page/view_app');
		}
	}

	function view_appv2()
	{
		$result['title'] = "ANNUAL PROCUREMENT PLAN (APP)";
		$result['data'] = $this->SGODModel->two_cond_group('sgod_app', 'b_code', $_SESSION['aip'], 'bs', 'MOOE', 'aip_id');
		$result['ssa'] = $this->SGODModel->two_cond('sgod_school_allocation', 'schoolID', $this->session->username, 'alloc_year', $_SESSION['fy']);


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('app_viewv2', $result);

		if ($this->input->post('submit')) {
			$this->SGODModel->reupdate_app();
			$this->session->set_flashdata('success', 'Saved successfully.');

			redirect(base_url() . 'Page/view_app');
		}
	}

	function app_edit()
	{
		$result['title'] = "UPDATE ANNUAL PROCUREMENT PLAN (APP)";
		$result['data'] = $this->SGODModel->one_cond_row('sgod_app', 'id', $this->uri->segment(3));


		if ($this->input->post('submit')) {
			$this->SGODModel->reupdate_app();
			$this->session->set_flashdata('success', 'Saved successfully.');

			redirect(base_url() . 'Page/view_app');
		}

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('app_update', $result);
	}

	function gapp_edit()
	{
		$result['title'] = "UPDATE ANNUAL PROCUREMENT PLAN (APP)";
		$result['data'] = $this->SGODModel->one_cond_row('sgod_app', 'id', $this->uri->segment(3));


		if ($this->input->post('submit')) {
			$aip_id = $this->input->post('aip_id');
			$this->SGODModel->reupdate_app();
			$this->session->set_flashdata('success', 'Saved successfully.');

			redirect(base_url() . 'Page/group_app/' . $aip_id);
		}

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('gapp_update', $result);
	}

	function app_delete()
	{

		$id = $this->uri->segment(4);
		$this->SGODModel->delete('3', 'id', 'sgod_app');

		//$aipmat = $this->SGODModel->one_cond_row('sgod_app', 'aip_id', $id);
		$aipmat = $this->SGODModel->one_cond('sgod_app', 'aip_id', $id);
		$rows = '';
		foreach ($aipmat as $row) {
			$rows .= $row->materials . ', ';
		}
		$materials = rtrim($rows, ', ');

		$this->SGODModel->update_aip_material($materials);





		$this->session->set_flashdata('danger', ' Settings was deleted');

		redirect(base_url() . 'Page/group_app/' . $id);
	}

	function gapp_new()
	{
		$result['title'] = "NEW ANNUAL PROCUREMENT PLAN (APP)";
		$result['data'] = $this->SGODModel->one_cond_row('sgod_app', 'id', $this->uri->segment(3));


		if ($this->input->post('submit')) {
			$aip_id = $this->input->post('aip_id');
			$this->SGODModel->reupdate_app();
			$this->session->set_flashdata('success', 'Saved successfully.');

			redirect(base_url() . 'Page/group_app/' . $aip_id);
		}

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('gapp_create', $result);
	}


	function app_new()
	{
		$result['title'] = "NEW ANNUAL PROCUREMENT PLAN (APP)";
		$result['data'] = $this->SGODModel->one_cond_row('sgod_app', 'id', $this->uri->segment(3));


		if ($this->input->post('submit')) {
			$this->SGODModel->reupdate_app();
			$this->session->set_flashdata('success', 'Saved successfully.');

			redirect(base_url() . 'Page/view_app');
		}

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('app_create', $result);
	}

	function group_app($param)
	{
		$result['title'] = "MATERIALS ANNUAL PROCUREMENT PLAN (APP)";
		$result['data'] = $this->SGODModel->one_cond('sgod_app', 'aip_id', $param);
		$result['aip'] = $this->SGODModel->one_cond_row('sgod_aip', 'id', $param);
		$result['aip_s'] = $this->SGODModel->two_cond_row('sgod_aip_submit', 'school_id', $this->session->username, 'b_code', $_SESSION['aip']);


		if ($this->input->post('submit')) {
			$this->SGODModel->insert_materials();
			$this->SGODModel->update_aip_materials();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/group_app/' . $param);
		}


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('app_group', $result);
	}


	function aip_new()
	{
		$fys = $this->SGODModel->last_record('sgod_fy', 'id', 'DESC');
		$result['title'] = "ADD NEW ANNUAL IMPLEMENTATION PLAN";
		$result['data'] = $this->SGODModel->get_all('sgod_aip');
		$result['pillar'] = $this->SGODModel->get_all_orderby('sgod_settings_pillar', 'pillar', 'ASC');
		$result['domain'] = $this->SGODModel->get_all_orderby('sgod_settings_domain', 'domain', 'ASC');

		$result['pias'] = $this->SGODModel->two_cond('sgod_settings_pias', 'year', $_SESSION['fy'], 'school_id', $this->session->username);


		$result['matatag'] = $this->SGODModel->get_all_orderby('sgod_settings_matatag', 'id', 'DESC');
		$result['strand'] = $this->SGODModel->get_all_orderby('sgod_settings_strand', 'strand', 'ASC');
		$result['bs'] = $this->SGODModel->get_all_orderby('sgod_settings_bs', 'id', 'ASC');
		$result['last'] = $this->SGODModel->last_record('sgod_aip', 'id', 'DESC');
		$result['pil'] = $this->SGODModel->table_num('sgod_aip');



		$result['ssa'] = $this->SGODModel->two_cond('sgod_school_allocation', 'schoolID', $this->session->username, 'alloc_year', $_SESSION['fy']);
		$result['group'] = $this->Common->no_cond('sgod_alloc_group', 'alloc_group');

		$result['ssa'] = $this->SGODModel->get_all('sgod_setting_io');

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_add', $result);

		if ($this->input->post('submit')) {
			$fy = $this->input->post('fy');
			$b_code = $this->input->post('b_code');
			$check = $this->SGODModel->three_cond('sgod_aip_submit', 'fy', $fy, 'remarks', 'Approved', 'b_code', $b_code);
			if (empty($check)) {
				$this->SGODModel->insert_aip();
				$this->SGODModel->insert_app();
				$this->session->set_flashdata('success', 'Saved successfully.');
			} else {
				$this->session->set_flashdata('danger', 'AIP Locked.');
			}
			redirect(base_url() . 'Page/aip_new');
		}
	}

	function aip_edit($param)
	{

		$fys = $this->SGODModel->last_record('sgod_fy', 'id', 'DESC');
		$result['title'] = "UPDATE ANNUAL IMPLEMENTATION PLAN";
		$result['data'] = $this->SGODModel->get_single_by_id('id', 'sgod_aip', $param);
		$result['pillar'] = $this->SGODModel->get_all_orderby('sgod_settings_pillar', 'pillar', 'ASC');
		$result['domain'] = $this->SGODModel->get_all_orderby('sgod_settings_domain', 'domain', 'ASC');
		//ss$result['pias'] = $this->SGODModel->one_cond_orderby('sgod_settings_pias', 'year', $_SESSION['fy'], 'pias', 'ASC');
		$result['pias'] = $this->SGODModel->two_cond('sgod_settings_pias', 'year', $_SESSION['fy'], 'school_id', $this->session->username);
		$result['matatag'] = $this->SGODModel->get_all_orderby('sgod_settings_matatag', 'matatag', 'ASC');
		$result['strand'] = $this->SGODModel->get_all_orderby('sgod_settings_strand', 'strand', 'ASC');
		$result['ssa'] = $this->SGODModel->get_all('sgod_school_allocation', 'schoolID', $this->session->username, 'alloc_year', $fys->fy);
		$result['bs'] = $this->SGODModel->get_all_orderby('sgod_settings_bs', 'id', 'ASC');

		$result['group'] = $this->Common->no_cond('sgod_alloc_group', 'alloc_group');


		if ($this->input->post('submit')) {
			$this->SGODModel->update_aip($param);
			//$this->SGODModel->delete('3', 'aip_id', 'sgod_app');
			//$this->SGODModel->update_app();
			$this->session->set_flashdata('success', 'Updated successfully');
			redirect(base_url() . 'Page/aip');
		}

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('aip_update', $result);
	}

	function aip_delete()
	{
		$this->SGODModel->delete('3', 'id', 'sgod_aip');
		$this->session->set_flashdata('danger', ' Settings was deleted');
		$this->SGODModel->delete('3', 'aip_id', 'sgod_app');

		redirect(base_url() . 'Page/aip');
	}

	function sop()
	{
		$result['title'] = "SCHOOL OPERATIONAL PLAN";
		$result['b_label'] = "+ ADD NEW";
		$result['b_link'] = "#";
		$result['ssa'] = $this->SGODModel->one_cond('sgod_school_allocation', 'schoolID', $this->session->username);
		//$result['data']=$this->SGODModel->get_all('sgod_aip');

		$result['data'] = $this->SGODModel->one_cond('sgod_aip', 'b_code', $_SESSION['aip']);

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sop_view', $result);

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_sop();
			$this->session->set_flashdata('success', 'Saved successfully.');

			redirect(base_url() . 'Page/sop');
		}
	}

	function sop_edit($param)
	{
		$result['title'] = "UPDATE TARGET";
		$result['b_label'] = "+ ADD NEW";
		$result['b_link'] = "#";

		$result['sop'] = $this->SGODModel->one_cond_row('sgod_sop', 'id', $param);


		if ($this->input->post('submit')) {
			$this->SGODModel->update_sop($param);
			$this->session->set_flashdata('success', 'Saved successfully.');

			redirect(base_url() . 'Page/sop');
		}

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sop_update', $result);
	}



	function generate_sop()
	{
		$result['title'] = "ANNUAL IMPLEMENTATION PLAN";
		$result['b_label'] = "+ ADD NEW";
		$result['b_link'] = "#";

		$school_id = $this->session->username;
		$fy = $_SESSION['fy'];
		$bcode = $_SESSION['aip'];

		$result['fy'] = $_SESSION['fy'];



		$result['data'] = $this->SGODModel->get_aip($school_id, $fy, $bcode);
		$result['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $bcode);
		$result['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);
		$result['aip_submit'] = $this->SGODModel->aip_related_row('sgod_aip_submit', $school_id, $fy, $bcode);
		$result['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $bcode);

		$result['ft'] = $this->SGODModel->two_cond_row('sgod_school_allocation', 'schoolID', $this->session->username, 'alloc_batch', $_SESSION['aip']);


		$this->load->view('sop_generate', $result);
	}

	function generate_sop_admin()
	{
		$result['title'] = "ANNUAL IMPLEMENTATION PLAN";
		$result['b_label'] = "+ ADD NEW";
		$result['b_link'] = "#";

		$school_id = $this->uri->segment(3);
		$fy = $this->uri->segment(4);
		$bcode = $this->uri->segment(5);

		$result['fy'] = $this->uri->segment(4);

		$result['data'] = $this->SGODModel->get_aip($school_id, $fy, $bcode);
		$result['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $bcode);
		$result['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);


		$this->load->view('sop_generate', $result);
	}

	function generate_ca()
	{
		$result['title'] = "ca";
		$result['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $this->uri->segment(3));
		$result['aip'] = $this->SGODModel->two_cond_row('sgod_aip_submit', 'school_id', $this->uri->segment(3), 'b_code', $this->uri->segment(4));
		$result['alloc'] = $this->SGODModel->one_cond_row('sgod_school_allocation', 'alloc_batch', $this->uri->segment(4));
		$result['a'] = $this->SGODModel->two_cond_orderby('sgod_aip_track', 'remarks', 'Approved', 'submit_id', $this->uri->segment(5), 'id', 'ASC');
		$this->load->view('ca', $result);
	}


	function generate_aip()
	{
		$result['title'] = "ANNUAL IMPLEMENTATION PLAN";
		$result['b_label'] = "+ ADD NEW";
		$result['b_link'] = "#";

		$school_id = $this->session->username;
		$fy = $_SESSION['fy'];
		$bcode = $_SESSION['aip'];

		echo $_SESSION['fy'];

		$result['fy'] = $_SESSION['fy'];

		$result['data'] = $this->SGODModel->get_aip($school_id, $fy, $bcode);
		$result['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $bcode);

		$result['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);
		$result['aip_submit'] = $this->SGODModel->aip_related_row('sgod_aip_submit', $school_id, $fy, $bcode);

		$result['aip_sc'] = $this->Common->four_cond_count_row('sgod_aip_submit', 'school_id', $school_id, 'fy', $fy, 'b_code', $bcode, 'remarks', 'Approved');

		$result['ft'] = $this->SGODModel->two_cond_row('sgod_school_allocation', 'schoolID', $this->session->username, 'alloc_batch', $_SESSION['aip']);



		$this->load->view('aip_generate', $result);
	}

	function aip_admin()
	{
		$result['title'] = "ANNUAL IMPLEMENTATION PLAN";
		$result['b_label'] = "+ ADD NEW";
		$result['b_link'] = "#";

		$result['fy'] = $this->uri->segment(4);

		$school_id = $this->uri->segment(3);
		$fy = $this->uri->segment(4);
		$bcode = $this->uri->segment(5);

		$result['data'] = $this->SGODModel->get_aip($school_id, $fy, $bcode);
		$result['data_row'] = $this->SGODModel->get_aip_row($school_id, $fy, $bcode);
		$result['school'] = $this->SGODModel->one_cond_row('schools', 'schoolId', $school_id);
		$result['aip_submit'] = $this->SGODModel->aip_related_row('sgod_aip_submit', $school_id, $fy, $bcode);

		$this->load->view('aip_generate', $result);
	}

	function generate_aip_filter()
	{
		$result['title'] = "Generate ANNUAL IMPLEMENTATION PLAN";
		$this->load->view('aip_generate_filter', $result);
	}

	function acc()
	{
		$data['page'] = $this->SGODModel->get_accomplishment();
		$data['section'] = $data['page']['section'];
		$id = $data['page']['id'];
		$data['acc'] = $this->SGODModel->get_all_data_where_single('sgod_accomplishments', 'year', '2023');

		$this->load->view('accomplishment', $data);
	}

	function secaccview($param)
	{
		$result['data'] = $this->SGODModel->get_table_where($param, 'sgod_acc_image');
		$result['sf'] = $this->SGODModel->get_table_where($param, 'sgod_files');
		$this->load->view('sec_acc_view', $result);
	}

	function report()
	{
		$quarter = $this->input->post('quarter');
		$year = $this->input->post('year');
		$week = $this->input->post('weekAcc');
		$month = $this->input->post('month');
		$category = $this->input->post('activityCategory');

		$result['cat'] = $category;

		if ($category == 'all') {
			$result['accomplish'] = $this->SGODModel->get_accomplishment_by('Accomplishment', $quarter, $year, $week, $month);
			$result['update'] = $this->SGODModel->get_accomplishment_by('Updates', $quarter, $year, $week, $month);
		} elseif ($category == 'accomplishment') {
			$result['accomplish'] = $this->SGODModel->get_accomplishment_by($category, $quarter, $year, $week, $month);
		} else {
			$result['update'] = $this->SGODModel->get_accomplishment_by($category, $quarter, $year, $week, $month);
		}
		$result['acc'] = $this->SGODModel->get_accomplishment_by_row($quarter, $year, $week, $month);

		if ($week == "") {
			$result['r'] = "Quarter";
			$result['rr'] = "ly";
			$result['q'] = $this->input->post('quarter');
		} else {
			$result['r'] = "Week";
			$result['rr'] = "ly";
			$result['q'] = $this->input->post('weekAcc');
		}



		$this->load->view('sec_report_view', $result);
	}
	function reportv2()
	{

		$quarter = $this->input->post('quarter');
		$year = $this->input->post('year');
		$week = $this->input->post('weekAcc');
		$month = $this->input->post('month');
		$category = $this->input->post('activityCategory');
		$secGroup = $this->session->userdata('secGroup');

		$result['cat'] = $category;

		if ($category == 'all') {
			$result['accomplish'] = $this->SGODModel->get_accomplishment_by('Accomplishment', $quarter, $year, $week, $month, $secGroup);
			$result['update'] = $this->SGODModel->get_accomplishment_by('Updates', $quarter, $year, $week, $month, $secGroup);
		} elseif ($category == 'accomplishment') {
			$result['accomplish'] = $this->SGODModel->get_accomplishment_by($category, $quarter, $year, $week, $month, $secGroup);
		} else {
			$result['update'] = $this->SGODModel->get_accomplishment_by($category, $quarter, $year, $week, $month, $secGroup);
		}
		$result['acc'] = $this->SGODModel->get_accomplishment_by_row($quarter, $year, $week, $month, $secGroup);

		if ($week == "") {
			$result['r'] = "Quarter";
			$result['rr'] = "ly";
			$result['q'] = $this->input->post('quarter');
		} else {
			$result['r'] = "Week";
			$result['rr'] = "ly";
			$result['q'] = $this->input->post('weekAcc');
		}



		$this->load->view('sec_report_viewv2', $result);
	}


	function sec_filter()
	{
		$this->load->view('sec_filter_report');
	}
	function sec_filterv2()
	{
		$this->load->view('sec_filter_reportv2');
	}
	function sfy()
	{
		$this->load->view('sec_filter_year');
	}

	function report_sfy()
	{

		$quarter = $this->input->post('quarter');
		$year = $this->input->post('year');
		$category = $this->input->post('activityCategory');
		$secGroup = $this->session->userdata('secGroup');

		$result['cat'] = $category;

		if ($category == 'all') {
			$result['accomplish'] = $this->SGODModel->get_year_accomplishment('Accomplishment', $year, $secGroup);
			$result['update'] = $this->SGODModel->get_year_accomplishment('Updates', $year, $secGroup);

			$result['accomplishment'] = $this->SGODModel->get_year_accomplishment('Accomplishment', $year, $secGroup);
			$result['updates'] = $this->SGODModel->get_year_accomplishment('Updates', $year, $secGroup);

			$result['sections'] = $this->SGODModel->get_acc_group_by_section_year($year);
		} elseif ($category == 'accomplishment') {
			$result['accomplish'] = $this->SGODModel->get_year_accomplishment($category, $year, $secGroup);
			$result['accomplishment'] = $this->SGODModel->get_year_accomplishment('Accomplishment', $year, $secGroup);
		} else {
			$result['update'] = $this->SGODModel->get_year_accomplishment($category, $year, $secGroup);
			$result['updates'] = $this->SGODModel->get_year_accomplishment('Updates', $year, $secGroup);
		}

		$result['acc'] = $this->SGODModel->get_accomplish_by_row_year($year);


		$this->load->view('sfy_view', $result);
	}

	function sec_filter_admin()
	{
		$this->load->view('sec_filter_report_admin');
	}
	function report_admin()
	{

		$quarter = $this->input->post('quarter');
		$year = $this->input->post('year');
		$week = $this->input->post('weekAcc');
		$month = $this->input->post('month');
		$category = $this->input->post('activityCategory');

		$result['cat'] = $category;

		if ($category == 'all') {
			$result['accomplish'] = $this->SGODModel->get_all_accomplishment('Accomplishment', $quarter, $year, $week, $month);
			$result['update'] = $this->SGODModel->get_all_accomplishment('Updates', $quarter, $year, $week, $month);

			$result['accomplishment'] = $this->SGODModel->get_all_accomplishment('Accomplishment', $quarter, $year, $week, $month);
			$result['updates'] = $this->SGODModel->get_all_accomplishment('Updates', $quarter, $year, $week, $month);

			$result['sections'] = $this->SGODModel->get_accomplishment_group_by_section($quarter, $year, $week, $month);
		} elseif ($category == 'accomplishment') {
			$result['accomplish'] = $this->SGODModel->get_all_accomplishment($category, $quarter, $year, $week, $month);
			$result['accomplishment'] = $this->SGODModel->get_all_accomplishment('Accomplishment', $quarter, $year, $week, $month);
		} else {
			$result['update'] = $this->SGODModel->get_all_accomplishment($category, $quarter, $year, $week, $month);
			$result['updates'] = $this->SGODModel->get_all_accomplishment('Updates', $quarter, $year, $week, $month);
		}
		$result['acc'] = $this->SGODModel->get_accomplish_by_row($quarter, $year, $week, $month);

		if ($week == "") {
			$result['r'] = "Quarter";
			$result['rr'] = "ly";
			$result['q'] = $this->input->post('quarter');
		} else {
			$result['r'] = "Week";
			$result['rr'] = "ly";
			$result['q'] = $this->input->post('weekAcc');
		}
		$this->load->view('sec_report_view_admin', $result);
	}
	function report_adminv2()
	{

		$quarter = $this->input->post('quarter');
		$year = $this->input->post('year');
		$week = $this->input->post('weekAcc');
		$month = $this->input->post('month');
		$category = $this->input->post('activityCategory');
		$secGroup = $this->session->userdata('secGroup');

		$result['cat'] = $category;

		if ($category == 'all') {
			$result['accomplish'] = $this->SGODModel->get_all_accomplishment('Accomplishment', $quarter, $year, $week, $month, $secGroup);
			$result['update'] = $this->SGODModel->get_all_accomplishment('Updates', $quarter, $year, $week, $month, $secGroup);

			$result['accomplishment'] = $this->SGODModel->get_all_accomplishment('Accomplishment', $quarter, $year, $week, $month, $secGroup);
			$result['updates'] = $this->SGODModel->get_all_accomplishment('Updates', $quarter, $year, $week, $month, $secGroup);

			$result['sections'] = $this->SGODModel->get_acc_group_by_section($quarter, $year, $week, $month);
		} elseif ($category == 'accomplishment') {
			$result['accomplish'] = $this->SGODModel->get_all_accomplishment($category, $quarter, $year, $week, $month, $secGroup);
			$result['accomplishment'] = $this->SGODModel->get_all_accomplishment('Accomplishment', $quarter, $year, $week, $month, $secGroup);
		} else {
			$result['update'] = $this->SGODModel->get_all_accomplishment($category, $quarter, $year, $week, $month, $secGroup);
			$result['updates'] = $this->SGODModel->get_all_accomplishment('Updates', $quarter, $year, $week, $month, $secGroup);
		}
		$result['acc'] = $this->SGODModel->get_accomplish_by_row($quarter, $year, $week, $month, $secGroup);

		if ($week == "") {
			$result['r'] = "Quarter";
			$result['rr'] = "ly";
			$result['q'] = $this->input->post('quarter');
		} else {
			$result['r'] = "Week";
			$result['rr'] = "ly";
			$result['q'] = $this->input->post('weekAcc');
		}
		$this->load->view('sec_report_view_adminv2', $result);
	}

	public function multiple_files()
	{
		$this->load->library('upload');
		$image = array();
		$ImageCount = count($_FILES['image_name']['name']);
		for ($i = 0; $i < $ImageCount; $i++) {
			$_FILES['file']['name']       = $_FILES['image_name']['name'][$i];
			$_FILES['file']['type']       = $_FILES['image_name']['type'][$i];
			$_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'][$i];
			$_FILES['file']['error']      = $_FILES['image_name']['error'][$i];
			$_FILES['file']['size']       = $_FILES['image_name']['size'][$i];

			// File upload configuration
			$uploadPath = 'upload/tr_images';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|gif';

			// Load and initialize upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// Upload file to server
			if ($this->upload->do_upload('file')) {
				// Uploaded file data
				$imageData = $this->upload->data();
				$uploadImgData[$i]['file'] = $imageData['file_name'];
				$uploadImgData[$i]['acc_id'] = $this->input->post('id');
			}
		}
		if (!empty($uploadImgData)) {
			// Insert files data into the database
			$id = $this->input->post('id');
			$this->SGODModel->multiple_images($uploadImgData);
			redirect(base_url() . 'Page/secaccview/' . $id);
		}
	}
	public function atr()
	{
		$this->load->library('upload');
		$image = array();
		$ImageCount = count($_FILES['image_name']['name']);
		for ($i = 0; $i < $ImageCount; $i++) {
			$_FILES['file']['name']       = $_FILES['image_name']['name'][$i];
			$_FILES['file']['type']       = $_FILES['image_name']['type'][$i];
			$_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'][$i];
			$_FILES['file']['error']      = $_FILES['image_name']['error'][$i];
			$_FILES['file']['size']       = $_FILES['image_name']['size'][$i];

			// File upload configuration
			$uploadPath = 'upload/training_resources';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'pdf';

			// Load and initialize upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// Upload file to server
			if ($this->upload->do_upload('file')) {
				// Uploaded file data
				$imageData = $this->upload->data();
				$uploadImgData[$i]['file'] = $imageData['file_name'];
				$uploadImgData[$i]['file_title'] = $this->input->post('atr');
				$uploadImgData[$i]['acc_id'] = $this->input->post('id');
			}
		}
		if (!empty($uploadImgData)) {
			// Insert files data into the database
			$id = $this->input->post('id');
			$this->SGODModel->atr($uploadImgData);
			redirect(base_url() . 'Page/secaccview/' . $id);
		}
	}


	public function delete_attach($param)
	{
		$result['img'] = $this->SGODModel->get_single_table_by_id('id', 'sgod_acc_image', $param);
		$filename = $result['img']['file'];
		$id = $result['img']['acc_id'];
		$this->SGODModel->delete_group($param, $filename, 'tr_images', 'sgod_acc_image');
		redirect('Page/secaccview/' . $id);
	}
	public function delete_file($param)
	{
		$result['img'] = $this->SGODModel->get_single_table_by_id('id', 'sgod_files', $param);
		$filename = $result['img']['file'];
		$id = $result['img']['acc_id'];
		$this->SGODModel->delete_group($param, $filename, 'training_resources', 'sgod_files');
		redirect('Page/secaccview/' . $id);
	}

	public function addTrainingResources()
	{
		$config['upload_path'] = '/upload/training_resources/';
		$config['allowed_types'] = '*';
		$config['max_size'] = 15120;
		//$config['max_width'] = 1500;
		//$config['max_height'] = 1500;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('nonoy')) {
			$msg = array('error' => $this->upload->display_errors());

			$this->load->view('sec_acc_view', $msg);
		} else {
			$data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$IDNumber = $this->input->post('IDNumber');
			//$filename=$this->input->post('nonoy');
			$filename = $this->upload->data('nonoy');
			$docName = $this->input->post('docName');
			$date = date("Y-m-d");
			$que = $this->db->query("insert into sgod_files values('','$IDNumber','$docName','$filename','$date')");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Uploaded Succesfully!</b></div>');

			redirect('Page/sec_acc_view');
		}
	}


	function addAccomplishments()
	{
		$this->load->view('sect_accomplishments_add');

		if ($this->input->post('submit')) {
			//get data from the form


			$quarter = $this->input->post('quarter');
			$year = $this->input->post('year');
			$monthAcc = $this->input->post('monthAcc');
			$weekAcc = $this->input->post('weekAcc');
			$section = $this->session->userdata('section');
			$activity = addslashes($this->input->post('activity'));
			$particulars = addslashes($this->input->post('particulars'));
			$activityCategory = $this->input->post('activityCategory');
			$venue = addslashes($this->input->post('venue'));
			$targetDate = $this->input->post('targetDate');
			$dateConducted = $this->input->post('dateConducted');
			$resources = addslashes($this->input->post('resources'));
			$notes = addslashes($this->input->post('notes'));
			$remarks = addslashes($this->input->post('remarks'));
			$encoder = $this->session->userdata('username');
			$secGroup = $this->session->userdata('secGroup');

			$perIndicators = $this->input->post('perIndicators');
			$target = $this->input->post('target');
			$achieved = $this->input->post('achieved');
			$percentageAccom = $this->input->post('percentageAccom');


			$que = $this->db->query("insert into sgod_accomplishments (quarter, year, monthAcc, weekAcc, section, activity, particulars, activityCategory, venue, targetDate, dateConducted, encoder, resources, notes, perIndicators, target, achieved, percentageAccom, remarks, secGroup) values('$quarter','$year','$monthAcc','$weekAcc','$section','$activity','$particulars','$activityCategory','$venue','$targetDate','$dateConducted','$encoder','$resources','$notes','$perIndicators','$target','$achieved','$percentageAccom','$remarks','$secGroup')");
			$this->session->set_flashdata('success', ' Add Successfully!');
			redirect('Page/viewSecAccomplishments');
		}
	}

	function updateAccomplishments()
	{
		$id = $this->input->get('id');
		$result['data'] = $this->SGODModel->accombyid($id);
		$this->load->view('sect_accom_update', $result);

		if ($this->input->post('update')) {
			//get data from the form

			$quarter = $this->input->post('quarter');
			$year = $this->input->post('year');
			$weekAcc = $this->input->post('weekAcc');
			$monthAcc = $this->input->post('monthAcc');
			$particulars = addslashes($this->input->post('particulars'));
			$targetDate = $this->input->post('targetDate');
			$section = $this->session->userdata('section');
			$activity = addslashes($this->input->post('activity'));
			$activityCategory = $this->input->post('activityCategory');
			$venue = $this->input->post('venue');
			$dateConducted = $this->input->post('dateConducted');
			$encoder = $this->session->userdata('username');
			$resources = addslashes($this->input->post('resources'));
			$notes = addslashes($this->input->post('notes'));
			$remarks = addslashes($this->input->post('remarks'));

			$perIndicators = $this->input->post('perIndicators');
			$target = $this->input->post('target');
			$achieved = $this->input->post('achieved');
			$percentageAccom = $this->input->post('percentageAccom');

			$que = $this->db->query("update sgod_accomplishments set quarter='$quarter', year='$year', monthAcc='$monthAcc', weekAcc='$weekAcc', section='$section', activity='$activity', activityCategory='$activityCategory', particulars='$particulars', venue='$venue', targetDate='$targetDate', dateConducted='$dateConducted',resources='$resources',notes='$notes',perIndicators='$perIndicators',target='$target',achieved='$achieved',percentageAccom='$percentageAccom',remarks='$remarks' where id='" . $id . "'");
			$this->session->set_flashdata('success', ' Updated Successfully!');
			redirect('Page/viewSecAccomplishments');
		}
	}

	function deleteAccomplishment()
	{
		$id = $this->input->get('id');

		$que = $this->db->query("delete from sgod_accomplishments where id='" . $id . "'");
		$this->session->set_flashdata('danger', ' Deleted successfully.');
		redirect('Page/viewSecAccomplishments');
	}

	function implementation_plans()
	{
		//$result['fys'] = $this->SGODModel->last_record('sgod_fy', 'id', 'DESC');
		//$fy = $this->SGODModel->last_record('sgod_fy', 'id', 'DESC');
		$fy = $this->input->post('fy');
		$result['fys'] = $fy;
		$result['ssa'] = $this->SGODModel->two_cond('sgod_school_allocation', 'schoolID', $this->session->username, 'alloc_year', $fy);

		if ($this->input->post('aip')) {
			$code = $this->input->post('code');
			$fy = $this->input->post('fy');
			session_regenerate_id();
			$_SESSION['aip'] = $code;
			$_SESSION['fy'] = $fy;
			session_write_close();
			redirect(base_url() . 'Page/aip/');
		}

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('ip', $result);
		$this->load->view('templates/footer');
	}

	function settings_io()
	{
		$data['title'] = "Intermediate Outcome List";
		$data['m_title'] = "Add New Intermediate Outcome";
		$data['e_title'] = "Update Intermediate Outcome";
		$data['label'] = "Intermediate Outcome Description";
		$data['action'] = "settings_io";
		$data['del'] = "setting_io_del";
		$r_page = "settings_io";


		$data['page'] = $this->SGODModel->get_all('sgod_setting_io');
		$data['pillar'] = $this->SGODModel->get_all('sgod_settings_pillar');
		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('setting_io', $data);

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_io();
			redirect(base_url() . 'Page/' . $r_page);
		}

		if ($this->input->post('edit')) {
			$this->SGODModel->update_io();
			redirect(base_url() . 'Page/' . $r_page);
		}
	}
	public function setting_io_del()
	{
		$this->SGODModel->delete(3, 'id', 'sgod_setting_io');
		redirect(base_url() . 'Page/settings_io');
	}

	function settings_bs()
	{
		$data['title'] = "Budget Source List";
		$data['m_title'] = "Add New";
		$data['e_title'] = "Update";
		$data['label'] = "Description";
		$data['action'] = "settings_bs";
		$data['del'] = "setting_bs_del";
		$r_page = "settings_bs";

		$data['page'] = $this->SGODModel->get_all('sgod_settings_bs');
		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('setting_bs', $data);

		if ($this->input->post('submit')) {
			$this->SGODModel->insert_bs();
			redirect(base_url() . 'Page/' . $r_page);
		}

		if ($this->input->post('edit')) {
			$this->SGODModel->update_bs();
			redirect(base_url() . 'Page/' . $r_page);
		}
	}
	public function setting_bs_del()
	{
		$this->SGODModel->delete(3, 'id', 'sgod_settings_bs');
		redirect(base_url() . 'Page/settings_bs');
	}

	public function count_rows($table)
	{
		$result = $this->db->get($table);
		return $result;
	}


	function dra_aip()
	{
		$tdate = $this->input->post('tdate');
		if (isset($tdate)) {

			$result['aip'] = $this->SGODModel->two_cond('sgod_aip_track', 'remarks', 'Approved', 'tdate', $tdate);

			$this->load->view('dra_aip', $result);
		} else {
			redirect(base_url() . 'Page/aip_sub');
		}
	}

	function aip_sub_print()
	{

		if ($this->uri->segment(3) == 0) {
			$result['aip'] = $this->SGODModel->one_cond('sgod_aip_submit', 'remarks', 'Submitted');
		} else {
			$result['aip'] = $this->SGODModel->one_cond('sgod_aip_submit', 'remarks', 'Approved');
		}

		$this->load->view('dra_aip_print', $result);
	}

	function aip_dist_sub_print()
	{

		if ($this->uri->segment(3) == 0) {
			$result['aip'] = $this->SGODModel->one_cond('sgod_aip_submit', 'remarks', 'Submitted');
		} else {
			$result['aip'] = $this->SGODModel->one_cond('sgod_aip_submit', 'remarks', 'Approved');
		}

		$this->load->view('dra_aip_printv2', $result);
	}

	function manage_evaluator()
	{
		$data['title'] = "Manage Evaluator";


		//$data['data'] = $this->Common->one_cond('sgod_setting_io');


		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('me', $data);
	}

	// Document Verifier //

	function document_verifier()
	{
		$data['title'] = 'Document Verifier';

		$data['data'] = $this->Common->no_cond('document_verifier');

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('odv', $data);

		if ($this->input->post('submit')) {
			$this->Ren_model->new_document();
			$this->session->set_flashdata('success', ' New Document Entry.');
			//redirect(base_url() . 'document_verifier');
		}
	}

	function document_verifier_add()
	{
		$this->Reg->new_document();
		$this->session->set_flashdata('success', ' New Document Entry.');
		redirect(base_url() . 'Page/document_verifier');
	}

	function document_verifier_qr()
	{
		$data['data'] = $this->Common->one_cond_row('document_verifier', 'id', $this->uri->segment(3));

		$this->load->view('qr', $data);
	}
	function verify()
	{
		$data['data'] = $this->Common->one_cond_row('document_verifier', 'id', $this->uri->segment(3));

		$this->load->view('qr_verify', $data);
	}

	// Document Verifier end//

	function sbfp_form()
	{

		$result['title'] = "Master List Beneficiaries for School-Based Feeding Program (SBFP)";
		$result['sbf'] = $this->Common->one_cond('sbfp_data', 'schoolID', $this->session->c_id);

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sbfp', $result);
		$this->load->view('templates/footer');
	}

	function sbfp_dashboard()
	{
		$result['title'] = "SBFP DASHBOARD";

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sbfp_dashboard', $result);
		$this->load->view('templates/footer');
	}

	function baseline()
	{
		$result['title'] = "BASELINE WEIGHING";
		$result['sbf'] = $this->Common->one_cond('sbfp_data', 'schoolID', $this->session->c_id);


		$this->load->view('bw', $result);
	}

	function baseline2nd()
	{
		$result['title'] = "BASELINE WEIGHING";
		$result['sbf'] = $this->Common->one_cond('sbfp_data', 'schoolID', $this->session->c_id);


		$this->load->view('bw2nd', $result);
	}

	function baseline3nd()
	{
		$result['title'] = "BASELINE WEIGHING";
		$result['sbf'] = $this->Common->one_cond('sbfp_data', 'schoolID', $this->session->c_id);


		$this->load->view('bw2nd', $result);
	}

	function sbfp_form1()
	{
		$result['title'] = "Master List Beneficiaries for School-Based Feeding Program SBFP(SY date)";
		$result['sbf'] = $this->Common->one_cond('sbfp_data', 'schoolID', $this->session->c_id);


		$this->load->view('sbfp_form1', $result);
	}

	function sbfp_form2()
	{
		$result['title'] = "Master List Beneficiaries for School-Based Feeding Program SBFP(SY date)";
		$result['sbf'] = $this->Common->one_cond('sbfp_data', 'schoolID', $this->session->c_id);

		$this->load->view('sbfp_form2', $result);
	}

	function sbfp_form3()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['sbf'] = $this->Common->one_cond('sbfp_data', 'schoolID', $this->session->c_id);

		$this->load->view('sbfp_form3', $result);
	}

	function sbm()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['sbm'] = $this->Common->no_cond('sbm_indicator');

		if ($this->input->post('submit')) {
			$this->SGODModel->sbm_insert();
			redirect(base_url() . 'Page/sbm');
		}

		$this->load->view('sbm_indecator', $result);
	}

	function sbm_edit()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['sbm'] = $this->Common->one_cond_row('sbm_indicator', 'id', $this->uri->segment(3));

		if ($this->input->post('submit')) {
			$this->SGODModel->sbm_update();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/sbm');
		}

		$this->load->view('sbm_indecator_edit', $result);
	}

	function sbm_sub()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['sbm'] = $this->Common->no_cond('sbm_indicator');
		$result['sbm_sub'] = $this->Common->no_cond('sbm_sub_indicator');

		if ($this->input->post('submit')) {
			$this->SGODModel->sbm_sub_insert();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/sbm_sub');
		}


		$this->load->view('sbm_indecator_sub', $result);
	}

	function sbm_sub_edit()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['sbm'] = $this->Common->no_cond('sbm_indicator');
		$result['sbm_sub'] = $this->Common->one_cond_row('sbm_sub_indicator', 'id', $this->uri->segment(3));

		if ($this->input->post('submit')) {
			$this->SGODModel->sbm_sub_update();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/sbm_sub');
		}


		$this->load->view('sbm_indecator_sub_edit', $result);
	}

	function sbm_checklist()
	{
		$ap = $this->Common->two_cond_count_row('sgod_action_plan', 'school_id', $this->session->username, 'fy', $_SESSION['sbm_fy']);
		if ($ap->num_rows() <= 0) {
			redirect(base_url() . 'Page/sbm_action_plan');
		}

		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['sbm'] = $this->Common->no_cond('sbm_indicator');
		$result['sbm_sub'] = $this->Common->no_cond('sbm_sub_indicator');
		$school = $this->Common->one_cond_row('schools', 'schoolID', $this->session->username);
		$result['district'] = $this->Common->one_cond_row('district', 'discription', $school->district);

		$result['sbmc'] = $this->Common->one_cond_row('sbm', 'school_id', $this->session->username);
		$sbm = $this->Common->two_cond_count_row('sbm', 'school_id', $this->session->username, 'fy', $_SESSION['sbm_fy']);
		if ($sbm->num_rows() <= 0) {

			if ($this->input->post('submit')) {
				$this->SGODModel->sbm_cecklist_insert();
				$this->session->set_flashdata('success', 'Saved successfully.');
				redirect(base_url() . 'Page/sbm_checklist');
			}
			$this->load->view('sbm_form', $result);
		} else {

			$this->load->view('sbm_form_edit', $result);
		}
	}

	function sbm_checklist_final()
	{
		$this->SGODModel->sbm_cecklist_lock_unloc(1);
		$this->session->set_flashdata('success', 'Saved successfully.');
		redirect(base_url() . 'Page/sbm_checklist');
	}

	function sbm_checklist_unlock()
	{
		$this->SGODModel->sbm_cecklist_lock_unloc(0);
		$this->session->set_flashdata('success', 'Saved successfully.');
		redirect(base_url() . 'Page/checklist_district/' . $this->uri->segment(4));
	}

	function checklist_district()
	{

		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['sbm'] = $this->Common->no_cond('sbm_indicator');
		$result['sbm_sub'] = $this->Common->no_cond('sbm_sub_indicator');

		$school = $this->Common->one_cond_row('schools', 'schoolID', $this->uri->segment(3));
		$result['district'] = $this->Common->one_cond_row('district', 'discription', $school->district);


		$result['sbmc'] = $this->Common->two_cond_row('sbm', 'school_id', $this->uri->segment(3), 'fy',$_SESSION['sbm_fy']);
		$sbm = $this->Common->two_cond_count_row('sbm', 'school_id', $this->uri->segment(3), 'fy', $_SESSION['sbm_fy']);

		$this->load->view('sbm_form_edit', $result);
	}

	function sbm_checklist_edit()
	{
		$this->SGODModel->sbm_cecklist_update();
		$this->session->set_flashdata('success', 'Saved successfully.');
		redirect(base_url() . 'Page/sbm_checklist');
	}

	public function delete_sbm()
	{
		$this->Common->del('sbm_indicator', 'id', $this->uri->segment(3));
		$this->Page_model->insert_at('Deleted SBM Principles', $this->uri->segment(3));
		$this->session->set_flashdata('danger', 'Deleted successfully!');
		redirect('Page/sbm');
	}

	public function delete_sbm_sub()
	{
		$this->Common->del('sbm_sub_indicator', 'id', $this->uri->segment(3));
		$this->Page_model->insert_at('Deleted SBM Indicator', $this->uri->segment(3));
		$this->session->set_flashdata('danger', 'Deleted successfully!');
		redirect('Page/sbm_sub');
	}

	function sbm_district_list()
	{
		$_SESSION['sbm_fy'] = $this->input->post('fy');
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$district = $this->Common->one_cond_row('district', 'id', $this->session->c_id);
		$result['school'] = $this->Common->one_cond('schools', 'district', $district->discription);
		$result['sbmc'] = $this->Common->one_cond_row('sbm', 'school_id', $this->session->username);


		// if ($this->input->post('submit')) {
		// 	$this->SGODModel->sbm_sub_insert();
		// 	$this->session->set_flashdata('success', 'Saved successfully.');
		// 	redirect(base_url() . 'Page/sbm_sub');
		// }

		$this->load->view('sbm_district', $result);
	}

	function sbm_schoo_list_admin()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$district = $this->Common->one_cond_row('district', 'id', $this->uri->segment(3));
		$result['school'] = $this->Common->one_cond('schools', 'district', $district->discription);
		$result['sbmc'] = $this->Common->one_cond_row('sbm', 'school_id', $this->session->username);


		if ($this->input->post('submit')) {
			$this->SGODModel->sbm_sub_insert();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/sbm_sub');
		}


		$this->load->view('sbm_district', $result);
	}



	function sbm_district_list_admin()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$district = $this->Common->one_cond_row('district', 'id', $this->uri->segment(3));
		//$result['school']=$this->Common->one_cond('schools','district',$district->discription);
		$result['school'] = $this->Common->one_cond('sbm_submitted', 'district_id', $this->uri->segment(3));

		if ($this->input->post('submit')) {
			$this->SGODModel->sbm_sub_insert();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/sbm_sub');
		}


		$this->load->view('sbm_district_admin', $result);
	}

	function sbm_district_list_admin_not()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$district = $this->Common->one_cond_row('district', 'id', $this->uri->segment(3));
		//$result['school']=$this->Common->one_cond('schools','district',$district->discription);
		$result['school'] = $this->Common->one_cond('sbm_submitted', 'district_id', $this->uri->segment(3));

		if ($this->input->post('submit')) {
			$this->SGODModel->sbm_sub_insert();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/sbm_sub');
		}


		$this->load->view('sbm_district_admin', $result);
	}

	function sbm_admin()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$district = $this->Common->one_cond_row('district', 'id', $this->session->c_id);
		$result['school'] = $this->Common->no_cond('schools');
		$result['sbmc'] = $this->Common->one_cond_row('sbm', 'school_id', $this->session->username);

		if ($this->input->post('submit')) {
			$this->SGODModel->sbm_sub_insert();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/sbm_sub');
		}

		$this->load->view('sbm_admin', $result);
	}

	function sbm_districts()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM - DISTRICT LIST";
		$district = $this->Common->one_cond_row('district', 'id', $this->session->c_id);
		$result['school'] = $this->Common->no_cond('schools');
		$result['sbmc'] = $this->Common->one_cond_row('sbm', 'school_id', $this->session->username);

		$result['district'] = $this->Common->no_cond('district');

		$this->load->view('sbm_district_list', $result);
	}

	function sbm_checklist_district()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['sbm'] = $this->Common->no_cond('sbm_indicator');
		$result['sbm_sub'] = $this->Common->no_cond('sbm_sub_indicator');

		$sbm = $this->Common->one_cond_count_row('sbm', 'school_id', $this->uri->segment(3));
		$result['sbmc'] = $this->Common->one_cond_row('sbm', 'school_id', $this->uri->segment(3));

		$result['sbmcr'] = $this->Common->one_cond_row('sbm_remark', 'school_id', $this->uri->segment(3));
		$sbmr = $this->Common->one_cond_count_row('sbm_remark', 'school_id', $this->uri->segment(3));


		if ($sbm->num_rows() <= 0) {
			$this->load->view('sbm_form', $result);
		} else {

			if ($sbmr->num_rows() <= 0) {

				$this->load->view('sbm_district_form', $result);
			} else {

				$this->load->view('sbm_district_form_edit', $result);
			}
		}


		if ($this->input->post('submit')) {
			$this->SGODModel->sbm_cecklist_district_insert();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/sbm_checklist');
		}
	}

	function tapr_form_district()
	{

		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['sbm'] = $this->Common->no_cond('sbm_indicator');
		$result['sbm_sub'] = $this->Common->no_cond('sbm_sub_indicator');

		if ($this->session->position == 'smme') {
			$sbm = $this->Common->two_cond_count_row('sbm_remark_admin', 'school_id', $this->uri->segment(3), 'fy', $_SESSION['sbm_fy']);
		} else {
			$sbm = $this->Common->two_cond_count_row('sbm_remark', 'school_id', $this->uri->segment(3), 'fy', $_SESSION['sbm_fy']);
		}

		//$result['sbmc'] = $this->Common->two_cond_row('sbm','school_id',$this->uri->segment(3),'fy',date('Y'));
		$result['sbm_ta'] = $this->Common->two_cond_row('sbm_ta', 'school_id', $this->uri->segment(3), 'fy', $_SESSION['sbm_fy']);
		$result['sbm_remark'] = $this->Common->two_cond_row('sbm_remark', 'school_id', $this->uri->segment(3), 'fy', $_SESSION['sbm_fy']);
		$result['sbm_remark_admin'] = $this->Common->two_cond_row('sbm_remark_admin', 'school_id', $this->uri->segment(3), 'fy', $_SESSION['sbm_fy']);
		$result['sbmc'] = $this->Common->two_cond_row('sbm_ta', 'school_id', $this->uri->segment(3), 'fy', $_SESSION['sbm_fy']);
		if ($sbm->num_rows() <= 0) {

			if ($this->input->post('submit')) {
				$this->SGODModel->sbm_ta_insert();
				$this->session->set_flashdata('success', 'Saved successfully.');
				redirect(base_url() . 'Page/tapr_form');
			}

			if ($this->session->position == 'smme') {
				$this->load->view('sbm_ta_admin', $result);
			} else {
				$this->load->view('sbm_ta_district', $result);
			}
		} else {
			if ($this->session->position == 'smme') {
				$this->load->view('sbm_ta_admin_update', $result);
			} else {
				$this->load->view('sbm_ta_district_update', $result);
			}
		}
	}



	function tapr_district()
	{
		$this->SGODModel->sbm_cecklist_district_insert();
		$this->session->set_flashdata('success', 'Saved successfully.');
		redirect(base_url() . 'Page/tapr_form_district/' . $this->input->post('school_id'));
	}

	function tapr_admin()
	{
		$this->SGODModel->sbm_cecklist_admin_insert();
		$this->session->set_flashdata('success', 'Saved successfully.');
		redirect(base_url() . 'Page/tapr_form_district/' . $this->input->post('school_id'));
	}

	function tapr_district_update()
	{
		$this->SGODModel->sbm_checklist_district_update();
		$this->session->set_flashdata('success', 'Saved successfully.');
		redirect(base_url() . 'Page/tapr_form_district/' . $this->input->post('school_id'));
	}

	function tapr_admin_update()
	{
		$this->SGODModel->sbm_checklist_admin_update();
		$this->session->set_flashdata('success', 'Saved successfully.');
		redirect(base_url() . 'Page/tapr_form_district/' . $this->input->post('school_id'));
	}

	function sbm_d_update()
	{
		$this->SGODModel->sbm_checklist_district_update();
		$this->session->set_flashdata('success', 'Saved successfully.');
		redirect(base_url() . 'Page/sbm_checklist_district/' . $this->input->post('school_id'));
	}

	function sbm_list()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['sbm'] = $this->Common->no_cond('sbm_indicator');
		$result['sbm_sub'] = $this->Common->no_cond('sbm_sub_indicator');

		$sbm = $this->Common->one_cond_count_row('sbm', 'school_id', $this->uri->segment(3));
		$result['sbmc'] = $this->Common->one_cond_row('sbm', 'school_id', $this->uri->segment(3));

		$result['sbmcr'] = $this->Common->one_cond_row('sbm_remark', 'school_id', $this->uri->segment(3));
		$sbmr = $this->Common->one_cond_count_row('sbm_remark', 'school_id', $this->uri->segment(3));


		$this->load->view('sbm_list', $result);
	}

	function sbm_rate_list()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['sbm'] = $this->Common->one_cond('sbm', $this->uri->segment(3), $this->uri->segment(4));


		$this->load->view('sbm_rate_list', $result);
	}

	function new_appointment()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['staff'] = $this->Common->one_cond_row('hris_staff', 'IDNumber', $this->uri->segment(3));


		$this->load->view('ass_letter', $result);
	}

	function new_appointment_order()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['staff'] = $this->Common->one_cond_row('hris_staff', 'IDNumber', $this->uri->segment(3));


		$this->load->view('ass_letter_order', $result);
	}

	function new_appointment_cs()
	{
		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['staff'] = $this->Common->one_cond_row('hris_staff', 'IDNumber', $this->uri->segment(3));


		$this->load->view('ass_letter_cs', $result);
	}

	function sbm_action_plan()
	{
		$data['title'] = "Action Plan";

		$_SESSION['sbm_fy'] = $this->input->post('fy');


		$data['data'] = $this->Common->two_cond('sgod_action_plan', 'school_id', $this->session->username,'fy',$_SESSION['sbm_fy']);
		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sbm_action_plan', $data);
	}

	function sbm_district_tech()
	{
		$data['title'] = "Technical Assisstance Provision Form";


		$data['data'] = $this->Common->one_cond('sbm_tech', 'district', $this->session->c_id);
		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sbm_district_tech', $data);
	}

	function sbm_district_tech_admin()
	{



		$data['data'] = $this->Common->one_cond('sbm_tech', 'district', $this->uri->segment(3));
		$d = $this->Common->one_cond_row('district', 'id', $this->uri->segment(3));
		$data['title'] = "Technical Assisstance Provision - " . $d->discription;
		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sbm_district_tech', $data);
	}

	function sbm_district_tech_new()
	{
		$data['title'] = "Technical Assisstance Provision Form";


		if ($this->input->post('submit')) {
			$this->SGODModel->sbm_tech_insert();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/sbm_district_tech');
		}

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sbm_district_tech_new', $data);
	}

	function sbm_district_tech_edit()
	{
		$data['title'] = "Technical Assisstance Provision Form";

		$data['data'] = $this->Common->one_cond_row('sbm_tech', 'id', $this->uri->segment(3));

		if ($this->input->post('submit')) {
			$this->SGODModel->sbm_tech_update();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/sbm_district_tech');
		}

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sbm_district_tech_update', $data);
	}

	function sbm_action_plan_new()
	{
		$data['title'] = "Action Plan";


		if ($this->input->post('submit')) {
			$this->SGODModel->action_plan_insert();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/sbm_action_plan');
		}

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sbm_action_plan_new', $data);
	}

	function sbm_action_plan_edit()
	{
		$data['title'] = "Action Plan";

		$data['data'] = $this->Common->one_cond_row('sgod_action_plan', 'id', $this->uri->segment(3));


		if ($this->input->post('submit')) {
			$this->SGODModel->action_plan_update();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/sbm_action_plan');
		}

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sbm_action_plan_update', $data);
	}

	function sbm_action_plan_del()
	{
		$this->Common->delete('sgod_action_plan', 'id', 3);
		$this->session->set_flashdata('danger', 'Saved successfully.');
		redirect(base_url() . 'Page/sbm_action_plan');
	}

	function sbm_district_tech_del()
	{
		$this->Common->delete('sbm_tech', 'id', 3);
		$this->session->set_flashdata('danger', 'Saved successfully.');
		redirect(base_url() . 'Page/sbm_district_tech');
	}

	function sbm_action_plan_pview()
	{

		$data['school'] = $this->Common->one_cond_row('schools', 'schoolID', $this->session->username);
		$data['data'] = $this->Common->two_cond('sgod_action_plan', 'fy', $_SESSION['sbm_fy'], 'school_id', $this->session->username);

		$this->load->view('sbm_action_plan_pview', $data);
	}

	function sbm_action_plan_pview_district()
	{

		$data['school'] = $this->Common->one_cond_row('schools', 'schoolID', $this->uri->segment(3));
		$data['data'] = $this->Common->two_cond('sgod_action_plan', 'fy', $_SESSION['sbm_fy'], 'school_id', $this->uri->segment(3));

		$this->load->view('sbm_action_plan_pview', $data);
	}

	function tapr_form()
	{
		$ap = $this->Common->two_cond_count_row('sbm', 'school_id', $this->session->username, 'fy', $_SESSION['sbm_fy']);
		if ($ap->num_rows() <= 0) {
			redirect(base_url() . 'Page/sbm_checklist');
		}

		$result['title'] = "SCHOOL-BASED FEEDING PROGRAM";
		$result['sbm'] = $this->Common->no_cond('sbm_indicator');
		$result['sbm_sub'] = $this->Common->no_cond('sbm_sub_indicator');

		$school = $this->Common->one_cond_row('schools', 'schoolID', $this->session->username);
		$result['district'] = $this->Common->one_cond_row('district', 'discription', $school->district);

		$sbm = $this->Common->two_cond_count_row('sbm_ta', 'school_id', $this->session->username, 'fy', $_SESSION['sbm_fy']);
		$result['sbmc'] = $this->Common->two_cond_row('sbm_ta', 'school_id', $this->session->username, 'fy', $_SESSION['sbm_fy']);
		if ($sbm->num_rows() <= 0) {

			if ($this->input->post('submit')) {
				$this->SGODModel->sbm_ta_insert();
				$this->session->set_flashdata('success', 'Saved successfully.');
				redirect(base_url() . 'Page/tapr_form');
			}
			$this->load->view('sbm_ta', $result);
		} else {

			$this->load->view('sbm_ta_update', $result);
		}
	}

	function sbm_ta_final()
	{
		$this->SGODModel->sbm_ta_lock_unloc(1);
		$this->session->set_flashdata('success', 'Saved successfully.');
		redirect(base_url() . 'Page/tapr_form');
	}

	function sbm_ta_unlock()
	{
		$this->SGODModel->sbm_ta_lock_unloc(0);
		$this->session->set_flashdata('success', 'Saved successfully.');
		redirect(base_url() . 'Page/tapr_form_district/' . $this->uri->segment(4));
	}

	function ta_form_edit()
	{
		$this->SGODModel->sbm_ta_update();
		$this->session->set_flashdata('success', 'Saved successfully.');
		redirect(base_url() . 'Page/tapr_form');
	}

	function tapr_form_new()
	{
		$data['title'] = "TECHNICAL ASSISSTANCE PROVISION REPORT FORM";


		if ($this->input->post('submit')) {
			$this->SGODModel->tapr_insert();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/tapr_form');
		}

		$data['indicator'] = $this->Common->no_cond('sbm_indicator');

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sbm_tapr_new', $data);
	}

	function tapr_form_edit()
	{
		$data['title'] = "TECHNICAL ASSISSTANCE PROVISION REPORT FORM";

		$data['data'] = $this->Common->one_cond_row('sgod_sbm_tapr', 'id', $this->uri->segment(3));


		if ($this->input->post('submit')) {
			$this->SGODModel->tapr_update();
			$this->session->set_flashdata('success', 'Saved successfully.');
			redirect(base_url() . 'Page/tapr_form');
		}

		$data['indicator'] = $this->Common->no_cond('sbm_indicator');

		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('sbm_tapr_update', $data);
	}
	function tapr_form_del()
	{
		$this->Common->delete('sgod_sbm_tapr', 'id', 3);
		$this->session->set_flashdata('danger', 'Saved successfully.');
		redirect(base_url() . 'Page/tapr_form');
	}

	function lv()
	{
		$data['title'] = "Action Plan";
		$data['acc_name'] = $this->Common->no_cond('sgod_liq_acc_name');

		$data['data'] = $this->Common->one_cond('sgod_action_plan', 'school_id', $this->session->username);
		$this->load->view('templates/head');
		$this->load->view('templates/header');
		$this->load->view('lv', $data);
	}

	function sbcp_list()
	{
		$result['title'] = "School-Based Child Protection Committee Functionality Indicators Monitoring Tool";
		$result['sbcp'] = $this->Common->no_cond('sbcp_indicators');

		$school = $this->Common->one_cond_row('schools', 'schoolID', $this->session->username);
		$result['district'] = $this->Common->one_cond_row('district', 'discription', $school->district);

		$result['sbcpl'] = $this->Common->one_cond_row('sbcp', 'school_id', $this->session->username);
		$sbcpl = $this->Common->two_cond_count_row('sbcp', 'school_id', $this->session->username, 'fy', date('Y'));
		if ($sbcpl->num_rows() <= 0) {

			if ($this->input->post('submit')) {
				$this->SGODModel->sbcp_insert();
				$this->session->set_flashdata('success', 'Saved successfully.');
				redirect(base_url() . 'Page/sbcp_list');
			}
			$this->load->view('sbcp_rate_list', $result);
		} else {

			$this->load->view('sbcp_rate_list_edit', $result);
		}
	}

	function sbcp_list_edit()
	{
		$this->SGODModel->sbcp_update();
		$this->session->set_flashdata('success', 'Saved successfully.');
		redirect(base_url() . 'Page/sbcp_list');
	}

	public function memo()
	{
		$data['title'] = "Memo List";
		$data['m_title'] = "Add New Memo";
		$data['e_title'] = "Update Memo";
		$data['add_action'] = "memo";

		$data['page'] = $this->SGODModel->get_all_orderby('sgod_memo', 'id', 'DESC');
		$data['ln'] = $this->SGODModel->get_last_record('sgod_memo');

		$id = $this->input->post('id');

		if ($id) {
			$data['data'] = $this->SGODModel->get_memo_by_id($id);
		}

		$this->load->view('sgod_memo', $data);

		if ($this->input->post('submit')) {
			$mn = $this->input->post('memoNo');
			$check = $this->SGODModel->one_cond_count('sgod_memo', 'memoNo', $mn);

			if ($check->num_rows() <= 0) {
				$config['allowed_types'] = 'pdf';
				$config['upload_path'] = './uploads/sgod_memo/';
				$this->load->library('upload', $config);
				$this->upload->do_upload('file');
				$this->SGODModel->insert_memo();
				$this->session->set_flashdata('success', 'Successfully saved.');
				redirect(base_url() . 'Page/memo');
			} else {
				$this->session->set_flashdata('danger', 'Duplicate Memo Number.');
				redirect(base_url() . 'Page/memo');
			}
		}
	}

	public function memo_update()
	{
		$data['title'] = "Memo List";
		$data['add_action'] = "memo_update";

		$data['data'] = $this->SGODModel->one_cond_row('sgod_memo', 'id', $this->uri->segment(3));

		$this->load->view('memo_edit', $data);

		if ($this->input->post('submit')) {
			$this->SGODModel->memo_update();
			$this->session->set_flashdata('success', 'Successfully saved.');
			redirect(base_url() . 'Page/memo');
		}
	}

	public function memo_file_update()
	{
		$data['title'] = "Memo List";
		$data['m_title'] = "Add New Memo";
		$data['e_title'] = "Update Memo";
		$data['add_action'] = "memo_file_update";

		$data['data'] = $this->SGODModel->one_cond_row('sgod_memo', 'id', $this->uri->segment(3));
		$this->load->view('memo_file_edit', $data);

		if ($this->input->post('submit')) {
			$config['allowed_types'] = 'pdf';
			$config['upload_path'] = './upload/sgod_memo/';
			$this->load->library('upload', $config);
			$this->upload->do_upload('file');
			$this->SGODModel->mfu();
			$this->session->set_flashdata('success', 'Successfully saved.');
			redirect(base_url() . 'Page/memo');
		}
	}

	public function memo_delete()
	{
		$id = $this->input->get('id');
		$this->SGODModel->delete(3, 'id', 'sgod_memo');
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect("Page/memo");
	}
}
