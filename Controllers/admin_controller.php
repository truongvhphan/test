<?php
include_once '../Config/bootload.php';



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
            
            $view = Page::View();
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
   
}
 
    
?>
