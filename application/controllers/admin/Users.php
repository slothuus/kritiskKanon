<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct()
	{
		parent::__construct();			
		//$this->load->library('mongo_db');		
		$this->load->model('admin_model');			
	}	

	public function user_is_login()
	{
		if($this->session->userdata('logged_in')== true)
        { 
        	return true;
        }
        else
        {
            redirect('admin/users/login','refresh');
        }
	}

	public function login()
	{
		$this->load->view('admin/login.php');
	}

	public function check_login()
	{
		$admin_email=$this->input->post('admin_email');
		$admin_password=$this->input->post('admin_password');		
		$log_check=$this->admin_model->login($admin_email,$admin_password);		
		if($log_check)
		{
			$session_array=array();
			foreach($log_check as $row)
			{				
				$session_array=array(
					'admin_id'=>$row['admin_id'],
					'admin_name'=>$row['admin_name'],
					'admin_email'=>$row['admin_email']
				);		
				$this->session->set_userdata('logged_in',$session_array);			
			}
			redirect('admin/site_admin','refresh');
		}
		else
		{
			$this->session->set_flashdata('fail_msg', 'Invalid email or password!!!');
			redirect('admin/users/login','refresh');
		}		
	}

	public function index()
	{		
		$this->user_is_login(); 
		$data['main_content']='dashboard';	
		$this->load->view('admin/main_template.php',$data);		 
	}

	public function manage_timer()
	{
		$delete_last_timer=$this->mongo_db->where(array('timer_id' => 1))->delete('kk_timer');				
		$timer_data['timer_id']=1;
		$timer_data['timer_time']=$this->input->post('timer_time');		
		$add_timer_data=$this->admin_model->insertdata('kk_timer',$timer_data);
		redirect('admin/site_admin','refresh');
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');		//session_destroy();		
		redirect('admin/users/login','refresh');
	}
}
