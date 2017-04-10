<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quote extends CI_Model
{
	public function get_quotes($user_id)
	{
		$query="SELECT quotes.id 
				AS quote_id, 
				quotes.quoted_by,
				quotes.message, 
				users.username, 
				users.id 
				FROM quotes JOIN users 
				ON users.id=quotes.user_id
				ORDER by quotes.created_at DESC;";
		return $this->db->query($query)->result_array();
	}
	public function my_quotes($id)
	{
		$query="SELECT quotes.id AS quote_id, 
				quotes.quoted_by, 
				quotes.message, users.username, 
				users.id 
				FROM quotes 
				JOIN users 
				ON users.id=quotes.user_id 
				JOIN favorites 
				ON quotes.id=favorites.quote_id 
				WHERE favorites.user_id=?";
		$values=array($id);
		return $this->db->query($query,$values)->result_array();
	}
	public function add_to_fave($user_id,$quote_id)
	{
		$query="INSERT INTO favorites 
				(user_id, quote_id) 
				VALUES(?,?)";
		$values=array($user_id,$quote_id);
		$this->db->query($query,$values);
	}
	public function remove_fave($quote_id)
	{
		$query="DELETE FROM favorites
				WHERE favorites.quote_id=?";
		$values=array($quote_id);
		$this->db->query($query,$values);
	}
	// validate user input
	public function quote_validation($post)
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("quoted_by", "Quoted By", "trim|min_length[3]|required");
		$this->form_validation->set_rules("message", "Message", "trim|min_length[10]|required");
		if($this->form_validation->run())
		{
			return "valid";
		}
		else
		{
			return array(validation_errors());
		}
	}
	public function add_quote($post,$user_id)
	{
		$query="INSERT INTO quotes (quoted_by, message, created_at, updated_at, user_id) VALUES (?,?,NOW(),NOW(),?)";
		$values=array($post['quoted_by'], $post['message'],$user_id);
		$this->db->query($query,$values);
	}
}