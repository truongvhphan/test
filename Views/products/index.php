<?php
ob_start();

?>
<h1>Danh Mục Sản Phẩm</h1>
<a href="?action=add" data-toggle="tooltip" title="Thêm mới sản phẩm" >
    <img src="../Views/img/plus.png" />
</a>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="bg-success">
            <th>Product ID</th>
            <th>Category ID</th>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>List Price</th>
            <th colspan="2">Function</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($rsProducts as $product){
        echo '<tr>';
        echo '<td>' . $product->productID . '</td>';
        echo '<td>' . $product->categoryID . '</td>';
        echo '<td>' . $product->productCode . '</td>';
        echo '<td>' . $product->productName . '</td>';
        echo '<td>'. $product->listPrice . '</td>';
        echo '<td class="text-center">
                <a href="../Controllers/products_controller.php?action=delete&product_id=' . $product->productID . '">
                <img src="../Views/img/delete.png" data-toggle="tooltip" title="Xóa sản phẩm"/>
                </a>
            </td>';
        echo '<td class="text-center">
                <a href="../Controllers/products_controller.php?action=edit&product_id=' . $product->productID . '">
                <img src="../Views/img/pensil.png" data-toggle="tooltip" title="Cập nhật sản phẩm"/>
                </a>
             </td>';
        echo '</tr>';
    }
?>
    </tbody>
</table>
<p class="text-center"><?php echo $pagination;?></p>
<?php
return ob_get_clean();
?>