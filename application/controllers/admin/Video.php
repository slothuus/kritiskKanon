<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {
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

	public function manage_video()
	{
		$this->user_is_login();
		$video_id=$this->uri->segment(4);			

		$video_data['video_title']=$this->input->post('video_title');
		$video_data['video_link']=$this->input->post('video_link');
		
		$data['Get_ID_Wise_Video']=$this->admin_model->getDataById('kk_video','video_',$video_id);

		if(isset($video_id) && $video_id!='')
		{				
			$data['action_name']='Edit Video';
			$data['submit']='Edit';
			if($this->input->post('Edit'))
			{	
				$update_data=$this->admin_model->updaterecord('kk_video', 'video_', $video_data, $video_id);
				if($update_data)
				{
					$this->session->set_flashdata('success_msg', 'Successfully video data updated');
					redirect('admin/video/list_video','refresh');
				}
				else
				{
					$this->session->set_flashdata('fail_msg', 'Video data not updated');
					redirect('admin/video/list_video','refresh');
				}
				
			}
		}		
		else
		{			
			$data['action_name']='Add Video';
			$data['submit']='Add';
			if($this->input->post('Add'))
			{
				$add_data=$this->admin_model->insertdata('kk_video',$video_data);
				if($add_data)
				{
					$this->session->set_flashdata('success_msg', 'Successfully video data inserted');
					redirect('admin/video/list_video','refresh');	
				}
				else
				{
					$this->session->set_flashdata('fail_msg', 'Video data not inserted');
					redirect('admin/video/list_video','refresh');	
				}
				
			}
		}
		
		$data['main_content']='manage_video';	
		$this->load->view('admin/main_template.php',$data);			
	}

	public function list_video()
	{
		$this->user_is_login();
		$data['all_video']=$this->admin_model->getAllRecordByTable('kk_video');
		$data['main_content']='list_video';	
		$this->load->view('admin/main_template.php',$data);				
	}

	public function delete_video()
	{	
		$video_id=$this->input->post('video_id');	
		$delete=$this->admin_model->deleteRecordByID('kk_video', 'video_', $video_id);		
		if($delete)
		{			
			echo 'Deleted';
		}
		else
		{
			echo 'Not Deleted';
		}			
	}

	public function status_change_video()
	{
		$video_id=$this->input->post('video_id');
		$video_status=$this->input->post('video_status');	
		$status_chg=$this->admin_model->change_status('kk_video', 'video_',$video_status, $video_id);		
		$data['all_video']=$this->admin_model->getAllRecordByTable('kk_video');
		$this->load->view('admin/ajax_video_status.php',$data);
	}
}
