<?php
/**
 * Description of product_controller
 *
 * @author truongtram
 */
include_once("../Config/bootload.php");

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
           
			$start = 0;
                if(isset($_GET['start']))
                    $start = $_GET['start'];
                else
                    $start = null;
			 $view = Page::View();		
            if(file_exists($view) == false)
                throw new MVCException('Tập tin không tồn tại' . $view);
            else
            { 	$admin_model = new Administrators();
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
		
	case 'add_admin':
	 	$input = filter_input(INPUT_POST, 'submit');
		if($input == NULL)
		{
			 try{
				$tablesDB = new Database();
				$tables = $tablesDB->getTables();
				$view = Page::View();
				if(!file_exists($view))
					throw new MVCException('Tập tin không tồn tại ' . $view);
				else
				{
					$GLOBALS['template']['menu'] = include_once ('../template/menu.php');
					$GLOBALS['template']['content'] = include_once($view);
					$GLOBALS['template']['title'] = 'Add New Administrator ';
					include_once ('../template/index.php');
				}
			}
			catch(MVCException $e){
				
			}	
		}
		else
		{
			$email=$_POST["email_admin"];
			$pass=$_POST["Password"];
			$first=$_POST["firstName"];
			$last=$_POST["lastName"];
			$i = $_FILES['upload'];
			$img = Image::GetFile($i);
			//echo $img;
			$ad_model = new Administrators();
			$admin = $ad_model->AddAdmin($email,$pass,$first,$last,$img);
			//print_r($admin);
			header("Location: administrators_controller.php");
		}
        break;
		
	case "delete_admin":
		if(!isset($_GET["confirm"]))
		{
			if(isset($_GET["admin_id"]))
			{
				MessageBox::Show("Bạn có muốn xóa sản phẩm?",MB_CONFIRM);	
			}
		}
		else{
			 if($_GET['confirm'] == true){
                $id = $_GET['admin_id'];
                $adminModel = new Administrators();
                $adminModel->DeleteAdmin($id);
                header('Location: administrators_controller.php');
            }
		}
		break;
	case "edit_admin":
		$check_form_post = filter_input(INPUT_POST, 'submit');
        if($check_form_post == null){
            try{
                $tablesDB = new Database();
                $tables = $tablesDB->getTables();
				
              	$admin_model = new Administrators();
                $rsAdmins = $admin_model->getAdminByID($_GET['admin_id']);
				
                $view = Page::View();
                if(file_exists($view) == false)
                    throw new MVCException('Không tồn tại tập tin ' . $view);
                else
                {
                    $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                    $GLOBALS['template']['content'] = include_once $view;
                    $GLOBALS['template']['title'] = 'Edit Administrator';
                    include_once '../template/index.php';
                } 
				  
            }catch(MVCException $e)
            {
                
            }
        }
        else
        {
            $email = $_POST['email_admin'];
            $first = $_POST['first'];
            $last = $_POST['last'];
            $id = $_POST['adminID'];
			$i = $_FILES['upload'];
			$img = Image::GetFile($i);
           	$admin_model = new Administrators();
            $admin_model->EditAdmin($email,$first,$last,$img,$id);
            header('Location: administrators_controller.php');    
        }
	break;
	
	case "edit_pass":
			$passht =md5($_POST['passht']);
			$id = $_POST['adminID'];
			$admin_model = new Administrators();
			$rs = $admin_model->getPassByID($passht,$id);
			print_r($rs);
			/*if($rs!=NULL)
			{
				$passnew = $_POST['passnew'];
				$passnl = $_POST['passnl'];
				if(strcmp($passnew,$passnl)==0)
				{
					$admin_model->EditPass($id,$passnew);
					header('Location: administrators_controller.php'); 
				}
				else{
					echo "<script>alert('Mật khẩu mới & mật khẩu nhập lại không giống nhau!')</script>";
				}
			}
			else
			{
				echo "<script>alert('Mật khẩu hiện tại sai!')</script>"; 
			}*/
	break;
    
}

