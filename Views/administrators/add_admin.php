<?php
ob_start();
?>
    <h1>Them Administrators</h1>
        <form method="post" action="?action=add_admin_form">
            <input type="hidden" 
                   name="admin_id" 
                   value="<?php echo $rsCategory[0]->categoryID;?>"/>
            <table>
                <tr>
                    <td>EmailAddress</td>
                    <td>
                        <input type="text" name="EmailAddress"/>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="text" name="Password"/>
                    </td>
                </tr>
                <tr>
                    <td>firstName</td>
                    <td>
                        <input type="text" name="firstName"/>
                    </td>
                </tr>
                <tr>
                    <td>lastName</td>
                    <td>
                        <input type="text" name="lastName"/>
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