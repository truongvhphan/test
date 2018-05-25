<?php
class Database{
    private $dsn = 'mysql:dbname=my_guitar_shop2;host=localhost';
    private $username = 'root';
    private $password = '';
    private $conn = null;

    public function __construct() {
        try{
            $this->conn = new PDO($this->dsn, $this->username, $this->password);
            
        } catch (PDOException $ex) {
            $error_message = $ex->getMessage();
            $error_file = $ex->getFile();
            $error_line = $ex->getLine();
            $GLOBALS['template']['content'] = include_once '../Errors/database_error.php';
            $GLOBALS['template']['title'] = 'MVC Error';
            include_once '../template/index.php';
            exit();
        }
    }
    public function doQuery($strQuery, $param = null){
        if($param == null){
            $rs = $this->conn->prepare($strQuery);
            $rs->execute();
        }
        else{
            $rs = $this->conn->prepare($strQuery);
            for($i = 0; $i < count($param); $i++){
                $rs->bindParam($i+1, $param[$i]);
            }
            $rs->execute();
        }
        return $rs->fetchAll(PDO::FETCH_OBJ);
    }
    public function getTables()
    {
        $strQuery = 'SHOW TABLES';
        $rs = $this->doQuery($strQuery);
        return $rs;
    }
    public function __destruct() {
        $this->conn = null;
    }
}

