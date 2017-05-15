<?php require_once "includes/header-html.php"; ?>

<!-- Include navigation -->
<?php require_once "includes/navigation-html.php" ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
<?php
$postsSql = "SELECT `post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, 
SUBSTRING(`post_content`, 1, 400) AS `content`, `post_tags`, `post_comment_count`, `post_status` FROM `posts`  WHERE post_status = 1";
$postsQuery = mysqli_query($connect, $postsSql);
$num_rows = mysqli_num_rows($postsQuery);
if($num_rows === 0) echo '<h1>There is no posts yet !</h1>';
while($postsResults = mysqli_fetch_object($postsQuery)) {
echo $posts = <<<EOT
<!-- First Blog Post -->
<h2>
    <a href="post.php?id=$postsResults->post_id">$postsResults->post_title</a>
</h2>
<p class="lead">
    by <a href="author-posts.php?author=$postsResults->post_author">$postsResults->post_author</a>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on $postsResults->post_date</p>
<hr>
<a href='post.php?id=$postsResults->post_id'><img style='width:100%; height:300px;' class="img-responsive" src="images/$postsResults->post_image" alt=""></a>
<hr>
<p>$postsResults->content</p>
<a class="btn btn-primary" href="post.php?id=$postsResults->post_id">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

<hr>
EOT;
}
?>
                    
        </div>

        <!-- Blog Sidebar Widgets Column -->
       <?php require_once "includes/sidebar-html.php"; ?>

    </div>
    <!-- /.row -->

        <hr>
<?php require_once "includes/footer-html.php"; ?>