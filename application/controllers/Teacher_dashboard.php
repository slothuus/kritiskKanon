<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
class Teacher_dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();						
		$this->load->model('front_model');			
	}	

	public function teacher_is_login()
	{
		if($this->session->userdata('teacher_logged_in')== true)
		{ 
			return true;
		}
		else
		{
			redirect('home','refresh');
		}
	}
	
	public function index()
	{	
		$this->teacher_is_login();
		$teacher_sess_data=$this->session->userdata('teacher_logged_in');
		$teacher_id=$teacher_sess_data['teacher_id'];

		$data['vc_id_wise_data']=$this->front_model->GetRecordByID('kk_virtual_class', 'teacher_', $teacher_id);
		//$data['all_student_data']=$this->front_model->getAllRecordByTable('kk_student');		
		$this->load->view('teacher_dashboard.php',$data);		
	}

	/*By default page load data*/

	public function ajax_teacher_student_class()
	{
		$virtual_class_id=$this->input->post('virtual_class_id');	

		$data['virtual_class_id']=$virtual_class_id;
		$vc_id_wise_user_data=$this->front_model->GetRecordByID('kk_class_student', 'virtual_class_', $virtual_class_id);		
		$selected_std=array();
		$selected_std_not=array();
		$use_all_id=array();

		if(!empty($vc_id_wise_user_data))
		{
			foreach($vc_id_wise_user_data as $key=>$val)
			{			
				$get_user_name=$this->front_model->GetRecordByID('kk_student', 'student_', (int)$val['student_id']);
				$selected_std[]=$get_user_name;
				$use_all_id[]=(int)$val['student_id'];
			}
			$get_user_notin=$this->front_model->GetRecordWhereNot('kk_student', 'student_', $use_all_id);			
			$data['student_selected_data']=$selected_std;
			$data['remaining_student_data']=$get_user_notin;			
		}
		else
		{
			$get_alluser=$this->front_model->getAllRecordByTable('kk_student');
			$data['remaining_student_data']=$get_alluser;					
		}
		$data['gallery_data']=$this->front_model->getAllRecordByTable('kk_gallery');	
		$get_gallery_id=$this->front_model->GetRecordByID('kk_class_gallery', 'virtual_class_', $virtual_class_id);
		$data['gallery_id_data']=$get_gallery_id[0]['gallery_id'];
		$this->load->view('ajax_teacher_student_class.php',$data);
	}

	/*Insert virtual class*/

	public function insert_virtual_class()
	{
		$teacher_sess_data=$this->session->userdata('teacher_logged_in');
		$teacher_id=$teacher_sess_data['teacher_id'];		 
		$max_vc_id=$this->front_model->getMaxidfromtable('virtual_class_id','kk_virtual_class');		
		if(empty($max_vc_id[0]['virtual_class_id']))
		{
			$vc_id=1;				
		}
		else
		{			
			$vc_id=$max_vc_id[0]['virtual_class_id'] + 1;			
		}	
		$vc_data['_id']				= $vc_id;
		$vc_data['virtual_class_id']=$vc_id;
		$vc_data['teacher_id']=$teacher_id;
		$vc_data['virtual_class_name']=$this->input->post('virtual_class_name');
		$vc_data['virtual_class_image']='null';
		$vc_data['virtual_class_description']='null';			
		$vc_data['virtual_class_no_of_students']='null';
		$vc_data['virtual_class_no_of_groups']='null';
		$vc_data['virtual_class_updated_datetime']=date('Y-m-d H:i:s');
		$vc_data['virtual_class_status']='Active';

		$add_vc_data=$this->front_model->insertdata('kk_virtual_class',$vc_data);		
		$this->session->set_flashdata('success_msg', 'Virtual class inserted successfully');
		redirect('teacher_dashboard','refresh');
	}

	/*Insert virtual class wise student*/

	public function manage_class_wise_student()
	{
		$virtual_class_id=$this->input->post('virtual_class_id');		
		$hidden_student_selected_id=$this->input->post('hidden_student_selected_id');
		if(!empty($hidden_student_selected_id))
		{
			$exp_hidden_student_selected_id=explode(',',$hidden_student_selected_id);
			foreach ($exp_hidden_student_selected_id as $key => $value) {				
				$del=$this->mongo_db->where(array('virtual_class_id' => $virtual_class_id,'student_id' => $value))->delete('kk_class_student');
				$del1=$this->mongo_db->where(array('virtual_class_id' => $virtual_class_id,'student_id' => $value))->delete('kk_group');
			}		
		}
		
		if(!empty($this->input->post('hidden_student_to_id')))
		{
			$hidden_student_post_val=array_filter($this->input->post('hidden_student_to_id'));

			if(!empty($hidden_student_post_val))
			{
				
				$exp=explode(',', $hidden_student_post_val[0]);				
				foreach($exp as $key=>$val)
				{						
					$max_cls_student_id=$this->front_model->getMaxidfromtable('class_student_id','kk_class_student');		
					if(empty($max_cls_student_id[0]['class_student_id']))
					{
						$cls_student_id=1;				
					}
					else
					{			
						$cls_student_id=$max_cls_student_id[0]['class_student_id'] + 1;			
					}	

					$cls_student_data['_id']				= $cls_student_id;
					$cls_student_data['class_student_id']=$cls_student_id;
					$cls_student_data['virtual_class_id']=$virtual_class_id;				
					$cls_student_data['student_id']=$val;
					$cls_student_data['class_student_updated_datetime']=date('Y-m-d H:i:s');
					$cls_student_data['class_student_status']='Active';
					$add_cls_student_data=$this->front_model->insertdata('kk_class_student',$cls_student_data);	
				}
			}
		}		
		$this->session->set_flashdata('success_msg', 'Student inserted in class successfully');
		redirect('teacher_dashboard','refresh');
		/*echo "<pre>";
		print_r($this->input->post());
		exit;*/
	}

	/*Student name wise search data*/

	public function ajax_live_search()
	{
		/*For Live Search*/
		$virtual_class_id=$this->input->post('virtual_class_id');
		$student_name=$this->input->post('student_name');
		
		$vc_id_wise_user_data=$this->front_model->GetRecordByID('kk_class_student', 'virtual_class_', $virtual_class_id);		
		$selected_std=array();
		$selected_std_not=array();
		$use_all_id=array();

		if(!empty($vc_id_wise_user_data))
		{
			foreach($vc_id_wise_user_data as $key=>$val)
			{	
				$use_all_id[]=(int)$val['student_id'];
			}
			$get_user_notin=$this->mongo_db->where_not_in('student_id', $use_all_id)->like('student_name', $student_name, 'i', TRUE, TRUE)->get('kk_student');						
			$data['remaining_student_data']=$get_user_notin;			
		}
		else
		{
			$get_alluser=$this->mongo_db->like('student_name', $student_name, 'i', TRUE, TRUE)->get('kk_student');
			$data['remaining_student_data']=$get_alluser;					
		}
		$this->load->view('ajax_live_search_student.php',$data);
	} 

	/*Group wise student data*/

	public function ajax_group_wise_student()
	{
		$virtual_class_id=$this->input->post('virtual_class_id');
		$group_id=$this->input->post('group_id');	

		/*For Group*/

		$vc_group_wise_user_data=$this->mongo_db->where(array('virtual_class_id' => $virtual_class_id,'group_name' => $group_id))->get('kk_group');

		if(!empty($vc_group_wise_user_data))
		{		
			foreach($vc_group_wise_user_data as $key=>$val)
			{	
				$use_all_id[]=(int)$val['student_id'];
			}			
			$get_user_dataa=$this->mongo_db->where_in('student_id', $use_all_id)->get('kk_student');			
			$data['grp_wise_selected_student_data']=$get_user_dataa;	

			$get_all_userdata_from_group=$this->front_model->GetRecordByID('kk_group', 'virtual_class_', $virtual_class_id);
			foreach($get_all_userdata_from_group as $key1=>$val1)
			{			
				$in_group_all_user_id[]=(int)$val1['student_id'];				
			}		
			
			$grp_student_data=$this->front_model->GetRecordByID('kk_class_student', 'virtual_class_', $virtual_class_id);
			if(!empty($grp_student_data))
			{		
				
				foreach($grp_student_data as $key1=>$val1)
				{			
					if(in_array((int)$val1['student_id'],$in_group_all_user_id))
					{
						continue;
					}
					else
					{
						$remaining_std_dt1[]=(int)$val1['student_id'];
					}									
				}
			}
			$sas=array_filter($remaining_std_dt1);
			if(!empty($sas))
			{
				$get_user_remaining_data=$this->mongo_db->where_in('student_id', $remaining_std_dt1)->get('kk_student');	
				if(!empty($get_user_remaining_data))
				{
					$j=0;	
					foreach ($get_user_remaining_data as $key2 => $value2) {
						$ras1[$j][]=$value2;					 	
						$j++;
					}
					$data['remaining_grp_student_data']=$ras1;	
				}
			}
				
		}
		else
		{	
			$get_all_userdata_from_group=$this->front_model->GetRecordByID('kk_group', 'virtual_class_', $virtual_class_id);
			foreach($get_all_userdata_from_group as $key1=>$val1)
			{			
				$in_group_all_user_id[]=(int)$val1['student_id'];				
			}
			$grp_student_data=$this->front_model->GetRecordByID('kk_class_student', 'virtual_class_', $virtual_class_id);
			

			if(!empty($grp_student_data))
			{		
				foreach($grp_student_data as $key=>$val)
				{			
					if(in_array((int)$val['student_id'],$in_group_all_user_id))
					{
						continue;
					}
					else
					{
						$remaining_std_dt2[]=(int)$val['student_id'];
					}						
				}			 
			}
			$sas=array_filter($remaining_std_dt2);
			if(!empty($sas))
			{
				$get_user_remaining_data=$this->mongo_db->where_in('student_id', $remaining_std_dt2)->get('kk_student');					
				$j=0;	
				foreach ($get_user_remaining_data as $key2 => $value2) {
					$ras2[$j][]=$value2;					 	
					$j++;
				}
				$data['remaining_grp_student_data']=$ras2;	
			}

		}
		$this->load->view('ajax_group_student.php',$data);		
	}

	/*Group wise student insert*/

	public function manage_group_wise_student()
	{
		$virtual_class_id=$this->input->post('virtual_class_id');	
		$group_id=$this->input->post('group_id');	
		$hidden_student_group_from=$this->input->post('hidden_student_group_from');

		/*echo "<pre>";
		print_r($this->input->post());
		exit();*/

		if(!empty($hidden_student_group_from))
		{
			$exp_hidden_student_group_from=explode(',',$hidden_student_group_from);
			foreach ($exp_hidden_student_group_from as $key => $value) {				
				$del=$this->mongo_db->where(array('virtual_class_id' => $virtual_class_id,'student_id' => $value,'group_name' => $group_id ))->delete('kk_group');
			}		
		}
		
		if(!empty($this->input->post('hidden_student_group_to')))
		{
			$hidden_student_post_val=array_filter($this->input->post('hidden_student_group_to'));

			if(!empty($hidden_student_post_val))
			{
				
				$exp=explode(',', $hidden_student_post_val[0]);				
				foreach($exp as $key=>$val)
				{						
					$max_grp_id=$this->front_model->getMaxidfromtable('group_id','kk_group');		
					if(empty($max_grp_id[0]['group_id']))
					{
						$grp_id=1;				
					}
					else
					{			
						$grp_id=$max_grp_id[0]['group_id'] + 1;			
					}	

					$group_data['_id']				= $grp_id;
					$group_data['group_id']=$grp_id;
					$group_data['virtual_class_id']=$virtual_class_id;				
					$group_data['student_id']=$val;
					$group_data['group_name']=$group_id;
					$group_data['group_timer']=3;
					$group_data['group_updated_datetime']=date('Y-m-d H:i:s');
					$group_data['group_status']='Active';
					$add_group_data=$this->front_model->insertdata('kk_group',$group_data);	
				}
			}
		}		
		$this->session->set_flashdata('success_msg', 'Group wise student inserted successfully');
		redirect('teacher_dashboard','refresh');
		/*echo "<pre>";
		print_r($this->input->post());
		exit;*/
	}

	public function gallery_insert()
	{
		$teacher_sess_data=$this->session->userdata('teacher_logged_in');
		$teacher_id=$teacher_sess_data['teacher_id'];
		$virtual_class_id=$this->input->post('virtual_class_id');
		$gallery_id=$this->input->post('gallery_id');

		$check_exist_data=$this->mongo_db->where(array('virtual_class_id' => $virtual_class_id,'teacher_id' => $teacher_id))->get('kk_class_gallery');
		if(count($check_exist_data) > 0)
		{			
			$update_gallery_data=$this->mongo_db->where(array('virtual_class_id'=>$virtual_class_id,'teacher_id' => $teacher_id))->set(array('gallery_id' => $gallery_id))->update('kk_class_gallery');
			redirect('teacher_dashboard','refresh');
		}
		else
		{
			$max_cls_gal_id=$this->front_model->getMaxidfromtable('class_gallery_id','kk_class_gallery');		
			if(empty($max_cls_gal_id[0]['class_gallery_id']))
			{
				$cls_gal=1;				
			}
			else
			{			
				$cls_gal=$max_cls_gal_id[0]['class_gallery_id'] + 1;			
			}	
			$class_gallery_data['_id']				= $cls_gal;
			$class_gallery_data['class_gallery_id']=$cls_gal;
			$class_gallery_data['teacher_id']=$teacher_id;
			$class_gallery_data['virtual_class_id']=$virtual_class_id;
			$class_gallery_data['gallery_id']=$gallery_id;		
			$class_gallery_data['class_gallery_updated_datetime']=date('Y-m-d H:i:s');

			$add_class_gallery_data=$this->front_model->insertdata('kk_class_gallery',$class_gallery_data);		
			$this->session->set_flashdata('success_msg', 'Image gallery is assigned to virtual class successfully');
			redirect('teacher_dashboard','refresh');
		}
	}

	public function class_view()
	{
		$this->teacher_is_login();
		$teacher_sess_data=$this->session->userdata('teacher_logged_in');
		$teacher_id=$teacher_sess_data['teacher_id'];

		$data['vc_id_wise_data']=$this->front_model->GetRecordByID('kk_virtual_class', 'teacher_', $teacher_id);		
		
		$this->load->view('class_view.php',$data);	

	}

 

	public function class_wise_group_display()
	{
		$virtual_class_id=$this->input->post('virtual_class_id');

		/*Unique image code Started*/
		
		$get_student_img_data_group_wise=$this->mongo_db->where(array('virtual_class_id'=>$virtual_class_id))->get('kk_student_image');

		foreach($get_student_img_data_group_wise as $key=>$val)
		{
			$image_id_wise_student_dt[$val['image_id']][]=$val['student_id'];
		}
		/*echo "<pre>";
		print_r($get_student_img_data_group_wise);*/
/*
		echo "<pre>";
		print_r($image_id_wise_student_dt);*/
		$main=array();
		$uu=array();
		if(!empty($image_id_wise_student_dt))
		{
			foreach($image_id_wise_student_dt as $key1=>$val1)
			{
				$get_image_file_path=$this->mongo_db->select(array('image_file_path'))->where(array('image_id'=>$key1))->get('kk_image');
				foreach($get_image_file_path as $key2=>$val2)
				{
					$main[$key1]=$val2;
				}

				foreach($val1 as $key3=>$val3)
				{
					$get_student_name=$this->mongo_db->select(array('student_name'))->where(array('student_id'=>(int)$val3))->get('kk_student');	
					$main1[$key1]['student_name'][]=$get_student_name[0]['student_name'];					
				}
			}
		}
		
		/*echo "<pre>";
		print_r($main);
		echo "<pre>";
		print_r($main1);*/
		
		$result = array();
		if(!empty($main))
		{
			foreach($main as $key4=>$val4)
			{ // Loop though one array
				$val5 = $main1[$key4]; // Get the values from the other array
				$result[$key4] = $val4 + $val5; // combine 'em
			}
		}
		
	/*	echo "<pre>";
		print_r($result);*/
		//exit();
		if(!empty($result))
		{
			$data['uniq_image_wise_student_data']=$result;	
		}
		


		/*Unique image code completed*/


		$get_gallery_id_from_virtual_class=$this->mongo_db->where(array('virtual_class_id'=>$virtual_class_id))->get('kk_class_gallery');

		if(!empty($get_gallery_id_from_virtual_class))
		{
			$gallery_id=$get_gallery_id_from_virtual_class[0]['gallery_id'];

			if(!empty($gallery_id))
			{
				$get_all_imagedata_from_gallery_id=$this->mongo_db->select(array('image_id'))->where(array('gallery_id'=>$gallery_id))->get('kk_image');

				foreach($get_all_imagedata_from_gallery_id as $key=>$val)
				{
					$img_arr[]=$val['image_id'];
				}	
			}
		}
		
		
		/*echo "*******************************************************************************";
		echo "<br>";
		echo 'Image data from gallery id';
		echo "<pre>";
		print_r($img_arr);
*/
		$get_group_id_from_virtual_class=$this->mongo_db->select(array('group_name'))->where(array('virtual_class_id'=>$virtual_class_id))->distinct('kk_group', 'group_name');
		
		foreach($get_group_id_from_virtual_class as $key=>$val)
		{
			$grp_arr[]=$val['group_name'];
		}
		/*echo "*******************************************************************************";
		echo "<br>";
		echo 'Get group id from virtual_class';
		echo "<pre>";
		print_r($grp_arr);*/

		if(!empty($grp_arr))
		{
			$get_student_img_data_group_wise=$this->mongo_db->where(array('virtual_class_id'=>$virtual_class_id))->where_in('group_id',$grp_arr)->get('kk_student_image');
		}
		
		
		/*echo "*******************************************************************************";
		echo "<br>";
		echo 'Get student image group id wise';
		echo "<pre>";
		print_r($get_student_img_data_group_wise);
*/
		if(!empty($get_student_img_data_group_wise))
		{
			foreach($get_student_img_data_group_wise as $key=>$val)
			{
				$grp_wise_img_dt[$val['group_id']][]=$val;
			}
		}
		
		


		if(!empty($grp_wise_img_dt))
		{
			$data['grp_wise_img_dt']=$grp_wise_img_dt;
		}
		/*echo "<br>";
		echo 'Get group id wise img array';
		echo "<pre>";
		print_r($grp_wise_img_dt);

		exit;*/
		$this->load->view('class_wise_group_display.php',$data);
	}

	public function group_wise_image_data_in_slider()
	{
		$student_img_arr=$this->input->post('student_img_id');
		$image_id_arry=array();
		foreach($student_img_arr as $img_id){
			$image_id_arry[]=(int)$img_id;
		}		
		
		$click_img_id=$this->input->post('click_img_id');
		if (false !== ($i = array_search($click_img_id, $image_id_arry))) {
			$b = array_splice($image_id_arry, $i);
			$image_id_arry111 = array_merge($b, $image_id_arry);
		}
 
		foreach($image_id_arry111 as $key11=>$val11)
		{
			
			$student_image_dt=$this->mongo_db->where('student_image_id', $val11)->get('kk_student_image');
			$sequece_img_id_wise_dt[]=$student_image_dt[0];
		}
		

		foreach($sequece_img_id_wise_dt as $key=>$val)
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
		$data['student_image_data']=$all_img_details;
		$data['student_img_id']=$student_image_id;

		
		$this->load->view('group_wise_image_data_in_slider.php',$data);
	}

	/*Logout teacher section*/

	public function logout()
	{
		$this->session->unset_userdata('teacher_logged_in');		//session_destroy();		
		redirect('home','refresh');
	}

}