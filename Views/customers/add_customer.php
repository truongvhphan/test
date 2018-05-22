<?php
ob_start();
?>
    <h1>Them du lieu product</h1>
        <form method="post" action="?action=add_customer_db">
            <input type="hidden" 
                   name="customerID" 
                   value="<?php echo $rsCustomer[0]->customerID;?>"/>
            <table>
                <tr>
                    <td>Email Address</td>
                    <td>
                        <input type="text" name="email"/>
                    </td>
                </tr>
                <tr>
                    <td>first Name</td>
                    <td>
                        <input type="text" name="first"/>
                    </td>
                </tr>
                <tr>
                    <td>Last name</td>
                    <td>
                        <input type="text" name="last"/>
                    </td>
                </tr>
                 <tr>
                    <td>Ship Address</td>
                    <td>
                        <input type="text" name="ship"/>
                    </td>
                </tr>
                <tr>
                    <td>Billing Address</td>
                    <td>
                        <input type="text" name="billing"/>
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