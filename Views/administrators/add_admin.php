<?php
ob_start();
?>
<script>
	//Bẫy lỗi form add dùng jquery validation
	$().ready(function() {
        var validator = $("#formAddAdmin").validate({
			errorPlacement: function(error,element){
				$(element)
					.closest("form").find("label[for='" + element.attr("id") + "_error']").append(error);	
			},
			errorElement: "span",
			messages: {
				pass_admin:{
					required: " (Không được để trống)",
					minlength: " (Độ dài từ 5 ký tự trở lên)"
				},
				first_admin: {
					required: " (Không được để trống)",
					minlength: " (Độ dài từ 3 ký tự trở lên)"	
				},
				last_admin:{
					required: " (Không được để trống)",
					minlength: " (Độ dài từ 3 ký tự trở lên)"
				}	
			},
			rules:{
				email_admin:{
					required: true,
					errorEmail: true	
				}	
			}
		});
		$.validator.addMethod("errorEmail",function(value,element)
		{
			return this.optional(element)||/^.+gmail.com$/.test(value);
		},"only gmail.com email address are allowed.");
		$(".cancel").click(function(){
			validator.resetForm();	
		})
    });
</script>
    <h1>Them Administrators</h1>
        <form id="formAddAdmin"  method="post" action="?action=<?php echo $_GET['action']; ?>" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="email_admin">EmailAddress</label></td>
                    <td>
                        <input type="email" name="email_admin" id="email_admin" class="form-control"/>
                        <label for="email_admin_error" class="form-error"></label>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="Password" id="pass_admin" class="form-control" required minLength="5"/>
                        <label for="pass_admin_error" style="color:#F00"></label>
                    </td>
                </tr>
                <tr>
                    <td>firstName</td>
                    <td>
                        <input type="text" name="firstName" id="first_admin" class="form-control" required minLength="3"/>
                        <label for="first_admin_error" style="color:#F00"></label>
                    </td>
                </tr>
                <tr>
                    <td>lastName</td>
                    <td>
                        <input type="text" name="lastName" id="last_admin" class="form-control" required minLength="3"/>
                        <label for="last_admin_error" style="color:#F00"></label>
                    </td>
                </tr>
                <tr>
                	<td>Image</td>
                    <td><input  type="file" name="upload"/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Them moi" name="submit"/>
                    </td> 
                </tr>
            </table>
        </form>
<?php
return ob_get_clean();
?>