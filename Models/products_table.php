<?php   

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductModel extends Database{
    
    public function __construct() {
        parent::__construct();
    }
    public function getProducts($start=-1, $limit=5){
        if($start == -1)
            $query = 'SELECT * FROM products';
        else
            $query = 'SELECT * FROM products LIMIT ' . $start . ',' . $limit;
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function getProductByID($id){
        $sql = 'SELECT * FROM products WHERE productID=?';
        $param = array();
        $param[] = $id;
        $rs = $this->doQuery($sql, $param);
        return $rs;
    }
    public function insertNewProducts($category_ID, $productCode, $productName, $listPrice){
        $query = 'INSERT INTO products(categoryID, productCode, productName, listPrice)';
        $query.= ' VALUES(?, ?, ?, ?)';
        $param = array();
        $param[] = $category_ID;
        $param[] = $productCode;
        $param[] = $productName;
        $param[] = $listPrice;
        $this->doQuery($query, $param);
    }
    public function editProduct($category_ID, $productCode, $productName, $listPrice, $id){
        $query = 'UPDATE products SET categoryID = ?, productCode = ?, productName = ?, listPrice = ? WHERE productID=?';        
        $param = array();
        $param[] = $category_ID;
        $param[] = $productCode;
        $param[] = $productName;
        $param[] = $listPrice;
        $param[] = $id;
        $this->doQuery($query, $param);
    }
    public function DeleteProduct($productID)
    {
        $query = 'DELETE From products where productID=?';
        $param = array();
        $param[] = $productID;
        $this->doQuery($query,$param);
    }
}