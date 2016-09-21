<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Student_dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();						
		$this->load->model('front_model');			
	}	

	public function student_is_login()
	{
		if($this->session->userdata('student_logged_in')== true)
        { 
        	return true;
        }
        else
        {
            redirect('home','refresh');
        }
	}

	public function find_virtual_class($student_id)
	{
		$get_virtual_id=$this->mongo_db->select(array('virtual_class_id'))->where(array('student_id' => $student_id,'class_student_status' => 'Active'))->get('kk_class_student');
		if(!empty($get_virtual_id))
		{			
			return $get_virtual_id[0]['virtual_class_id'];
		}
	}
	
	public function find_group_id($virtual_class_id,$student_id)
	{
		$get_group_id=$this->mongo_db->select(array('group_name'))->where(array('student_id' => $student_id,'virtual_class_id'=>$virtual_class_id,'group_status' => 'Active'))->get('kk_group');
		if(!empty($get_group_id))
		{			
			return $get_group_id[0]['group_name'];
		}		
	}

	public function find_gallery_id($virtual_class_id)
	{
		$get_gallery_id=$this->mongo_db->select(array('gallery_id'))->where(array('virtual_class_id' => $virtual_class_id))->get('kk_class_gallery');
		if(!empty($get_gallery_id))
		{			
			return $get_gallery_id[0]['gallery_id'];
		}		
	}

	public function game_intro()
	{
		$data['virtual_class_id']=$this->uri->segment(3);
		$data['game_intro_data']=$this->front_model->GetRecordByID('kk_game_intro','intro_', 1);	
		$this->load->view('game_intro.php',$data);
	}

	public function index()
	{	
		$this->student_is_login();		
		$student_sess_data=$this->session->userdata('student_logged_in');
		$student_id=(string)$student_sess_data['student_id'];

		$student_wise_all_virtual=$this->mongo_db->select(array('virtual_class_id'))->where(array('student_id' => $student_id,'class_student_status' => 'Active'))->get('kk_class_student');
		
		$virtual_data=array();
		foreach($student_wise_all_virtual as $key=>$val)
		{			
			$get_virtual_classname=$this->front_model->GetRecordByID('kk_virtual_class','virtual_class_',(int)$val['virtual_class_id']);
				foreach ($get_virtual_classname as $key1 => $value1) {
					$virtual_data['virtual_class_id']=$value1['virtual_class_id'];
					$virtual_data['virtual_class_name']=$value1['virtual_class_name'];
					$virtual_data_main[]=$virtual_data;	
				}
		}
		$data['get_student_wise_virtual_data']=$virtual_data_main;

		/*echo "<pre>";
		print_r($virtual_data_main);
		exit;*/
		/*echo $this->input->post('virtual_class_id');
		if(!empty($this->input->post('virtual_class_id')))
		{
			$virtual_class_id=$this->input->post('virtual_class_id');
			$group_id=$this->find_group_id($virtual_class_id,$student_id);
			$gallery_id=$this->find_gallery_id($virtual_class_id);


			$data['virtual_class_id']=$virtual_class_id;
			$data['group_id']=$group_id;
			$data['gallery_id']=$gallery_id;		
		}
*/
		
		

		$this->load->view('student_dashboard.php',$data);
		
	}

	public function onchange_get_class()
	{
		$this->student_is_login();		
		$student_sess_data=$this->session->userdata('student_logged_in');
		$student_id=(string)$student_sess_data['student_id'];

		$virtual_class_id=(string)$this->input->post('virtual_class_id');
		$group_id=$this->find_group_id($virtual_class_id,$student_id);
		$gallery_id=$this->find_gallery_id($virtual_class_id);


		$data['virtual_class_id']=$virtual_class_id;
		$data['group_id']=$group_id;
		$data['gallery_id']=$gallery_id;		
		//print_r($data);
		$this->load->view('game_content_class_onchange.php',$data);
	}

	public function student_game1()
	{
		$this->student_is_login();		
		$student_sess_data=$this->session->userdata('student_logged_in');
		$student_id=(string)$student_sess_data['student_id'];

		$virtual_class_id=$this->uri->segment(3);
		$group_id=$this->find_group_id($virtual_class_id,$student_id);
		$gallery_id=$this->find_gallery_id($virtual_class_id);
		
		$data['game_intro_data']=$this->front_model->GetRecordByID('kk_game_intro','intro_', 1);
		$data['virtual_class_id']=$virtual_class_id;
		$data['group_id']=$group_id;
		$data['gallery_id']=$gallery_id;

		/*Selected Image Display Code*/
		$selected_gallery_image_data=$this->mongo_db->where(array('student_id' => $student_id,'virtual_class_id' => $virtual_class_id))->get('kk_student_image');

		//$selected_gallery_image_data=$this->front_model->GetRecordByID('kk_student_image','student_', $student_id);
		foreach($selected_gallery_image_data as $key=>$val)
		{
			$img_data=$this->front_model->GetRecordByID('kk_image','image_', (int)$val['image_id']);
			$img_id[]=$val['image_id'];
			$img_data1[]=$img_data;
		}
		foreach($img_data1 as $key1=>$val1)
		{
			$already_selected_data[$key1]=$val1[0];			
		}
		$data['already_selected_image_data']=$already_selected_data;
		
	
		/*Remaining image code*/

		$gallery_image_data=$this->front_model->GetRecordByID('kk_image','gallery_', $gallery_id);

		foreach ($gallery_image_data as $key2 => $value2) {
			if(in_array($value2['image_id'], $img_id))
			{
				continue;
			}
			else
			{
				$remainin_arry[]=$value2;
			}
		}

		$data['remainin_image_data']=$remainin_arry;		

		
		/*echo "<pre>";
		print_r($img_data);
		exit();*/
		$data['timer_time']=$this->front_model->GetRecordByID('kk_timer','timer_', 1);		

		$this->load->view('student_game1.php',$data);
	}

	public function student_game1_insert_data()
	{
		
		$this->student_is_login();		
		$student_sess_data=$this->session->userdata('student_logged_in');
		$student_id=(string)$student_sess_data['student_id'];

		$virtual_class_id=$this->input->post('virtual_class_id');
		$group_id=$this->find_group_id($virtual_class_id,$student_id);
		$gallery_id=$this->find_gallery_id($virtual_class_id);

		$image_id=$this->input->post('image_id');


		if(!empty($image_id))
		{
			$old_std_data_get=$this->mongo_db->where(array('student_id' => $student_id,'virtual_class_id'=>$virtual_class_id))->get('kk_student_image');
			foreach($old_std_data_get as $key=>$val)
			{
				$delete=$this->mongo_db->where(array('student_id' => $val['student_id'],'virtual_class_id'=>$virtual_class_id))->delete('kk_student_image');
			}
			$exp=explode(',', $image_id);	
			foreach($exp as $key=>$val)
			{						
				$max_std_img_id=$this->front_model->getMaxidfromtable('student_image_id','kk_student_image');		
				if(empty($max_std_img_id[0]['student_image_id']))
				{
					$std_img_id=1;				
				}
				else
				{			
					$std_img_id=$max_std_img_id[0]['student_image_id'] + 1;			
				}	

				$std_image_data['_id']				= $std_img_id;
				$std_image_data['student_image_id']=$std_img_id;
				$std_image_data['virtual_class_id']=$virtual_class_id;				
				$std_image_data['student_id']=$student_id;				
				$std_image_data['group_id']=$group_id;
				$std_image_data['image_id']=$val;
				$std_image_data['student_image_description']='null';
				$std_image_data['student_image_rating1']='null';
				$std_image_data['student_image_rating2']='null';
				$std_image_data['student_image_rating3']='null';
				$std_image_data['student_image_updated_datetime']=date('Y-m-d H:i:s');
				$std_image_data['student_image_status']='Active';
				$add_std_image_data=$this->front_model->insertdata('kk_student_image',$std_image_data);	
			}	
		}
		/*echo "<pre>";
		print_r($exp);
		exit();*/

		
	}

	public function student_game2()
	{
		
		$this->student_is_login();		
		$student_sess_data=$this->session->userdata('student_logged_in');
		$student_id=(string)$student_sess_data['student_id'];

		$virtual_class_id=$this->uri->segment(3);
		$group_id=$this->find_group_id($virtual_class_id,$student_id);
		$gallery_id=$this->find_gallery_id($virtual_class_id);

		$data['virtual_class_id']=$virtual_class_id;
		$data['group_id']=$group_id;
		$data['gallery_id']=$gallery_id;
		$data['student_id']=$student_id;
		

		$group_wise_student_image_data=$this->mongo_db->where(array('group_id' => $group_id,'virtual_class_id'=>$virtual_class_id))->get('kk_student_image');	
		
		$all_image=array();
		foreach($group_wise_student_image_data as $key=>$val)
		{
			$get_image_group_and_student_wise=$this->front_model->GetRecordByID('kk_image','image_', (int)$val['image_id']);
			foreach($get_image_group_and_student_wise as $key1=>$val1)
			{
				$all_image['primary_image_id']=$val['student_image_id'];
				$all_image['image_id']=$val1['image_id'];
				$all_image['image_file_path']=$val1['image_file_path'];
				$all_image['student_image_description']=$val['student_image_description'];
				$all_image['student_image_rating1']=$val['student_image_rating1'];
				$all_image['student_image_rating2']=$val['student_image_rating2'];
				$all_image['student_image_rating3']=$val['student_image_rating3'];				
				$all_img_details[]=$all_image;
			}
		}
		
		/*echo "<pre>";
		print_r($group_wise_student_image_data);

		echo "<pre>";
		print_r($get_image_group_and_student_wise);


		echo "<pre>";
		print_r($all_img_details);

		exit();*/
		$data['get_image_group_and_student_wise']=$all_img_details;
		$this->load->view('student_game2.php',$data);
	}

	public function student_game2_insert_data()
	{	
		$virtual_class_id=$this->input->post('virtual_class_id');
		$primary_image_id=(int)$this->input->post('primary_image_id');
		$image_id=$this->input->post('image_id');
		$student_id=$this->input->post('student_id');
		$student_image_rating1=$this->input->post('student_image_rating1');
		$student_image_rating2=$this->input->post('student_image_rating2');
		$student_image_rating3=$this->input->post('student_image_rating3');
		$student_image_description=$this->input->post('student_image_description');
	 
		$this->mongo_db->where(array('student_image_id' => $primary_image_id))->set(array('student_image_description' => $student_image_description,'student_image_rating1' => $student_image_rating1,'student_image_rating2' => $student_image_rating2,'student_image_rating3' => $student_image_rating3))->update('kk_student_image');
		
		redirect('student_dashboard/student_game2/'.$virtual_class_id,'refresh');
		/*echo "<pre>";
		print_r($this->input->post());
		exit();*/
	}

	public function student_image_data_useing_ajx()
	{
		$virtual_class_id=$this->input->post('virtual_class_id');
		$student_image_id=(int)$this->input->post('student_img_id');
		$student_image_dt=$this->mongo_db->where(array('student_image_id' => $student_image_id))->get('kk_student_image');
		foreach($student_image_dt as $key=>$val)
		{
			$get_image_filepath=$this->front_model->GetRecordByID('kk_image','image_', (int)$val['image_id']);
			foreach($get_image_filepath as $key1=>$val1)
			{
				$all_image['student_image_id']=$val['student_image_id'];
				$all_image['student_id']=$val['student_id'];
				$all_image['image_id']=$val['image_id'];
				$all_image['image_file_path']=$val1['image_file_path'];
				$all_image['image_description']=$val1['image_description'];
				$all_image['student_image_description']=$val['student_image_description'];
				$all_image['student_image_rating1']=$val['student_image_rating1'];
				$all_image['student_image_rating2']=$val['student_image_rating2'];
				$all_image['student_image_rating3']=$val['student_image_rating3'];				
				$all_img_details[]=$all_image;
			}
		}	
		/*echo "<pre>";
		print_r($all_img_details[0]['student_image_id']);*/
		$data['virtual_class_id']=$virtual_class_id;
		$data['student_image_data']=$all_img_details;
		$data['student_img_id']=$student_image_id;
		$this->load->view('student_image_model.php',$data);
	}
	public function logout()
	{
		$this->session->unset_userdata('student_logged_in');		//session_destroy();		
		redirect('home','refresh');
	}

	
}