<?php
ob_start();
?>
<h1>Edit Product</h1>

<form method="post" action="?action=edit_product_db">
    <input type="hidden" name="id" value="<?php echo $rsProduct[0]->productID;?>"/>
    <select name="categoryID">
    <?php
        foreach($rsCategory as $category):
            if($category->categoryID == $rsProduct[0]->categoryID):
    ?>
            <option value="<?php echo $category->categoryID;?>" selected="selected"><?php echo $category->categoryName;?></option>
    <?php
            else:
    ?>
           <option value="<?php echo $category->categoryID;?>"><?php echo $category->categoryName;?></option>
    <?php
            endif;      
        endforeach;
    ?>
    </select>
    <input type="text" name="productCode" value="<?php echo $rsProduct[0]->productCode;?>"/>
    <input type="text" name="productName" value="<?php echo $rsProduct[0]->productName;?>"/>
    <input type="text" name="listPrice" value="<?php echo $rsProduct[0]->listPrice;?>"/>
    <input type="submit" name="submit" value="Submit"/>
</form>
<?php
return ob_get_clean();
?>
