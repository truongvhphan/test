<?php
ob_start();

?>
<h1>Danh Mục Sản Phẩm</h1>
<a href="?action=add_customer" class="btn btn-success">Thêm mới sản phẩm</a>
<table class="table table-striped">
    <thead>
        <tr>
            <td>Customer ID</td>
            <td>Email Address</td>
            <td>Password</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>ship Address</td>
            <td>Billing Address</td>
            <td colspan="2">Function</td>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($rsCustomer as $customer){
        echo '<tr>';
        echo '<td>' . $customer->customerID . '</td>';
        echo '<td>' . $customer->emailAddress . '</td>';
        echo '<td>' . $customer->password . '</td>';
         echo '<td>' . $customer->firstName . '</td>';
        echo '<td>' . $customer->lastName . '</td>';
        echo '<td>' . $customer->shipAddressID . '</td>';
        echo '<td>'. $customer->billingAddressID . '</td>';
        echo '<td><a href="../Controllers/customers_controller.php?action=delete_customer&customer_id=' . $customer->customerID . '">Delete</a></td>';
        echo '<td><a href="../Controllers/customers_controller.php?action=edit_customer&customer_id=' . $customer->customerID . '">Edit</a></td>';
        echo '</tr>';
    }
?>
  
    </tbody>
</table>
<?php
return ob_get_clean();
?>