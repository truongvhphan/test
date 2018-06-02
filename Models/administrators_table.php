<?php 
    class Administrators extends Database{
        private $adminID;
        private $email;
        private $pass;
        private $first;
        private $last;
        
        public function setAdminID($id){
        $this->adminID = $id;
        }
        public function getAdminID(){
            return $this->adminID;
        }
        public function setAdminEmail($email){
            $this->email = $email;
        }
        public function getAdminEmail(){
            return $this->email;
        }
        public function getAdministrartor(){   
            $query = 'SELECT * FROM administrators';
            $rs = $this->doQuery($query);
            return $rs;
        }
        public function getAdminByID($id){   
            $query = 'SELECT * FROM administrators WHERE adminID=?';
            $param = array();
            $param[] = $id;
            $rs = $this->doQuery($query, $param);
            return $rs;
        }
		public function AddAdmin($email,$pass,$first,$last,$img){
			$sql="INSERT INTO administrators (emailAddress, password, firstName, lastName,image) VALUES (?,?,?,?,?)";
			$param = array();
            $param[] = $email;
			$param[]=md5($pass);
			$param[]=$first;
			$param[]=$last;
			$param[]=$img;
            $this->doQuery($sql, $param);
		}
		public function DeleteAdmin($id)
		{
			$sql = "delete from administrators where adminID=?";
			$param = array();
			$param[]=$id;
			$this->doQuery($sql,$param);	
		}
		public function EditAdmin($email,$first,$last,$img,$id)
		{
			$query = 'UPDATE administrators 
                  SET emailAddress = ?, firstName = ?, 
                      lastName = ?,image =? 
                  WHERE adminID=?';        
			$param = array();
			$param[] = $email;
			$param[] = $first;
			$param[] = $last;
			$param[]= $img;
			$param[] = $id;
			$this->doQuery($query, $param);
			
		}
		public function getPassByID($id,$pass)
		{
			$query = 'SELECT * FROM administrators WHERE adminID=? AND password=?';
            $param = array();
            $param[] = $id;
			$param[]=$pass;
            $rs = $this->doQuery($query, $param);
            return $rs;	
		}
		public function EditPass($id,$pass)
		{
			$query = 'UPDATE administrators SET password =? WHERE adminID=?';        
			$param = array();
			$param[] = $pass;
			$param[] = $id;
			$this->doQuery($query, $param);	
		}
    }
?>