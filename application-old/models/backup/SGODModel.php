<?php
class SGODModel extends CI_Model
{

	function cPublic()
	{
		$query = $this->db->query("select count(recID) as schoolCounts from schools where schoolType='Public'");
		return $query->result();
	}

	function cPrivate()
	{
		$query = $this->db->query("select count(recID) as schoolCounts from schools where schoolType='Private'");
		return $query->result();
	}

	function schoolDetails($schoolID)
	{
		$query = $this->db->query("select * from schools where schoolID='" . $schoolID . "'");
		return $query->result();
	}

	function aSectionAccomplishments($section)
	{
		$query = $this->db->query("select count(id) as Counts from sgod_accomplishments where section='" . $section . "'");
		return $query->result();
	}

	function totalSectionUsers($section)
	{
		$query = $this->db->query("select count(username) as Counts from sgod_users where section='" . $section . "'");
		return $query->result();
	}

	public function viewSections($param)
	{
		$query = $this->db->query("select * from sgod_sections where secGroup='" . $param . "' order by sectionName");
		return $query->result();
	}
	public function viewSectionsChecking($param)
	{
		$query = $this->db->query("select * from sgod_sections where secGroup='" . $param . "' and sectionName !='Chief - SGOD' order by sectionName");
		return $query->result();
	}

	function accombyid($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('sgod_accomplishments');
		return $result->result();
	}

	//$result = $this->db->query('SELECT * FROM mis.sgod_accomplishments where quarter="'.$quarter.'" and year='.$year.' and monthAcc="'.$month.'" and weekAcc='.$week.' and section="'.$sec.'" and activityCategory="'.$ac.'"');

	public function checking($quarter, $year, $week, $month, $sec, $ac)
	{
		$this->db->where("quarter", $quarter);
		$this->db->where("year", $year);
		$this->db->where("section", $sec);
		$this->db->where("monthAcc", $month);
		$this->db->where("weekAcc", $week);
		$result = $this->db->get('sgod_accomplishments');
		return $result->result();
	}

	function viewSecAccomplishments($section, $secGroup)
	{
		$this->db->where('section', $section);
		$this->db->where('secGroup', $secGroup);
		$result = $this->db->get('sgod_accomplishments');
		return $result->result();
	}

	function get_table_where($id, $table)
	{
		$this->db->where('acc_id', $id);
		$result = $this->db->get($table);
		return $result->result();
	}

	public function get_accomplishment()
	{
		$this->db->where('year', '2023');
		$result = $this->db->get('sgod_accomplishments');

		return $result->row_array();
	}
	public function get_all_data_where_single($table, $col, $val)
	{
		$this->db->where($col, $val);
		$result = $this->db->get($table);

		return $result->result_array();
	}

	public function get_accomplishment_by($cat, $quarter, $year, $week, $month, $secGroup)
	{

		$sec = $this->input->post('sec');

		$this->db->where("quarter", $quarter);
		$this->db->where("year", $year);
		$this->db->where("section", $sec);
		$this->db->where("secGroup", $secGroup);

		$this->db->where("activityCategory", $cat);

		if ($this->input->post('weekAcc') != "") {
			$this->db->where("monthAcc", $month);
			$this->db->where("weekAcc", $week);
			$this->db->where("secGroup", $secGroup);
		}
		$result = $this->db->get('sgod_accomplishments');

		return $result->result_array();
	}
	public function get_accomplishment_by_row($quarter, $year, $week, $month)
	{
		$this->db->where("quarter", $quarter);
		$this->db->where("year", $year);

		$user = $this->session->userdata('acctLevel');
		if ($user != 'System Administrator') {
			$sec = $this->session->userdata('section');
		} else {
			$sec = $this->input->post('sec');
		}

		$this->db->where("section", $sec);


		if ($this->input->post('weekAcc') != "") {
			$this->db->where("monthAcc", $month);
			$this->db->where("weekAcc", $week);
			$this->db->group_by("section");
		}
		$result = $this->db->get('sgod_accomplishments');

		return $result->row();
	}
	public function get_accomplish_by_row($quarter, $year, $week, $month)
	{
		$this->db->where("quarter", $quarter);
		$this->db->where("year", $year);

		if ($this->input->post('weekAcc') != "") {
			$this->db->where("monthAcc", $month);
			$this->db->where("weekAcc", $week);
			$this->db->group_by("section");
		}
		$result = $this->db->get('sgod_accomplishments');

		return $result->row();
	}

	public function get_accomplish_by_row_year($year)
	{
		$this->db->where("year", $year);
		$result = $this->db->get('sgod_accomplishments');
		return $result->row();
	}
	public function get_all_accomplishment($cat, $quarter, $year, $week, $month, $secGroup)
	{

		$this->db->where("quarter", $quarter);
		$this->db->where("year", $year);
		$this->db->where("activityCategory", $cat);
		$this->db->where("secGroup", $secGroup);

		if ($this->input->post('weekAcc') != "") {
			$this->db->where("monthAcc", $month);
			$this->db->where("weekAcc", $week);
			$this->db->where("secGroup", $secGroup);
		}
		$this->db->group_by('section');
		$result = $this->db->get('sgod_accomplishments');

		return $result->result();
	}

