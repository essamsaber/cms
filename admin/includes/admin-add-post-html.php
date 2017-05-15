<?php  
if(isset($_POST['create_post'])) {
	$post['title'] = clear($_POST['title']);
	$post['category_id'] = $_POST['post_category_id'];
	$post['author'] = $_POST['author'];
	$post['status'] = $_POST['post_status'];
	
	$post['image'] = uniqid().$_FILES['image']['name'];
	$post['image_tmp'] = $_FILES['image']['tmp_name'];

	$post['tags'] = $_POST['post_tags'];
	$post['content'] = clear($_POST['post_content']);
	move_uploaded_file($post['image_tmp'], '../images/'.$post['image']);

	$insert_post_sql = "INSERT INTO `posts`(`post_category_id`, `post_title`, `post_author`, `post_image`, `post_content`, `post_tags`,  `post_status`) ";
	$insert_post_sql .= "VALUES ({$post['category_id']},'{$post['title']}','{$post['author']}','{$post['image']}',
	'{$post['content']}','{$post['tags']}', '{$post['status']}')";
	$execute_insert_query = mysqli_query($connect, $insert_post_sql);
	$last_inserted_post = mysqli_insert_id($connect);
	$_SESSION['add_post'] ="<p class='alert alert-success'>The post added successfully&nbsp;<a href='../post.php?id={$last_inserted_post}'>View post</a>&nbsp;<a href='posts.php'>View all posts</a></p>";
	confirmQuery($execute_insert_query);

}
?>
<form action="" method="post" enctype="multipart/form-data">
<?php if(isset($_SESSION['add_post'])) echo $_SESSION['add_post']; unset($_SESSION['add_post']); ?>
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" name="title" class="form-control">
	</div>
	<div class="form-group">
		<select name="post_category_id">
		<?php  
			$get_cats_sql = "SELECT * FROM categories";
			$execute_cats_sql = mysqli_query($connect, $get_cats_sql);
			while($cats = mysqli_fetch_object($execute_cats_sql)):
		?>
				<option value="<?= $cats->cat_id; ?>"><?= $cats->cat_title;?></option>
			<?php endwhile;?>
		</select>
	</div>
	<div class="form-group">
		<input type="hidden" name="author" value="<?= $_SESSION['username'];?>" class="form-control">
	</div>
	<div class="form-group">
		<select name="post_status">
			<option value="0">Draft</option>
			<option value="1">Publish</option>
		</select>
	</div>
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" name="post_tags" class="form-control">
	</div>
	<div class="form-group">
		<label for="post_status">Post Content</label>
		<textarea class="form-control" name="post_content" id="post-editor" cols="30" rows="10">
			
		</textarea>
	</div>
	<div class="form-group">
		<input type="submit" name="create_post" value="Publish Post" class="btn btn-primary">
	</div>

</form>



