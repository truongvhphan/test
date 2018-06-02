<?php
ob_start();
?>
<script>
	//Bẫy lỗi form add dùng jquery validation
	$().ready(function() {
        var validator = $("#formEdit").validate({
			errorPlacement: function(error,element){
				$(element)
					.closest("form").find("label[for='" + element.attr("id") + "_error']").append(error);	
			},
			errorElement: "span",
			messages: {
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
    <h1>Cập nhật dữ liệu administrator</h1>
        <form id="formEdit" method="post" action="?action=edit_admin">
            <input type="hidden" 
                   name="adminID" 
                   value="<?php echo $rsAdmins[0]->adminID;?>"/>
            <table>
                <tr>
                    <td><label for="email_admin">EmailAddress</label></td>
                    <td>
                        <input id="email_admin" type="text" name="email_admin" value="<?php echo $rsAdmins[0]->emailAddress;?>"/>
                        <label for="email_admin_error" class="form-error"></label>
                    </td>
                </tr>
                <tr>
                    <td>first Name</td>
                    <td>
                        <input type="text" id="first_admin" name="first" value="<?php echo $rsAdmins[0]->firstName;?>" required minLength="3"/>
                        <label for="first_admin_error" style="color:#F00"></label>
                    </td>
                </tr>
                <tr>
                    <td>Last name</td>
                    <td>
                        <input type="text" id="last_admin" name="last" value="<?php echo $rsAdmins[0]->lastName;?>" required minLength="3"/>
                        <label for="last_admin_error" style="color:#F00"></label>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Cập nhật" name="submit"/>
                    </td> 
                </tr>
            </table>
        </form>
<?php
return ob_get_clean();
?>