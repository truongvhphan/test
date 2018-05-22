<?php
/**
 * Description of product_controller
 *
 * @author truongtram
 */
include_once '../Models/database.php';
include_once("../Models/administrators_table.php");
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
            $view = AppController::View();
            if(file_exists($view) == false)
                throw new MVCException('Tập tin không tồn tại' . $view);
            else
            {
                $admin_model = new Administrators();
                $rsAdmins = $admin_model->getAdministrartor();
                $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                $GLOBALS['template']['content'] = include_once $view;
                $GLOBALS['template']['title'] = 'Administrators List';
                include_once '../template/index.php';
            }
        }
        catch(MVCException $e)
        {
            
        }
        break;
    break;
	case 'add_admin':
        try{
            $tablesDB = new Database();
            $tables = $tablesDB->getTables();
            $view = AppController::View();
			
            if(!file_exists($view))
                throw new MVCException('Tập tin không tồn tại ' . $view);
            else
            {
                $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                $GLOBALS['template']['content'] = $view;
                $GLOBALS['template']['title'] = 'Add New Administrator ';
                include_once '../template/index.php';
            }
        }
        catch(MVCException $e){
            
        }
        break;
	
	case 'add_admin_form':
		if(isset($_POST['EmailAddress'])&&isset($_POST['Password'])&&isset($_POST['firstName'])&& isset($_POST['lastName']))
        {
            $email = $_POST['EmailAddress'];
            $pass = $_POST['Password'];
            $first = $_POST['firstName'];
            $last = $_POST['lastName'];
            $admin = new Administrators();
            $admin->AddAdmin($email,$pass,$first,$last);
            header('Location: administrators_controller.php');
        }
        break;
	break;
    
}
