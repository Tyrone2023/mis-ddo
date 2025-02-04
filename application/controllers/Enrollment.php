<?php
class Enrollment extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('PersonnelModel');
		$this->load->helper('url');
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->model('StudentModel');
		$this->load->model('SettingsModel');

		if ($this->session->userdata('logged_in') !== TRUE) {
			redirect('login');
		}
	}

	//Profile List
	function profileList()
	{
		$result['data'] = $this->StudentModel->getProfile();
		$this->load->view('profile_list', $result);
	}

	function profileEntry()
	{
		$data['ethnicity'] = $this->SettingsModel->get_ethnicity();
		$data['religion'] = $this->SettingsModel->get_religion();
		$data['prevschool'] = $this->SettingsModel->get_prevschool();

		$this->load->view('profile_form', $data);  // Pass the data to the view


		if ($this->input->post('submit')) {
			// Get and format data from the form
			$data = [
				'StudentNumber' => $this->input->post('StudentNumber'),
				'LRN' => $this->input->post('LRN'),
				'FirstName' => strtoupper($this->input->post('FirstName')),
				'MiddleName' => strtoupper($this->input->post('MiddleName')),
				'LastName' => strtoupper($this->input->post('LastName')),
				'nameExt' => $this->input->post('nameExt'),
				'Sex' => $this->input->post('Sex'),
				'CivilStatus' => $this->input->post('CivilStatus'),
				'Citizenship' => $this->input->post('Citizenship'),
				'BloodType' => $this->input->post('BloodType'),
				'Religion' => $this->input->post('Religion'),
				'BirthPlace' => $this->input->post('BirthPlace'),
				'BirthDate' => $this->input->post('BirthDate'),
				'Age' => $this->input->post('Age'),
				'Ethnicity' => $this->input->post('Ethnicity'),
				'Elementary' => $this->input->post('Elementary'),


				'TelNumber' => $this->input->post('TelNumber'),
				'MobileNumber' => $this->input->post('MobileNumber'),
				'EmailAddress' => $this->input->post('EmailAddress'),
				'Province' => $this->input->post('Province'),
				'City' => $this->input->post('City'),
				'Brgy' => $this->input->post('Brgy'),
				'Sitio' => $this->input->post('Sitio'),
				'Guardian' => $this->input->post('Guardian'),
				'GuardianContact' => $this->input->post('GuardianContact'),
				'GuardianAddress' => $this->input->post('GuardianAddress'),
				'GuardianRelationship' => $this->input->post('GuardianRelationship'),
				'GuardianTelNo' => $this->input->post('GuardianTelNo'),
				'guardianOccupation' => $this->input->post('guardianOccupation'),
				'Father' => $this->input->post('Father'),
				'FOccupation' => $this->input->post('FOccupation'),

				'fContactNo' => $this->input->post('fContactNo'),
				'mContactNo' => $this->input->post('mContactNo'),

				'Mother' => $this->input->post('Mother'),
				'MOccupation' => $this->input->post('MOccupation'),

				'Notes' => $this->input->post('Notes'),


			];

			$completeName = $data['FirstName'] . ' ' . $data['LastName'];
			$Encoder = $this->session->userdata('username');
			// $AdmissionDate = date("Y-m-d");
			// $GraduationDate = date("Y-m-d");
			$Password = sha1($data['BirthDate']);
			$now = date('H:i:s A');

			// Check if record exists
			$exists = $this->db->where('StudentNumber', $data['StudentNumber'])->count_all_results('studeprofile');
			if ($exists) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Student Number is in use.</b></div>');
				redirect('Page/profileList');
			} else {
				// Save profile
				$this->db->insert('studeprofile', array_merge($data, [
					'Encoder' => $Encoder,
					// 'AdmissionDate' => $AdmissionDate,
					// 'GraduationDate' => $GraduationDate,
					'EmailAddress' => $data['EmailAddress'],
				]));

				$this->db->insert('o_users', [
					'username' => $data['StudentNumber'],
					'password' => $Password,
					'position' => 'Student',
					'fName' => $data['FirstName'],
					'mName' => $data['MiddleName'],
					'lName' => $data['LastName'],
					'email' => $data['EmailAddress'],
					'avatar' => 'avatar.png',
					'acctStat' => 'active',
					'dateCreated' => date("Y-m-d"),
					'IDNumber' => $data['StudentNumber'],
				]);

				$fullName = $data['FirstName'] . ' ' . $data['MiddleName'] . ' ' . $data['LastName'];

				// Log to the activity trail with the student's full name
				$this->db->insert('atrail', [
					'atDesc' => 'Created profile and user account for ' . $fullName,  // Include student's name in atDesc
					'atDate' => date("Y-m-d"),
					'atTime' => $now,
					'atRes' => $Encoder,
					'atSNo' => $data['StudentNumber'],
				]);

				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Profile has been saved successfully.</b></div>');

				// Email Notification
				$this->load->config('email');
				$this->load->library('email');

				$mail_message = 'Dear ' . $data['FirstName'] . ',<br><br>Your profile is now encoded to SRMS. Please take note of the following:<br>';
				$mail_message .= 'Username: <b>' . $data['StudentNumber'] . '</b><br>Password: <b>' . $data['BirthDate'] . '</b><br><br>Thanks & Regards,<br>SRMS - Online';

				$this->email->from('no-reply@srmsportal.com', 'SRMS Online Team')
					->to($data['EmailAddress'])
					->subject('Account Created')
					->message($mail_message)
					->send();

				redirect('Page/profileList');
			}
		}
	}
}
