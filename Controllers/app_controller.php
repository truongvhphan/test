<?php   
//requail c?t l?y admin
class AppController{
    public static function View($menu=null)
    {
        if($menu == null)
        {
            $path = $_SERVER['PHP_SELF'];
            $pathArr = explode('/',$path);
            $path = $pathArr[count($pathArr)-1];
            $pathArr = explode('_', $path);
            $path = $pathArr[0];
            
            if($_SERVER['QUERY_STRING']){
                $query_string = $_SERVER['QUERY_STRING'];
                if(strpos($query_string, '&')){
                    $query_stringArr = explode('&', $query_string);
                    $query_stringArr = $query_stringArr[0];
                }
                else
                {
                    $query_stringArr = $query_string;
                }
                if(strpos($query_stringArr, 'action')){
                    $pattern = array('/action/', '/=/');
                    $query_string = trim(preg_replace($pattern,'',$query_stringArr));
                }
                else{
                    $query_string = 'index';
                }
            }
            else
            {
                $query_string = 'index';
            }
        }
        else
        {
            $path = $_SERVER['PHP_SELF'];
            $pathArr = explode('/',$path);
            $path = $pathArr[count($pathArr)-1];
            $pathArr = explode('_', $path);
            $path = $pathArr[0];
            $query_string = $menu;
        }
        return '../views/' . $path . '/' . $query_string . '.php';
    }
       
    
}
?>