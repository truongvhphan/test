<?php 
    include_once('../Config/bootload.php');
    
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
            $customer = new Customers();
            $start = 0;
            if(isset($_GET['start'])){
                $start = $_GET['start'];
            }
            $rsCustomer = $customer->getCustomer($start);
            $rsCustomerPage = $customer->getCustomer();
            $view = Page::View();
            if(file_exists($view)==false)
            {
                throw new MVCException('file không tồn tại' . $view);
            }
            else
                //Phân trang
                $pagination = Page::createPagination($rsCustomerPage);
                
                $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['title'] ='Customers List';
                include_once '../template/index.php';
            
        }
         catch(MVCException $e){}              
        break;
        case 'add_customer':
            $check_form_customer = filter_input(INPUT_POST,"submit");
            if($check_form_customer==null)
            {
                try
                {
                    $data = new Database();
                    $tables = $data->getTables();
                    $customer = new Customers();
                    $rsCustomer = $customer->getCustomer();
                     $view = Page::View();
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
            }
            else
            {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $first = $_POST['firstname'];
                $last = $_POST['lastname'];
                $ship = $_POST['ship'];
                $billing = $_POST['billing'];
                md5($password);
                $customer = new Customers();
                $customer->InsertCustomer($email,$password,$first,$last,$ship,$billing);
                header('Location: customers_controller.php'); 
            }         
        break;
        
        case 'delete_customer':
            if(!isset($_GET['confirm']))
            {
                if(isset($_GET['customer_id']))
                {
                    MessageBox::Show('Bạn có muốn xóa không ?',MB_CONFIRM);
                }
            }
            else
            {
                if(isset($_GET['confirm'])==true)
                {
                    $id = $_GET['customer_id'];
                    $customer = new Customers();
                    $customer->deleteCustomers($id);
                    header('Location: customers_controller.php');
                }             
            }
        break;
        case 'edit_customer':
            try
            {
                $data = new Database();
                $tables = $data->getTables();
                $customer = new Customers();
                $rsCustomer = $customer->getCustomerByID($_GET['customer_id']);
                 $view = Page::View();
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
                    $customer = new Customers();
                    $customer->UpdateCustomer($email,$password,$first,$last,$ship,$billing,$customerID);
                    header('Location: admin_controller.php');
                }
                
        break;
    }
?>