<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_niandev extends CI_Model{
    var $table;
    var $column_order;
    var $column_search;
    var $column_groupby;
    var $order;
    var $join;
    var $where;
    var $select;
    function my_constructor($data=array()) {
        $this->table = $data['table'];
        $this->join = isset($data['join'])?$data['join']:array();
        $this->where = isset($data['where'])?$data['where']:array();
        $this->column_order = isset($data['column_order'])?$data['column_order']:array();
        $this->column_search = isset($data['column_search'])?$data['column_search']:array();
        $this->column_groupby =isset($data['column_groupby'])?$data['column_groupby']:array();
        $this->select = isset($data['select'])?$data['select']:null;
        if (isset($data["db"])) {
			$this->db = $this->load->database($data["db"], TRUE);
		}
    }
    public function getRows(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->result();
    }
    public function getFirst(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->row();
    }
    public function countAll(){
        if(count($this->join)>0){
            foreach ($this->join as $table => $joinon) {
                $this->db->join($table, $joinon);
            }
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function countFiltered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    private function _get_datatables_query(){
         if(!empty($this->select)){
             $this->db->select($this->select);

         }
        $this->db->from($this->table);
        if(count($this->join)>0){
            foreach ($this->join as $table => $joinon) {
                $this->db->join($table, $joinon);
            }
        }
        if(count($this->where)>0){
            foreach ($this->where as $table => $whereon) {
                $this->db->where($table, $whereon);
            }
        }

        foreach($this->column_groupby as $item){
            $this->db->group_by($item);
        }
    }
}


/* End of file M_admin.php */
/* Location: ./application/controllers/M_admin.php */