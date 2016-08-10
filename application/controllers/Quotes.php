<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quotes extends CI_Controller
{
	public function home()
	{
		// $this->output->enable_profiler(TRUE);
		$user_id=$this->session->userdata('user_info')['id'];
		$quotes=array();
		$quotes['quote']=$this->Quote->get_quotes($user_id);
		$quotes['my_quote']=$this->Quote->my_quotes($user_id);
		$this->load->view('home',$quotes);
	}
	public function add_to_fave($id)
	{
		$user_id=$this->session->userdata('user_info')['id'];
		$this->Quote->add_to_fave($user_id,$id);
		redirect(base_url('/Quotes/home'));
	}
	public function remove_fave($id)
	{
		$this->Quote->remove_fave($id);
		redirect(base_url('/Quotes/home'));
	}
	public function add_quote()
	{
		$post=$this->input->post();
		$validation=$this->Quote->quote_validation($post);
		if($validation === 'valid')
		{
			$post=$this->input->post();
			$user_id= $this->session->userdata('user_info')['id'];
			$this->Quote->add_quote($post,$user_id);
			redirect(base_url('/Quotes/home')); 
		}
		else
		{
			$errors=array(validation_errors());
			$this->session->set_flashdata('errors',$errors);
			redirect(base_url('/Quotes/home'));
		}


	}
}