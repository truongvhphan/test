<?php
class Categories extends Database{
    private $categoryId;
    private $categoryName;
    public function __construct() {
        parent::__construct();
        
    }
    public function setCategoryId($category_id){
        $this->categoryId = $category_id;
    }
    public function getCategoryId(){
        return $this->categoryId;
    }
    public function setCategoryName($category_name){
        $this->categoryName = $category_name;
    }
    public function getCategoryname(){
        return $this->categoryName;
    }
    public function getCategories($start = null, $limit = 5){
        if($start == null){
            $query = 'SELECT * FROM categories';
        }
        else{
            $query = "SELECT * FROM categories LIMIT $start, $limit";
        }
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function getCategoryByID($category_id){   
        $query = 'SELECT * FROM categories WHERE categoryID=?';
        $param = array();
        $param[] = $category_id;
        $rs = $this->doQuery($query, $param);
        return $rs;
    }
    public function insertNewCategory($category_name){
        $query = 'INSERT INTO categories(categoryName)';
        $query.= ' VALUES(?)';
        
        $param = array();
        $param[] = $category_name;
        $this->doQuery($query, $param);
    }
    public function deleteCategory($category_id){
        $query = 'DELETE FROM categories WHERE categoryID=?';
        $param = array();
        $param[]= $category_id;
        $this->doQuery($query, $param);
    }
    public function editCategory($category_name, $category_id){
        $query = 'UPDATE categories SET categoryName=? WHERE categoryID=?';
        $param = array();
        $param[] = $category_name;
        $param[] = $category_id;
        $this->doQuery($query, $param);
    }
}
