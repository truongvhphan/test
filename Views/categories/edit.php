<?php
ob_start();
?>
<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#form2").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
			category_name: {
				required: " (Không được để trống)",
				minlength: " (Độ dài từ 3 ký tự trở lên)"
			}/*,
			password: {
				required: " (required)",
				minlength: " (must be between 5 and 12 characters)",
				maxlength: " (must be between 5 and 12 characters)"
			}*/
		}
	});

	$(".cancel").click(function() {
		validator.resetForm();
	});
});
</script>
    <h1>Cập nhật loại nhạc Cụ</h1>
        <form class="form-horizontal" method="post" action="?action=<?php echo $_GET['action'];?>" id="form2">
        <input type="hidden" 
                   name="category_id" 
                   value="<?php echo $rsCategory[0]->categoryID;?>"/>
            <div class="form-group">
                    <label for="category_name" class="form-label">Tên loại nhạc cụ</label>
                        <input type="text"
                               class="form-control" 
                               name="category_name" 
                               id="category_name"
                               value="<?php echo $rsCategory[0]->categoryName;?>" required minlength="3"/>
                    <label for="category_name_error" class="form-label"></label>
            </div>
            <div class="form-group">
                        <input type="submit" value="Cập Nhật" class="btn btn-dark"/>
            </div>
        </form>
<?php
return ob_get_clean();
?>