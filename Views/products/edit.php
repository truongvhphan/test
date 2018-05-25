<?php
ob_start();
?>
<script>
$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#frmProductEdit").validate({
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
<h1>Edit Product</h1>

<form method="post" id="frmProductEdit" action="?action=<?php echo $_GET['action'];?>">
    <input type="hidden" name="id" value="<?php echo $rsProduct[0]->productID;?>"/>
    <div class="form-group">
        <label class="form-label">Chọn thể loại</label>
    <select name="categoryID" class="form-control">
    <?php
        foreach($rsCategory as $category):
            if($category->categoryID == $rsProduct[0]->categoryID):
    ?>
            <option value="<?php echo $category->categoryID;?>" selected="selected"><?php echo $category->categoryName;?></option>
    <?php
            else:
    ?>
           <option value="<?php echo $category->categoryID;?>"><?php echo $category->categoryName;?></option>
    <?php
            endif;      
        endforeach;
    ?>
    </select>
    </div>
    <div class="form-group">
                    <label for="productCode">Product code</label>      
                    <input type="text" 
                            id="productCode" 
                            name="productCode"
                            value="<?php echo $rsProduct[0]->productCode;?>" 
                            class="form-control" 
                            required minlength="3"/>
                    <label for="productCode_error" class="form-error"></label>
              </div>
              <div class="form-group">
                    <label class="form-label">Product Name</label>
                    <input type="text" id="productName" value="<?php echo $rsProduct[0]->productName;?>"
                            name="productName" class="form-control" required minlength="3"/>
                    <label for="productName_error" class="form-error"></label>
              </div>
              <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="10" required>
                    <?php echo $rsProduct[0]->description;?>
                    </textarea>
                    <label for="description_error" class="form-error"></label>
              </div>
              <div class="form-group">
                    <label class="form-label">List Price</label>
                    <input type="text" id="price" name="price" value="<?php echo $rsProduct[0]->listPrice;?>" 
                            class="form-control" required />
                    <label for="price_error" class="form-error"></label>      
              </div>
              <div class="form-group">
                    <label class="form-label">Discount Percent</label>
                    <input type="text" id="discountPercent" 
                            name="discountPercent" value="<?php echo $rsProduct[0]->discountPercent;?>" 
                            placeholder="discount" class="form-control" required /> %
                    <label for="discountPercent_error" class="form-error"></label>
              </div>
    <input type="submit" name="submit" value="Submit"/>
</form>
<?php
return ob_get_clean();
?>
