<?php
include_once '../Config/bootload.php';


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
            $productDB = new Products();
            $start = 0;
            if(isset($_GET['start'])){
                $start = $_GET['start'];
            }
            $rsProducts = $productDB->getProducts($start);
            $rsProductPage =  $productDB->getProducts();
            $view = Page::View();
            if(file_exists($view) == false)
                throw new MVCException('Tập tin không tồn tại' . $view);
            else
            {
                $categories_model = new Categories();
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
    case 'add':
        $check_form_post = filter_input(INPUT_POST,'submit');
        if($check_form_post == null){
            try{
                $tablesDB = new Database();
                $tables = $tablesDB->getTables();
                $categoryModel = new Categories();
                $rsCategory = $categoryModel->getCategories();
                $view = Page::View();
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
        }
        else
        {
            $categoryID = $_POST['categoryID'];
            $productCode = $_POST['productCode'];
            $productName = $_POST['productName'];
            $description = $_POST['description'];
            $discountPercent = $_POST['discountPercent'];
            $price = $_POST['price'];
            $date_class = new DateTime();
            $date = $date_class->format('Y-m-d H:i:s');
            $productModel = new Products();
            $productModel->insertNewProducts($categoryID,$productCode,$productName,$description,$price, $discountPercent,$date);
            header('Location: products_controller.php');
        }
        break;
    case 'edit':
        $check_form_post = filter_input(INPUT_POST, 'submit');
        if($check_form_post == null){
            try{
                $tablesDB = new Database();
                $tables = $tablesDB->getTables();
                $category_model = new Categories();
                $rsCategory = $category_model->getCategories();
                $model = new Products();
                $rsProduct = $model->getProductByID($_GET['product_id']);
                $view = Page::View();
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
        }
        else
        {
            $categoryId = $_POST['categoryID'];
            $productCode = $_POST['productCode'];
            $productName = $_POST['productName'];
            $description = $_POST['description'];
            $listPrice = $_POST['listPrice'];
            $discountPercent = $_POST['discountPercent'];
            $id = $_POST['id'];
            $model = new Products();
            $model->editProduct($categoryId, $productCode, $productName, $description, $listPrice, $discountPercent, $id);
            header('Location: products_controller.php');    
        }
        break;
    case 'delete':
        if(!isset($_GET['confirm'])){
            if(isset($_GET['product_id'])){
                MessageBox::Show('Bạn có muốn xóa sản phẩm?', MB_CONFIRM);
            }
        }
        else{
            if($_GET['confirm'] == true){
                $id = $_GET['product_id'];
                $productModel = new Products;
                $productModel->DeleteProduct($id);
                header('Location: products_controller.php');
            }
        }
        break;
    
}
