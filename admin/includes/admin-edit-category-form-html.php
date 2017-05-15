<div class="col-xs-6">
<form method="post" action="">
	<div class="form-group">
		<label for="cat-title">Edit category</label>
		<input type="text" name="update_category" class="form-control" value="<?php if(isset($cat->cat_title)) echo $cat->cat_title; ?>">
		<input type="hidden" name="category_id" value="<?php if(isset($cat->cat_id)) echo $cat->id; ?>">
	</div>
	<div class="form-group">
		<input type="submit" name="updateCategory" value="Update Category" class="btn btn-primary">
	</div>
</form>
</div>