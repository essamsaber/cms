<?php require_once "includes/header-html.php"; ?>

<!-- Include navigation -->
<?php require_once "includes/navigation-html.php" ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
<?php
$num_posts_per_page = 5;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start_from = ($page-1) * $num_posts_per_page;
$postsSql = "SELECT `post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, 
SUBSTRING(`post_content`, 1, 400) AS `content`, `post_tags`, `post_status` FROM `posts`  WHERE post_status = 1 ORDER BY post_id DESC LIMIT $start_from, $num_posts_per_page ";

$postsQuery = mysqli_query($connect, $postsSql);

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
<?php  
$query = "SELECT * FROM posts";
$result = mysqli_query($connect, $query);
$total_posts = mysqli_num_rows($result);
$total_pages = ceil($total_posts / $num_posts_per_page);
?>
<ul class="pager">
<?php for($i=1; $i<= $total_pages; $i++): ?>
    <?php 
        if($i == $page){
            echo "<li><a style='background: #000' href='?page=$i'>$i</a></li>"; 
        } else {
            echo "<li><a href='?page=$i'>$i</a></li>";  
        } 
    ?>
<?php endfor; ?>
</ul>
        <hr>
<?php require_once "includes/footer-html.php"; ?>