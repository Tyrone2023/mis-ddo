<?php

class Reg extends CI_Model{

    public function __construct(){
          $this->load->database();

    }

    public function educ_jhss_update(){
       $g = $this->input->post('learn');
       $s = $this->input->post('special');
       if($s == ''){
        $jhss = $g;
       }else{
        $jhss = $g.' - '.$s;
       }

      $data = array(
        'jhss' => $jhss
      );

      $this->db->where('id', $this->input->post('id'));
      return $this->db->update('hris_applicant', $data);
    }

    public function educ_shss_update(){
        $g = $this->input->post('group');
       $s = $this->input->post('strand');
       if($s == ''){
        $shss = $g;
       }else{
        $shss = $g.' - '.$s;
       }

      $data = array(
        'shss' => $shss
      );

      $this->db->where('id', $this->input->post('id'));
      return $this->db->update('hris_applicant', $data);
    }


    public function educ_update(){

      $data = array(
        'bd' => $this->input->post('bd'), 
        'dg' => $this->input->post('dg'), 
        'du' => $this->input->post('du'), 
        'dgwa' => $this->input->post('dgwa'), 
        'ue' => $this->input->post('ue'), 
        'gwae' => $this->input->post('gwae'), 
        'pg' => $this->input->post('pg'), 
        'pgu' => $this->input->post('pgu'), 
        'jhss' => $this->input->post('jhss'),
        'shss' => $this->input->post('shss'),
        'specialization' => $this->input->post('s')
      );

      $this->db->where('id', $this->input->post('id'));
      return $this->db->update('hris_applicant', $data);
    }

    public function educ_update_staff(){

      $data = array(
        'bd' => $this->input->post('bd'), 
        'dg' => $this->input->post('dg'), 
        'du' => $this->input->post('du'), 
        'dgwa' => $this->input->post('dgwa'), 
        'ue' => $this->input->post('ue'), 
        'gwae' => $this->input->post('gwae'), 
        'pg' => $this->input->post('pg'), 
        'pgu' => $this->input->post('pgu'), 
        'jhss' => $this->input->post('jhss'),
        'shss' => $this->input->post('shss'),
        'specialization' => $this->input->post('s')
      );

      $this->db->where('IDNumber', $this->input->post('id'));
      return $this->db->update('hris_staff', $data);
    }

    public function ai_update(){

      $data = array( 
              'FirstName' => $this->input->post('FirstName'),
              'MiddleName' => $this->input->post('MiddleName'),
              'LastName' => $this->input->post('LastName'),
              'NameExtn' => $this->input->post('NameExtn'),
              'resVillage' => $this->input->post('resVillage'),
              'resBarangay' => $this->input->post('resBarangay'),
              'resCity' => $this->input->post('resCity'),
              'resProvince' => $this->input->post('resProvince'),
              'Sex' => $this->input->post('Sex'),
              'contactNo' => $this->input->post('contactNo'),
              'asht' => $this->input->post('asht'),
              'empPosition' => $this->input->post('cp')
        );

      $this->db->where('id', $this->input->post('id'));
      return $this->db->update('hris_applicant', $data);
    }

    public function ai_update_staff(){

      $data = array( 
              'FirstName' => $this->input->post('FirstName'),
              'MiddleName' => $this->input->post('MiddleName'),
              'LastName' => $this->input->post('LastName'),
              'NameExtn' => $this->input->post('NameExtn'),
              'resVillage' => $this->input->post('resVillage'),
              'resBarangay' => $this->input->post('resBarangay'),
              'resCity' => $this->input->post('resCity'),
              'resProvince' => $this->input->post('resProvince'),
              'Sex' => $this->input->post('Sex'),
              'contactNo' => $this->input->post('contactNo'),
              'asht' => $this->input->post('asht'),
              'empPosition' => $this->input->post('cp')
        );

      $this->db->where('IDNumber', $this->input->post('id'));
      return $this->db->update('hris_staff', $data);
    }

   

    public function ai_sex_update(){
      if($this->input->post('Sex') == "M"){
        $sex = 0;
      }else{
        $sex = 1;
      }

      $data = array( 
        'sex' => $sex
      );

      $this->db->where('user_id', $this->input->post('id'));
      return $this->db->update('users', $data);
    }

    public function lr_update(){

      $data = array( 
              'lr' => $this->input->post('lr')
      );

      $this->db->where('empEmail', $this->input->post('empEmail'));
      //$this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_applicant', $data);
    }


    public function lr_update_staff(){

      $data = array( 
              'lr' => $this->input->post('lr')
      );

      $this->db->where('IDNumber', $this->input->post('id'));
      //$this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_staff', $data);
    }

    public function ept_update(){

      $data = array( 
              'ept' => $this->input->post('ept'),
              'eptr' => $this->input->post('eptr')
      );

      $this->db->where('empEmail', $this->input->post('empEmail'));
      $this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_applications', $data);
    }

