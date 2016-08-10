<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_model
{
	public function reg_validate($post)
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required");
		$this->form_validation->set_rules("username", "Username", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required");
		$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|matches[password]|required");
		$this->form_validation->set_rules("hire_date","Date of Hire", "trim");
		if($this->form_validation->run())
		{
			return "valid";
		}
		else
		{
			return array(validation_errors());
		}
	}
	public function login_validate($post)
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password", "Password", "trim|min_length[8]|required");
		if($this->form_validation->run())
		{
			return "valid";
		}
		else
		{
			return array(validation_errors());
		}
	}
	public function check_user($email,$password)
	{
		$query="SELECT * FROM users 
				WHERE users.email=? 
				AND users.password=?";
		$values=array($email,md5($password));
		$check=$this->db->query($query,$values)->row_array();
		if(empty($check))
		{
			//*no user has been found. ok to create//
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function check_email($username,$email)
	{
		$query="SELECT * FROM users WHERE users.username=? OR users.email=?";
		$values=array($username,$email);
		if(empty($this->db->query($query,$values)->row_array()))
		{
			//if its empty, then no one has that username or email//
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function create_user($post)
	{
		$query="INSERT INTO users 
				(first_name,last_name,username,email,password,hire_date,created_at,updated_at) 
				VALUES(?,?,?,?,?,?,NOW(),NOW())";
		$values=array($post['first_name'],
				$post['last_name'],
				$post['username'],
				$post['email'],
				md5($post['password']),
				$post['hire_date']);
		$this->db->query($query,$values);
	}
	public function get_user_info($email,$password)
	{
		$query="SELECT users.id, 
				users.first_name,
				users.last_name, 
				users.username,
				users.email,
				users.hire_date
				FROM users
				WHERE users.email=? AND
				users.password=?";
		$values=array($email,md5($password));
		return $this->db->query($query,$values)->row_array();
	}
	public function count($user_id)
	{
		$query="SELECT count(*) AS count, users.username
				FROM quotes JOIN users ON users.id=quotes.user_id
				WHERE quotes.user_id=?";
		$values=array($user_id);
		return $this->db->query($query,$values)->row_array();
	}
	public function show_user($id)
	{
		$query="SELECT quotes.user_id,
				quotes.quoted_by, 
				quotes.message,
				users.username
				FROM quotes JOIN users ON users.id=quotes.user_id 
				WHERE users.id=?";
		$values=array($id);
		return $this->db->query($query,$values)->result_array();

	}
}