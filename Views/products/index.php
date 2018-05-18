<?php
ob_start();

?>
<h1>Danh Mục Sản Phẩm</h1>
<a href="?action=add_product_form" class="btn btn-success">Thêm mới sản phẩm</a>
<table class="table table-striped">
    <thead>
        <tr>
            <td>Product ID</td>
            <td>Category ID</td>
            <td>Product Code</td>
            <td>Product Name</td>
            <td>List Price</td>
            <td colspan="2">Function</td>
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
        echo '<td><a href="../Controllers/products_controller.php?action=delete_product&product_id=' . $product->productID . '">Delete</a></td>';
        echo '<td><a href="../Controllers/products_controller.php?action=edit_product_form&product_id=' . $product->productID . '">Edit</a></td>';
        echo '</tr>';
    }
?>
    <tr><td colspan="6"><?php echo $pagination;?></td></tr>
    </tbody>
</table>
<?php
return ob_get_clean();
?>