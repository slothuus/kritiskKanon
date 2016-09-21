<?php
	class Front_model extends CI_Model
	{
		public function __construct()
	    {
	        parent::__construct();	        
	    }

	    public function insertdata($tbl_name, $data) {
	        $query = $this->mongo_db->insert($tbl_name, $data);	        
	        return $query;
	    }

	    public function getMaxidfromtable($fieldname,$tablename)
	    {
	    	$max_id=$this->mongo_db->order_by(array($fieldname=>'DESC'))->limit(1)->get($tablename);
	    	return $max_id;
	    }

	    public function login($prefix,$email,$password,$table)
		{			
			$login_check=$this->mongo_db->where(array($prefix.'email' => $email,$prefix.'password' => $password))->get($table);
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

		public function exitsEmail($email = NULL) {	        
	        
	        $teacher_query=$this->mongo_db->where(array('teacher_email' => $email))->get('kk_teacher');
			$count_teacher_data=count($teacher_query);

			$student_query=$this->mongo_db->where(array('student_email' => $email))->get('kk_student');
			$count_student_data=count($student_query);

			if($count_teacher_data > 0)
			{
				 echo 'false';
			}
			else if($count_student_data > 0)
			{
				 echo 'false';
			}
			else
			{
				echo 'true';			
			}
	    }

	    public function exitsStudent($std_id,$vrt_id) {	        
	        
	        $std_query=$this->mongo_db->where(array('student_id' => $std_id,'virtual_class_id' => $vrt_id))->get('kk_class_student');
			
			return $std_query;
			
	    }

	    public function getAllRecordByTable($tbl_name) {	        
	        $result = $this->mongo_db->get($tbl_name);
	        return $result;
	    }

	    public function GetRecordByID($tbl_name, $prefix, $ID) {
	        $result=$this->mongo_db->where(array($prefix . 'id' => $ID))->get($tbl_name);
	        return $result;
	    }

	    public function GetRecordWhereNot($tbl_name, $prefix, $ID) {
	        $result=$this->mongo_db->where_not_in($prefix . 'id', $ID)->get($tbl_name);
	        return $result;
	    }		   

	    public function deleteRecordByID($tbl_name, $prefix, $ID) {
	        $result=$this->mongo_db->where(array($prefix . 'id' => $ID))->delete($tbl_name);
	        return $result;
	    }
	}
?>