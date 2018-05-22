<?php
/**
 * Description of product_controller
 *
 * @author truongtram
 */
include_once '../Models/database.php';
include_once '../Models/products_table.php';
include_once '../Models/categories_table.php';
include_once '../Controllers/app_controller.php';
include_once '../Errors/mvc_exception.php';
include_once '../Libs/page_lib.php';

$action = filter_input(INPUT_POST, 'action');
if($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
    if($action == NULL){
        $action = 'index';
    }
}

switch ($action){
    case 'index':
        try{
            $tablesDB = new Database();
            $tables = $tablesDB->getTables();
            $productDB = new ProductModel();
            $start = 0;
            if(isset($_GET['start'])){
                $start = $_GET['start'];
            }
            $rsProducts = $productDB->getProducts($start);
            $rsProductPage =  $productDB->getProducts();
            $view = AppController::View();
            if(file_exists($view) == false)
                throw new MVCException('Tập tin không tồn tại' . $view);
            else
            {
                $categories_model = new CategoryModel();
                $rsCategories = $categories_model->getCategories();
                $pagination = Page::createPagination($rsProductPage);
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
    case 'add_product_form':
        try{
            $tablesDB = new Database();
            $tables = $tablesDB->getTables();
            $categoryModel = new CategoryModel();
            $rsCategory = $categoryModel->getCategories();
            $view = AppController::View();
            if(!file_exists($view))
                throw new MVCException('Tập tin không tồn tại ' . $view);
            else
            {
                $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['title'] = 'Add New Product';
                include_once '../template/index.php';
            }
        }
        catch(MVCException $e){
            
        }
        break;
    case 'add_product_db':
        if(isset($_POST['categoryID'])&&isset($_POST['productCode'])&&isset($_POST['productName'])&&isset($_POST['price']))
        {
            $categoryID = $_POST['categoryID'];
            $productCode = $_POST['productCode'];
            $productName = $_POST['productName'];
            $price = $_POST['price'];
            $productModel = new ProductModel();
            $productModel->insertNewProducts($categoryID,$productCode,$productName,$price);
            header('Location: products_controller.php');
        }
        break;
    case 'edit_product_form':
        try{
            $tablesDB = new Database();
            $tables = $tablesDB->getTables();
            $category_model = new CategoryModel();
            $rsCategory = $category_model->getCategories();
            $model = new ProductModel();
            $rsProduct = $model->getProductByID($_GET['product_id']);
            $view = AppController::View();
            if(file_exists($view) == false)
                throw new MVCException('Không tồn tại tập tin ' . $view);
            else
            {
                $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['title'] = 'Edit Product';
                include_once '../template/index.php';
            }   
        }catch(MVCException $e)
        {
            
        }
        break;
    case 'edit_product_db':
        $categoryId = $_POST['categoryID'];
        $productCode = $_POST['productCode'];
        $productName = $_POST['productName'];
        $listPrice = $_POST['listPrice'];
        $id = $_POST['id'];
        $model = new ProductModel();
        $model->editProduct($categoryId, $productCode, $productName, $listPrice, $id);
        header('Location: admin_controller.php');
        break;
    case 'delete_product':
        $id = $_GET['product_id'];
        $productModel = new ProductModel();
        $productModel->DeleteProduct($id);
        header('Location: admin_controller.php');
        break;
    
}
