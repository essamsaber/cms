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
    $post_id = $_GET['id'];
    $updat_post_views_sql = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = $post_id";
    mysqli_query($connect, $updat_post_views_sql);
    $postSql = "SELECT `post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, 
            `post_content`, `post_tags`, `post_status` FROM `posts` WHERE post_id = '$post_id'";
    $postQuery = mysqli_query($connect, $postSql);
    $postsResults = mysqli_fetch_object($postQuery);
    if($postsResults->post_status == 0) {
    header("Location: index.php");
    }
} else {
    header("Location: index.php");
}


echo $post = <<<EOT
<h1 class="page-header">
    Page Heading
    <small>Secondary Text</small>
</h1>

<!-- First Blog Post -->
<h2>
    <a href="post.php?id=$postsResults->post_id">$postsResults->post_title</a>
</h2>
<p class="lead">
    by <a href="index.php">$postsResults->post_author</a>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on $postsResults->post_date</p>
<hr>
<img class="img-responsive" src="images/$postsResults->post_image" alt="">
<hr>
<p>$postsResults->post_content</p>

EOT;

?>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <?php  
                if(isset($_POST['create_comment'])) {
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                        $insert_comment_sql = "INSERT INTO comments (`comment_post_id`, `comment_author`, `comment_email`, `comment_content`) VALUES ($post_id,'$comment_author','$comment_email','$comment_content')";
                        $execute_insert_comment_sql = mysqli_query($connect, $insert_comment_sql);
                        header("Location: post.php?id=$post_id");
                    } else {
                        echo '<p class="alert alert-danger">All fields are required</p>';
                    }
                }
                ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                           <label>Author:</label>
                           <input class="form-control" type="text" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input class="form-control" type="email" name="comment_email">
                        </div>
                        <div class="form-group">
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button name="create_comment" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <!-- Comment -->
                <div class="media">

                    <div class="media-body">
                    <?php  
                        $get_comment_by_post_id = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 1 ORDER BY comment_id desc";
                        $execute_get_comment = mysqli_query($connect, $get_comment_by_post_id);
                        while($comment = mysqli_fetch_object($execute_get_comment)) :
                    ?>
                        <a class="pull-left" href="#">
                            <img width="64" height="64" class="media-object" src="./images/avatar.png" alt="">
                        </a>&nbsp;
                        <h4 class="media-heading"><?= $comment->comment_author;?>
                            <small><?= $comment->comment_date;?></small>
                        </h4>
                        <p><?= $comment->comment_content ;?></p>
                        <!-- Nested Comment -->
<!--                         <div class="media">
                            <a class="pull-left" href="#">
                                <img width="64" height="64" class="media-object" src="./images/banner.png" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div> -->
                        <!-- End Nested Comment -->
                        <?php endwhile; ?>
                    </div>
                </div>                    
        </div>

        <!-- Blog Sidebar Widgets Column -->
       <?php require_once "includes/sidebar-html.php"; ?>

    </div>
    <!-- /.row -->

        <hr>
<?php require_once "includes/footer-html.php"; ?>