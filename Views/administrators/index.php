<?php
ob_start();

?>
<h1>Danh Mục Sản Phẩm</h1>
<a href="?action=add_admin" class="btn btn-success">Thêm mới sản phẩm</a>
<table class="table table-striped">
    <thead>
        <tr>
            <td>AdminID</td>
            <td>emailAddress</td>
            <td>Password</td>
            <td>firstName</td>
            <td>lastName</td>
            <td colspan="2">Function</td>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($rsAdmins as $admin){
        echo '<tr>';
        echo '<td>' . $admin->adminID . '</td>';
        echo '<td>' . $admin->emailAddress . '</td>';
		echo '<td>' . $admin->password . '</td>';
        echo '<td>' . $admin->firstName . '</td>';
        echo '<td>' . $admin->lastName . '</td>';
        echo '<td><a href="../Controllers/Administrators_controller.php?action=delete_product&product_id=' . $admin->adminID . '">Delete</a></td>';
        echo '<td><a href="../Controllers/Administrators_controller.php?action=edit_product_form&product_id=' . $admin->adminID . '">Edit</a></td>';
        echo '</tr>';
    }
?>
    </tbody>
</table>
<?php
return ob_get_clean();
?>