	public function get_year_accomplishment($cat, $year, $secGroup)
	{

		$this->db->where("year", $year);
		$this->db->where("activityCategory", $cat);
		$this->db->where("secGroup", $secGroup);
		$this->db->group_by('section');
		$result = $this->db->get('sgod_accomplishments');

		return $result->result();
	}

	public function get_all_acc_by_section($cat, $quarter, $year, $week, $month, $section)
	{

		$this->db->where("quarter", $quarter);
		$this->db->where("year", $year);
		$this->db->where("activityCategory", $cat);
		$this->db->where("section", $section);

		if ($this->input->post('weekAcc') != "") {
			$this->db->where("monthAcc", $month);
			$this->db->where("weekAcc", $week);
		}
		$result = $this->db->get('sgod_accomplishments');

		return $result->result();
	}

	public function get_all_acc_by_section_year($cat, $year, $section)
	{

		$this->db->where("year", $year);
		$this->db->where("activityCategory", $cat);
		$this->db->where("section", $section);
		$result = $this->db->get('sgod_accomplishments');

		return $result->result();
	}

	public function get_accomplishment_group_by_section($quarter, $year, $week)
	{

		$this->db->where("quarter", $quarter);
		$this->db->where("year", $year);

		if ($this->input->post('weekAcc') != "") {
			$this->db->where("weekAcc", $week);
		}
		$this->db->group_by('section');
		$result = $this->db->get('sgod_accomplishments');

		return $result->result();
	}

	public function get_acc_group_by_section_year($year)
	{

		$this->db->where("year", $year);

		$this->db->group_by('section');
		$result = $this->db->get('sgod_accomplishments');

		return $result->result();
	}

	public function get_acc_group_by_section($quarter, $year, $week, $month)
	{

		$this->db->where("quarter", $quarter);
		$this->db->where("year", $year);

		if ($this->input->post('weekAcc') != "") {
			$this->db->where("weekAcc", $week);
			$this->db->where("monthAcc", $month);
		}

		$this->db->group_by('section');
		$result = $this->db->get('sgod_accomplishments');

		return $result->result();
	}

	public function get_aip($school_id, $fy, $bcode)
	{
		$this->db->where("school_id", $school_id);
		$this->db->where("fy", $fy);
		$this->db->where("b_code", $bcode);
		$this->db->group_by('pia');
		$result = $this->db->get('sgod_aip');

		return $result->result();
	}

	public function get_aip_sip_project($school_id, $fy, $pia, $bcode)
	{
		$this->db->where("school_id", $school_id);
		$this->db->where("fy", $fy);
		$this->db->where("b_code", $bcode);
		$this->db->where("pia", $pia);
		$this->db->group_by('sip_project');
		$result = $this->db->get('sgod_aip');
		return $result->result();
	}

	public function get_aip_by_sip($school_id, $fy, $sip, $bcode)
	{
		$this->db->where("school_id", $school_id);
		$this->db->where("fy", $fy);
		$this->db->where("b_code", $bcode);
		$this->db->where("sip_project", $sip);
		$result = $this->db->get('sgod_aip');
		return $result->result();
	}

	public function get_aip_row($school_id, $fy, $bcode)
	{
		$this->db->where("school_id", $school_id);
		$this->db->where("fy", $fy);
		$this->db->where("b_code", $bcode);
		$this->db->group_by('fy');
		$result = $this->db->get('sgod_aip');

		return $result->row();
	}
	public function aip_related_row($table, $school_id, $fy, $bcode)
	{
		$this->db->where("school_id", $school_id);
		$this->db->where("fy", $fy);
		$this->db->where("b_code", $bcode);
		$this->db->group_by('fy');
		$result = $this->db->get($table);
		return $result->row();
	}

	public function aip_category($table, $school_id, $fy, $bcode, $cat)
	{
		$this->db->where("school_id", $school_id);
		$this->db->where("fy", $fy);
		$this->db->where("b_code", $bcode);
		$this->db->where("category", $cat);
		$this->db->where("budget_source", 'MOOE');
		$result = $this->db->get($table);
		return $result->result();
	}
	public function get_all_aip($school_id, $fy, $pia, $code)
	{
		$this->db->where("school_id", $school_id);
		$this->db->where("fy", $fy);
		$this->db->where("b_code", $code);
		$this->db->where("pia", $pia);
		$result = $this->db->get('sgod_aip');

		return $result->result();
	}




