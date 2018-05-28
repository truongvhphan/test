<?php
include_once '../Config/bootload.php';


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
            $view = Page::View();
            if(file_exists($view) == false)
                throw new MVCException('Tập tin không tồn tại' . $view);
            else
            {
                if(isset($_GET['start']))
                    $start = $_GET['start'];
                else
                    $start = null;
                    
                $categories_model = new Categories();
                $rsCategories = $categories_model->getCategories($start);
                $rsPage = $categories_model->getCategories();
                $pagination = Page::createPagination($rsPage);
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
    case 'add':
        $input = filter_input(INPUT_POST, 'category_name');
        if($input == NULL)
        {
            try{
                $view = Page::View();
                if(file_exists($view) == false)
                    throw new MVCException('Tập tin không tồn tại' . $view);
                else
                {
                    $tablesDB = new Database();
                    $tables = $tablesDB->getTables();
                    $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                    $GLOBALS['template']['content'] = include_once $view;
                    $GLOBALS['template']['title'] = 'Add New Category';
                    include_once '../template/index.php';
                }
            }
            catch(MVCException $e)
            {
                
            }
        }
        else
        {
            $category_model = new Categories();
            $category_model->insertNewCategory($input);
            header('Location: categories_controller.php');
        }
        break;
    
    case 'delete':
        if(!isset($_GET['confirm'])){
            if(isset($_GET['cate_id'])){
                MessageBox::Show('Bạn có muốn xóa không?', MB_CONFIRM);
            }
        }
        else
        {
            if($_GET['confirm'] == true){
                $category_id = $_GET['cate_id'];
                $category_model = new Categories;
                $category_model->deleteCategory($category_id);
                header('Location: categories_controller.php');
            }
        }
        break;
    case 'edit':
        $input = filter_input(INPUT_POST, 'category_name');
        if($input == NULL){
            try{
                $category_id = $_GET['cate_id'];
                $category_model = new Categories();
                $rsCategory = $category_model->getCategoryByID($category_id);
                $view =  Page::View();
                if(file_exists($view) == false)
                    throw new MVCException('Không tìm thấy tập tin ' . $view);
                else
                {
                    $tablesDB = new Database();
                    $tables = $tablesDB->getTables();
                    $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                    $GLOBALS['template']['content'] = include_once $view;
                    $GLOBALS['template']['title'] = 'Edit Category';
                    include_once '../template/index.php';
                }
            }catch(MVCException $e){}
        }
        else{
            $category_id = $_POST['category_id'];
            $category_name = $_POST['category_name'];
            $category_model = new Categories();
            $category_model->editCategory($category_name, $category_id);
            header('Location: categories_controller.php');    
        }
        break;
}

