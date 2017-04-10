<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function index()
	{
		$this->load->view('index');
	}
	public function logoff()
	{
		$this->session->sess_destroy();
		redirect(base_url('/'));
	}
	public function create_user()
	{
		// create a new user
		$post=$this->input->post();
		$this->load->model('User');
		$result=$this->User->reg_validate($post);

		// validate user input to pass validation rules
		if($result === "valid")
		{
			$username=$this->input->post('username');
			$email=$this->input->post('email');
			$check=$this->User->check_email($username,$email);
			// check to see if user already exists
			if($check === TRUE)
			{
				$this->User->create_user($post);
				$messages=array('You have successfully been registered. Please login below');
				$this->session->set_flashdata('messages',$messages);
				redirect(base_url('/'));
			}
			else
			{
				$errors=array('This user has already been registered. please login below');
				$this->session->set_flashdata('errors',$errors);
				redirect(base_url('/'));
			}
		}
		else
		{
			$errors=array(validation_errors());
			$this->session->set_flashdata('errors',$errors);
			redirect(base_url('/'));
		}
	}
	public function login()
	{
		$post=$this->input->post();
		$this->load->model('User');
		$result=$this->User->login_validate($post);
		// validate user input to pass validation rules
		if($result === "valid")
		{
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			$check_user=$this->User->check_user($email,$password);
			// check to see if user exists
			if($check_user === TRUE)
			{
				$messages=array('You are not registered. Please register and proceed to login');
				$this->session->set_flashdata('messages',$messages);
				redirect(base_url('/'));
			}
			else
			{
				// email has been found, check user input and login user
				$user_info=array();
				$email=$this->input->post('email');
				$password=$this->input->post('password');
				$user_info=$this->User->get_user_info($email,$password);
				$this->session->set_userdata('user_info',$user_info);
				redirect(base_url('/Quotes/home'));
			}
		}
		else
		{
			$errors=array(validation_errors());
			$this->session->set_flashdata('errors',$errors);
			redirect(base_url('/'));
		}
	}
	public function show_user($id)
	{
		// get information for specific user
		$user_data=array();
		$user_data['user_quotes']=$this->User->show_user($id);
		$user_data['count']=$this->User->count($id);
		$this->load->view('show_user',$user_data);
	}

}