	public function get_all_aip_by()
	{
		$this->db->where("school_id", $this->input->post('school_id'));

		$fy = $this->input->post('fy');
		$pillar = $this->input->post('pillar');
		$domain = $this->input->post('domain');
		$strand = $this->input->post('strand');
		$pias = $this->input->post('pias');

		if ($fy != "") {
			$this->db->where("fy", $fy);
		}
		if ($pillar != "") {
			$this->db->where("pillar", $pillar);
		}
		if ($domain != "") {
			$this->db->where("domain", $domain);
		}
		if ($strand != "") {
			$this->db->where("strand", $strand);
		}
		if ($pias != "") {
			$this->db->where("pia", $pias);
		}
		$result = $this->db->get('sgod_aip');

		return $result->result();
	}

	public function get_single_table_by_id($col, $table, $param)
	{
		$this->db->where($col, $param);
		$result = $this->db->get($table);

		return $result->row_array();
	}
	public function get_single_by_id($col, $table, $param)
	{
		$this->db->where($col, $param);
		$result = $this->db->get($table);

		return $result->row();
	}
	public function get_all_by_row($col, $table, $param)
	{
		$this->db->where($col, $param);
		$result = $this->db->get($table);

		return $result->result();
	}

	public function get_all_by_row2($col, $table, $secGroup, $col2, $section)
	{
		$this->db->where($col, $secGroup);
		$this->db->where($col2, $section);
		$result = $this->db->get($table);

		return $result->result();
	}

	public function count_table_row($table){
		$result = $this->db->get($table);
		return $result;
	}
	public function count_sections($table, $param)
	{
		$this->db->where("secGroup", $param);
		$result = $this->db->get($table);
		return $result;
	}

	public function count_sec_users($table, $param)
	{
		$this->db->where("secGroup", $param);
		$result = $this->db->get($table);
		return $result;
	}

	public function count_sec_accomplishments($table, $param)
	{
		$this->db->where("secGroup", $param);
		$result = $this->db->get($table);
		return $result;
	}

	public function get_all($table)
	{
		$result = $this->db->get($table);
		return $result->result();
	}

	public function get_all_orderby($table, $col, $val)
	{
		$this->db->order_by($col, $val);
		$result = $this->db->get($table);
		return $result->result();
	}
	public function one_cond_orderby($table, $ccol, $cval, $col, $val){
		$this->db->where($ccol, $cval);
		$this->db->order_by($col, $val);
		$result = $this->db->get($table);
		return $result->result();
	}


	public function two_cond_orderby($table, $ccol, $cval, $ccol2, $cval2, $col, $val){
		$this->db->where($ccol, $cval);
		$this->db->where($ccol2, $cval2);
		$this->db->order_by($col, $val);
		$this->db->limit(1); 
		$result = $this->db->get($table);
		return $result->row();
	}

	
	
	public function count_all($table,$col,$val){
		$query = $this->db->get_where($table, array($col => $val));
		return $query;
	}

	public function count_all_two_cond($table,$col,$val,$col2,$val2){
		$query = $this->db->get_where($table, array($col => $val,$col2 =>$val2));
		return $query;
	}



	// public function count_all($table){
	// 	$query = $this->db->get_where($table, array('company_id' => $this->session->com_id,'status' => '0'));
	// 	return $query;
	// }
	


	public function one_cond($table, $col, $val){
		$this->db->where($col, $val);
		$result = $this->db->get($table);
		return $result->result();
	}

	public function no_cond($table){
		$result = $this->db->get($table);
		return $result->result();
	}

	public function two_cond_rca($table, $col, $val, $mon){
		$this->db->where($col, $val);
		$this->db->where($mon . ' !=', 0);
		$result = $this->db->get($table);
		return $result->result();
	}


	public function two_cond_not_equal_sencod($table, $col, $val, $col2,$val2){
		$this->db->where($col, $val);
		$this->db->where($col2 . ' !=', $val2);
		$result = $this->db->get($table);
		return $result->result();
	}

	public function three_cond_not_equal_cond($table, $col, $val, $col2,$val2, $col3,$val3){
		$this->db->where($col, $val);
		$this->db->where($col2, $val2);
		$this->db->where($col3 . ' !=', $val3);
		$result = $this->db->get($table);
		return $result->result();
	}


	public function two_cond_count_not_equal_cond($table, $col, $val, $col2,$val2){
		$this->db->where($col, $val);
		$this->db->where($col2 . ' !=', $val2);
		$result = $this->db->get($table);
		return $result;
	}

	public function three_cond_count_not_equal_cond($table, $col, $val, $col2,$val2, $col3,$val3){
		$this->db->where($col, $val);
		$this->db->where($col2, $val2);
		$this->db->where($col3 . ' !=', $val3);
		$result = $this->db->get($table);
		return $result;
	}

	public function one_cond_not_equal($table, $col,$val){
		$this->db->where($col . ' !=', $val);
		$result = $this->db->get($table);
		return $result->result();
	}

