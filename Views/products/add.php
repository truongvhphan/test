<?php
ob_start();
?>
<script>
//Bẫy lỗi form edit dùng jquery validation
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#frmProduct").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "_error']" )
						.append( error );
		},
		errorElement: "span",
		messages: {
			productCode: {
				required: " (Không được để trống)",
				minlength: " (Độ dài từ 3 ký tự trở lên)"
			},
			productName: {
				required: " (required)",
				minlength: " (must be between 5 and 12 characters)",
				//maxlength: " (must be between 5 and 12 characters)"
			},
            description: {
				required: " (required)",
				minlength: " (must be between 5 and 12 characters)",
				//maxlength: " (must be between 5 and 12 characters)"
			},
            price: {
				required: " (required)",
				minlength: " (must be between 5 and 12 characters)",
				//maxlength: " (must be between 5 and 12 characters)"
			},
            discountPercent: {
				required: " (required)",
				minlength: " (must be between 5 and 12 characters)",
				//maxlength: " (must be between 5 and 12 characters)"
			}
		}
	});

	$(".cancel").click(function() {
		validator.resetForm();
	});
});
</script>
    <h1>Them du lieu product</h1>
        <form method="post" id="frmProduct" class="form-horizontal" action="?action=<?php echo $_GET['action'];?>">
            <div class="form-group">
                    <label class="control-label">Tên Nhạc Cụ</label>
                        <select name="categoryID" class="form-control">
                        <?php foreach($rsCategory as $product)
                        {
                        ?>
                            <option value="<?php echo $product->categoryID ; ?>"><?php echo $product->categoryName; ?></option>
                        <?php } ?>
                        </select>
              </div>      
              <div class="form-group">
                    <label for="productCode">Product code</label>      
                    <input type="text" id="productCode" name="productCode" class="form-control" required minlength="3"/>
                    <label for="productCode_error" class="form-error"></label>
              </div>
              <div class="form-group">
                    <label class="form-label">Product Name</label>
                    <input type="text" id="productName" name="productName" class="form-control" required minlength="3"/>
                    <label for="productName_error" class="form-error"></label>
              </div>
              <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="10" required></textarea>
                    <label for="description_error" class="form-error"></label>
              </div>
              <div class="form-group">
                    <label class="form-label">List Price</label>
                    <input type="text" id="price" name="price" class="form-control" required />
                    <label for="price_error" class="form-error"></label>      
              </div>
              <div class="form-group">
                    <label class="form-label">Discount Percent</label>
                    <input type="text" id="discountPercent" name="discountPercent" placeholder="discount" class="form-control" required /> %
                    <label for="discountPercent_error" class="form-error"></label>
              </div>
              
              <input type="submit" value="Them moi" name="submit" class="btn btn-dark"/>      
              
        </form>
<?php
return ob_get_clean();
?>