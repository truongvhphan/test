<?php
include_once '../Models/database.php';
include_once '../Models/categories_table.php';
include_once 'app_controller.php';
include_once '../Errors/mvc_exception.php';

$action = filter_input(INPUT_POST, 'action');
if($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
    if($action == NULL)
    $action = 'index';
}

switch ($action){
    case 'index':
        try{
            $tablesDB = new Database();
            $tables = $tablesDB->getTables();
            $view = AppController::View();
            if(file_exists($view) == false)
                throw new MVCException('Tập tin không tồn tại' . $view);
            else
            {
                $categories_model = new CategoryModel();
                $rsCategories = $categories_model->getCategories();
                $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['title'] = 'Categories List';
                include_once '../template/index.php';
            }
        }
        catch(MVCException $e)
        {
            
        }
        break;
    break;
    case 'add_category_form':
        try{
            $view = AppController::View();
            if(file_exists($view) == false)
                throw new MVCException('Tập tin không tồn tại' . $view);
            else
            {
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['title'] = 'Add New Category';
                include_once '../template/index.php';
            }
        }
        catch(MVCException $e)
        {
            
        }
        break;
    case 'add_category_db':
        if(isset($_POST['category_name'])){
            $category_model = new CategoryModel();
            $category_model->insertNewCategory($_POST['category_name']);
            header('Location: admin_controller.php');
        }
        break;
    case 'delete_category_db':
        if(isset($_GET['cate_id'])){
            $category_id = $_GET['cate_id'];
            $category_model = new CategoryModel();
            $category_model->deleteCategory($category_id);
            header('Location: ../Admin/index.php');
        }
        break;
    case 'edit_category_form':
        try{
            $category_id = $_GET['cate_id'];
            $category_model = new CategoryModel();
            $rsCategory = $category_model->getCategoryByID($category_id);
            $view = AppController::View();
            if(file_exists($view) == false)
                throw new MVCException('Không tìm thấy tập tin ' . $view);
            else
            {
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['title'] = 'Edit Category';
                include_once '../template/index.php';
            }
        }catch(MVCException $e){}
        break;
    case 'edit_category_db':
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $category_model = new CategoryModel();
        $category_model->editCategory($category_name, $category_id);
        header('Location: admin_controller.php');
        break;
}

