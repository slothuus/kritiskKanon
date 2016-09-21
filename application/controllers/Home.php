<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();						
		$this->load->model('front_model');			
	}	
	
	public function index()
	{		
		$this->load->view('home.php');
	}

	public function insert_student_teacher()
	{		
		$user_type=$this->input->post('user_type');
		if($user_type=='student')
		{
			$max_student_id=$this->front_model->getMaxidfromtable('student_id','kk_student');		
			if(empty($max_student_id[0]['student_id']))
			{
				$student_id=1;				
			}
			else
			{			
				$student_id=$max_student_id[0]['student_id'] + 1;			
			}
			$student_data['student_id']=$student_id;
			$student_data['student_name']=$this->input->post('name');
			$student_data['student_email']=$this->input->post('email');
			$student_data['student_city']=$this->input->post('city');
			$student_data['student_password']=$this->input->post('password');			
			$student_data['student_updated_datetime']=date('Y-m-d H:i:s');
			$student_data['student_status']='Active';
			$add_data=$this->front_model->insertdata('kk_student',$student_data);
			$this->session->set_flashdata('success_msg', 'Successfully student inserted');
			redirect('home','refresh');
		}	
		else
		{
			$max_teacher_id=$this->front_model->getMaxidfromtable('teacher_id','kk_teacher');		
			if(empty($max_teacher_id[0]['teacher_id']))
			{
				$teacher_id=1;				
			}
			else
			{			
				$teacher_id=$max_teacher_id[0]['teacher_id'] + 1;			
			}
			$teacher_data['teacher_id']=$teacher_id;
			$teacher_data['teacher_name']=$this->input->post('name');
			$teacher_data['teacher_email']=$this->input->post('email');
			$teacher_data['teacher_city']=$this->input->post('city');
			$teacher_data['teacher_password']=$this->input->post('password');			
			$teacher_data['teacher_updated_datetime']=date('Y-m-d H:i:s');
			$teacher_data['teacher_status']='Active';
			$add_data=$this->front_model->insertdata('kk_teacher',$teacher_data);
			$this->session->set_flashdata('success_msg', 'Successfully teacher inserted');
			redirect('home','refresh');
		}
	}

	public function login_student_teacher()
	{
		$email=$this->input->post('login_email');
		$password=$this->input->post('login_password');		
		$check_teacher_login=$this->front_model->login('teacher_',$email,$password,'kk_teacher');
		$check_student_login=$this->front_model->login('student_',$email,$password,'kk_student');	
		
		if($check_teacher_login)
		{
			$teacher_session_array=array();
			foreach($check_teacher_login as $row)
			{				
				$teacher_session_array=array(
					'teacher_id'=>$row['teacher_id'],
					'teacher_name'=>$row['teacher_name'],
					'teacher_email'=>$row['teacher_email'],
					'teacher_city'=>$row['teacher_city'],
					'teacher_name'=>$row['teacher_name']
				);	
				$max_tch_log_id=$this->front_model->getMaxidfromtable('teacher_log_id','kk_teacher_log');		
				if(empty($max_tch_log_id[0]['teacher_log_id']))
				{
					$teacher_id=1;				
				}
				else
				{			
					$teacher_id=$max_tch_log_id[0]['teacher_log_id'] + 1;			
				}

				$teacher_log_dt['teacher_log_id']=$teacher_id;
				$teacher_log_dt['teacher_id']=$row['teacher_id'];
				$teacher_log_dt['teacher_login_datetime']=date('Y-m-d H:i:s');

				$teacher_log_insert=$this->front_model->insertdata('kk_teacher_log',$teacher_log_dt);
					
				$this->session->set_userdata('teacher_logged_in',$teacher_session_array);			
			}
			redirect('teacher_dashboard','refresh');
		}

		else if($check_student_login)
		{
			$student_session_array=array();
			foreach($check_student_login as $row)
			{				
				$student_session_array=array(
					'student_id'=>$row['student_id'],
					'student_name'=>$row['student_name'],
					'student_email'=>$row['student_email'],
					'student_city'=>$row['student_city'],
					'student_name'=>$row['student_name']
				);	
				$max_student_log_id=$this->front_model->getMaxidfromtable('student_log_id','kk_student_log');		
				if(empty($max_student_log_id[0]['student_log_id']))
				{
					$student_id=1;				
				}
				else
				{			
					$student_id=$max_student_log_id[0]['student_log_id'] + 1;			
				}

				$student_log_dt['student_log_id']=$student_id;
				$student_log_dt['student_id']=$row['student_id'];
				$student_log_dt['student_login_datetime']=date('Y-m-d H:i:s');

				$student_log_insert=$this->front_model->insertdata('kk_student_log',$student_log_dt);

				$this->session->set_userdata('student_logged_in',$student_session_array);			
			}			 
			/*redirect('student_dashboard/game_intro','refresh');*/
			redirect('student_dashboard','refresh');
		}

		else 
		{
			$this->session->set_flashdata('fail_msg', 'Invalid email or password!!!');
			redirect('home','refresh');
		}
	}	

	public function chek_exists_email()
	{
		$email=$this->input->post('email');
		$check=$this->front_model->exitsEmail($email);
		echo $check;
		if($check=='false')
		{
			return false;
		}
		else
		{
			return true;			
		}
	}
}