<?php
ob_start();

?>
<h1>Danh Mục Sản Phẩm</h1>
<a href="?action=add_admin"><img src="../Views/img/plus.png" width="30px" height="30px" alt="Thêm mới" data-toggle="tooltip" title="Thêm mới"/> Thêm mới</a>
<table class="table table-border">
    <thead>
        <tr>
            <td>AdminID</td>
            <td>emailAddress</td>
            <td>Password</td>
            <td>firstName</td>
            <td>lastName</td>
            <td>Image</td>
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
		echo '<td><img src="'.$admin->image.'"/></td>';
        echo '<td><a href="../Controllers/Administrators_controller.php?action=delete_admin&admin_id=' . $admin->adminID . '"><img  src="../Views/img/delete.png" width="25px" height="30px"/></a> ';
        echo ' <a href="../Controllers/Administrators_controller.php?action=edit_admin&admin_id=' . $admin->adminID . '"><img  src="../Views/img/pensil.png" width="25px" height="30px"/></a> ';
		echo ' <a href="../Controllers/Administrators_controller.php?action=edit_pass&admin_id='.$admin->adminID.'" data-toggle="modal" data-target="#myModal">Đổi Password</a></td>';
        echo '</tr>';
    }
?>
    </tbody>
</table>
<script>
	//Bẫy lỗi form add dùng jquery validation
	$().ready(function() {
        var validator = $("#formEditPass").validate({
			errorPlacement: function(error,element){
				$(element)
					.closest("form").find("label[for='" + element.attr("id") + "_error']").append(error);	
			},
			errorElement: "span",
			messages: {
				pass_ht:{
					required: " (Không được để trống)",
					minlength: " (Độ dài từ 5 ký tự trở lên)"
				},
				pass_new: {
					required: " (Không được để trống)",
					minlength: " (Độ dài từ 5 ký tự trở lên)"	
				},
				pass_nl:{
					required: " (Không được để trống)",
					minlength: " (Độ dài từ 5 ký tự trở lên)"
				}	
			}
		});
    });
</script>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <form method="post" id="formEditPass" action="?action=edit_pass">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#F06;color:#FFF">
              <h5 class="modal-title" style="margin-right:310px"> Đổi mật khẩu</h5>
            </div>
            <div class="modal-body">
            	<input type="hidden" 
                   name="adminID" 
                   value="<?php echo $_GET['adminID']?>"/>
                  <p><input type="password" name="passht" id="pass_ht" placeholder="Mật khẩu hiện tại" class="form-control" required minLength="5"/>
                     <label for="pass_ht_error" style="color:#F00"></label></p>
                  <p><input type="password" name="passnew" id="pass_new" placeholder="Mật khẩu mới" class="form-control" required minLength="5"/>
                    <label for="pass_new_error" style="color:#F00"></label></p>
                 <p><input type="password" name="passnl" id="pass_nl" class="form-control" placeholder="Nhập lại mật khẩu mới" required minLength="5"/>
                    <label for="pass_nl_error" style="color:#F00"></label></p>
            
            </div>
            <div class="modal-footer">
              <button type="submit" name="submit" class="btn btn-danger">Lưu</button>
               <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
          </div>
       </form>
      
    </div>
  </div>
<?php
return ob_get_clean();
?>