<?php


class Common extends CI_Model{

    public function __construct(){
        $this->load->database();

    }
public function one_cond_between($table,$col,$val,$con,$minvalue,$maxvalue){
    $this->db->where($col, $val);
    $this->db->where("$con BETWEEN '$minvalue' AND '$maxvalue'");
    $query = $this->db->get($table);
    return $query->result();
}

// common functions loop

public function no_cond($table){
    $query = $this->db->get($table);
    return $query->result();
}

public function one_cond($table,$col,$val){
    $this->db->where($col, $val);
    $query = $this->db->get($table);
    return $query->result();
}

public function two_cond($table,$col,$val,$col2,$val2){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $query = $this->db->get($table);
    return $query->result();
}
public function three_cond($table,$col,$val,$col2,$val2,$col3,$val3){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3, $val3);
    $query = $this->db->get($table);
    return $query->result();
}

public function four_cond($table,$col,$val,$col2,$val2,$col3,$val3,$col4,$val4){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3, $val3);
    $this->db->where($col4, $val4);
    $query = $this->db->get($table);
    return $query->result();
}

public function four_cond_or($table,$col,$val,$col2,$val2,$col3,$val3,$col4,$val4,$orcol,$orval,$orcol2,$orval2){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3, $val3);
    $this->db->where($col4, $val4);
    $this->db->or_where($orcol, $orval);
    $this->db->or_where($orcol2, $orval2);
    $query = $this->db->get($table);
    return $query->result();
}

public function one_cond_or($table,$col,$val,$orcol,$orval){
    $this->db->where($col, $val);
    $this->db->or_where($orcol, $orval);
    $query = $this->db->get($table);
    return $query->result();
}

public function one_cond_two_or($table,$col,$val,$orcol,$orval,$orcol2,$orval2){
    $this->db->where($col, $val);
    $this->db->or_where($orcol, $orval);
    $this->db->or_where($orcol2, $orval2);
    $query = $this->db->get($table);
    return $query->result();
}

public function five_cond($table,$col,$val,$col2,$val2,$col3,$val3,$col4,$val4,$col5,$val5){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3, $val3);
    $this->db->where($col4, $val4);
    $this->db->where($col5, $val5);
    $query = $this->db->get($table);
    return $query->result();
}

public function three_cond_not_equal($table,$col,$val,$col2,$val2,$col3,$val3,$colob,$colobv){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3.' != ', $val3);
    $this->db->order_by($colob, $colobv);
    $query = $this->db->get($table);
    return $query->result();
}

public function four_cond_not_equal($table,$col,$val,$col2,$val2,$col3,$val3,$col4,$val4,$colob,$colobv){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3, $val3);
    $this->db->where($col4.' != ', $val4);
    $this->db->order_by($colob, $colobv);
    $query = $this->db->get($table);
    return $query->result();
}

public function three_cond_not_equal_gb($table,$col,$val,$col2,$val2,$col3,$val3,$colob,$colobv,$gb){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3.' != ', $val3);
    $this->db->order_by($colob, $colobv);
    $this->db->group_by($gb);
    $query = $this->db->get($table);
    return $query->result();
}



// one condation order by
public function no_cond_order_by($table,$orderby,$orderbyvalue){
    $this->db->order_by($orderby, $orderbyvalue);
    $query = $this->db->get($table);
    return $query->result();
}
public function one_cond_loop_order_by($table,$col,$val,$orderby,$orderbyvalue){
    $this->db->where($col, $val);
    $this->db->order_by($orderby, $orderbyvalue);
    $query = $this->db->get($table);
    return $query->result();
}

public function two_cond_order_by($table,$col,$val,$col2, $val2, $orderby,$orderbyvalue){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->order_by($orderby, $orderbyvalue);
    $query = $this->db->get($table);
    return $query->result();
}

public function three_cond_order_by($table,$col,$val,$col2, $val2,$col3, $val3,$orderby,$orderbyvalue){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3, $val3);
    $this->db->order_by($orderby, $orderbyvalue);
    $query = $this->db->get($table);
    return $query->result();
}

public function three_cond_order_by_or($table,$col,$val,$col2, $val2,$col3, $val3,$orderby,$orderbyvalue){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3, $val3);
    $this->db->order_by($orderby, $orderbyvalue);
    $query = $this->db->get($table);
    return $query->result();
}

// one condation group by

public function no_cond_group($table,$valcol){
	$this->db->group_by($valcol);
	$result = $this->db->get($table);
	return $result->result();
}

public function one_cond_group($table, $col, $val,$valcol){
	$this->db->where($col, $val);
	$this->db->group_by($valcol);
	$result = $this->db->get($table);
	return $result->result();
}

public function two_cond_group($table, $col,$val,$col2,$val2,$valcol){
	$this->db->where($col, $val);
    $this->db->where($col2, $val2);
	$this->db->group_by($valcol);
	$result = $this->db->get($table);
	return $result->result();
}




// common function single row
public function one_cond_row($table, $col, $val){
    $this->db->where($col, $val);
    $result = $this->db->get($table)->row();
    return $result;
}

public function two_cond_row($table,$col,$val,$col2,$val2){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $result = $this->db->get($table)->row();
    return $result;
}

public function three_cond_row($table,$col,$val,$col2,$val2,$col3,$val3){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3, $val3);
    $result = $this->db->get($table)->row();
    return $result;
}

