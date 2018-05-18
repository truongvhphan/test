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
            $query = 'SELECT * FROM administrartor WHERE adminID=?';
            $param = array();
            $param[] = $id;
            $rs = $this->doQuery($query, $param);
            return $rs;
        }
    }
?>