<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game_intro extends CI_Controller {
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
		$data['main_content']='manage_game_intro';			
		$data['get_gane_intro']=$this->mongo_db->where(array('intro_id' => 1))->get('kk_game_intro');	
		$this->load->view('admin/main_template.php',$data);
	}

	public function manage_game_intro()
	{	
		$delete_last_intro=$this->mongo_db->where(array('intro_id' => 1))->delete('kk_game_intro');				
		$gme_intro_data['intro_id']=1;
		$gme_intro_data['intro_description']=$this->input->post('intro_description');
		$gme_intro_data['intro_updated_datetime']=date('Y-m-d H:i:s');		

		$add_game_data=$this->admin_model->insertdata('kk_game_intro',$gme_intro_data);
		redirect('admin/game_intro','refresh');		
	}

	
}
