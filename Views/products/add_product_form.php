<?php
ob_start();
?>
    <h1>Them du lieu product</h1>
        <form method="post" action="?action=add_product_db">
            <input type="hidden" 
                   name="category_id" 
                   value="<?php echo $rsCategory[0]->categoryID;?>"/>
            <table>
                <tr>
                    <td>Tên Nhạc Cụ</td>
                    <td>
                        <select name="categoryID">
                        <?php foreach($rsCategory as $product)
                        {
                        ?>
                            <option value="<?php echo $product->categoryID ; ?>"><?php echo $product->categoryName; ?></option>
                        <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Product code</td>
                    <td>
                        <input type="text" name="productCode"/>
                    </td>
                </tr>
                <tr>
                    <td>Product Name</td>
                    <td>
                        <input type="text" name="productName"/>
                    </td>
                </tr>
                <tr>
                    <td>List Price</td>
                    <td>
                        <input type="text" name="price"/>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Them moi"/>
                    </td> 
                </tr>
            </table>
        </form>
<?php
return ob_get_clean();
?>