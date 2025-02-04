<?php

class Pages extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');


        $this->load->model('PersonnelModel');
    }


    public function view(){
        if($this->session->position == 'smme'){
            
            $page = "dashboard_smme";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['title'] = "Company List";
            $data['pn'] = "Company";
            $data['link'] = "company_new";


            $result['data'] = $this->Page_model->count_all('hris_staff');
            $result['sub'] = $this->SGODModel->two_cond_count_rows('sgod_aip_submit','fy', '2024','status',0);
            $result['ap'] = $this->SGODModel->two_cond_count_rows('sgod_aip_submit','fy', '2024','status',1);
            $result['req'] = $this->SGODModel->two_cond_count_rows('sgod_aip_request', 'fy', '2024','stat',0);



            $this->load->view('templates/head');
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $result);
            $this->load->view('templates/modal');
            $this->load->view('templates/footer');

        }elseif($this->session->position == 'Accountant'){
            
            $page = "dashboard_smme";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['title'] = "Company List";
            $data['pn'] = "Company";
            $data['link'] = "company_new";


            $result['data'] = $this->Page_model->count_all('hris_staff');
            $result['sub'] = $this->SGODModel->two_cond_count_rows('sgod_aip_submit','fy', '2024','status',0);
            $result['ap'] = $this->SGODModel->two_cond_count_rows('sgod_aip_submit','fy', '2024','status',1);
            $result['req'] = $this->SGODModel->two_cond_count_rows('sgod_aip_request', 'fy', '2024','stat',0);
            $result['last'] = $this->SGODModel->get_last_record('sgod_school_allocation');



            $this->load->view('templates/head');
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $result);
            $this->load->view('templates/modal');
            $this->load->view('templates/footer');

        }else{
            $page = "dashboard";

            if ($this->session->userdata('position') === 'Admin') {
            } elseif ($this->session->userdata('position') === 'Super Admin') {
            } elseif ($this->session->userdata('position') === 'Staff') {
            } elseif ($this->session->userdata('position') === 'smme') {
            } else {
                $this->Page_model->check_ownership($param);
            }

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['title'] = "Company List";
            $data['pn'] = "Company";
            $data['link'] = "company_new";


            $result['data'] = $this->Page_model->count_all('hris_staff');
            $result['data1'] = $this->Page_model->count_inactive('hris_staff');
            $result['data2'] = $this->Page_model->count_teaching('hris_staff');
            $result['data3'] = $this->Page_model->count_nonteaching('hris_staff');
            $result['data4'] = $this->Page_model->count_for_approval_leave('hris_leave');



            $this->load->view('templates/head');
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $result);
            $this->load->view('templates/modal');
            $this->load->view('templates/footer');
        }
    }


    public function view_user()
    {
        $page = "dashboard_user";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Company List";
        $data['pn'] = "Company";
        $data['link'] = "company_new";

        $empEmail = $this->session->userdata('username');
        $result['data1'] = $this->Page_model->countvacancy('hris_jobvacancy');
        $result['data2'] = $this->Page_model->countapplications('hris_applications', $empEmail);

        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $result);
        $this->load->view('templates/modal');
        $this->load->view('templates/footer');
    }

    public function view_employee()
    {
        $page = "dashboard_employee";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Company List";
        $data['pn'] = "Company";
        $data['link'] = "company_new";

        $empEmail = $this->session->userdata('username');
        $result['data1'] = $this->Page_model->countTrainingNeeds('hris_training_needs', $empEmail);
        $result['data2'] = $this->Page_model->countTrainingDevt('hris_ind_devt', $empEmail);
        $result['data3'] = $this->Page_model->vlCount($empEmail);
        $result['data4'] = $this->PersonnelModel->announcements_post();

        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $result);
        $this->load->view('templates/modal');
        $this->load->view('templates/footer');
    }

    public function users()
    {
        $page = "user_list";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "User's List";
        $data['pn'] = "Add New User";
        $data['link'] = "user_add";
        
        if($this->session->position == 'Super Admin'){
            $data['users'] = $this->Page_model->get_posts('users');
        }else{
            $data['users'] = $this->Page_model->get_post_except('users', 'position', 'Super Admin');  
        }
       

        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/modal_com');
        $this->load->view('templates/footer');
    }

    public function users_school()
    {
        $page = "user_list_school";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "User's List";
        $data['pn'] = "Add New User";
        $data['link'] = "user_add";
        $IDNumber = $this->session->userdata('username');
        $data['users'] = $this->Page_model->get_post_school('users', 'position', 'School', 'username', 'IDNumber');

        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/modal_com');
        $this->load->view('templates/footer');
    }

    public function user_add()
    {

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        ', '</div>');
        $this->form_validation->set_rules('Username', 'Username', 'required');

        if ($this->form_validation->run() == FALSE) {

            $page = "user_new";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['users'] = $this->Page_model->get_post_except_group_by('users', 'position', 'Super Admin');
            $data['title'] = "Add New User";

            $this->load->view('templates/head');
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');
        } else {

            $this->Page_model->insert_user();
            $this->Page_model->insert_at('Add New user id number ' . $this->db->insert_id());
            $this->session->set_flashdata('success', ' New User Added.');
            redirect(base_url() . 'users');
        }
    }

    public function user_add2()
    {

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        ', '</div>');
        $this->form_validation->set_rules('Username', 'Username', 'required');

        if ($this->form_validation->run() == FALSE) {

            $page = "user_new";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['users'] = $this->Page_model->get_post_except_group_by('users', 'position', 'Super Admin');
            $data['title'] = "Add New User";

            $this->load->view('templates/head');
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');
        } else {

            $this->Page_model->insert_user_2();
            $this->Page_model->insert_at('Add New user id number ' . $this->db->insert_id());
            $this->session->set_flashdata('success', ' New User Added.');
            redirect(base_url() . 'users');
        }
    }

    public function user_edit($param)
    {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('position', 'position', 'required');

        if ($this->form_validation->run() == FALSE) {

            $page = "user_update";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['title'] = "Edit User";

            $data['users'] = $this->Page_model->get_post_except_group_by('users', 'position', 'Super Admin');
            $data['user'] = $this->Page_model->get_single_table_by_id('users', 'id', $param);
            $data['id'] = $data['user']['id'];
            $data['username'] = $data['user']['username'];
            $data['position'] = $data['user']['position'];
            $data['fname'] = $data['user']['fname'];
            $data['mname'] = $data['user']['mname'];
            $data['lname'] = $data['user']['lname'];
            $data['se'] = $data['user']['sex'];
            $data['address'] = $data['user']['address'];

            $this->load->view('templates/head');
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');
        } else {

            $this->Page_model->update_user();
            $this->Page_model->insert_at('Updated User id number ' . $param);
            $this->session->set_flashdata('save', 'Selected user was updated');
            redirect(base_url() . 'users');
        }
    }
    public function user_delete($param)
    {
        $this->Page_model->delete('2', 'id', 'users');
        $this->Page_model->insert_at('Deleted user id number ' . $param);
        $this->session->set_flashdata('danger', ' User account was deleted.');
        redirect(base_url() . 'users');
    }

    public function personel_del()
    {
        $id = $this->input->get('id');
        $this->db->query("delete from hris_staff where IDNumber='" . $id . "'");
        $this->Page_model->insert_at('Deleted user id number ' . $id);
        $this->session->set_flashdata('danger', 'Deleted successfully!');
        redirect(base_url() . 'personnel');
    }

    public function personnel()
    {

        $page = "personel_list";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Personnel List";
        $data['pn'] = "Add New";
        $data['link'] = "personel_add";
        $data['personel'] = $this->Page_model->get_limited_col('hris_staff', '*');
        // $data['personel'] = $this->Page_model->get_limited_col('hris_staff', 'FirstName,MiddleName,LastName,IDNumber,empPosition,Department, currentStatus');


        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }


    public function personnel_teaching()
    {

        $page = "personel_list_v2";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Personnel List";
        $data['pn'] = "Teaching Personnel";
        // $data['link'] = "personel_add";
        $data['personel'] = $this->Page_model->get_limited_col_con('hris_staff', 'FirstName,MiddleName,LastName,IDNumber,empPosition,Department', 'Teaching');


        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function personnel_nonteaching()
    {

        $page = "personel_list_v2";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Personnel List";
        $data['pn'] = "Non-Teaching Personnel";
        // $data['link'] = "personel_add";
        $data['personel'] = $this->Page_model->get_limited_col_con('hris_staff', 'FirstName,MiddleName,LastName,IDNumber,empPosition,Department', 'Non-Teaching');


        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function ntp()
    {

        $page = "personel_list_v2";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Personnel List";
        $data['pn'] = "Non-Teaching Personnel";
        // $data['link'] = "personel_add";
        $data['personel'] = $this->Page_model->empGroup('hris_staff', 'FirstName,MiddleName,LastName,IDNumber,empPosition,Department', 'Non-Teaching');


        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function tp()
    {

        $page = "personel_list_v2";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Personnel List";
        $data['pn'] = "Teaching Personnel";
        // $data['link'] = "personel_add";
        $data['personel'] = $this->Page_model->empGroup('hris_staff', 'FirstName,MiddleName,LastName,IDNumber,empPosition,Department', 'Teaching');


        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }


    public function personnel_inactive()
    {

        $page = "personel_list_v2";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Personnel List";
        $data['pn'] = "Inactive Personnel";
        // $data['link'] = "personel_add";
        $data['personel'] = $this->Page_model->get_limited_col_con2('hris_staff', 'FirstName,MiddleName,LastName,IDNumber,empPosition,Department', 'Active');


        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function school_inactive()
    {
        $page = "personel_list_inactive";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Personnel List (INACTIVE)";
        // $data['pn'] = "Inactive Personnel";
        // $data['link'] = "personel_add";
        $data['personel'] = $this->Page_model->school_inactive('hris_staff', 'FirstName,MiddleName,LastName,IDNumber,empPosition,Department, currentStatus', 'Active');


        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function personel_add()
    {

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        ', '</div>');
        $this->form_validation->set_rules('IDNumber', 'IDNumber', 'required');

        if ($this->form_validation->run() == FALSE) {

            $page = "personel_new";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['users'] = $this->Page_model->get_post_except_group_by('users', 'position', 'Super Admin');
            $data['title'] = "Add New Employee";

            $this->load->view('templates/head');
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');
        } else {

            $this->Page_model->insert_profile();
            $this->Page_model->insert_user();
            $this->Page_model->insert_at('Added new employee profile id number ' . $this->db->insert_id());
            $this->session->set_flashdata('success', ' New employee added successfully.');
            redirect(base_url() . 'personnel');
        }
    }

    public function personnel_profile($param)
    {

        $page = "profile";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Profile";
        $data['user'] = $this->Page_model->get_single_table_by_id('hris_staff', 'IDNumber', $param);
        $data['c_user'] = $this->Page_model->get_single_table_by_id('users', 'user_id', $param);
        $data['awards'] = $this->Page_model->get_posts_by_col('hris_awards', 'IDNumber', $param);
        $data['files'] = $this->Page_model->get_posts_by_col('hris_files', 'IDNumber', $param);
        $data['trainings'] = $this->Page_model->get_posts_by_col('hris_trainings', 'IDNumber', $param);
        $data['educ'] = $this->Page_model->get_posts_by_col('hris_educ', 'IDNumber', $param);
        $data['family'] = $this->Page_model->get_posts_by_col('hris_family', 'IDNumber', $param);
        $data['employment'] = $this->Page_model->get_posts_by_col('hris_employment', 'IDNumber', $param);
        $data['ipcr'] = $this->Page_model->get_posts_by_col('hris_ipcr', 'IDNumber', $param);

        $data['users'] = $this->Page_model->get_row_data('users', 'username', $param);

        $data['c_id'] = $data['c_user']['user_id'];
        $data['image'] = $data['c_user']['image'];

        if ($this->session->userdata('position') === 'Admin') :
            $data['id'] = $data['user']['IDNumber'];
            $data['c_id'] = $data['c_user']['user_id'];

        elseif ($this->session->userdata('position') === 'School') :
            $data['id'] = $data['user']['IDNumber'];
            $data['c_id'] = $data['c_user']['user_id'];

        elseif ($this->session->userdata('position') === 'Super Admin') :
            $data['id'] = $data['user']['IDNumber'];
            $data['c_id'] = $data['c_user']['user_id'];

        elseif ($this->session->userdata('position') === 'Staff') :
            $data['id'] = $data['user']['IDNumber'];
            $data['c_id'] = $data['c_user']['user_id'];
        elseif ($this->session->userdata('position') === 'user') :
            $data['id'] = $this->session->userdata('username');
            $data['c_id'] = $this->session->userdata('username');
        endif;

        $data['FirstName'] = $data['user']['FirstName'];
        $data['MiddleName'] = $data['user']['MiddleName'];
        $data['LastName'] = $data['user']['LastName'];
        $data['NameExtn'] = $data['user']['NameExtn'];
        $data['prefix'] = $data['user']['prefix'];
        $data['jobTitle'] = $data['user']['jobTitle'];
        $data['empPosition'] = $data['user']['empPosition'];
        $data['Department'] = $data['user']['Department'];
        $data['schoolID'] = $data['user']['schoolID'];
        $data['MaritalStatus'] = $data['user']['MaritalStatus'];
        $data['empStatus'] = $data['user']['empStatus'];
        $data['BirthDate'] = $data['user']['BirthDate'];
        $data['BirthPlace'] = $data['user']['BirthPlace'];
        $data['Sex'] = $data['user']['Sex'];
        $data['height'] = $data['user']['height'];
        $data['weight'] = $data['user']['weight'];
        $data['bloodType'] = $data['user']['bloodType'];
        $data['gsis'] = $data['user']['gsis'];
        $data['pagibig'] = $data['user']['pagibig'];
        $data['philHealth'] = $data['user']['philHealth'];
        $data['sssNo'] = $data['user']['sssNo'];
        $data['tinNo'] = $data['user']['tinNo'];
        $data['resHouseNo'] = $data['user']['resHouseNo'];
        $data['resStreet'] = $data['user']['resStreet'];
        $data['resVillage'] = $data['user']['resVillage'];
        $data['resBarangay'] = $data['user']['resBarangay'];
        $data['resCity'] = $data['user']['resCity'];
        $data['resProvince'] = $data['user']['resProvince'];
        $data['resZipCode'] = $data['user']['resZipCode'];
        $data['perHouseNo'] = $data['user']['perHouseNo'];
        $data['perStreet'] = $data['user']['perStreet'];
        $data['perVillage'] = $data['user']['perVillage'];
        $data['perBarangay'] = $data['user']['perBarangay'];
        $data['perCity'] = $data['user']['perCity'];
        $data['perProvince'] = $data['user']['perProvince'];
        $data['perZipCode'] = $data['user']['perZipCode'];
        $data['empTelNo'] = $data['user']['empTelNo'];
        $data['empMobile'] = $data['user']['empMobile'];
        $data['empEmail'] = $data['user']['empEmail'];
        $data['settingsID'] = $data['user']['settingsID'];
        $data['pronoun1'] = $data['user']['pronoun1'];
        $data['pronoun2'] = $data['user']['pronoun2'];
        $data['age'] = $data['user']['age'];
        $data['dateHired'] = $data['user']['dateHired'];
        $data['retirement'] = $data['user']['retirement'];
        $data['retYear'] = $data['user']['retYear'];
        $data['agencyCode'] = $data['user']['agencyCode'];
        $data['citizenship'] = $data['user']['citizenship'];
        $data['dualCitizenship'] = $data['user']['dualCitizenship'];
        $data['citizenshipType'] = $data['user']['citizenshipType'];
        $data['citizenshipCountry'] = $data['user']['citizenshipCountry'];
        $data['contactName'] = $data['user']['contactName'];
        $data['contactRel'] = $data['user']['contactRel'];
        $data['contactEmail'] = $data['user']['contactEmail'];
        $data['contactNo'] = $data['user']['contactNo'];
        $data['contactAddress'] = $data['user']['contactAddress'];
        $data['fb'] = $data['user']['fb'];
        $data['skype'] = $data['user']['skype'];
        $data['stationCode'] = $data['user']['staCode'];
        $data['umid'] = $data['user']['umid'];
        $data['csEligibility'] = $data['user']['csEligibility'];
        $data['csLevel'] = $data['user']['csLevel'];
        $data['currentStatus'] = $data['user']['currentStatus'];
        $data['YearsAsJO'] = $data['user']['YearsAsJO'];
        $data['workNature1'] = $data['user']['workNature1'];
        $data['workNature2'] = $data['user']['workNature2'];
        $data['employeeNo'] = $data['user']['employeeNo'];
        $data['itemNo'] = $data['user']['itemNo'];
        $data['sgNo'] = $data['user']['sgNo'];
        $data['authAnSalary'] = $data['user']['authAnSalary'];
        $data['actualSalary'] = $data['user']['actualSalary'];
        $data['stepNo'] = $data['user']['stepNo'];
        $data['origAppointmentDate'] = $data['user']['origAppointmentDate'];
        $data['lastAppointmentDate'] = $data['user']['lastAppointmentDate'];
        $data['serviceLenght'] = $data['user']['serviceLenght'];
        $data['payGroup'] = $data['user']['payGroup'];
        $data['payCat'] = $data['user']['payCat'];
        $data['workStat'] = $data['user']['workStat'];
        $data['staCode'] = $data['user']['staCode'];
        $data['lastUpdate'] = $data['user']['lastUpdate'];
        $data['updatedBy'] = $data['user']['updatedBy'];



        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/modal');
        $this->load->view('templates/footer');
    }

    public function del_ipcr($param)
    {
        $result['img'] = $this->Page_model->get_single_table_by_id("hris_ipcr", 'id', $param);
        $filename = $result['img']['fileName'];
        $id = $result['img']['IDNumber'];
        $this->Page_model->delete_group($param, $filename, 'ipcr', "hris_ipcr");
        $this->Page_model->insert_at('Delete uploaded IPCR. ' . $param);
        $this->session->set_flashdata('danger', ' IPCR deleted successfully!');
        redirect(base_url() . 'personnel_profile/' . $id);
    }

    public function del_sip($param)
    {
        $result['img'] = $this->Page_model->get_single_table_by_id("school_imp_plans", 'id', $param);
        $filename = $result['img']['fileAttachment'];
        $id = $result['img']['id'];
        $this->Page_model->delete_group($param, $filename, 'sip_files', "school_imp_plans");
        // $this->Page_model->insert_at('Delete uploaded IPCR. ' . $param);
        $this->session->set_flashdata('danger', ' Deleted successfully!');
        redirect(base_url() . 'page/view_sip/');
    }


    public function del_201($param)
    {
        $result['img'] = $this->Page_model->get_single_table_by_id("hris_files", 'id', $param);
        $filename = $result['img']['fileName'];
        $id = $result['img']['IDNumber'];
        $this->Page_model->delete_group($param, $filename, '201files', "hris_files");
        $this->Page_model->insert_at('Deleted 201 Files. ' . $param);
        $this->session->set_flashdata('danger', ' 201 File deleted successfully!');
        redirect(base_url() . 'personnel_profile/' . $id);
    }

    public function delete_employment()
    {
        $empID = $this->input->get('empID');
        $id = $this->input->get('id');
        $this->db->query("delete  from hris_employment where empID='" . $empID . "'");
        $this->session->set_flashdata('success', 'Deleted successfully!');
        redirect(base_url() . 'personnel_profile/' . $id);
    }

    public function delete_awards()
    {
        $awardsID = $this->input->get('awardsID');
        $id = $this->input->get('id');
        $this->db->query("delete  from hris_awards where id='" . $awardsID . "'");
        $this->session->set_flashdata('success', 'Deleted successfully!');
        redirect(base_url() . 'personnel_profile/' . $id);
    }

    public function delete_trainings()
    {
        $trainingID = $this->input->get('trainingID');
        $id = $this->input->get('id');
        $this->db->query("delete  from hris_trainings where trainingID='" . $trainingID . "'");
        $this->session->set_flashdata('success', 'Deleted successfully!');
        redirect(base_url() . 'personnel_profile/' . $id);
    }

    public function delete_education()
    {
        $educID = $this->input->get('educID');
        $id = $this->input->get('id');
        $this->db->query("delete  from hris_educ where educID='" . $educID . "'");
        $this->session->set_flashdata('success', 'Deleted successfully!');
        redirect(base_url() . 'personnel_profile/' . $id);
    }

    public function delete_family()
    {
        $famID = $this->input->get('famID');
        $id = $this->input->get('id');
        $this->db->query("delete  from hris_family where famID='" . $famID . "'");
        $this->session->set_flashdata('success', 'Deleted successfully!');
        redirect(base_url() . 'personnel_profile/' . $id);
    }

    public function twoOonefiles()
    {
        $config['allowed_types'] = 'jpg|pdf';
        $config['upload_path'] = './uploads/201files/';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('attachment')) {
            //$file = $this->upload->data();
            $id = $this->input->post('id');

            $this->Page_model->insert_201files();
            $this->Page_model->insert_at('Add new 201 file,  id number ' . $this->db->insert_id());
            $this->session->set_flashdata('success', '1 file uploaded successfully!');
            redirect(base_url() . 'personnel_profile/' . $id);
        } else {
            print_r($this->upload->display_errors());
        }
    }


    public function sip()
    {
        $config['allowed_types'] = 'pdf';
        $config['upload_path'] = './uploads/sip_files/';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('attachment')) {
            //$file = $this->upload->data();

            $this->Page_model->insert_sip();
            // $this->Page_model->insert_at('Add new 201 file,  id number ' . $this->db->insert_id());
            $this->session->set_flashdata('success', '1 file uploaded successfully!');
            redirect(base_url() . 'page/view_sip');
        } else {
            print_r($this->upload->display_errors());
        }
    }

    public function ipcr()
    {
        $config['allowed_types'] = 'pdf';
        $config['upload_path'] = './uploads/ipcr/';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('fileName')) {
            //$file = $this->upload->data();
            $id = $this->input->post('id');

            $this->Page_model->insert_ipcr();
            $this->Page_model->insert_at('Add new IPCR,  id number ' . $this->db->insert_id());
            $this->session->set_flashdata('success', '1 file uploaded successfully!');
            redirect(base_url() . 'personnel_profile/' . $id);
        } else {
            print_r($this->upload->display_errors());
        }
    }

    public function awards()
    {
        $id = $this->input->post('id');

        $this->Page_model->insert_awards();
        $this->session->set_flashdata('success', 'One record added successfully!');
        redirect(base_url() . 'personnel_profile/' . $id);
    }

    public function family()
    {
        $id = $this->input->post('id');

        $this->Page_model->insert_family();
        $this->session->set_flashdata('success', 'One record added successfully!');
        redirect(base_url() . 'personnel_profile/' . $id);
    }

    public function trainings()
    {
        $id = $this->input->post('id');

        $this->Page_model->insert_trainings();
        $this->session->set_flashdata('success', 'One record added successfully!');
        redirect(base_url() . 'personnel_profile/' . $id);
    }

    public function employment()
    {
        $id = $this->input->post('id');

        $this->Page_model->insert_employment();
        $this->session->set_flashdata('success', 'One record added successfully!');
        redirect(base_url() . 'personnel_profile/' . $id);
    }

    public function education()
    {
        $id = $this->input->post('id');

        $this->Page_model->insert_education();
        $this->session->set_flashdata('success', 'One record added successfully!');
        redirect(base_url() . 'personnel_profile/' . $id);
    }
    public function plantilla()
    {

        $page = "plantilla";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Plantilla Positions";
        $data['pn'] = "Add New";
        $data['link'] = "plantilla_add";
        $data['page'] = $this->Page_model->get_posts('hris_plantilla');

        $data['status'] = $this->Page_model->group_by_status('hris_plantilla');

        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/modal_com');
        $this->load->view('templates/footer');
    }
    public function items($param)
    {

        $page = "plantilla_items";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Plantilla List";
        $data['pn'] = "Add New";
        $data['link'] = "plantilla_add";
        $data['p'] = $param;
        $data['page'] = $this->Page_model->get_posts_by_col('hris_plantilla', 'status', $param);



        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/modal_com');
        $this->load->view('templates/footer');
    }

    public function mis_logs()
    {

        $page = "mis_logs";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "MIS Logs";
        $data['pn'] = "Add New";
        $data['link'] = "plantilla_add";
        // $data['p'] = $param;
        $data['page'] = $this->Page_model->get_posts('mis_logs');



        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/modal_com');
        $this->load->view('templates/footer');
    }

    public function plantilla_add()
    {

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        ', '</div>');
        $this->form_validation->set_rules('pGroup', 'Plantilla Group', 'required');
        //$this->form_validation->set_rules('termPeriodto', 'Term Period To', 'required');

        if ($this->form_validation->run() == FALSE) {

            $page = "plantilla_new";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['pgroup'] = $this->Page_model->get_post_group_by('hris_plantilla', 'pGroup');
            $data['itemNo'] = $this->Page_model->get_post_group_by('hris_plantilla', 'itemNo');
            $data['itemPosition'] = $this->Page_model->get_post_group_by('hris_plantilla', 'itemPosition');
            $data['title'] = "Add New User";
            $data['title'] = "Add New User";

            $this->load->view('templates/head');
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');
        } else {

            $this->Page_model->insert_plantilla();
            $this->Page_model->insert_at('Add New user id number ' . $this->db->insert_id());
            $this->session->set_flashdata('success', ' New User Save');
            redirect(base_url() . 'plantilla');
        }
    }
    public function plantilla_update($param)
    {

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        ', '</div>');
        $this->form_validation->set_rules('pGroup', 'Plantilla Group', 'required');

        if ($this->form_validation->run() == FALSE) {

            $page = "plantilla_edit";


            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['title'] = "Plantilla Update";
            $data['plantilla'] = $this->Page_model->get_single_table_by_id('hris_plantilla', 'id', $param);
            $data['id'] = $data['plantilla']['id'];
            $data['pGroup'] = $data['plantilla']['pGroup'];
            $data['itemNo'] = $data['plantilla']['itemNo'];
            $data['itemPosition'] = $data['plantilla']['itemPosition'];
            $data['sg'] = $data['plantilla']['sg'];
            $data['step'] = $data['plantilla']['step'];
            $data['authAnnualSalary'] = $data['plantilla']['authAnnualSalary'];

            $this->load->view('templates/head');
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');
        } else {
            $this->Page_model->update_plantilla();
            $last_id = $this->input->post('id');
            $this->Page_model->insert_at('Add New Plantilla id number ' . $last_id);
            $this->session->set_flashdata('success', 'Succesfully Updated.');
            redirect(base_url() . 'plantilla');
        }
    }
    public function plantilla_del($param)
    {
        $this->Page_model->delete('2', 'id', 'hris_plantilla');
        $this->Page_model->insert_at('Delete Plantilla id number ' . $param);
        $this->session->set_flashdata('danger', ' Plantilla deleted');
        redirect(base_url() . 'plantilla');
    }



    public function position()
    {

        $page = "ap";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Unfilled Items";
        if ($this->session->position != "Admin") {
            $data['page'] = $this->Page_model->get_table_by_col_group_by_param_by_two('hris_plantilla', 'status', 1, 'view_status', 1, 'itemPosition');
        } else {
            $data['page'] = $this->Page_model->get_table_by_col_group_by('hris_plantilla', 'status', 1, 'itemPosition');
        }
        $data['pos'] = $this->Page_model->position_count();

        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/modal_apply');
        $this->load->view('templates/footer');
    }
    public function view_status_unview($param)
    {
        $data['page'] = $this->Page_model->get_single_table_by_id('hris_plantilla', 'id', $param);
        $item = $data['page']['itemPosition'];

        $this->Page_model->update_view_status_unview($param, $item);
        $this->Page_model->insert_at('Update Plantilla id number ' . $param);
        $this->session->set_flashdata('success', ' View Status Updated');
        redirect(base_url() . 'position');
    }
    public function view_status_view($param)
    {
        $data['page'] = $this->Page_model->get_single_table_by_id('hris_plantilla', 'id', $param);
        $item = $data['page']['itemPosition'];

        $this->Page_model->update_view_status_view($param, $item);
        $this->Page_model->insert_at('Update Plantilla id number ' . $param);
        $this->session->set_flashdata('success', ' View Status Updated');
        redirect(base_url() . 'position');
    }

    public function reg()
    {

        $page = "registered";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Registered Applicant List";
        $data['pn'] = "New Applicant";
        $data['link'] = "reg_add";
        $data['registered'] = $this->Page_model->get_post_except('hris_registration', 'status', 1);

        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/modal_com');
        $this->load->view('templates/footer');
    }
    public function register()
    {

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        ', '</div>');
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        //$this->form_validation->set_rules('termPeriodto', 'Term Period To', 'required');

        if ($this->form_validation->run() == FALSE) {

            $page = "registration_new";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }
            $data['title'] = "Register";
            $data['count'] = $this->Page_model->get_single_table_by_id('count', 'id', 1);
            $data['per'] = $data['count']['number'];
            $data['per_id'] = $data['count']['id'];

            $this->load->view('pages/' . $page, $data);
        } else {

            $this->Page_model->insert_reg();
            $this->Page_model->insert_at('Add New user id number ' . $this->db->insert_id());
            $this->Page_model->update_count();
            $this->Page_model->insert_reg_user();

            //Email Notification
            $email = $this->input->post('email');
            $fname = $this->input->post('fname');
            $this->load->config('email');
            $this->load->library('email');
            $mail_message = 'Dear ' . $fname . ',' . "\r\n";
            $mail_message .= '<br><br>Your account has been created successfully.' . "\r\n";
            // $mail_message .= '<br>Course: <b>' . $Course . '</b>' ."\r\n";
            // $mail_message .= '<br>Major: <b>' . $Major . '</b>'."\r\n";
            // $mail_message .= '<br>Year Level: <b>' . $YearLevel . '</b>'."\r\n";
            // $mail_message .= '<br>Sem/SY: <b>' . $Semester . ', '. $SY .'</b>'."\r\n";
            // $mail_message .= '<br>Status: <b>For Validation</b>'."\r\n";

            // $mail_message .= '<br><br>You will be notified once validated.' ."\r\n";
            $mail_message .= '<br><br>Thanks & Regards,';
            $mail_message .= '<br>HRIS - Online';

            $this->email->from('no-reply@lxeinfotechsolutions.com', 'HRIS')
                ->to($email)
                ->subject('Account Created')
                ->message($mail_message);
            $this->email->send();


            $this->session->set_flashdata('danger', 'fdasdf fadfas');
            redirect(base_url());
        }
    }

    public function school($param)
    {

        $id = $this->session->userdata('username');
        $result['data'] = $this->Page_model->schoolInfo('schools', $id);
        $this->load->view('dashboard_school', $result);
    }

    public function registered_profile($param){

        $this->Page_model->check_ownership($param);

        $page = "profile_reg";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $res['page'] = $this->Page_model->get_single_row_by_id('settings', 'id', 2);
        $data['title'] = "Profile";
        $data['user'] = $this->Page_model->get_single_table_by_id('hris_applicant', 'id', $param);
        $data['c_user'] = $this->Page_model->get_single_table_by_id('users', 'user_id', $param);
        $data['awards'] = $this->Page_model->get_posts_by_col('hris_awards', 'IDNumber', $param);
        $data['files'] = $this->Page_model->get_posts_by_col('hris_files', 'IDNumber', $param);
        $data['trainings'] = $this->Page_model->get_posts_by_col('hris_trainings', 'IDNumber', $param);
        $data['educ'] = $this->Page_model->get_posts_by_col('hris_educ', 'IDNumber', $param);
        $data['family'] = $this->Page_model->get_posts_by_col('hris_family', 'IDNumber', $param);
        $data['employment'] = $this->Page_model->get_posts_by_col('hris_employment', 'IDNumber', $param);
        $data['ipcr'] = $this->Page_model->get_posts_by_col('hris_ipcr', 'IDNumber', $param);
        $data['c_id'] = $data['c_user']['user_id'];
        $data['image'] = $data['c_user']['image'];

        $data['id'] = $data['user']['id'];
        $data['record_no'] = $data['user']['record_no'];
        $data['FirstName'] = $data['user']['FirstName'];
        $data['MiddleName'] = $data['user']['MiddleName'];
        $data['LastName'] = $data['user']['LastName'];
        $data['NameExtn'] = $data['user']['NameExtn'];
        $data['prefix'] = $data['user']['prefix'];
        $data['empPosition'] = $data['user']['empPosition'];
        $data['Department'] = $data['user']['Department'];
        $data['MaritalStatus'] = $data['user']['MaritalStatus'];
        $data['empStatus'] = $data['user']['empStatus'];
        $data['BirthDate'] = $data['user']['BirthDate'];
        $data['BirthPlace'] = $data['user']['BirthPlace'];
        $data['Sex'] = $data['user']['Sex'];
        $data['height'] = $data['user']['height'];
        $data['weight'] = $data['user']['weight'];
        $data['bloodType'] = $data['user']['bloodType'];
        $data['gsis'] = $data['user']['gsis'];
        $data['pagibig'] = $data['user']['pagibig'];
        $data['philHealth'] = $data['user']['philHealth'];
        $data['sssNo'] = $data['user']['sssNo'];
        $data['tinNo'] = $data['user']['tinNo'];
        $data['resHouseNo'] = $data['user']['resHouseNo'];
        $data['resStreet'] = $data['user']['resStreet'];
        $data['resVillage'] = $data['user']['resVillage'];
        $data['resBarangay'] = $data['user']['resBarangay'];
        $data['resCity'] = $data['user']['resCity'];
        $data['resProvince'] = $data['user']['resProvince'];
        $data['resZipCode'] = $data['user']['resZipCode'];
        $data['perHouseNo'] = $data['user']['perHouseNo'];
        $data['perStreet'] = $data['user']['perStreet'];
        $data['perVillage'] = $data['user']['perVillage'];
        $data['perBarangay'] = $data['user']['perBarangay'];
        $data['perCity'] = $data['user']['perCity'];
        $data['perProvince'] = $data['user']['perProvince'];
        $data['perZipCode'] = $data['user']['perZipCode'];
        $data['empTelNo'] = $data['user']['empTelNo'];
        $data['empMobile'] = $data['user']['empMobile'];
        $data['empEmail'] = $data['user']['empEmail'];
        $data['settingsID'] = $data['user']['settingsID'];
        $data['pronoun1'] = $data['user']['pronoun1'];
        $data['pronoun2'] = $data['user']['pronoun2'];
        $data['age'] = $data['user']['age'];
        $data['dateHired'] = $data['user']['dateHired'];
        $data['retirement'] = $data['user']['retirement'];
        $data['retYear'] = $data['user']['retYear'];
        $data['agencyCode'] = $data['user']['agencyCode'];
        $data['citizenship'] = $data['user']['citizenship'];
        $data['dualCitizenship'] = $data['user']['dualCitizenship'];
        $data['citizenshipType'] = $data['user']['citizenshipType'];
        $data['citizenshipCountry'] = $data['user']['citizenshipCountry'];
        $data['contactName'] = $data['user']['contactName'];
        $data['contactRel'] = $data['user']['contactRel'];
        $data['contactEmail'] = $data['user']['contactEmail'];
        $data['contactNo'] = $data['user']['contactNo'];
        $data['contactAddress'] = $data['user']['contactAddress'];
        $data['fb'] = $data['user']['fb'];
        $data['skype'] = $data['user']['skype'];
        $data['stationCode'] = $data['user']['stationCode'];
        $data['umid'] = $data['user']['umid'];
        $data['csEligibility'] = $data['user']['csEligibility'];
        $data['csLevel'] = $data['user']['csLevel'];
        $data['currentStatus'] = $data['user']['currentStatus'];
        $data['YearsAsJO'] = $data['user']['YearsAsJO'];
        $data['workNature1'] = $data['user']['workNature1'];
        $data['workNature2'] = $data['user']['workNature2'];
        $data['employeeNo'] = $data['user']['employeeNo'];
        $data['itemNo'] = $data['user']['itemNo'];
        $data['sgNo'] = $data['user']['sgNo'];
        $data['authAnSalary'] = $data['user']['authAnSalary'];
        $data['actualSalary'] = $data['user']['actualSalary'];
        $data['stepNo'] = $data['user']['stepNo'];
        $data['origAppointmentDate'] = $data['user']['origAppointmentDate'];
        $data['lastAppointmentDate'] = $data['user']['lastAppointmentDate'];
        $data['workStat'] = $data['user']['workStat'];
        $data['staCode'] = $data['user']['staCode'];
        $data['lastUpdate'] = $data['user']['lastUpdate'];
        $data['updatedBy'] = $data['user']['updatedBy'];

        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }

  

    public function apply(){
        $this->Page_model->apply_insert();
        $this->Page_model->insert_at('Apply id number ');
        $this->session->set_flashdata('success', ' Plantilla deleted');
        redirect(base_url() . 'registered_profile/' . $this->session->c_id);
    }
    public function applicant(){

        $page = "ap_application";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Applicant";
        $data['page'] = $this->Page_model->get_posts_by_col('applied', 'status', 0);

        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/modal_com');
        $this->load->view('templates/footer');
    }
    public function ap_delete($param)
    {
        $this->Page_model->delete('2', 'id', 'applied');
        $this->Page_model->insert_at('Delete application id number ' . $param);
        $this->session->set_flashdata('danger', ' Application was deleted');
        redirect(base_url() . 'applicant');
    }






    /* to delete */
    public function pass()
    {
        $this->Page_model->pass();
        redirect(base_url());
    }

    public function user_pass($param)
    {
        $this->Page_model->user_pass_change($param);
        $this->session->set_flashdata('success', 'Successfully Updated.');
        redirect(base_url() . "users");
    }



    public function log_in()
    {

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'uassword', 'required');

        if ($this->form_validation->run() == FALSE) {

            $page = "login";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['page'] = $this->Page_model->get_single_row_by_id('settings', 'id', 1);
            $this->load->view('pages/' . $page, $data);
        } else {

            $user_id = $this->Page_model->login();



            if ($user_id) {

                $user_data = array(
                    'username' => $user_id['username'],
                    'user' => $user_id['fname'] . ' ' . $user_id['mname'] . ' ' . $user_id['lname'],
                    'position' => $user_id['position'],
                    //'office' => $user_id['office'],
                    'sex' => $user_id['sex'],
                    'image' => $user_id['image'],
                    'id' => $user_id['id'],
                    'c_id' => $user_id['user_id'],
                    //'company_id' => $user_id['company_id'],
                    'logged_in' => true

                );

                $this->session->set_userdata($user_data);

                $logStat = 'success';
                $logType = 'login';
                $this->Page_model->insert_logs($logStat, $logType);


                if ($this->session->position == "user") {
                    redirect(base_url() . 'Pages/view_employee');
                    $this->Page_model->insert_logs();
                } elseif ($this->session->position === "reg") {
                    redirect(base_url() . 'registered_profile/' . $this->session->c_id);
                } elseif ($this->session->position === "School") {
                    redirect(base_url() . 'Page/schoolDashboard/');
                } elseif ($this->session->position === "Staff") {
                    redirect(base_url());
                } elseif ($this->session->position === "Accountant") {
                    redirect(base_url());
                } else {
                    redirect(base_url());
                }
            } else {
                $this->session->set_flashdata('failed', 'Username/Password not match');
                $logStat = 'failed';
                $this->Page_model->insert_logs_failed($logStat);
                redirect(base_url() . 'log_in');
            }
        }
    }
    public function lock_user_screen()
    {

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE) {

            $page = "lock_screen";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $this->load->view('pages/' . $page);
        } else {

            $user_id = $this->Page_model->lock_screen();

            if ($user_id) {

                $user_data = array(
                    'username' => $user_id['username'],
                    'user' => $user_id['fname'] . ' ' . $user_id['mname'] . ' ' . $user_id['lname'],
                    'position' => $user_id['position'],
                    'office' => $user_id['office'],
                    'image' => $user_id['image'],
                    'id' => $user_id['id'],
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('user_log', 'You are now loged in as '
                    . $this->session->position);
                redirect(base_url());
            } else {
                $this->session->set_flashdata('failed', 'Password not match');
                redirect(base_url() . 'lock_user_screen');
            }
        }
    }

    public function logout()
    {

        $logStat = 'success';
        $logType = 'logout';
        $this->Page_model->insert_logs_out($logStat, $logType);

        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('position');
        $this->session->unset_userdata('office');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('aip');

        $this->session->set_flashdata('failed', 'You are logged out.');

       

        redirect(base_url() . 'log_in');
    }
    public function lock()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('position');
        $this->session->unset_userdata('office');
        $this->session->unset_userdata('logged_in');

        $this->session->set_flashdata('danger', 'You are now in Locked Screen Mode');
        redirect(base_url() . 'lock_user_screen');
    }

    public function new_applicant()
    {

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        ', '</div>');
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        //$this->form_validation->set_rules('termPeriodto', 'Term Period To', 'required');

        if ($this->form_validation->run() == FALSE) {

            $page = "applicant_new";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }
            $data['title'] = "Register";
            $data['count'] = $this->Page_model->get_row_data('count', 'id', 1);


            $this->load->view('templates/header_public');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer_public');
        } else {

            $r_no = $this->input->post('record_no');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $email = $this->input->post('email');
            $bd = $this->input->post('bd');
            $record_no_check = $this->Page_model->check_single_row_exist('hris_applicant', 'record_no', $r_no);
            $check = $this->Page_model->check_exist('hris_applicant', $fname, $lname);
            $email_check = $this->Page_model->check_single_row_exist('hris_applicant', 'empEmail', $email);


            if ($email_check->num_rows() >= 1) {
                $this->session->set_flashdata('danger', 'Duplicate Email found.');
                redirect(base_url() . 'new_applicant');
            } else {
                if ($check->num_rows() >= 1) {
                    $this->session->set_flashdata('danger', 'Duplicate records found.');
                    redirect(base_url() . 'new_applicant');
                } else {
                    $this->Page_model->insert_application();
                    $id = $this->db->insert_id();
                    $this->Page_model->update_app_count();
                    $this->Page_model->insert_reg_user($id);

                    //Email Notification
                    $this->load->config('email');
                    $this->load->library('email');
                    $mail_message = 'Dear ' . $fname . ',' . "\r\n";
                    $mail_message .= '<br><br>Thank you for signing up!' . "\r\n";
                    $mail_message .= '<br><br>You may now login to the system using <span style="color:red; font-weight:bold;">' . $email . '</span> as your username and <span style="color:red; font-weight:bold;">' . $bd . ' </span> as your password.' . "\r\n";
                    $mail_message .= '<br><br>Thanks & Regards,';
                    $mail_message .= '<br>HRIS - Online';

                    $this->email->from('no-reply@depeddavor.com', 'Human Resource Information System')
                        ->to($email)
                        ->subject('Account Created')
                        ->message($mail_message);
                    $this->email->send();


                    $this->session->set_flashdata('success', 'Your registration has been processed successfully.  Please check your email for the login credentials.');
                    redirect(base_url() . 'log_in');
                }
            }
        }
    }

    public function profile_reg_delete($param)
    {
        $this->Page_model->delete('3', 'id', 'hris_applicant');
        $this->Page_model->delete('3', 'user_id', 'users');
        $this->Page_model->insert_at('Deleted Applicant id number ' . $param);
        $this->session->set_flashdata('danger', ' Applicant account was deleted.');
        redirect(base_url() . 'Page/regApplicants');
    }

    public function del_application($param)
    {
        $this->Page_model->delete('3', 'appID', 'hris_applications');
        $this->Page_model->insert_at('Deleted Application id number ' . $param);
        $this->session->set_flashdata('danger', ' Applications was deleted.');
        redirect(base_url() . 'Page/myApplications');
    }

    public function pass_change()
    //this area
    {
        if ($this->session->position == "Admin") {
            $this->Page_model->change_pass_admin();
        } elseif ($this->session->position == "School") {
            $this->Page_model->change_pass_school();
        } else {
            $this->SGODModel->change_pass();
            $this->session->set_flashdata('success', 'Updated successfully.');
            redirect('Pages/users');
        }
        $this->Page_model->insert_at('Change Applicant id number ' . $this->db->insert_id());
        $this->session->set_flashdata('success', 'Password successfully changed.');
        $id = $this->input->post('id');

        if ($this->session->userdata('position') === 'Admin') :
            redirect(base_url() . 'users');
        elseif ($this->session->userdata('position') === 'School') :
            redirect(base_url() . 'Page/employeelist/');
        elseif ($this->session->userdata('position') === 'reg') :
            redirect(base_url() . 'registered_profile/' . $id);
        elseif ($this->session->userdata('position') === 'user') :
            redirect('Pages/view_employee');
        endif;
    }

    public function other_settings()
    {

        $page = "settings_other";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = "Other Settings";
        $data['page'] = $this->Page_model->get_all_posts('settings');


        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function update_settings()
    {
        $this->Page_model->close_open('3', 'id', 'settings', 'status', '4');
        $this->Page_model->insert_at('Update Other Settings id number ' . $this->db->insert_id());
        $this->session->set_flashdata('success', 'Successfully Updated');
        redirect(base_url() . 'Pages/other_settings');
    }

    public function profile_reg_edit($param){

        $this->Page_model->check_ownership($param);

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        ', '</div>');
        $this->form_validation->set_rules('FirstName', 'First Name', 'required');
        //$this->form_validation->set_rules('termPeriodto', 'Term Period To', 'required');

        if ($this->form_validation->run() == FALSE) {

            $page = "profile_reg_update";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['title'] = "Applicant";
            $data['app'] = $this->Page_model->get_single_row_by_id('hris_applicant', 'id', $param);

            $this->load->view('templates/head');
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/modal_com');
            $this->load->view('templates/footer');
        } else {
            $this->Page_model->update_profile_reg();
            $this->Page_model->insert_at('Profile registration successfully updated id number ' . $this->db->insert_id());
            $this->session->set_flashdata('success', 'Updated successfully');
            redirect(base_url() . 'Pages/registered_profile/' . $param);
        }
    }

    public function employee_edit($param)
    {

        if ($this->session->userdata('position') === 'Admin') {
        } elseif ($this->session->userdata('position') === 'Super Admin') {
        } elseif ($this->session->userdata('position') === 'School') {
        } elseif ($this->session->userdata('position') === 'Staff') {
        } else {
            $this->Page_model->check_ownership($param);
        }

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        ', '</div>');
        $this->form_validation->set_rules('FirstName', 'First Name', 'required');
        //$this->form_validation->set_rules('termPeriodto', 'Term Period To', 'required');

        if ($this->form_validation->run() == FALSE) {

            $page = "employee_update";

            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['title'] = "Employee Update";
            $data['app'] = $this->Page_model->get_single_row_by_id('hris_staff', 'IDNumber', $param);

            $this->load->view('templates/head');
            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/modal_com');
            $this->load->view('templates/footer');
        } else {
            $this->Page_model->update_employee();
            $this->Page_model->update_user_acct();
            $this->Page_model->insert_at('Employee information successfully updated id number ' . $this->db->insert_id());
            $this->session->set_flashdata('success', 'Updated successfully.');
            redirect(base_url() . 'Pages/personnel_profile/' . $param);
        }
    }


    public function ies()
    {
        $page = "ies_form";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }
        $id = $this->uri->segment(3);
        $appId = $this->uri->segment(4);
        $jobId = $this->uri->segment(5);
        $data['ap'] = $this->Page_model->get_single_row_by_id('hris_applicant', 'id', $id);
        $data['rate'] = $this->Page_model->get_single_row_by_id('hris_applications_rating', 'appID', $appId);
        $data['job'] = $this->Page_model->get_single_row_by_id('hris_jobvacancy', 'jobID', $jobId);
        $data['title'] = "INDIVIDUAL EVALUATION SHEET(IES)";

        $this->load->view('pages/' . $page, $data);
    }

    public function car_rqa()
    {
        $page = "car_rqa_form";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $jobID = $this->uri->segment(3);
        $data['job'] = $this->Page_model->get_single_row_by_id('hris_jobvacancy', 'jobID', $jobID);
        $data['car'] = $this->Page_model->rqa($jobID);

        $data['title'] = "COMPARATIVE ASSESSMENT RESULT - REGISTRY OF QUALIFIED APPLICANTS (CAR - RQA)";

        $this->load->view('pages/' . $page, $data);
    }

    public function car_rqa1()
    {
        $page = "car_rqa_form1";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $jobID = $this->uri->segment(3);
        $data['job'] = $this->Page_model->get_single_row_by_id('hris_jobvacancy', 'jobID', $jobID);
        $data['car'] = $this->Page_model->rqa($jobID);

        $data['title'] = "COMPARATIVE ASSESSMENT RESULT - REGISTRY OF QUALIFIED APPLICANTS (CAR - RQA)";

        $this->load->view('pages/' . $page, $data);
    }

    public function rqa_specialization_print()
    {
        $page = "car_rqa_form_special";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $jobID = $this->input->get('id');
        $spe = $this->input->get('spec');
        $data['job'] = $this->Page_model->get_single_row_by_id('hris_jobvacancy', 'jobID', $jobID);
        $data['car'] = $this->Page_model->rqa_specialization($jobID, $spe);

        $data['title'] = "COMPARATIVE ASSESSMENT RESULT - REGISTRY OF QUALIFIED APPLICANTS (CAR - RQA)";

        $this->load->view('pages/' . $page, $data);
    }

    public function rqa_specialization_print1()
    {
        $page = "car_rqa_form_special_posting1";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $jobID = $this->input->get('id');
        $spe = $this->input->get('spec');
        $data['job'] = $this->Page_model->get_single_row_by_id('hris_jobvacancy', 'jobID', $jobID);
        $data['car'] = $this->Page_model->rqa_specialization($jobID, $spe);

        $data['title'] = "COMPARATIVE ASSESSMENT RESULT - REGISTRY OF QUALIFIED APPLICANTS (CAR - RQA)";

        $this->load->view('pages/' . $page, $data);
    }

    public function rqa_municipality_print()
    {
        $page = "car_rqa_form_special2";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $jobID = $this->input->get('id');
        $mun = $this->input->get('mun');
        $data['job'] = $this->Page_model->get_single_row_by_id('hris_jobvacancy', 'jobID', $jobID);
        $data['car'] = $this->Page_model->rqa_mun($jobID, $mun);

        $data['title'] = "COMPARATIVE ASSESSMENT RESULT - REGISTRY OF QUALIFIED APPLICANTS (CAR - RQA)";

        $this->load->view('pages/' . $page, $data);
    }

    public function rqa_municipality_track()
    {
        $page = "car_rqa_form_special3";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $jobID = $this->input->get('id');
        $mun = $this->input->get('mun');
        $spec = $this->input->get('spec');
        $data['job'] = $this->Page_model->get_single_row_by_id('hris_jobvacancy', 'jobID', $jobID);
        $data['car'] = $this->Page_model->rqa_mun_track($jobID, $mun, $spec);

        $data['title'] = "COMPARATIVE ASSESSMENT RESULT - REGISTRY OF QUALIFIED APPLICANTS (CAR - RQA)";

        $this->load->view('pages/' . $page, $data);
    }

    public function rqa_municipality_spec()
    {
        $page = "car_rqa_form_special3";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $jobID = $this->input->get('id');
        $mun = $this->input->get('mun');
        $spec = $this->input->get('spec');
        $data['job'] = $this->Page_model->get_single_row_by_id('hris_jobvacancy', 'jobID', $jobID);
        $data['car'] = $this->Page_model->rqa_mun_spec($jobID, $mun, $spec);

        $data['title'] = "COMPARATIVE ASSESSMENT RESULT - REGISTRY OF QUALIFIED APPLICANTS (CAR - RQA)";

        $this->load->view('pages/' . $page, $data);
    }


    public function rqa_track_print()
    {
        $page = "car_rqa_form_special";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $jobID = $this->input->get('id');
        $spe = $this->input->get('spec');
        $data['job'] = $this->Page_model->get_single_row_by_id('hris_jobvacancy', 'jobID', $jobID);
        $data['car'] = $this->Page_model->rqa_track($jobID, $spe);

        $data['title'] = "COMPARATIVE ASSESSMENT RESULT - REGISTRY OF QUALIFIED APPLICANTS (CAR - RQA)";

        $this->load->view('pages/' . $page, $data);
    }

    public function rqa_track_print1()
    {
        $page = "car_rqa_form_special_posting";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $jobID = $this->input->get('id');
        $spe = $this->input->get('spec');
        $data['job'] = $this->Page_model->get_single_row_by_id('hris_jobvacancy', 'jobID', $jobID);
        $data['car'] = $this->Page_model->rqa_track($jobID, $spe);

        $data['title'] = "COMPARATIVE ASSESSMENT RESULT - REGISTRY OF QUALIFIED APPLICANTS (CAR - RQA)";

        $this->load->view('pages/' . $page, $data);
    }

    function schools(){
        $type=$this->input->get('type');
        $result['data']=$this->Page_model->schools($type);
      $this->load->view('schools',$result);
      }




   // renren new code please don't touch

    public function ma($param){


        $page = "rp";

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['data'] = $this->Common->one_cond_row('hris_applicant', 'id', $param);
        $data['user'] = $this->Common->one_cond_row('users', 'user_id', $param);


        $this->load->view('templates/head');
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function update_educ(){
        $this->Reg->educ_update();
        $this->session->set_flashdata('success', 'Successfuly Saved');
        redirect(base_url() . 'pages/ma/' . $this->session->c_id);
    }

    public function update_ai(){
        $this->Reg->ai_update();
        $this->session->set_flashdata('success', 'Successfuly Saved');
        redirect(base_url() . 'pages/ma/' . $this->session->c_id);
    }

    public function update_lr(){
        $this->Reg->lr_update();
        $this->session->set_flashdata('success', 'Successfuly Saved');
        redirect(base_url() . 'pages/ma/' . $this->session->c_id.'#lr');
    }

    public function update_ept(){
        $this->Reg->ept_update();
        $this->session->set_flashdata('success', 'Successfuly Saved');
        redirect(base_url() . 'pages/ma/' . $this->session->c_id.'#ept');
    }

    public function update_tc(){
        $this->Reg->tc_update();
        $this->session->set_flashdata('success', 'Successfuly Saved');
        redirect(base_url() . 'pages/ma/' . $this->session->c_id.'#lr');
    }

    public function update_efile(){
        $config['allowed_types'] = 'jpg|png|pdf';
        $config['upload_path'] = './uploads/regfile';
        $new_name = time().'efile'.$this->input->post('id').$_FILES["file_name"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);

        if($this->upload->do_upload('file')){
            $id = $this->input->post('id');
            $reg = $this->Common->one_cond_row('hris_applicant','id',$id);
            unlink("uploads/regfile/".$reg->efile);
            $this->Reg->educfile_update();
            $this->session->set_flashdata('success', 'Successfully updated.');
            redirect(base_url() . 'pages/ma/' . $this->session->c_id.'#efile');
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function update_wefile(){
        $config['allowed_types'] = 'jpg|png|pdf';
        $config['upload_path'] = './uploads/regfile';
        $new_name = time().'wefile'.$this->input->post('id').$_FILES["file_name"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);

        if($this->upload->do_upload('file')){
            $id = $this->input->post('id');
            $reg = $this->Common->one_cond_row('hris_applicant','id',$id);
            unlink("uploads/regfile/".$reg->wefile);
            $this->Reg->wefile_update();
            $this->session->set_flashdata('success', 'Successfully updated.');
            redirect(base_url() . 'pages/ma/' . $this->session->c_id.'#lr');
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function update_letfile(){
        $config['allowed_types'] = 'jpg|png|pdf';
        $config['upload_path'] = './uploads/regfile';
        $new_name = time().'letfile'.$this->input->post('id').$_FILES["file_name"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);

        if($this->upload->do_upload('file')){
            $id = $this->input->post('id');
            $reg = $this->Common->one_cond_row('hris_applicant','id',$id);
            unlink("uploads/regfile/".$reg->letfile);
            $this->Reg->letfile_update();
            $this->session->set_flashdata('success', 'Successfully updated.');
            redirect(base_url() . 'pages/ma/' . $this->session->c_id.'#lr');
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function update_tscfile(){
        $config['allowed_types'] = 'jpg|png|pdf';
        $config['upload_path'] = './uploads/regfile';
        $new_name = time().'tscfile'.$this->input->post('id').$_FILES["file_name"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);

        if($this->upload->do_upload('file')){
            $id = $this->input->post('id');
            $reg = $this->Common->one_cond_row('hris_applicant','id',$id);
            unlink("uploads/regfile/".$reg->tscfile);
            $this->Reg->tscfile_update();
            $this->session->set_flashdata('success', 'Successfully updated.');
            redirect(base_url() . 'pages/ma/' . $this->session->c_id.'#lr');
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function update_tcfile(){
        $config['allowed_types'] = 'jpg|png|pdf';
        $config['upload_path'] = './uploads/regfile';
        $new_name = time().'tcfile'.$this->input->post('id').$_FILES["file_name"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);

        if($this->upload->do_upload('file')){
            $id = $this->input->post('id');
            $reg = $this->Common->one_cond_row('hris_applicant','id',$id);
            unlink("uploads/regfile/".$reg->tcfile);
            $this->Reg->tcfile_update();
            $this->session->set_flashdata('success', 'Successfully updated.');
            redirect(base_url() . 'pages/ma/' . $this->session->c_id.'#lr');
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function update_pdsfile(){
        $config['allowed_types'] = 'jpg|png|pdf';
        $config['upload_path'] = './uploads/regfile';
        $new_name = time().'pdsfile'.$this->input->post('id').$_FILES["file_name"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);

        if($this->upload->do_upload('file')){
            $id = $this->input->post('id');
            $reg = $this->Common->one_cond_row('hris_applicant','id',$id);
            unlink("uploads/regfile/".$reg->pdsfile);
            $this->Reg->pdsfile_update();
            $this->session->set_flashdata('success', 'Successfully updated.');
            redirect(base_url() . 'pages/ma/' . $this->session->c_id.'#ept');
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function update_oafile(){
        $config['allowed_types'] = 'jpg|png|pdf';
        $config['upload_path'] = './uploads/regfile';
        $new_name = time().'oafile'.$this->input->post('id').$_FILES["file_name"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);

        if($this->upload->do_upload('file')){
            $id = $this->input->post('id');
            $reg = $this->Common->one_cond_row('hris_applicant','id',$id);
            unlink("uploads/regfile/".$reg->oafile);
            $this->Reg->oafile_update();
            $this->session->set_flashdata('success', 'Successfully updated.');
            redirect(base_url() . 'pages/ma/' . $this->session->c_id.'#ept');
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function update_ipcrffile(){
        $config['allowed_types'] = 'jpg|png|pdf';
        $config['upload_path'] = './uploads/regfile';
        $new_name = time().'ipcrffile'.$this->input->post('id').$_FILES["file_name"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);

        if($this->upload->do_upload('file')){
            $id = $this->input->post('id');
            $reg = $this->Common->one_cond_row('hris_applicant','id',$id);
            unlink("uploads/regfile/".$reg->ipcrffile);
            $this->Reg->ipcrffile_update();
            $this->session->set_flashdata('success', 'Successfully updated.');
            redirect(base_url() . 'pages/ma/' . $this->session->c_id.'#ept');
        }else{
            print_r($this->upload->display_errors()); 
        }
    }



}
