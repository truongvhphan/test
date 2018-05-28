<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="nguyenvanthieu" />
	<title>
    <?php
        if(isset($GLOBALS['template']['title'])){
            echo $GLOBALS['template']['title'];
        } 
    ?>
    </title>
    <link type="text/css" rel="stylesheet" href="../views/css/bootstrap.min.css"/> 
     <script src="../views/js/jquery.js"> </script>
    <script src="../views/js/bootstrap.min.js"></script>       
    <script src="../Views/js/jquery.validate.min.js"></script>
</head>

<body>
    
    <div class="container-fluid">
        <div class="row bg-transparent">
            <div class="col-sm-12 text-center">
                <h1 class="text-info text-capitalize">Chương trình quản lý nhạc cụ</h1>
            </div>
        </div>
<?php
    if(isset($GLOBALS['template']['menu'])){
        echo $GLOBALS['template']['menu'];
    }
    if(isset($GLOBALS['template']['content'])){
        echo $GLOBALS['template']['content'];
    }
?>
    </div>     
   

</body>
</html>