	public function two_cond($table, $col, $val, $col2, $val2){
		$this->db->where($col, $val);
		$this->db->where($col2, $val2);
		$result = $this->db->get($table);
		return $result->result();
	}

	public function two_cond_group($table, $col, $val, $col2, $val2, $valcol)
	{
		$this->db->where($col, $val);
		$this->db->where($col2, $val2);
		$this->db->group_by($valcol);
		$result = $this->db->get($table);
		return $result->result();
	}
	public function no_cond_group_by($table, $valcol){
		$this->db->group_by($valcol);
		$result = $this->db->get($table);
		return $result->result();
	}

	public function three_cond($table, $col, $val, $col2, $val2, $col3, $val3){
		$this->db->where($col, $val);
		$this->db->where($col2, $val2);
		$this->db->where($col3, $val3);
		$result = $this->db->get($table);
		return $result->result();
	}

	public function one_cond_where_or($table, $col, $val, $col2, $val2)
	{
		$this->db->where($col, $val);
		$this->db->or_where($col2, $val2);
		$result = $this->db->get($table);
		return $result->result();
	}

	public function two_cond_row($table, $col, $val, $col2, $val2)
	{
		$this->db->where($col, $val);
		$this->db->where($col2, $val2);
		$result = $this->db->get($table);
		return $result->row();
	}

	public function get_last_record($table)
	{
		$this->db->order_by('id', 'DESC')->limit(1);
		$result = $this->db->get($table);
		return $result->row();
	}

	


	public function three_cond_row($table, $col, $val, $col2, $val2, $col3, $val3)
	{
		$this->db->where($col, $val);
		$this->db->where($col2, $val2);
		$this->db->where($col3, $val3);
		$result = $this->db->get($table);
		return $result->row();
	}

	public function one_cond_row($table, $col, $val)
	{
		$this->db->where($col, $val);
		$result = $this->db->get($table);
		return $result->row();
	}

	public function get_data_by_id($table, $col, $val)
	{
		$this->db->where($col, $val);
		$result = $this->db->get($table);
		return $result->row();
	}
	public function last_record($table, $col, $val){
		$this->db->order_by($col, $val);
		$this->db->limit(1);
		$result = $this->db->get($table);
		return $result->row();
	}

	public function aip($table, $val1, $val2, $val3, $val4)
	{
		$this->db->where('school_id', $val1);
		$this->db->where('fy', $val2);
		$this->db->where('b_code', $val3);
		$this->db->where('category', $val4);
		$this->db->where('budget_source', 'MOOE');

		$result = $this->db->get($table);
		return $result->result();
	}



	public function delete($segment, $col_id, $table)
	{
		$id = $this->uri->segment($segment);
		$this->db->where($col_id, $id);
		$this->db->delete($table);
		return true;
	}

	// public function delete_percentage(){
	// 	$this->db->where('b_code',$_SESSION['aip']);
	// 	$this->db->where('fy',$_SESSION['fy']);
	// 	$this->db->where('school_id',$this->session->username);
	// 	$this->db->delete('sgod_app_percentage');
	// 	return true;
	// }


	public function table_num($table)
	{
		$query = $this->db->get_where($table, array('status' => '0'));
		return $query;
	}

	public function update_noti(){

		$id = $this->uri->segment(3);

		$data = array(
			'notify' => 0
		);

		$this->db->where('submit_id', $id);
		$this->db->where('res !=', $this->session->username);
		return $this->db->update('sgod_aip_track', $data);
	}

	

	//Settings area

	public function insert_app_cat(){
		$data = array(
			'category' => $this->input->post('category')
		);

		return $this->db->insert('sgod_settings_cat', $data);
	}

	public function update_app_cat(){

		$id = $this->input->post('id');

		$data = array(
			'category' => $this->input->post('category')
		);

		$this->db->where('id', $id);
		return $this->db->update('sgod_settings_cat', $data);
	}

	public function insert_app_pillar(){
		$data = array(
			'pillar' => $this->input->post('pillar')
		);

		return $this->db->insert('sgod_settings_pillar', $data);
	}

	public function update_app_pillar(){

		$id = $this->input->post('id');

		$data = array(
			'pillar' => $this->input->post('pillar')
		);

		$this->db->where('id', $id);
		return $this->db->update('sgod_settings_pillar', $data);
	}

	public function insert_domain(){
		$data = array(
			'domain' => $this->input->post('domain')
		);

		return $this->db->insert('sgod_settings_domain', $data);
	}

	public function update_domain(){

		$id = $this->input->post('id');

		$data = array(
			'domain' => $this->input->post('domain')
		);

		$this->db->where('id', $id);
		return $this->db->update('sgod_settings_domain', $data);
	}

	public function insert_strand(){
		$data = array(
			'strand' => $this->input->post('strand')
		);

		return $this->db->insert('sgod_settings_strand', $data);
	}

