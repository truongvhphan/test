<?php
ob_start();
?>
  <script>
// only for demo purposes
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#addForm").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
			firstname: {
				required: " (required)",
				minlength: " (must be at least 3 characters)"
			}
            lastname: {
				required: " (required)",
				minlength: " (must be at least 3 characters)"
			}
		}
	});

	$(".cancel").click(function() {
		validator.resetForm();
	});
});
</script>

    <h1>Them du lieu customer</h1>
<form method="post" action="?action=add_customer_db" id="addForm" autocomplete="off">
   
    <table>
       <tr>
            <td><label for="email">Email Address</label></td>
            <td>
                <input type="text" name="email"/>
            </td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td>
                <input id="password" type="text" name="password"/>
            </td>
        </tr>
        <tr>
            <td><label for="firstname">first Name</label></td>
            <td>    
                <input id="firstname" type="text" name="firstname" required minlength="3"/>
            </td>
        </tr>
        <tr>
            <td><label for="lastname">Last Name</label></td>
            <td>
                <input id="lastname" type="text" name="lastname"/>
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
                <input type="submit" value="Thêm mới"/>
            </td> 
        </tr>
    </table>
</form>


<?php
return ob_get_clean();
?>