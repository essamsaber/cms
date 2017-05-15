<?php  
if(isset($_GET['delete'])) {
    $post_id_to_delete = $_GET['delete'];
    $delete_post_sql = "DELETE FROM posts WHERE post_id = {$post_id_to_delete}";
    $execute_delete_post = mysqli_query($connect, $delete_post_sql);
}
?>
<form method="post" action="">
<?php  
if(isset($_POST['apply'])) {
    if(isset($_POST['checkBoxArray'])) {
        if(isset($_POST['bulk_options'])) {
            foreach($_POST['checkBoxArray'] as $p_id) {
                $bulk_options = $_POST['bulk_options'];
                switch($bulk_options) {
                    case '1':
                    $publish_sql = "UPDATE posts SET post_status = $bulk_options WHERE post_id = $p_id";
                    $exec_publish = mysqli_query($connect, $publish_sql);
                    break;
                    case '0':
                    $unpublish_sql = "UPDATE posts SET post_status = $bulk_options WHERE post_id = $p_id";
                    $exec_unpublish = mysqli_query($connect, $unpublish_sql);
                    break;
                    case 'delete':
                    $delete_sql = "DELETE FROM posts WHERE post_id = $p_id";
                    $exec_delete_sql = mysqli_query($connect, $delete_sql); 
                    break;
                    case 'clone':
                    $get_posts_to_clone = "SELECT * FROM posts WHERE post_id = $p_id";
                    $exec_get_posts = mysqli_query($connect, $get_posts_to_clone);
                    while($post_to_clone = mysqli_fetch_object($exec_get_posts)) {
                        $post_category_id = $post_to_clone->post_category_id;
                        $post_title = addslashes($post_to_clone->post_title);
                        $post_author = $post_to_clone->post_author;
                        $post_image = $post_to_clone->post_image;
                        $post_content = addslashes($post_to_clone->post_content);
                        $post_tags = addslashes($post_to_clone->post_tags);
                        $post_status = addslashes($post_to_clone->post_status);
                        $copy_post_sql = "INSERT INTO `posts`(`post_category_id`, `post_title`, `post_author`, `post_image`, `post_content`, `post_tags`, `post_status`) ";
                        $copy_post_sql .= "VALUES ($post_category_id, '$post_title', '$post_author', '$post_image', '$post_content', '$post_tags', 0)";
                        $exec_copy_post = mysqli_query($connect, $copy_post_sql);
                        if(!$exec_copy_post) {
                            echo mysqli_error($connect);
                        }
                    }
                    break;
                }
            }
        }
    }
}
?>
<div style="padding: 0px;" id="bulksOptionsContainer" class="form-group col-xs-4">
    <select name="bulk_options" class="form-control" name="" id="">
        <option value="">Select Options</option>
        <option value="1">Publish</option>
        <option value="0">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
    </select>
</div>
<div class="col-xs-4">
    <input type="submit" name="apply" value="Apply" class="btn btn-success">
    <a href="?source=add-post" class="btn btn-primary">Add New</a>
</div>
<table class="text-center table table-hover table-bordered">
    <thead>
        <tr>
            <th><input type="checkbox" id="selectAllBoxes" name=""></th>
            <th class="text-center">ID</th>
            <th class="text-center">Author</th>
            <th class="text-center">Title</th>
            <th class="text-center">Category</th>
            <th class="text-center">Status</th>
            <th class="text-center">Image</th>
            <th class="text-center">Tags</th>
            <th class="text-center">Comments</th>
            <th class="text-center">Date</th>
            <th class="text-center">Views No.</th>
            <th class="text-center">Preview</th>
            <th class="text-center" style="width:100px;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php  
            $get_posts_sql = "SELECT * FROM posts ORDER BY post_id DESC";
            $execute_posts_sql = mysqli_query($connect, $get_posts_sql);

            while($post = mysqli_fetch_object($execute_posts_sql)): // Begin the first loop
                $get_cat_by_id = "SELECT * FROM categories WHERE cat_id = '{$post->post_category_id}'";
                $execute_get_cat = mysqli_query($connect, $get_cat_by_id);
                while($cat = mysqli_fetch_object($execute_get_cat)): // Begin the second loop ?>
                <tr>
                    <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?=$post->post_id;?>"></td>
                    <td><?= $post->post_id ;?></td>
                    <td><?= $post->post_author;?></td>
                    <td><?= $post->post_title; ?></td>
                    <td><?= $cat->cat_title;?></td>
                    <td>
                       <?php  
                        if($post->post_status == 1) {
                            echo '<strong>Published</strong>';
                        } else {
                            echo '<strong>Unpublished</strong>';
                        }
                       ?>
                    </td>
                    <td><img width='100' src='../images/<?= $post->post_image;?>' /></td>
                    <td><?= $post->post_tags;?></td>
                    <td>
                    <?php  
                    $comment_count_sql = "SELECT * FROM comments WHERE comment_post_id = '$post->post_id'";
                    $exec_comment_count = mysqli_query($connect, $comment_count_sql);
                    echo "<a href='comments-post.php?id=$post->post_id'>".$comment_count = mysqli_num_rows($exec_comment_count)."</a>";
                    ?>
                    </td>
                    <td><?= $post->post_date; ?></td>
                    <td><?= $post->post_views; ?></td>
                    <td><a href="../post.php?id=<?=$post->post_id;?>">View post</a></td>
                    <td><a href='posts.php?source=edit-post&amp;id=<?=$post->post_id;?>'>Edit</a> - <a onClick='javascript: return confirm("Are use sure that you want to delete it?");' href='posts.php?delete=<?= $post->post_id;?>'>Delete</a></td>
                </tr>
            <?php endwhile; // End the second loop

            endwhile; // End the first loop
        ?>                                    
    </tbody>
</table>
</form>
