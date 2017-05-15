
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php  
                $navSql = "SELECT * FROM categories";
                $categories = mysqli_query($connect, $navSql);
                while($category = mysqli_fetch_object($categories)) {
                    echo "<li><a href='category.php?id=$category->cat_id'>$category->cat_title</a></li>";
                }
                ?>
                <?php  
                    if(!isset($_SESSION['user_role'])) 
                        echo '<li><a href="registeration.php">Register</a></li>';
                ?>
                <li><a href="admin">Admin</a></li>
                <?php 
                if(isset($_SESSION['user_role'])) {
                    if($_SESSION['user_role'] === 'admin'){
                        if(isset($_GET['id'])) {
                            $post_id = $_GET['id'];
                        echo "<li><a href='admin/posts.php?source=edit-post&amp;id=$post_id'>Edit Post</a></li>";
                        }
                    }
                }
                if(isset($_SESSION['user_role'])) echo '<li class="active"><a href="includes/logout.php">Logout</a></li>'; 
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>