public function two_cond_not_equal_row($table,$col,$val,$col2,$val2){
    $this->db->where($col, $val);
    $this->db->where($col2.' != ', $val2);
    $result = $this->db->get($table)->row();
    return $result;
}



public function three_cond_not_equal_row($table, $col,$val,$col2,$val2,$col3,$val3){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3.' != ', $val3);
    $result = $this->db->get($table)->row();
    return $result;
}

public function one_cond_row_desc($table,$col,$val,$ob,$obv){
    $this->db->where($col, $val);
    $this->db->order_by($ob,$obv);
    $result = $this->db->get($table)->row();
    return $result;
}


// common function count

public function no_cond_count_row($table){
    $result = $this->db->get($table);
    return $result;
}

public function one_cond_count_row($table, $col, $val){
    $this->db->where($col, $val);
    $result = $this->db->get($table);
    return $result;
}

public function two_cond_count_row($table, $col,$val,$col2,$val2){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $result = $this->db->get($table);
    return $result;
}

public function three_cond_not_equal_count_row($table, $col,$val,$col2,$val2,$col3,$val3){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3.' != ', $val3);
    $result = $this->db->get($table);
    return $result;
}

public function three_cond_count_row($table, $col,$val,$col2,$val2,$col3,$val3){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3, $val3);
    $result = $this->db->get($table);
    return $result;
}

public function four_cond_count_row($table, $col,$val,$col2,$val2,$col3,$val3,$col4,$val4){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3, $val3);
    $this->db->where($col4, $val4);
    $result = $this->db->get($table);
    return $result;
}

public function four_cond_count_row_one_not_equal($table, $col,$val,$col2,$val2,$col3,$val3,$col4,$val4){
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->where($col3, $val3);
    $this->db->where($col4.' != ', $val4);
    $result = $this->db->get($table);
    return $result;
}

//join table

public function two_join_one_cond($t1,$t2,$select,$joinby,$col,$val,$gb,$ob,$obval){
    $this->db->select($select);
    $this->db->from($t1.' as a');
    $this->db->join($t2.' as b', $joinby, 'left');
    $this->db->where($col, $val);  
    $this->db->group_by($gb);
    $this->db->order_by($ob,$obval);
    $query = $this->db->get(); 
    return $query->result();
}

public function two_join_three_cond($t1,$t2,$select,$joinby,$col,$val,$col2,$val2,$col3,$val3,$ob,$obval){
    $this->db->select($select);
    $this->db->from($t1.' as a');
    $this->db->join($t2.' as b', $joinby, 'left');
    $this->db->where($col, $val);  
    $this->db->where($col2, $val2); 
    $this->db->where($col3, $val3); 
    $this->db->order_by($ob,$obval);
    $query = $this->db->get(); 
    return $query->result();
}

public function three_join_one_cond($t1,$t2,$t3,$select,$joinby,$joinby2,$col,$val,$gb,$ob,$obval){
    $this->db->select($select);
    $this->db->from($t1.' as a');
    $this->db->join($t2.' as b', $joinby, 'left');
    $this->db->join($t3.' as c', $joinby2, 'left');
    $this->db->where($col, $val);  
    $this->db->group_by($gb);
    $this->db->order_by($ob,$obval);
    $query = $this->db->get(); 
    return $query->result();
}

public function two_join_one_ne_cond($t1,$t2,$select,$joinby,$col,$val,$gb,$ob,$obval){
    $this->db->select($select);
    $this->db->from($t1.' as a');
    $this->db->join($t2.' as b', $joinby, 'left');
    $this->db->where($col.' != ', $val); 
    $this->db->group_by($gb);
    $this->db->order_by($ob,$obval);
    $query = $this->db->get(); 
    return $query->result();
}

public function two_join_two_cond($t1,$t2,$select,$joinby,$col,$val,$col2,$val2,$gb,$ob,$obval){
    $this->db->select($select);
    $this->db->from($t1.' as a');
    $this->db->join($t2.' as b', $joinby, 'left');
    $this->db->where($col, $val);  
    $this->db->where($col2, $val2);  
    $this->db->group_by($gb);
    $this->db->order_by($ob,$obval);
    $query = $this->db->get(); 
    return $query->result();
}








//common function

public function delete($table,$col_id,$segment){
    $id = $this->uri->segment($segment);
    $this->db->where($col_id,$id);
    $this->db->delete($table);
    return true;
}

function delete_with_attach($table,$segment,$attach){
    $this->db->where('id', $segment);
    unlink("uploads/".$attach);
    $this->db->delete($table);
}

function delete_with_attachv2($table,$segment,$folder,$attach){
    $this->db->where('id', $segment);
    unlink($folder."/".$attach);
    $this->db->delete($table);
}

public function tcd( $table,$col,$val,$col2,$val2){ // two cond delete
    $this->db->where($col, $val);
    $this->db->where($col2, $val2);
    $this->db->delete($table);
    return true;
}

public function del( $table,$col,$val){ // one cond delete
    $this->db->where($col, $val);
    $this->db->delete($table);
    return true;
}

public function rqa($table,$jobID){
    $query = $this->db->query("SELECT * FROM hris_applications a join $table r on a.appID=r.appID where jobID='" . $jobID . "' and  total_points>='50' ORDER BY total_points DESC");
    return $query->result();
}

public function rqa_non($jobID){

    $query = $this->db->query("SELECT * FROM hris_applications a join hris_rating_none r on a.appID=r.appID where jobID='" . $jobID . "'  and dq=1 ORDER BY total_points DESC");
    return $query->result();

}





}

