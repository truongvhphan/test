<?php 
    include_once('../Models/database.php');
    include_once('../Models/categories_table.php');
    include_once('../Models/customers_table.php');
    include_once '../Controllers/app_controller.php';
    
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
                throw new MVCException('file không t?n t?i'.$view);
            }
            else
                $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['title'] ='Customers List';
                include_once '../template/index.php';
            
        }
         catch(MVCException $e){}              
        break;
        case 'add_customer_form':
        try
        {
            $data = new Database();
            $tables = $data->getTables();
            $customer = new CustomerModel();
            $rsCustomer = $customer->getCustomer();
             $view = AppController::View();
            if(file_exists($view)==false)
            {
                throw new MVCException('file không t?n t?i'.$view);
            }
             else
                $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['title'] ='Customers List';
                include_once '../template/index.php';
        }            
        catch(MVCException $e){}
        break;
        case 'add_customer_db':
            if(isset($_POST['customerID'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['first'])
                &&isset($_POST['last'])&& isset($_POST['ship'])&& isset($_POST['billing']))
            {
                $customerID = $_POST['customerID'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $first = $_POST['first'];
                $last = $_POST['last'];
                $ship = $_POST['ship'];
                $billing = $_POST['billing'];
                $customer = new CustomerModel();
                $customer->InsertCustomer($customer,$email,$password,$first,$last,$ship,$billing);
                header('Location: customers_controller.php');
            }        
        break;
    }
?>