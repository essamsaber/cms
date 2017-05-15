<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form method="post" action="search.php">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" name="search" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
        </form>
        <!-- /.input-group -->
    </div>
        <!-- Logion group -->


    <!-- Blog Categories Well -->
<?php if(!isset($_SESSION['user_role'])): ?>
    <div class="well">
        <h4>Login</h4>
        <form method="post" action="includes/login.php">
            <div class="form-group">
                <input type="text" name="username" placeholder="enter username" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password"  class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="Login" class="btn btn-primary">
            </div>
            <?php if(isset($_SESSION['loginMsg'])) echo $_SESSION['loginMsg']; ?>
        </form>
        <!-- /.input-group -->
    </div>
<?php endif; ?>


    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                <?php  
                    $catSQL = "SELECT * FROM categories";
                    $catQuery = mysqli_query($connect, $catSQL);
                    while($categories = mysqli_fetch_object($catQuery)) {
                        echo "<li><a href='category.php?id=$categories->cat_id'>$categories->cat_title</a></li>";
                    }
                ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
  <?php include_once "includes/widget.php" ?>

</div>