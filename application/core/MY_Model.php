<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Model extends CI_Model {
	
	// name table
	public $table = '';
	
	function add($data = NULL){
		$this->db->insert($this->table, $data); //
		$flag = $this->db->affected_rows();
		$insert_id = $this->db->insert_id();
		if($flag > 0){
			return array(
				'id_insert'	=> $insert_id,
				'type'		=> 'successful',
				'message'	=> 'Add value successful!',
			);
		}
		else
		{
			return array(
				'type'		=> 'error',
				'message'	=> 'Add value error!',
			);
		}
	}

	function edit($data = NULL, $id = '', $key = 'id'){
		if($data !='' AND $id !='' ){
			$this->db->where(array($key => $id))->update($this->table, $data);
			$flag = $this->db->affected_rows();
			if($flag > 0){
				return array(
					'type'		=> 'successful',
					'message'	=> 'Update value successful!',
				);
			}
			else
			{
				return array(
					'type'		=> 'error',
					'message'	=> 'Update value error!',
				);
			}
		}
	}


	function delete($id){
		if($id != ''){
			$this->db->delete($this->table, array('id' => $id));
		}
	}

	function getAll($fields = '*', $order = 'id desc', $start = '', $limit = ''){
		$result = $this->db->select($fields)->from($this->table);
		$result = $this->db->order_by($order);
		if($limit != ''){
			$result = $this->db->limit($limit, $start);
		}
		$result = $this->db->get()->result_array();
		return $result;
	}

	function find($fieldValue = '', $fields = '*', $field = 'id'){
		$result = $this->db->select($fields)->from($this->table);
		if($fieldValue != ''){
			$result = $this->db->where(array($field => $fieldValue));
			$result = $this->db->get()->row_array();
			return $result;
		}
	}

	function findWhere($where = NULL, $fields = '*', $order = 'id desc', $start = '', $limit = ''){
		$result = $this->db->select($fields)->from($this->table);
		$result = $this->db->order_by($order);
		if($limit != ''){
			$result = $this->db->limit($limit, $start);
		}
		if($where != ''){
			$result = $this->db->where($where);
			$result = $this->db->get()->result_array();
			return $result;
		}
	}

	function find_row_max($field_max = ''){
		$result = $this->db->select_max($field_max)->from($this->table);
		$result = $this->db->get()->row_array();
		return $result;
	}
	
}
?>