	public function insert_fy(){
		$data = array(
			'fy' => $this->input->post('fy')
		);

		return $this->db->insert('sgod_fy', $data);
	}

	public function update_strand(){

		$id = $this->input->post('id');

		$data = array(
			'strand' => $this->input->post('strand')
		);

		$this->db->where('id', $id);
		return $this->db->update('sgod_settings_strand', $data);
	}

	public function insert_pias(){
		$data = array(
			'pias' => $this->input->post('pias'),
			'year' => $this->input->post('year'),
			'school_id' => $this->session->username
		);

		return $this->db->insert('sgod_settings_pias', $data);
	}

	public function update_pias()
	{

		$id = $this->input->post('id');

		$data = array(
			'pias' => $this->input->post('pias'),
			'year' => $this->input->post('year')
		);

		$this->db->where('id', $id);
		return $this->db->update('sgod_settings_pias', $data);
	}

	public function insert_matatag()
	{
		$data = array(
			'matatag' => $this->input->post('matatag')
		);

		return $this->db->insert('sgod_settings_matatag', $data);
	}

	public function insert_app_percentage()
	{
		$data = array(
			'mb' => $this->input->post('mb'),
			'mr' => $this->input->post('mr'),
			'tli' => $this->input->post('tli'),
			'tst' => $this->input->post('tst'),
			'b_code' => $this->input->post('b_code'),
			'school_id' => $this->input->post('school_id'),
			'fy' => $_SESSION['fy']
		);

		return $this->db->insert('sgod_app_percentage', $data);
	}
	public function update_app_percentage()
	{
		$id = $this->input->post('id');

		$data = array(
			'mb' => $this->input->post('mb'),
			'mr' => $this->input->post('mr'),
			'tli' => $this->input->post('tli'),
			'tst' => $this->input->post('tst'),
			'b_code' => $this->input->post('b_code'),
			'school_id' => $this->input->post('school_id'),
			'fy' => $_SESSION['fy']
		);

		$this->db->where('id', $id);
		return $this->db->update('sgod_app_percentage', $data);
	}

	public function insert_bs()
	{
		$data = array(
			'description' => $this->input->post('description')
		);

		return $this->db->insert('sgod_settings_bs', $data);
	}

	public function update_matatag()
	{

		$id = $this->input->post('id');

		$data = array(
			'matatag' => $this->input->post('matatag')
		);

		$this->db->where('id', $id);
		return $this->db->update('sgod_settings_matatag', $data);
	}

	public function insert_aip()
	{
		$data = array(
			'school_id' => $this->input->post('school_id'),
			'fy' => $this->input->post('fy'),
			'pillar' => $this->input->post('pillar'),
			'domain' => $this->input->post('domain'),
			'strand' => $this->input->post('strand'),
			'pia' => $this->input->post('pia'),
			'sip_project' => $this->input->post('sip_project'),
			'sip_pObjective' => $this->input->post('sip_pObjective'),
			'sip_output' => $this->input->post('sip_output'),
			'strategy' => $this->input->post('strategy'),
			'pi' => $this->input->post('pi'),
			'movs' => $this->input->post('movs'),
			'pr' => $this->input->post('pr'),
			'schedule' => $this->input->post('schedule'),
			'venue' => $this->input->post('venue'),
			'budget' => $this->input->post('budget'),
			'budget_source' => $this->input->post('budget_source'),
			'materials' => $this->input->post('materials'),
			'matatag' => $this->input->post('matatag'),
			'b_code' => $this->input->post('b_code'),
			'category' => $this->input->post('category'),
			'group' => $this->input->post('group'),
			'io' => $this->input->post('io')
		);

		return $this->db->insert('sgod_aip', $data);
	}

	public function insert_app()
	{

		$materials = explode(',', $this->input->post('materials'));
		$id = $this->db->insert_id();

		for ($i = 0; $i < count($materials); $i++) {

			$item = array(
				'materials' => $materials[$i],
				'aip_id' => $id,
				'b_code' => $this->input->post('b_code'),
				'fy' => $this->input->post('fy'),
				'school_id' => $this->session->username,
				'bs' => $this->input->post('budget_source')
			);

			$this->db->insert('sgod_app', $item);
		}
	}

	public function update_app()
	{

		$materials = explode(',', $this->input->post('materials'));
		$id = $this->input->post('aip_id');

		for ($i = 0; $i < count($materials); $i++) {

			$item = array(
				'materials' => $materials[$i],
				'aip_id' => $id,
				'b_code' => $this->input->post('b_code'),
				'fy' => $this->input->post('fy'),
				'school_id' => $this->session->username,
				'bs' => $this->input->post('budget_source')
			);

			$this->db->insert('sgod_app', $item);
		}
	}

