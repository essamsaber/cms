<?php require_once "includes/header-html.php"; ?>

<!-- Include navigation -->
<?php require_once "includes/navigation-html.php" ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
<?php
if(isset($_GET['id'])) {
    $post_cat_id = $_GET['id'];    
} else {
    header("Location: index.php");
}
$postsSql = "SELECT `post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, 
SUBSTRING(`post_content`, 1, 400) AS `content`, `post_tags`, `post_comment_count`, `post_status` FROM `posts` WHERE `post_category_id` = '$post_cat_id' ";
$postsQuery = mysqli_query($connect, $postsSql);
while($postsResults = mysqli_fetch_object($postsQuery)) {
echo $posts = <<<EOT
<h1 class="page-header">
    Page Heading
    <small>Secondary Text</small>
</h1>

<!-- First Blog Post -->
<h2>
    <a href="#">$postsResults->post_title</a>
</h2>
<p class="lead">
    by <a href="index.php">$postsResults->post_author</a>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on $postsResults->post_date</p>
<hr>
<img class="img-responsive" src="images/$postsResults->post_image" alt="">
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