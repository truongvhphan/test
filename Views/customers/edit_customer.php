<?php
ob_start();
?>
    <h1>Them du lieu product</h1>
        <form method="post" action="?action=edit_customer_db">
            <input type="hidden" 
                   name="customerID" 
                   value="<?php echo $rsCustomer[0]->customerID;?>"/>
            <table>
                <tr>
                    <td>Email Address</td>
                    <td>
                        <input type="text" name="email" value="<?php echo $rsCustomer[0]->emailAddress;?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="text" name="pass" value="<?php echo $rsCustomer[0]->password;?>"/>
                    </td>
                </tr>
                <tr>
                    <td>first Name</td>
                    <td>
                        <input type="text" name="first" value="<?php echo $rsCustomer[0]->firstName;?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Last name</td>
                    <td>
                        <input type="text" name="last" value="<?php echo $rsCustomer[0]->lastName;?>"/>
                    </td>
                </tr>
                 <tr>
                    <td>Ship Address</td>
                    <td>
                        <input type="text" name="ship" value="<?php echo $rsCustomer[0]->shipAddressID;?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Billing Address</td>
                    <td>
                        <input type="text" name="billing" value="<?php echo $rsCustomer[0]->billingAddressID;?>"/>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" value="C?p nh?t"/>
                    </td> 
                </tr>
            </table>
        </form>
<?php
return ob_get_clean();
?>