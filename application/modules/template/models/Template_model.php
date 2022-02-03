<?php defined('BASEPATH') or exit('No direct script access allowed');

class Template_model extends CI_Model
{

	public function notifications($id = null)
	{
		return  $this->db->select(" 
			COUNT(receiver_id) as total
		")
			->from('message')
			->where('receiver_id', $id)
			->where('receiver_status', 0)
			->group_by('receiver_status')
			->get()
			->row();
	}

	public function messages($id = null)
	{
		return $this->db->select("
				message.id, 
				message.subject, 
				message.message, 
				message.datetime, 
				user.image, 
				IF (ISNULL(user.firstname) || ISNULL(user.lastname), 'Unauthorized', CONCAT_WS(' ', user.firstname, user.lastname)) AS sender_name
			")
			->from("message")
			->join('user', 'user.id = message.sender_id', 'left')
			->where('message.receiver_id', $id)
			->where('message.receiver_status', 0)
			->order_by('message.datetime', 'desc')
			->get()
			->result();
	}

	public function setting()
	{
		//======================================
		$this->db->select('id');
		$this->db->from('journal');
		$this->db->where("active", 1);
		$journal = $this->db->get()->row()->id;
		//======================================
		if (!isset($journal)) {
			$dataSession = [
				'active' 	              => 1,
			];
			$this->db->insert('journal', $dataSession);
			//========================================
			$this->db->select('id');
			$this->db->from('journal');
			$this->db->where("active", 1);
			$journal = $this->db->get()->row()->id;
		}
		//=======================================
		$_SESSION['journal'] = $journal;
		//=======================================
		return $this->db->get('setting')->row();
	}
	public function read($select_items, $table, $where_array)
	{
		$this->db->select($select_items);
		$this->db->from($table);
		foreach ($where_array as $field => $value) {
			$this->db->where($field, $value);
		}
		return $this->db->get()->row();
	}
}
