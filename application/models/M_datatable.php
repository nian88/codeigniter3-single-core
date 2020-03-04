<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_datatable extends CI_Model{
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
    public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        
        // _pe($this->db->last_query());
        return $query->result();
    }
    public function countAll(){
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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    private function _get_datatables_query($postData){
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
        foreach ($postData['where'] as $key => $value) {
            if (array_key_exists($value['field'], $postData))
            {
                if ($postData[$value['field']]!="") {
                    switch ($value['operator']) {
                    case "=":
                        $this->db->where($value['field'], $postData[$value['field']]);
                        break;
                    case "like":
                        $this->db->like($value['field'], $postData[$value['field']]);
                        break;
                    case "or_like":
                        $this->db->or_like($value['field'], $postData[$value['field']]);
                        break;
                    default:
                        $this->db->where($value['field'].$value['operator'], $postData[$value['field']]);
                        break;
                    }
                }
              }
        }

        $i = 0;
        foreach($this->column_search as $item){
            if($postData['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
               if(count($this->column_search) - 1 == $i){
                    $this->db->group_end();
                }
            }
            $i++;
        }

        foreach($this->column_groupby as $item){
            $this->db->group_by($item);
        }

        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}
