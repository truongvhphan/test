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

        <h1 class="text-center">Thêm mới loại Nhạc Cụ</h1>
        <form method="post" class="form-horizontal" id="form2" action="?action=<?php echo $_GET['action'];?>">
        
            <div class="form-group">
                <label class="control-label" for="category_name">Tên nhạc cụ</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required minlength="3" />
                <label for="category_name_error" class="form-error"></label>
            </div>
            <div class="form-group">
                <input type="submit" value="Thêm" class="btn btn-dark"/>
            </div>
        </form>
<?php
return ob_get_clean();
?>