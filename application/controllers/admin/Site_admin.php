<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_admin extends CI_Controller {
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
		$data['main_content']='manage_siteadmin';	
		$data['all_gallery']=$this->admin_model->getAllRecordByTable('kk_gallery');		
		$this->load->view('admin/main_template.php',$data);
	}

	public function insert_gallery()
	{	
		$max_gal_id=$this->admin_model->getMaxidfromtable('gallery_id','kk_gallery');		
		if(empty($max_gal_id[0]['gallery_id']))
		{
			$gal_id=1;				
		}
		else
		{			
			$gal_id=$max_gal_id[0]['gallery_id'] + 1;			
		}	
		
		$siteadmin_data['gallery_id']=$gal_id;
		$siteadmin_data['gallery_name']=$this->input->post('gallery_name');
		$siteadmin_data['gallery_updated_datetime']=date('Y-m-d H:i:s');
		$siteadmin_data['gallery_status']='Active';

		$add_data=$this->admin_model->insertdata('kk_gallery',$siteadmin_data);
		$siteadmin_data['all_gallery']=$this->admin_model->getAllRecordByTable('kk_gallery');
		redirect('admin/site_admin','refresh');
		//$this->load->view('admin/ajax_siteadmindata.php',$siteadmin_data);
	}

	public function chek_exists_galname()
	{
		$gallery_name=$this->input->post('gallery_name');
		$check=$this->admin_model->exitsGalleyname($gallery_name);
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

	public function insert_gallery_images_ajx()
	{	
		$img_data['_id']				= (int)$this->input->post('ig_id');
	    $img_data['image_id']			= (int)$this->input->post('ig_id');
	    $img_data['gallery_id']			= $this->input->post('gal_id');
	    $img_data['image_name']			= '';
	    $img_data['image_year'] 		= '';
	    $img_data['image_description'] 	= '';
	    $img_data['image_file_path'] 	= '';
	    $img_data['image_updated_datetime']			= date('Y-m-d H:i:s');
	    $img_data['image_status']			= 'Active';	    
	    $add_data=$this->admin_model->insertdata('kk_image',$img_data);
	}

	public function insert_gallery_images()
	{
		/*echo "<pre>";
		print_r($this->input->post());exit();	
		exit();*/
		$gallery_id=(string)$this->input->post('gallery_id');
		$old_data_get=$this->mongo_db->where(array('gallery_id' => $gallery_id))->get('kk_image');
		foreach($old_data_get as $key=>$val)
		{
			$delete=$this->mongo_db->where(array('gallery_id' => $val['gallery_id']))->delete('kk_image');
		}	

		/*echo "<pre>";
		print_r($old_data_get);
		exit();*/

				
		/*echo "<pre>";
		print_r($this->input->post());exit();	*/
		$i = 0; 		
		$ims=array();
		if(!empty($this->input->post('image_name')))
		{
			foreach($this->input->post('image_name') as $image_name){

				$max_img_id=$this->admin_model->getMaxidfromtable('image_id','kk_image');		
				if(empty($max_img_id[0]['image_id']))
				{
					$img_id=1;				
				}
				else
				{			
					$img_id=$max_img_id[0]['image_id'] + 1;			
				}

				$img_data['_id']				= (int)$this->input->post('image_id')[$i];
			    $img_data['image_id']			= (int)$this->input->post('image_id')[$i];
			    $img_data['gallery_id']			= $this->input->post('gallery_id');
			    $img_data['image_name']			= $image_name;
			    $img_data['image_year'] 		= $this->input->post('image_year')[$i];
			    $img_data['image_description'] 	= $this->input->post('image_description')[$i];
			    $img_data['image_file_path'] 	= $this->input->post('image_file_path')[$i];
			    $img_data['image_updated_datetime']			= date('Y-m-d H:i:s');
			    $img_data['image_status']			= 'Active';
			    
			    //$ims['aaa'][]=$img_data;
			    $add_data=$this->admin_model->insertdata('kk_image',$img_data);

			    $i++;
			}
		}
		$this->session->set_flashdata('success_msg', 'Successfully data inserted');	
		redirect('admin/site_admin','refresh');
	}

	public function get_gallery_wise_images()
	{
		$img_gallery_id=$this->input->post('img_gallery_id');
		$gallery_img_data['gallery_img_arr']=$this->mongo_db->where(array('gallery_id' => $img_gallery_id))->get('kk_image');		
		$this->load->view('admin/ajax_multi_imagedata.php',$gallery_img_data);
		
	}

	public function delete_image_from()
	{
		$image_id=(int)$this->input->post('image_id');
		$delete=$this->mongo_db->where(array('image_id' => $image_id))->delete('kk_image');		
		if($delete)
		{			
			echo 'Deleted';
		}
		else
		{
			echo 'Not Deleted';
		}
	}

	public function get_last_imageid()
	{
		$max_img_id=$this->admin_model->getMaxidfromtable('image_id','kk_image');	
		/*echo "<pre>";	
		print_r($max_img_id[0]['image_id']);*/
		if(empty((int)$max_img_id[0]['image_id']))
		{			
			$img_id=(int)1;				 
			return $img_id;
		}
		else
		{
			echo $img_id1=(int)$max_img_id[0]['image_id'] + 1;						 
			return $img_id1;
		}
	}

	/*public function manage_video()
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
	}*/
}
