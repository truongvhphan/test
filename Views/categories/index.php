<?php
ob_start();
?>

<h1>Danh Mục Nhạc Cụ</h1>
<?php
    foreach ($rsCategories as $row){
        echo $row->categoryID . ' -- ' . $row->categoryName ;
        echo ' <a href="../Controllers/categories_controller.php?action=delete_category_db&cate_id=' . $row->categoryID .  '">Delete</a>';
        echo ' <a href="../Controllers/categories_controller.php?action=edit_category_form&cate_id=' . $row->categoryID .  '">Edit</a>';
        echo '<br/>';
    }
?>
<a href="?action=add_category">Thêm mới loại nhạc cụ</a>
<?php
return ob_get_clean();
?>