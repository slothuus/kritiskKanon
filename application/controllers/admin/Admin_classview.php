<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
class Admin_classview extends CI_Controller {
	public function __construct()
	{
		parent::__construct();			
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

	public function index()
	{			
		$this->user_is_login();
		$data['main_content']='admin_classview';	
		$data['all_teacher_class_data']=$this->admin_model->getAllRecordByTable('kk_virtual_class');		
		$this->load->view('admin/main_template.php',$data);
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
		$get_group_id_from_virtual_class=$this->mongo_db->where(array('virtual_class_id'=>$virtual_class_id))->distinct('kk_group', 'group_name');
		
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
		print_r($get_student_img_data_group_wise);*/

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
		$this->load->view('admin/class_wise_group_display.php',$data);
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
			$get_image_filepath=$this->mongo_db->where('image_id', (int)$val['image_id'])->get('kk_image');
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

		
		$this->load->view('admin/group_wise_image_data_in_slider.php',$data);
	}
}
