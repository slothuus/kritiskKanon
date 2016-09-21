<?php
	class Admin_model extends CI_Model
	{
		public function __construct()
	    {
	        parent::__construct();	        
	    }	

	    public function login($email,$password)
		{			
			$login_check=$this->mongo_db->where(array('admin_email' => $email,'admin_password' => $password))->get('kk_admin');
			$count_data=count($login_check);
			if($count_data == 1)
			{
				return $login_check;
			}
			else
			{
				return false;				
			}
		}   

		public function insertdata($tbl_name, $data) {
	        $query = $this->mongo_db->insert($tbl_name, $data);	        
	        return $query;
	    }

	    public function getAllRecordByTable($tbl_name) {	        
	        $result = $this->mongo_db->get($tbl_name);
	        return $result;
	    }

	    public function getMaxidfromtable($fieldname,$tablename)
	    {
	    	$max_id=$this->mongo_db->order_by(array($fieldname=>'DESC'))->limit(1)->get($tablename);
	    	return $max_id;
	    }

	  /*  public function getDataById($tbl_name ,$ID) {
	       $galley_image_data=$this->mongo_db->get_where($tbl_name, array('image_id' => $ID));
	       print_r($this->mongo_db->get_where($tbl_name, array('image_id' => $ID)));	
		   return $galley_image_data;		
	    }*/

	  /*  public function getIdWiseStatus($tbl_name, $prefix, $ID) {
	        $this->db->where($prefix . 'id', $ID);
	        $query = $this->db->get($tbl_name);
	        $result = $query->row_array();
	        return $result;
	    }
*/
	/*	public function change_status($tbl_name, $prefix, $action, $id) {

	        if ($action == 'Inactive') {
	            $data = array($prefix . 'status' => 'Active');
	        } else {
	            $data = array($prefix . 'status' => 'Inactive');
	        }
	        try {
	            $this->db->where($prefix . 'id', $id);
	            $result = $this->db->update($tbl_name, $data);
	        } catch (Exception $e) {
	            echo $e->getMessage();
	            die;
	        }
	        return $result;
	    }

*/
	    public function exitsGalleyname($gallery_name = NULL) {	        
	        $query=$this->mongo_db->where(array('gallery_name' => $gallery_name))->get('kk_gallery');
			$count_data=count($query);
			if($count_data > 0)
			{
				 echo 'false';
			}
			else
			{
				echo 'true';			
			}
	    }

	    /*public function updaterecord($tbl_name, $prefix, $data, $ID) {
	        $this->db->where($prefix . 'id', $ID);
	        $query = $this->db->update($tbl_name, $data);
	        return TRUE;
	    }*/

	    public function deleteRecordByID($tbl_name, $prefix, $ID) {
	        $result=$this->mongo_db->where(array($prefix . 'id' => $ID))->delete($tbl_name);
	        return $result;
	    }

	    
	}
?>