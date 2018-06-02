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
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
			firstname: {
				required: " (Không được để trống)",
				minlength: " (Độ dài từ 3 ký tự trở lên)"
			},
            lastname: {
				required: " (Không được để trống)",
				minlength: " (Độ dài từ 3 ký tự trở lên)"
			},
            password:{
                required:"(Không được để trống)",
                minlength:"(Độ dài từ 6 ký tự trở lên)"
            }           
		},
        //để thêm điều kiện cho đuôi email thì phải bỏ vô rules 
        rules:{
            email:{
                required: true,
                webucatorEmail: true
            }
        }
	});
    $.validator.addMethod("webucatorEmail",function(value,element){
        return this.optional(element) || /^.+web.com$/.test(value);        
    },"only web.com email address are allowed.");

	$(".cancel").click(function() {
		validator.resetForm();
	});
});
</script>

    <h1>Them du lieu customer</h1>
<form method="post" action="?action=<?php echo $_GET['action']; ?>" id="addForm" autocomplete="off">
   
    <table>
       <tr>
            <td><label for="email">Email Address</label></td>
            <td>
                <input type="email" name="email" id="email"/>
                <label for="email_error" class="form-error"></label>
            </td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td>
                <input id="password" type="text" name="password" required minlength="6"/>
                <label for="password_error" class="form-error"></label>
            </td>
        </tr>
        <tr>
            <td><label for="firstname">first Name</label></td>
            <td>    
                <input id="firstname" type="text" name="firstname" required minlength="3"/>
                 <label for="firstname_error" class="form-error"></label>
            </td>
        </tr>
        <tr>
            <td><label for="lastname">Last Name</label></td>
            <td>
                <input id="lastname" type="text" name="lastname" required minlength="3"/>
                 <label for="lastname_error" class="form-error"></label>
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
                <input type="submit" name="submit" value="Thêm mới"/>
            </td> 
        </tr>
    </table>
</form>


<?php
return ob_get_clean();
?>