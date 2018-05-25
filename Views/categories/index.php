<?php
ob_start();
?>

<h1>Danh Mục Nhạc Cụ</h1>
<a href="?action=add"><img src="../views/img/plus.png" alt="Thêm mới" data-toggle="tooltip" title="Thêm mới"/></a>
<table class="table table-striped table-bordered">
<thead>
    <tr class="bg-success">
        <th>Mã Loại</th>
        <th>Tên Loại Nhạc cụ</th>
        <th colspan="2" class="text-center">Chức Năng</th>
    </tr>
</thead>
<tbody>
<?php
    foreach ($rsCategories as $row){
        echo '<tr>';
        echo '<td>' . $row->categoryID . '</td>';
        echo '<td>' . $row->categoryName . '</td>';
        echo '<td class="text-center">
                <a href="../Controllers/categories_controller.php?action=delete&cate_id=' . $row->categoryID .  '">
                    <img src="../views/img/delete.png" data-toggle="tooltip" title="Xóa loại nhạc cụ" />
                </a>
              </td>';
        echo '<td class="text-center">
                <a href="../Controllers/categories_controller.php?action=edit&cate_id=' . $row->categoryID .  '">
                    <img src="../views/img/pensil.png" data-toggle="tooltip" title="Cập nhật loại nhạc cụ"/>
                </a>
              </td>';
        echo '</tr>';
    }
?>
</tbody>
</table>
<p><?php echo $pagination;?></p>
<?php
return ob_get_clean();
?>