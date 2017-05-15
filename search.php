<?php require_once "includes/header-html.php"; ?>

<!-- Include navigation -->
<?php require_once "includes/navigation-html.php" ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
<?php
if(isset($_POST['search'])) {
	$keyword = $_POST['keyword'];
	$searchSQL = "SELECT * FROM posts WHERE post_tags LIKE '%$keyword%'";
	$searchQuery = mysqli_query($connect, $searchSQL);
	if(mysqli_num_rows($searchQuery) > 0) {
		while ($searchResult = mysqli_fetch_object($searchQuery)) {
			echo $result = <<<EOT
<h1 class="page-header">
    Page Heading
    <small>Secondary Text</small>
</h1>

<!-- First Blog Post -->
<h2>
    <a href="#">$searchResult->post_title</a>
</h2>
<p class="lead">
    by <a href="index.php">$searchResult->post_author</a>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on $searchResult->post_date</p>
<hr>
<img class="img-responsive" src="images/$searchResult->post_image" alt="">
<hr>
<p>$searchResult->post_content</p>
<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

<hr>
EOT;
		}
	} else {
		echo "<h1>No result</h1>";
	}
	
} else {
	header("Location: index.php");
}

?>
                    
        </div>

        <!-- Blog Sidebar Widgets Column -->
       <?php require_once "includes/sidebar-html.php"; ?>

    </div>
    <!-- /.row -->

        <hr>
<?php require_once "includes/footer-html.php"; ?>