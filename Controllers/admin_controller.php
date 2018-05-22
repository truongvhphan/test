<?php
include_once '../Models/database.php';
include_once '../Models/categories_table.php';
include_once '../Models/products_table.php';
include_once('../Models/administrators_table.php');
include_once '../Controllers/app_controller.php';
include_once '../Errors/mvc_exception.php';


$action = filter_input(INPUT_POST, 'acion');
if($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
    if($action == NULL){
        $action = 'index';
    }
}

switch($action){
    case 'index':
        try{
            
            $tableDB = new Database();
            $tables = $tableDB->getTables();
            
            $view = AppController::View();
            if(file_exists($view) == false)
                throw new MVCException('Không tồn tại tập tin ' . $view);
            else{
                $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['title'] = 'Administration Management System';
                include_once '../template/index.php';
            }
        }catch(MVCException $e){
            
        }
        break;
    case 'add_category':
        //Chuyển sang category_controller.php xử lý yêu cầu
        header('Location: ../Controllers/category_controller.php?action=add_category_form');
        break;
    case 'add_product':
        header('Location: ../Controllers/product_controller.php?action=add_product_form');
        break;
    case 'add_customer':
        header('Location: ../Controllers/customers_controller.php?action=add_customer_form');
        break;
}
 
    
?>
