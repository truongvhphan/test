<?php
ob_start();
?>
        <h1>Thêm mới loại Nhạc Cụ</h1>
        <form method="post" action="?action=add_category_db">
            <table>
                <tr>
                    <td>Tên Nhạc Cụ</td>
                    <td>
                        <input type="text" name="category_name" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Thêm"/>
                    </td> 
                </tr>
            </table>
        </form>
   
<?php
return ob_get_clean();
?>