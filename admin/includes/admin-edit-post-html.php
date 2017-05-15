<?php 
// Get post that we need to edit  
if(isset($_GET['id'])) {
	$post_id = $_GET['id'];
	$get_post_by_id_sql = "SELECT * FROM posts WHERE post_id = '{$post_id}'";
	$execute_get_post = mysqli_query($connect, $get_post_by_id_sql);
	$post = mysqli_fetch_object($execute_get_post);
}

if(isset($_POST['update_post'])) {
	$post_title = clear($_POST['title']);
	$post_category_id = $_POST['post_category'];
	$post_author = $_POST['author'];
	$post_status = $_POST['post_status'];
	
	$post_image = $_FILES['image']['name'];
	$post_image_tmp = $_FILES['image']['tmp_name'];

	$post_tags = $_POST['post_tags'];
	$post_content = clear($_POST['post_content']);

	if(empty($post_image)) {
		$post_image = $post->post_image;
	} else {
		$post_image = uniqid().$_FILES['image']['name'];
		move_uploaded_file($post_image_tmp, '../images/'.$post_image);
	}
	$update_post_sql = "UPDATE posts SET post_category_id = {$post_category_id}, post_title = '{$post_title}', ";
	$update_post_sql.= "post_author = '{$post_author}', post_image = '{$post_image}', ";
	$update_post_sql.= "post_content = '{$post_content}', post_tags = '{$post_tags}', ";
	$update_post_sql.= "post_status = '{$post_status}' WHERE post_id = '$post_id'";

	$execute_update_query = mysqli_query($connect, $update_post_sql);
	if($execute_update_query) {
		echo $_SESSION['updatePost'] = '<p class="alert alert-success">Post updated successfully</p>';
		echo '<meta http-equiv="refresh" content="0.3">';
		unset($_SESSION['updatePost']);
	}
}
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" name="title" class="form-control" value="<?= $post->post_title; ?>">
	</div>
	<div class="form-group">
		<select name="post_category">
		<?php
		$get_all_cats_sql = "SELECT * FROM categories";
		$execute_get_cats = mysqli_query($connect, $get_all_cats_sql);
		while($cats = mysqli_fetch_object($execute_get_cats)):?>
			 <option  value='<?=$cats->cat_id;?>'><?=$cats->cat_title; ?></option>
		<?php endwhile; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="post_author">Post Author</label>
		<input type="text" name="author" class="form-control" value="<?= $post->post_author; ?>">
	</div>
	<div class="form-group">
		<select name="post_status">
			<?php  
				if($post->post_status == 0) {
					echo '<option value="0">Draft</option>
						  <option value="1">Publish</option>';
				} else {
					echo '<option value="1">Publish</option>
						  <option value="0">Draft</option>';
				}
			?>
		</select>
	</div>
	<div class="form-group">
		<img width="100" src="../images/<?=$post->post_image;?>">
		<input type="file" name="image">
	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" name="post_tags" class="form-control" value="<?= $post->post_tags; ?>">
	</div>
	<div class="form-group">
		<label for="post_status">Post Content</label>
		<textarea class="form-control" name="post_content" id='post-editor' cols="30" rows="10">
			<?= $post->post_content; ?>
		</textarea>
	</div>
	<div class="form-group">
		<input type="submit" name="update_post" value="Update Post" class="btn btn-primary">
	</div>

</form>
