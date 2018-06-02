<?php 
    class Customers extends Database{
        private $id;
        private $email;
        private $pass;
        private $fisrt;
        private $last;
        private $ship;
        private $billing;
        
        public function __construct()
        {
            parent::__construct();
        }
        public function setID($id)
        {
            $this->id = $id;
        }
        public function getID()
        {
            $this->id;
        }
        public function getshipAdressID()
        {
            $query= 'select shipAddressID from customers';
            $rs = $this->doQuery($query);
            return $rs;
        }
        public function getCustomer($start= -1, $limit=5)
        {
            if($start == -1){
                $query = 'select * from customers';
            }
            else
                $query = 'select * from customers LIMIT ' .$start.','.$limit;           
            $rs =$this->doQuery($query);
            return $rs;
        }
        public function getCustomerByID($id)
        {
            $query ='select * from customers where customerID=?';
            $param = array();
            $param[] = $id;
            $rs =$this->doQuery($query,$param);
            return $rs;
        }
        public function InsertCustomer($email, $pass, $first, $last,$ship,$billing)
        {
            $query ='insert into customers(emailAddress,password,firstName,lastName,shipAddressID,billingAddressID) Values(?,?,?,?,?,?)';
            $param = array();
            $param[]= $email;
            $param[]= md5($pass);
            $param[] = $first;
            $param[] =$last;
            $param[] = $ship;
            $param[] = $billing;
            $this->doQuery($query,$param);
        }
        public function deleteCustomers($id)
        {
            $query ='delete from customers where customerID=?';
            $param = array();
            $param[]= $id;
            $this->doQuery($query,$param);
        }
        public function UpdateCustomer($email, $pass, $first,$last,$ship,$billing,$id)
        {
            $query ='Update customers set emailAddress=?, password=?,firstName=?,lastName=?,shipAddressID=?,billingAddressID=? where customerID=?';
            $param = array();
            $param[]= $email;
            $param[]= $pass;
            $param[]= $first;
            $param[]= $last;
            $param[]= $ship;
            $param[]= $billing;
            $param[]= $id;
            $this->doQuery($query,$param);
        }
    }
?>