	public function reupdate_app()
	{

		$id = $this->input->post('id');
		$data = array(
			'unit_price' => $this->input->post('unit_price'),
			'quantity' => 0,
			'unit_measure' => $this->input->post('unit_measure'),
			'budget_alloc' => 0,
			'jan' => $this->input->post('jan'),
			'feb' => $this->input->post('feb'),
			'mar' => $this->input->post('mar'),
			'april' => $this->input->post('april'),
			'may' => $this->input->post('may'),
			'june' => $this->input->post('june'),
			'july' => $this->input->post('july'),
			'aug' => $this->input->post('aug'),
			'sept' => $this->input->post('sept'),
			'oct' => $this->input->post('oct'),
			'nov' => $this->input->post('nov'),
			'dec' => $this->input->post('dec'),
			'stat' => 1,
			'qjan' => $this->input->post('qjan'),
			'qfeb' => $this->input->post('qfeb'),
			'qmar' => $this->input->post('qmar'),
			'qapril' => $this->input->post('qapril'),
			'qmay' => $this->input->post('qmay'),
			'qjune' => $this->input->post('qjune'),
			'qjuly' => $this->input->post('qjuly'),
			'qaug' => $this->input->post('qaug'),
			'qsept' => $this->input->post('qsept'),
			'qoct' => $this->input->post('qoct'),
			'qnov' => $this->input->post('qnov'),
			'qdec' => $this->input->post('qdec'),
		);

		$this->db->where('id', $id);
		return $this->db->update('sgod_app', $data);
	}

	public function insert_sop()
	{
		$data = array(
			'aip_id' => $this->input->post('aip_id'),
			'q1' => $this->input->post('q1'),
			'q2' => $this->input->post('q2'),
			'q3' => $this->input->post('q3'),
			'q4' => $this->input->post('q4'),
			'total' => $this->input->post('total'),
			'type' => $this->input->post('type')
		);

		return $this->db->insert('sgod_sop', $data);
	}
	public function update_sop($id)
	{
		$data = array(
			'q1' => $this->input->post('q1'),
			'q2' => $this->input->post('q2'),
			'q3' => $this->input->post('q3'),
			'q4' => $this->input->post('q4'),
			'total' => $this->input->post('total'),
		);

		$this->db->where('id', $id);
		return $this->db->update('sgod_sop', $data);
	}

	public function update_aip($param){

		$data = array(
			'school_id' => $this->input->post('school_id'),
			'fy' => $this->input->post('fy'),
			'pillar' => $this->input->post('pillar'),
			'domain' => $this->input->post('domain'),
			'strand' => $this->input->post('strand'),
			'pia' => $this->input->post('pia'),
			'sip_project' => $this->input->post('sip_project'),
			'sip_pObjective' => $this->input->post('sip_pObjective'),
			'sip_output' => $this->input->post('sip_output'),
			'strategy' => $this->input->post('strategy'),
			'pi' => $this->input->post('pi'),
			'movs' => $this->input->post('movs'),
			'pr' => $this->input->post('pr'),
			'schedule' => $this->input->post('schedule'),
			'venue' => $this->input->post('venue'),
			'category' => $this->input->post('category'),
			'budget' => $this->input->post('budget'),
			'budget_source' => $this->input->post('budget_source'),
			'matatag' => $this->input->post('matatag'),
			'io' => $this->input->post('io')
		);

		$this->db->where('id', $param);
		return $this->db->update('sgod_aip', $data);
	}

	

	public function insert_aip_action(){
		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d', time());
		$t = date('h:i:s a', time());

		$data = array(
			'submit_id' => $this->input->post('submit_id'),
			'action' => $this->input->post('action'),
			'remarks' => $this->input->post('remarks'),
			'tdate' => $date,
			'ttime' => $t,
			'res' => $this->session->username
		);

		return $this->db->insert('sgod_aip_track', $data);
	}

	public function insert_materials(){

		$data = array(
			'aip_id' => $this->input->post('aip_id'),
			'materials' => $this->input->post('material'),
			'aip_id' => $this->input->post('aip_id'), 
			'school_id' => $this->input->post('school_id'),
			'fy' => $this->input->post('fy'),
			'b_code' => $this->input->post('b_code')
		);

		return $this->db->insert('sgod_app', $data);
	}

	public function update_aip_materials(){

		$aip_id = $this->input->post('aip_id');
		$mat = $this->input->post('material');
		$mats = $this->input->post('aip_marterials');

		$data = array(
			'materials' => $mats.', '.$mat
		);

		$this->db->where('id', $aip_id);
		return $this->db->update('sgod_aip', $data);
	}

	public function update_aip_material($mat){

		$aip_id = $this->uri->segment(4);

		$data = array(
			'materials' => $mat
		);

		$this->db->where('id', $aip_id);
		return $this->db->update('sgod_aip', $data);
	}

