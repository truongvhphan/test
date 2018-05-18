<?php
ob_start();
?>
    <h1>Cập nhật loại nhạc Cụ</h1>
        <form method="post" action="?action=edit_category_db">
            <input type="hidden" 
                   name="category_id" 
                   value="<?php echo $rsCategory[0]->categoryID;?>"/>
            <table>
                <tr>
                    <td>Tên Nhạc Cụ</td>
                    <td>
                        <input type="text" 
                               name="category_name" 
                               value="<?php echo $rsCategory[0]->categoryName;?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Cập Nhật"/>
                    </td> 
                </tr>
            </table>
        </form>
<?php
return ob_get_clean();
?>