    public function tc_update(){

      $data = array( 
              'tc' => $this->input->post('tc')
      );

      $this->db->where('empEmail', $this->input->post('empEmail'));
      //$this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_applicant', $data);
    }

    public function tc_update_staff(){

      $data = array( 
              'tc' => $this->input->post('tc')
      );

      $this->db->where('IDNumber', $this->input->post('id'));
      //$this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_staff', $data);
    }

    public function educfile_update(){

            $file = $this->upload->data();
            $filename = $file['file_name']; 

            $data = array(
                'efile' => $filename
                );

                $this->db->where('empEmail', $this->input->post('empEmail'));
                //$this->db->where('jobID', $this->input->post('jobID'));
            return $this->db->update('hris_applicant', $data);
      }

      public function educfile_update_staff(){

            $file = $this->upload->data();
            $filename = $file['file_name']; 

            $data = array(
                'efile' => $filename
                );

                $this->db->where('IDNumber', $this->input->post('id'));
                //$this->db->where('jobID', $this->input->post('jobID'));
            return $this->db->update('hris_staff', $data);
      }

      public function outfile_update_staff(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'oa' => $filename
            );

            $this->db->where('IDNumber', $this->input->post('id'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_staff', $data);
      }

      public function aefile_update_staff(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'ae' => $filename
            );

            $this->db->where('IDNumber', $this->input->post('id'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_staff', $data);
      }

      public function aefile_update(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'ae' => $filename
            );

            $this->db->where('empEmail', $this->input->post('empEmail'));
                //$this->db->where('jobID', $this->input->post('jobID'));
            return $this->db->update('hris_applicant', $data);
      }

      public function aldfile_update_staff(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'ald' => $filename
            );

            $this->db->where('IDNumber', $this->input->post('id'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_staff', $data);
      }

      public function aldfile_update(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'ald' => $filename
            );

            $this->db->where('empEmail', $this->input->post('empEmail'));
                //$this->db->where('jobID', $this->input->post('jobID'));
            return $this->db->update('hris_applicant', $data);
      }

      public function educfile_update_staff_none(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'tor_cav' => $filename
            );

            $this->db->where('IDNumber', $this->input->post('id'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_staff', $data);
      }

      public function educfile_update_none(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'tor_cav' => $filename
            );

            $this->db->where('empEmail', $this->input->post('empEmail'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_applicant', $data);
      }

      public function wefile_update(){

            $file = $this->upload->data();
            $filename = $file['file_name']; 

            $data = array(
                'wefile' => $filename
                );

            $this->db->where('empEmail', $this->input->post('empEmail'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_applicant', $data);
      }

      public function wefile_update_staff(){

            $file = $this->upload->data();
            $filename = $file['file_name']; 

            $data = array(
                'wefile' => $filename
                );

            $this->db->where('IDNumber', $this->input->post('id'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_staff', $data);
      }

      public function eligibility_update_staff(){

            $file = $this->upload->data();
            $filename = $file['file_name']; 

            $data = array(
                'eligibility' => $filename
                );

            $this->db->where('IDNumber', $this->input->post('id'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_staff', $data);
      }

      public function eligibility_update(){

            $file = $this->upload->data();
            $filename = $file['file_name']; 

            $data = array(
                'eligibility' => $filename
                );

                $this->db->where('empEmail', $this->input->post('empEmail'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_applicant', $data);
      }

      public function letfile_update(){

            $file = $this->upload->data();
            $filename = $file['file_name']; 

            $data = array(
                'letfile' => $filename
                );

            $this->db->where('empEmail', $this->input->post('empEmail'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_applicant', $data);
      }

      public function letfile_update_staff(){

            $file = $this->upload->data();
            $filename = $file['file_name']; 

            $data = array(
                'letfile' => $filename
                );

            $this->db->where('IDNumber', $this->input->post('id'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_staff', $data);
      }

      public function tscfile_update(){

          $file = $this->upload->data();
          $filename = $file['file_name']; 

          $data = array(
              'tscfile' => $filename
              );

            $this->db->where('empEmail', $this->input->post('empEmail'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_applicant', $data);
      }

      public function tscfile_update_staff(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'tscfile' => $filename
            );

          $this->db->where('IDNumber', $this->input->post('id'));
          //$this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_staff', $data);
    }

      public function tcfile_update(){

          $file = $this->upload->data();
          $filename = $file['file_name']; 

          $data = array(
              'tcfile' => $filename
              );

              $this->db->where('empEmail', $this->input->post('empEmail'));
              //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_applicant', $data);
      }

      public function tcfile_update_staff(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'tcfile' => $filename
            );

            $this->db->where('IDNumber', $this->input->post('id'));
            //$this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_staff', $data);
    }

      public function omni_update(){

          $file = $this->upload->data();
          $filename = $file['file_name']; 

          $data = array(
              'omnibus' => $filename
              );

              $this->db->where('empEmail', $this->input->post('empEmail'));
              //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_applicant', $data);
      }

      public function omni_update_staff(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'omnibus' => $filename
            );

            $this->db->where('IDNumber', $this->input->post('id'));
            //$this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_staff', $data);
    }

      public function apfile_update(){

          $file = $this->upload->data();
          $filename = $file['file_name']; 

          $data = array(
              'application' => $filename
              );

              $this->db->where('empEmail', $this->input->post('empEmail'));
              $this->db->where('jobID', $this->input->post('jobID'));
              $this->db->where('pre_school', $this->input->post('school_id'));
        return $this->db->update('hris_applications', $data);
      }

      public function apfile_update_staff(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'application' => $filename
            );

            $this->db->where('empEmail', $this->input->post('id'));
            $this->db->where('jobID', $this->input->post('jobID'));
            $this->db->where('pre_school', $this->input->post('school_id'));
      return $this->db->update('hris_applications', $data);
    }

      public function voters_update(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'voters' => $filename
            );

            $this->db->where('empEmail', $this->input->post('empEmail'));
            //$this->db->where('jobID', $this->input->post('jobID'));
        return $this->db->update('hris_applicant', $data);
    }

    public function voters_update_staff(){

      $file = $this->upload->data();
      $filename = $file['file_name']; 

      $data = array(
          'voters' => $filename
          );

          $this->db->where('IDNumber', $this->input->post('id'));
          //$this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_staff', $data);
  }

	  public function pdsfile_update(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'pdsfile' => $filename
            );

            $this->db->where('empEmail', $this->input->post('empEmail'));
            //$this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_applicant', $data);
    }

    public function pdsfile_update_staff(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'pdsfile' => $filename
            );

            $this->db->where('IDNumber', $this->input->post('id'));
            //$this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_staff', $data);
    }

	  public function oafile_update(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'oafile' => $filename
            );

            $this->db->where('empEmail', $this->input->post('empEmail'));
            // $this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_applicant', $data);
    }

    public function oafile_update_staff(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'oafile' => $filename
            );

            $this->db->where('IDNumber', $this->input->post('id'));
            // $this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_staff', $data);
    }

    public function outfile_update(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'oa' => $filename
            );

            $this->db->where('empEmail', $this->input->post('empEmail'));
            // $this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_applicant', $data);
    }

  

	  public function ipcrffile_update(){

        $file = $this->upload->data();
        $filename = $file['file_name']; 

        $data = array(
            'ipcrffile' => $filename
            );

            $this->db->where('empEmail', $this->input->post('empEmail'));
            // $this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_applicant', $data);
    }

    public function ipcrffile_update_staff(){

      $file = $this->upload->data();
      $filename = $file['file_name']; 

      $data = array(
          'ipcrffile' => $filename
          );

          $this->db->where('IDNumber', $this->input->post('id'));
          // $this->db->where('jobID', $this->input->post('jobID'));
    return $this->db->update('hris_staff', $data);
  }

    public function ap_submit(){
      date_default_timezone_set('Asia/Manila');
      $date = date('Y-m-d');
      $t = date('h:i:s a', time());

      $data = array( 
              'jobID' => $this->input->post('id'), 
              'empEmail' => $this->session->username, 
              'dateSubmitted' => $date, 
              'appStatus' => 'Application Submitted', 
              'applicant_id' => $this->session->c_id,
              'app_year' => date('Y'),
              'district' => $this->input->post('district'), 
              'pre_school' => $this->input->post('school')
      );
  
      return $this->db->insert('hris_applications', $data);
    }

    public function edit_submit(){

      $data = array( 
              'district' => $this->input->post('district'), 
              'pre_school' => $this->input->post('school')
      );
  
      $this->db->where('empEmail', $this->session->username);
      $this->db->where('jobID', $this->input->post('id'));
      return $this->db->update('hris_applications', $data);
    }

    public function ap_change_stat($status){

      $data = array( 
              'appStatus' => $status
      );

      $this->db->where('applicant_id', $this->uri->segment(3));
      $this->db->where('jobID', $this->uri->segment(4));
      return $this->db->update('hris_applications', $data);
    }

    public function ap_change_stat_all($status){

      $data = array( 
              'appStatus' => $status
      );

      $this->db->where('appStatus', 'Validated');
      $this->db->where('app_year', date('Y'));
      return $this->db->update('hris_applications', $data);
    }

    public function ap_change_stat_district($status){

      $data = array( 
              'appStatus' => $status
      );

      $this->db->where('district', $this->input->get('district'));
      $this->db->where('jobID', $this->uri->segment(4));
      $this->db->where('appStatus','Validated');
      return $this->db->update('hris_applications', $data);
    }

    public function ap_trackv4($status){
      date_default_timezone_set('Asia/Manila');
      $date = date('Y-m-d');
      $t = date('h:i:s a', time());

      $data = array( 
              'jobID' => $this->uri->segment(4), 
              'dateSubmitted' => $date, 
              'appStatus' => $status, 
              'timeSubmitted' => $t,
              'applicant_id' => $this->uri->segment(3),
              'res' => $this->session->username,
              'app_id' => $this->uri->segment(6)
      );
  
      return $this->db->insert('hris_applications_track', $data);
    }
    

    public function ap_track($status){
      date_default_timezone_set('Asia/Manila');
      $date = date('Y-m-d');
      $t = date('h:i:s a', time());

      if($this->session->position != 'reg'){
        $jobid = $this->uri->segment(4);
      }else{
        $jobid = $this->input->post('id');
      }

      $data = array( 
              'jobID' => $jobid, 
              //'empEmail' => $this->session->username, 
              'dateSubmitted' => $date, 
              'appStatus' => $status, 
              'timeSubmitted' => $t,
              'applicant_id' => $this->uri->segment(3),
              'res' => $this->session->username,
              'app_id' => $this->uri->segment(6)
      );
  
      return $this->db->insert('hris_applications_track', $data);
    }

    public function ap_trackv3($status){
      date_default_timezone_set('Asia/Manila');
      $date = date('Y-m-d');
      $t = date('h:i:s a', time());

      if($this->session->position != 'reg'){
        $jobid = $this->uri->segment(4);
      }else{
        $jobid = $this->input->post('id');
      }

      $data = array( 
              'jobID' => $jobid, 
              //'empEmail' => $this->session->username, 
              'dateSubmitted' => $date, 
              'appStatus' => $status, 
              'timeSubmitted' => $t,
              'applicant_id' => $this->uri->segment(3),
              'res' => $this->session->username,
              'app_id' => $this->uri->segment(6)
      );
  
      return $this->db->insert('hris_applications_track', $data);
    }

    public function ap_trackv2($status){
      date_default_timezone_set('Asia/Manila');
      $date = date('Y-m-d');
      $t = date('h:i:s a', time());

      $data = array( 
              'jobID' => $this->input->post('jobID'),
              'dateSubmitted' => $date, 
              'appStatus' => $status, 
              'timeSubmitted' => $t,
              'applicant_id' => $this->uri->segment(3),
              'res' => $this->session->username,
              'app_id' => $this->input->post('appID')
      );
  
      return $this->db->insert('hris_applications_track', $data);
    }


    public function ap_track_apply($status,$app_id){
      date_default_timezone_set('Asia/Manila');
      $date = date('Y-m-d');
      $t = date('h:i:s a', time());

      if($this->session->position != 'reg'){
        $jobid = $this->uri->segment(4);
      }else{
        $jobid = $this->input->post('id');
      }

      $data = array( 
              'jobID' => $jobid, 
              //'empEmail' => $this->session->username, 
              'dateSubmitted' => $date, 
              'appStatus' => $status, 
              'timeSubmitted' => $t,
              'applicant_id' => $this->uri->segment(3),
              'res' => $this->session->username,
              'app_id' => $app_id
      );
  
      return $this->db->insert('hris_applications_track', $data);
    }

    public function ap_track_apply_user($status,$app_id){
      date_default_timezone_set('Asia/Manila');
      $date = date('Y-m-d');
      $t = date('h:i:s a', time());

      $jobid = $this->input->post('id');

      $data = array( 
              'jobID' => $jobid, 
              //'empEmail' => $this->session->username, 
              'dateSubmitted' => $date, 
              'appStatus' => $status, 
              'timeSubmitted' => $t,
              'applicant_id' => $this->uri->segment(3),
              'res' => $this->session->username,
              'app_id' => $app_id
      );
  
      return $this->db->insert('hris_applications_track', $data);
    }

    

    public function ap_track_comment($status){
      date_default_timezone_set('Asia/Manila');
      $date = date('Y-m-d');
      $t = date('h:i:s a', time());

      
      $data = array( 
              'jobID' => $this->uri->segment(4),
              //'empEmail' => $this->session->username, 
              'dateSubmitted' => $date, 
              'appStatus' => $status, 
              'timeSubmitted' => $t,
              'applicant_id' => $this->uri->segment(3),
              'res' => $this->session->username,
              'app_id' => $this->input->post('app_id')
      );
  
      return $this->db->insert('hris_applications_track', $data);
    }

    public function app_inquiry(){
      date_default_timezone_set('Asia/Manila');
      $date = date('Y-m-d');
      $t = date('h:i:s a', time());

      
      $data = array( 
              'inquiry' => $this->input->post('comment'), 
              'res' => $this->session->username,
              'idate' => $date, 
              'application_id' => $this->input->post('app_id'), 
              'applicant_id' => $this->uri->segment(3),
              'job_id' => $this->uri->segment(4),
              'timeSubmitted' => $t,
              
      );
  
      return $this->db->insert('hris_application_inquiry', $data);
    }


    public function close_jv(){


      $data = array(
          'jvStatus' => 'Closed'
          );

      $this->db->where('jobID', $this->uri->segment(3));
      return $this->db->update('hris_jobvacancy', $data);
    }

    public function remove_attach($column){

      $data = array(
          $column => ''
          );

      $this->db->where('id', $this->uri->segment(3));
      return $this->db->update('hris_applicant', $data);
    }

    public function remove_attach_staff($column){

      $data = array(
          $column => ''
          );

      $this->db->where('IDNumber', $this->uri->segment(3));
      return $this->db->update('hris_staff', $data);
    }

    public function remove_attach_app($column){

      $data = array(
          $column => ''
          );

      $this->db->where('appID', $this->uri->segment(7));
      return $this->db->update('hris_applications', $data);
    }

    public function open_jv(){


      $data = array(
          'jvStatus' => 'Open'
          );

      $this->db->where('jobID', $this->uri->segment(3));
      return $this->db->update('hris_jobvacancy', $data);
    }

    public function insert_rate($gt, $fy){

      $data = array(
          'record_no' => $this->uri->segment(5), 
          'appID' => $this->uri->segment(6),
          'education' => .00001, 
          'training' => .00001, 
          'experience' => .00001, 
          'let_rating' => .00001, 
          'demo_rating' => .00001, 
          'tr_rating' => .00001,
          'job_type' => $gt,
          'fy' => $fy,
          
      );

      return $this->db->insert('hris_applications_rating', $data);
    }

    public function insert_rate_none(){

      $data = array(
          'educ' => .00001, 
          'trainings' => .00001, 
          'experience' => .00001, 
          'performance' => .00001, 
          'oa' => .00001, 
          'ae' => .00001, 
          'ald' => .00001, 
          'interview' => .00001, 
          'written' => .00001, 
          'record_no' => $this->input->post('record'),
          'appID' => $this->input->post('appID'),
          'job_type' => $this->input->post('job_type'),
          'fy' => $this->input->post('job_fy'),
          
      );

      return $this->db->insert('hris_rating_none', $data);
    }

    public function trspecialupdate(){


      $data = array( 
          'tr_rating' => $this->uri->segment(3),
          'eval_id3' => $this->session->id
          
      );
      $this->db->where('fy',$this->uri->segment(4));
      $this->db->where('record_no',$this->uri->segment(5));
      $this->db->where('tr_rating','0.00001');
      return $this->db->update('hris_applications_rating', $data);
    }

    public function insert_exp_rate(){


      $data = array(
          'record_no' => $this->input->post('record_no'), 
          'appID' => $this->input->post('app_id'), 
          'education' => .1, 
          'training' => .1, 
          'experience' => .1, 
          'let_rating' => .1, 
          'demo_rating' => $this->input->post('demo_rating'), 
          'tr_rating' => .1,
          'eval_id2' => $this->session->id
      );

      return $this->db->insert('hris_applications_rating', $data);
    }

    public function insert_tr_rate(){


      $data = array(
          'record_no' => $this->input->post('record_no'), 
          'appID' => $this->input->post('app_id'), 
          'education' => .1, 
          'training' => .1, 
          'experience' => .1, 
          'let_rating' => .1, 
          'demo_rating' => .1, 
          'tr_rating' => $this->input->post('demo_rating'),
          'eval_id3' => $this->session->id
      );

      return $this->db->insert('hris_applications_rating', $data);
    }

    public function update_rate($educ){


      $data = array(
          $educ => $this->input->post($educ),
      );


      $this->db->where('appID', $this->input->post('app_id'));
      $this->db->where('record_no', $this->input->post('record_no'));
      return $this->db->update('hris_applications_rating', $data);
    }

    public function update_rate_none($educ){


      $data = array(
          $educ => $this->input->post($educ),
      );


      $this->db->where('appID', $this->input->post('app_id'));
      $this->db->where('record_no', $this->input->post('record_no'));
      return $this->db->update('hris_rating_none', $data);
    }

    public function lock_application($val){

      $data = array(
          'stat' => $val
      );

      //$this->db->where('jobID', $this->uri->segment(3));
      return $this->db->update('hris_applicant', $data);
    }

    public function lock_applicant_document_submission($table,$val){

      $data = array(
          'stat' => $val
      );

      //$this->db->where('jobID', $this->uri->segment(3));
      return $this->db->update($table, $data);
    }

    

    public function update_dq($val){

      $data = array(
          'dq' => $val
      );

      $this->db->where('appID', $this->input->post('appID'));
      return $this->db->update('hris_applications', $data);
    }

    public function insert_dq(){
      date_default_timezone_set('Asia/Manila');
      $date = date('Y-m-d');
      $t = date('h:i:s a', time());
      $li = ($this->input->post('li') == '') ? 0 : 1;
      $da_pds = ($this->input->post('da_pds') == '') ? 0 : 1;
      $prc = ($this->input->post('prc') == '') ? 0 : 1;
      $trbd = ($this->input->post('trbd') == '') ? 0 : 1;
      $omni = ($this->input->post('omni') == '') ? 0 : 1;

      $educ = ($this->input->post('educ') == '') ? 0 : 1;
      $exp = ($this->input->post('exp') == '') ? 0 : 1;
      $tr = ($this->input->post('tr') == '') ? 0 : 1;
      $eli = ($this->input->post('eli') == '') ? 0 : 1;

      $data = array( 
              'jobID' => $this->input->post('jobID'), 
              'appID' => $this->input->post('appID'), 
              'apID' => $this->input->post('id'), 
              'li' => $li, 
              'da_pds' => $da_pds, 
              'prc' => $prc, 
              'trbd' => $trbd, 
              'omni' => $omni, 
              'local' => $this->input->post('local'), 
              'remarks' => $this->input->post('remarks'), 
              'reason' => $this->input->post('reason'), 
              'vdate' => $date,
              'res' => $this->session->id,

              'educ' => $educ,
              'exp' => $exp,
              'tr' => $tr,
              'eli' => $eli,


      );
  
      return $this->db->insert('hris_app_dq', $data);
    }

    public function update_dq2(){
      date_default_timezone_set('Asia/Manila');
      $date = date('Y-m-d');
      $t = date('h:i:s a', time());
      $li = ($this->input->post('li') == '') ? 0 : 1;
      $da_pds = ($this->input->post('da_pds') == '') ? 0 : 1;
      $prc = ($this->input->post('prc') == '') ? 0 : 1;
      $trbd = ($this->input->post('trbd') == '') ? 0 : 1;
      $omni = ($this->input->post('omni') == '') ? 0 : 1;

      $data = array( 
              'jobID' => $this->input->post('jobID'), 
              'appID' => $this->input->post('appID'), 
              'apID' => $this->input->post('id'), 
              'li' => $li, 
              'da_pds' => $da_pds, 
              'prc' => $prc, 
              'trbd' => $trbd, 
              'omni' => $omni, 
              'local' => $this->input->post('local'), 
              'remarks' => $this->input->post('remarks'), 
              'reason' => $this->input->post('reason'), 
              'vdate' => $date,
              'res' => $this->session->id
      );
  
      $this->db->where('id', $this->input->post('dq_id'));
      return $this->db->update('hris_app_dq', $data);
    }

    

    public function lock_applications($val){

      $data = array(
          'stat' => $val
      );

      //$this->db->where('jobID', $this->uri->segment(3));
      return $this->db->update('hris_applications', $data);
    }

    public function applicant_stat($val){

      $data = array(
          'a_stat' => $val
      );

      $this->db->where('jobID', $this->uri->segment(3));
      return $this->db->update('hris_jobvacancy', $data);
    }

    public function application_close_open($val){

      $data = array(
          'stat' => $val
      );

      $this->db->where('jobID', $this->uri->segment(3));
      return $this->db->update('hris_applications', $data);
    }

    public function in_lock_application($val){

      $data = array(
          'stat' => $val
      );

      $this->db->where('jobID', $this->uri->segment(3));
      $this->db->where('empEmail', $this->input->get('ee'));
      return $this->db->update('hris_applications', $data);
    }

    public function lock_staff($val){

      $data = array(
          'stat' => $val
      );

      $this->db->where('jobID', $this->uri->segment(3));
      $this->db->where('empEmail', $this->input->get('ee'));
      return $this->db->update('hris_applications', $data);
    }

    public function applicant_status($val){

      $data = array(
          'stat' => $val
      );

      $this->db->where('empEmail', $this->input->get('ee'));
      return $this->db->update('hris_applicant', $data);
    }

    public function staff_status($val){

      $data = array(
          'stat' => $val
      );

      //$this->db->where('empEmail', $this->input->get('ee'));
      return $this->db->update('hris_staff', $data);
    }

    public function application_status($val){

      $data = array(
          'stat' => $val
      );

      $this->db->where('empEmail', $this->input->get('ee'));
      return $this->db->update('hris_applications', $data);
    }

    

    public function update_application_district(){

      $data = array(
          'district' => $this->input->post('district'),
          'pre_school' => $this->input->post('school')
      );

      $this->db->where('appID', $this->input->post('appID'));
      return $this->db->update('hris_applications', $data);
    }

    public function update_application_district_blank(){

      $data = array(
          'district' => '',
          'pre_school' => ''
      );

      $this->db->where('appID', $this->uri->segment(5));
      return $this->db->update('hris_applications', $data);
    }

    public function in_applicant_stat($val){

      $data = array(
          'a_stat' => $val
      );

      $this->db->where('jobID', $this->uri->segment(3));
      $this->db->where('empEmail', $this->input->get('ee'));
      return $this->db->update('hris_jobvacancy', $data);
    }

    public function insert_job(){

      $file = $this->upload->data();
      $filename = $file['file_name']; 

      date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$now = date('H:i:s A');
			$date = date("Y-m-d");

      $data = array(
          'jobTitle' => $this->input->post('jobTitle'), 
          'empType' => $this->input->post('empType'), 
          'file' => $filename,
          'postedBy'=> $this->session->username, 
          'datePosted'=> $date, 
          'jvStatus'=> 'Open',  
          'sy'=> $this->input->post('sy'),
          'job_type'=> $this->input->post('job_type'),
          'position'=> $this->input->post('position'),
          'assign'=> $this->input->post('assign')
          );
      return $this->db->insert('hris_jobvacancy', $data);
    }

    public function edit_jobvacancy(){

      $data = array(
          'jobTitle' => $this->input->post('jobTitle'), 
          'empType' => $this->input->post('empType'), 
          'sy' => $this->input->post('sy'),
          'job_type' => $this->input->post('job_type'),
          'position'=> $this->input->post('position'),
          'assign'=> $this->input->post('assign')
      );

      $this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_jobvacancy', $data);
    }

    public function doc_update(){

      $file = $this->upload->data();
      $filename = $file['file_name']; 

      $data = array(
          'file' => $filename
          );

          $this->db->where('jobID', $this->input->post('jobID'));
      return $this->db->update('hris_jobvacancy', $data);
    }

    public function update_eval($eval){


      $data = array(
          $eval => $this->session->id
      );


      $this->db->where('appID', $this->input->post('app_id'));
      $this->db->where('record_no', $this->input->post('record_no'));
      return $this->db->update('hris_applications_rating', $data);
    }

    public function update_eval_none($eval){


      $data = array(
          $eval => $this->session->id
      );


      $this->db->where('appID', $this->input->post('app_id'));
      $this->db->where('record_no', $this->input->post('record_no'));
      return $this->db->update('hris_rating_none', $data);
    }

    public function notifychange(){
      $data = array(
          'nstat' => 1
      );


      $this->db->where('applicant_id', $this->uri->segment(3));
      $this->db->where('jobID',  $this->uri->segment(4));
      $this->db->where('res !=',  $this->session->username);
      $this->db->where('nstat',  0);
      return $this->db->update('hris_applications_track', $data);
    }

    public function notifychangeadmin(){
      $data = array(
          'nstat' => 1
      );


      $this->db->where('applicant_id', $this->uri->segment(3));
      $this->db->where('jobID',  $this->uri->segment(4));
      $this->db->where('res',  $this->input->get('empEmail'));
      $this->db->where('nstat',  0);
      return $this->db->update('hris_applications_track', $data);
    }

    public function new_document(){

      $data = array(
          'name' => $this->input->post('name'), 
          'doc_type' => $this->input->post('doc_type'), 
          'doc_des' => $this->input->post('doc_des'), 
          'doc_no' => $this->input->post('doc_no'), 
          'rdate' => $this->input->post('rdate')

      );

      return $this->db->insert('document_verifier', $data);
    }


  // sub users

  public function insert_sub_user(){

        $password = $this->input->post('password');
        $hash = password_hash($password, PASSWORD_DEFAULT);


        $data = array(
            'username' => $this->input->post('username'),
            'Password' => $hash,
            'position' => $this->input->post('position'),
            'fname' => $this->input->post('fname'),
            'mname' => $this->input->post('mname'),
            'lname' => $this->input->post('lname'),
            'address' => $this->input->post('address'),
            'sex' => $this->input->post('sex'),
            'user_id' => $this->session->c_id, 
            'sp' => $this->input->post('sp')

        );

        return $this->db->insert('users', $data);
  }

  public function update_sub_user(){


    $data = array(
        'username' => $this->input->post('username'),
        'fname' => $this->input->post('fname'),
        'mname' => $this->input->post('mname'),
        'lname' => $this->input->post('lname'),
        'address' => $this->input->post('address'),
        'sex' => $this->input->post('sex'),
        'sp' => $this->input->post('sp')

    );

    $this->db->where('id', $this->input->post('id'));
    return $this->db->update('users', $data);
  }


  public function sp_position_insert(){

    $data = array( 
            'position' => $this->input->post('position'), 
            'main_position' => $this->input->post('mp')
    );

    return $this->db->insert('users_sp', $data);
  }

  public function sp_position_update(){

    $data = array( 
            'position' => $this->input->post('position'), 
            'main_position' => $this->input->post('mp')
    );

    $this->db->where('id', $this->input->post('id'));
    return $this->db->update('users_sp', $data);
  }

  public function insert_va(){

    $this->db->simple_query('INSERT INTO hris_applications_rating (record_no, appID, education, training, experience, let_rating, demo_rating, tr_rating)
    SELECT record_no, appID, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1
    FROM hris_applications INNER JOIN hris_applicant ON hris_applications.applicant_id=hris_applicant.id where appStatus="Validated"');
    return true;
  }

  function random_password(){
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $password = array(); 
    $alpha_length = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) 
    {
        $n = rand(0, $alpha_length);
        $password[] = $alphabet[$n];
    }
    return implode($password); 
}

  public function update_request_password(){
    
    if($this->input->post('at') == 1){
        $user = $this->Common->one_cond_row('users','username',$this->input->post('email'));
        $email = $this->input->post('email');
        $username = $this->input->post('email');
    }elseif($this->input->post('at') == 2){
        $user = $this->Common->one_cond_row('hris_staff','empEmail',$this->input->post('email'));
        $username = $user->IDNumber;
        $email = $user->empEmail;
    }else{
        $user = $this->Common->one_cond_row('schools','schoolEmail',$this->input->post('email'));
        $username = $user->schoolID;
        $email = $user->schoolEmail;
    }

    $password = $this->Reg->random_password();

    $fname = 'Maam/Sir';

                //Email Notification
                $this->load->config('email');
                $this->load->library('email');
                $mail_message = 'Dear ' . $fname . ',' . "\r\n";
                //$mail_message .= '<br><br>Thank you for signing up!' . "\r\n";
                $mail_message .= '<br><br>You have successfully reset your password. Your new password is ' . ' <span style="color:red; font-weight:bold;">' . $password . ' </span>' . "\r\n";
                $mail_message .= '<br><br>Thanks & Regards,';
                $mail_message .= '<br>DepEd MIS - Online';

                $this->email->from('no-reply@depeddavor.com', 'DepEd DavOr MIS')
                    ->to($email)
                    ->subject('Password Changed')
                    ->message($mail_message);
                $this->email->send();

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $data = array(
        'Password' => $hash

    );

    $this->db->where('username', $username);
    return $this->db->update('users', $data);
}


public function aip_app_join(){

  $this->db->select('a.id,a.category,a.school_id,b.materials');
  $this->db->from('sgod_aip as a');
  $this->db->join('sgod_app as b', 'b.aip_id=a.id', 'left');
  $this->db->where('category','MINOR REPAIR');  
  $this->db->where('a.school_id','500417');  
  $this->db->group_by('b.materials');
  $this->db->order_by('b.materials','ASC');
  $query = $this->db->get(); 
  return $query->result();
}

function sbfp_upload($record)
	{

		if (count($record) > 0) {

			$data = array( 
        "fname" => trim($record[0]), 
        "mname" => trim($record[1]), 
        "lname" => trim($record[2]), 
        "lrn" => trim($record[3]), 
        "sy" => trim($record[4]), 
        "school_id" => trim($record[5]), 
        "dbirth" => trim($record[6]), 
        "w_kg" => trim($record[7]), 
        "h_m" => trim($record[8]), 
        "sex" => trim($record[9]), 
        "h_m2" => trim($record[10]), 
        "age_y" => trim($record[1]), 
        "age_m" => trim($record[12]), 
        "bmi" => trim($record[13]), 
        "nut_stat" => trim($record[14]), 
        "section" => trim($record[15]), 
        "pcfm" => trim($record[16]), 
        "p_4ps" => trim($record[17]), 
        "sbfp_in_prev" => trim($record[18]), 
        "dw" => trim($record[19]), 
        "cat_primary" => trim($record[20]), 
        "cat_second" => trim($record[21]), 
        "nut_stat_1_ns" => trim($record[22]), 
        "nut_stat_1_ha" => trim($record[23]), 
        "nut_stat_2_ns" => trim($record[24]), 
        "nut_stat_2_ha" => trim($record[25]), 
        "nut_stat_3_ns" => trim($record[26]), 
        "nut_stat_3_ha" => trim($record[27]), 
        "nut_stat_4_ns" => trim($record[28]), 
        "nut_stat_4_ha" => trim($record[29]), 
        "nut_stat_5_ns" => trim($record[30]), 
        "nut_stat_5_ha" => trim($record[31])
			);


			$this->db->insert('sbfp', $data);

			// }

		}
	}


  public function calculate_rating($fy){
    $this->db->query('update hris_applications_rating set total_points = education+training+experience+let_rating+demo_rating+tr_rating where fy='.$fy);
  }

  public function calculate_rating_none($fy){
    $this->db->query('update hris_rating_none set total_points = educ+trainings+experience+performance+oa+ae+ald+interview+written+skills where fy='.$fy);
  }

  public function lock_applicant_application($table, $jobid,$emp){
    $this->db->set('stat', 1)
             ->where('EXISTS (SELECT 1 FROM hris_applications WHERE hris_applications.empEmail = '.$table.'.'.$emp.' AND hris_applications.jobID = '.$jobid.')', null, false)
             ->update($table);
  }



  public function update_aq(){

    $data = array(
      'stat' => 1, 
    );

    $this->db->where('application_id', $this->uri->segment(3));
    return $this->db->update('hris_application_inquiry', $data);
  }
  

  
    

    





}