	public function aip_approved()
	{
		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d', time());
		$t = date('h:i:s a', time());

		$data = array(
			'submit_id' => $this->uri->segment(3),
			'remarks' => "Approved",
			'tdate' => $date,
			'dtime' => $t,
			'res' => $this->session->username
		);

		return $this->db->insert('sgod_aip_track', $data);
	}

	public function request(){
		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d', time());
		$t = date('h:i:s a', time());

		$data = array(
			'fy' => $_SESSION['fy'], 
			'b_code' => $_SESSION['aip'], 
			'school_id' => $this->session->username, 
			'tdate' => $date, 
			'ttime' => $t, 
			'remarks' => $this->input->post('remarks')
		);

		return $this->db->insert('sgod_aip_request', $data);
	}
	public function request_update(){
		$data = array(
			'stat' => 1
		);
		return $this->db->update('sgod_aip_request', $data);
	}

	public function request_insert_track(){
		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d', time());
		$t = date('h:i:s a', time());

		$data = array(
			'submit_id' => $this->input->post('id'),
			'remarks' => 'Request for Unlock: '.$this->input->post('remarks'),
			'tdate' => $date,
			'dtime' => $t,
			'res' => $this->session->username
		);

		return $this->db->insert('sgod_aip_track', $data);
	}

	public function aip_remarks(){
		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d', time());
		$t = date('h:i:s a', time());

		$data = array(
			'submit_id' => $this->input->post('id'),
			'school_id' => $this->input->post('school_id'),
			'remarks' => $this->input->post('remarks'),
			'tdate' => $date,
			'dtime' => $t,
			'res' => $this->session->username,
			'notify' => 1,
			'position' => $this->session->position
		);

		return $this->db->insert('sgod_aip_track', $data);
	}

	public function aip_open()
	{
		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d', time());
		$t = date('h:i:s a', time());

		$data = array(
			'submit_id' => $this->input->post('id'),
			'remarks' => $this->input->post('remarks'),
			'tdate' => $date,
			'dtime' => $t,
			'res' => $this->session->username
		);

		return $this->db->insert('sgod_aip_track', $data);
	}
	public function update_aip_open()
	{

		$id = $this->input->post('id');

		$data = array(
			'status' => 0,
			'remarks' => $this->input->post('reason')
		);

		$this->db->where('id', $id);
		return $this->db->update('sgod_aip_submit', $data);
	}

	public function update_aip_action()
	{

		$id = $this->uri->segment(3);

		$data = array(
			'status' => 1,
			'remarks' => "Approved"
		);

		$this->db->where('id', $id);
		return $this->db->update('sgod_aip_submit', $data);
	}

	public function aip_submit($fy, $id, $bcode)
	{
		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d', time());

		$data = array(
			'school_id' => $id,
			'fy' => $fy,
			'remarks' => 'Submitted',
			'res' => $this->session->username,
			'date' => $date,
			'b_code' => $bcode
		);

		return $this->db->insert('sgod_aip_submit', $data);
	}
	public function aip_track($id)
	{
		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d', time());
		$t = date('h:i:s a', time());

		$data = array(
			'submit_id' => $id,
			'school_id' => $this->session->username,
			'remarks' => 'Submitted',
			'res' => $this->session->username,
			'tdate' => $date,
			'dtime' => $t,
			'position' => 'School',
			'notify' => 1
		);

		return $this->db->insert('sgod_aip_track', $data);
	}

	// public function update_aip_status(){

	// 	$fy = 2023;
	// 	$school_id = 129443;

	// 	$data = array(
	// 	'status' => 0
	// 	); 

	// 	//$this->db->where('status', 0);
	// 	$this->db->where('fy', $fy);
	// 	$this->db->where('school_id', $school_id);
	// 	return $this->db->update('sgod_aip', $data);	
	// }


	function schools($type)
	{
		$this->db->where('schoolType', $type);
		$this->db->order_by('schoolName');
		$result = $this->db->get('schools');
		return $result->result();
	}
	function insert_memo()
	{
		$file = $this->upload->data();
		$filename = $file['file_name'];

		$data = array(
			'file' => $filename,
			'title' => $this->input->post('title')
		);

		return $this->db->insert('sgod_memo', $data);
	}

	public function multiple_images($image = array())
	{
		return $this->db->insert_batch('sgod_acc_image', $image);
	}

	public function atr($image = array())
	{
		return $this->db->insert_batch('sgod_files', $image);
	}

	function delete_group($param, $attach, $path, $table)
	{
		$this->db->where('id', $param);
		unlink("upload/" . $path . "/" . $attach);
		$this->db->delete($table, array('id' => $param));
	}

