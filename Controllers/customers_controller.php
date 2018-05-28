<?php 
    include_once('../Models/database.php');
    include_once('../Models/categories_table.php');
    include_once('../Models/customers_table.php');
    include_once '../Controllers/app_controller.php';
    include_once '../Errors/mvc_exception.php';
    
    $action = filter_input(INPUT_GET,'action');
    if($action == NULL)
    {
        $action = filter_input(INPUT_POST,'action');
        if($action == Null)
            $action ='index';
    }
    switch($action)
    {
        case 'index':
        try
        {
            $data = new Database();
            $tables = $data->getTables();
            $customer = new CustomerModel();
            $rsCustomer = $customer->getCustomer();
            $view = AppController::View();
            if(file_exists($view)==false)
            {
                throw new MVCException('file không tồn tại' . $view);
            }
            else
                $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['title'] ='Customers List';
                include_once '../template/index.php';
            
        }
         catch(MVCException $e){}              
        break;
        case 'add_customer':
        try
        {
            $data = new Database();
            $tables = $data->getTables();
            $customer = new CustomerModel();
            $rsCustomer = $customer->getCustomer();
             $view = AppController::View();
            if(!file_exists($view))
            {
                throw new MVCException('file không tồn tại' . $view);
            }
             else
             {
                $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['title'] = 'Add New Customers';
                include_once '../template/index.php';
             }
        }            
        catch(MVCException $e){}
        break;
        case 'add_customer_db':
        print_r($_POST);
                $email = $_POST['email'];
                $password = $_POST['password'];
                $first = $_POST['firstname'];
                $last = $_POST['lastname'];
                $ship = $_POST['ship'];
                $billing = $_POST['billing'];
                $customer = new CustomerModel();
                $customer->InsertCustomer($email,$password,$first,$last,$ship,$billing);
                header('Location: customers_controller.php');   
        break;
        
        case 'delete_customer':
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $customer = new CustomerModel();
                $customer->deleteCustomers($id);
                header('Location: admin_controller.php');
            }
        break;
        case 'edit_customer':
            try
            {
                $data = new Database();
                $tables = $data->getTables();
                $customer = new CustomerModel();
                $rsCustomer = $customer->getCustomerByID($_GET['customer_id']);
                 $view = AppController::View();
                if(!file_exists($view))
                {
                    throw new MVCException('file không tồn tại' . $view);
                }
                 else
                 {
                    $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                    $GLOBALS['template']['content'] = include_once $view;
                    $GLOBALS['template']['title'] = 'Update Customers';
                    include_once '../template/index.php';
                 }
            }            
        catch(MVCException $e){}
        break;
        case 'edit_customer_db':
             if(isset($_POST['customerID'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['firstname'])
                &&isset($_POST['lastname'])&& isset($_POST['ship'])&& isset($_POST['billing']))
                {
                    $customerID = $_POST['customerID'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $first = $_POST['firstname'];
                    $last = $_POST['lastname'];
                    $ship = $_POST['ship'];
                    $billing = $_POST['billing'];
                    $customer = new CustomerModel();
                    $customer->UpdateCustomer($email,$password,$first,$last,$ship,$billing,$customerID);
                    header('Location: admin_controller.php');
                }
                
        break;
    }
?>