	function copy_row($param)
	{
		$query = $this->db->query("INSERT INTO sgod_accomplishments
		(quarter, year, monthAcc, weekAcc, section, activity, activityCategory, particulars, venue, targetDate, dateConducted, encoder, resources, notes, perIndicators, target, achieved, percentageAccom, remarks, secGroup)
		SELECT quarter, year, monthAcc, weekAcc, section, activity, activityCategory, particulars, venue, targetDate, dateConducted, encoder, resources, notes, perIndicators, target, achieved, percentageAccom, remarks, secGroup
		FROM sgod_accomplishments
		WHERE id = '{$param}'");
	}

	public function get_accomplishment_by_date($year, $month, $week, $section, $secGroup)
	{
		$this->db->where("year", $year);
		$this->db->where("monthAcc", $month);
		$this->db->where("weekAcc", $week);
		$this->db->where('section', $section);
		$this->db->where('secGroup', $secGroup);
		$result = $this->db->get('sgod_accomplishments');

		return $result->result();
	}

	public function two_cond_count_rows($table,$col,$val,$col2,$val2){
		$result = $this->db->where($col,$val);
		$result = $this->db->where($col2,$val2);
        $result = $this->db->get($table);
        return $result;
    }

	public function one_cond_count_rows($table,$col,$val){
		$result = $this->db->where($col,$val);
        $result = $this->db->get($table);
        return $result;
    }



// code @ 1/12/2024 //

public function insert_school(){
	$data = array(
		'schoolID' => $this->input->post('schoolID'), 
		'schoolName' => $this->input->post('schoolName'), 
		'division' => 'Davao Oriental Division', 
		'district' => $this->input->post('district'), 
		'course' => $this->input->post('course'), 
		'schoolType' => $this->input->post('schoolType'), 
		'yearEstab' => $this->input->post('yearEstab'), 
		'schoolEmail' => $this->input->post('schoolEmail'), 
		'congDist' => $this->input->post('congDist'), 
		'province' => $this->input->post('province'), 
		'city' => $this->input->post('city'), 
		'brgy' => $this->input->post('brgy'), 
		'adminFName' => $this->input->post('adminFName'), 
		'adminMName' => $this->input->post('adminMName'), 
		'adminLName' => $this->input->post('adminLName'), 
		'adminMobile' => $this->input->post('adminMobile'), 
		'adminEmail' => $this->input->post('adminEmail'), 
		'settingsID' => 1, 
		'adminDesignation' => $this->input->post('adminDesignation'),  
		'schoolLogo' => 'logo.png'
	);

	return $this->db->insert('schools', $data);
}

public function update_fund_allocation(){

	$id = $this->input->post('id');
	$fund = $this->input->post('alloc_amount');
	$m = $fund/12;

	$data = array(
		'alloc_amount' => $fund, 
		'mo_jan' => $m, 
		'mo_feb' => $m, 
		'mo_mar' => $m, 
		'mo_apr' => $m, 
		'mo_may' => $m, 
		'mo_jun' => $m, 
		'mo_jul' => $m, 
		'mo_aug' => $m, 
		'mo_sep' => $m, 
		'mo_oct' => $m, 
		'mo_nov' => $m, 
		'mo_dec' => $m
	);

	$this->db->where('id', $id);
	return $this->db->update('sgod_school_allocation', $data);
}

public function change_pass(){

	$id = $this->input->post('id');

	$password = $this->input->post('pass');
	$hash = password_hash($password, PASSWORD_DEFAULT);
	$data = array(
		'password' => $hash
	);

	$this->db->where('id', $id);
	return $this->db->update('users', $data);
}

public function insert_fund_allocation(){
	$fund = $this->input->post('alloc_amount');
	$f = $fund/12;

	if($this->input->post('type') == 'MOOE'){
		$jan = $f;
		$feb = $f;
		$mar = $f;
		$apr = $f;
		$may = $f;
		$jun = $f;
		$jul = $f;
		$aug = $f;
		$sep = $f;
		$oct = $f;
		$nov = $f;
		$dec = $f;
	}else{
		$jan = 0;
		$feb = 0;
		$mar = 0;
		$apr = 0;
		$may = 0;
		$jun = 0;
		$jul = 0;
		$aug = 0;
		$sep = 0;
		$oct = 0;
		$nov = 0;
		$dec = 0;
	}


	$data = array( 
		'schoolID' => $this->input->post('schoolID'), 
		'alloc_year' => $this->input->post('fy'), 
		'alloc_batch' => $this->input->post('bcode'), 
		'alloc_amount' => $this->input->post('alloc_amount'), 
		'alloc_type' => $this->input->post('type'), 
		'alloc_group' => $this->input->post('group'), 
		'mo_jan' => $jan, 
		'mo_feb' => $feb, 
		'mo_mar' => $mar, 
		'mo_apr' => $apr, 
		'mo_may' => $may, 
		'mo_jun' => $jun, 
		'mo_jul' => $jul, 
		'mo_aug' => $aug, 
		'mo_sep' => $sep, 
		'mo_oct' => $oct, 
		'mo_nov' => $nov, 
		'mo_dec' => $dec
	);

	return $this->db->insert('sgod_school_allocation', $data);
}







}
