<?php require_once "includes/admin-header-html.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
<?php require_once "includes/admin-navigation-html.php"; ?>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome admin   
                            <small><?=$_SESSION['username'];?></small>                         
                        </h1>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $get_posts_sql = "SELECT * FROM posts";
                                            $exec_get_posts = mysqli_query($connect, $get_posts_sql);
                                            $posts_count = mysqli_num_rows($exec_get_posts);
                                        ?>
                                        <div class="huge"><?=$posts_count;?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $get_comments_sql = "SELECT * FROM comments";
                                            $exec_get_comments = mysqli_query($connect, $get_comments_sql);
                                            $comments_count = mysqli_num_rows($exec_get_comments);
                                        ?>
                                        <div class="huge"><?=$comments_count;?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $get_users_sql = "SELECT * FROM users";
                                            $exec_get_users = mysqli_query($connect, $get_users_sql);
                                            $users_count = mysqli_num_rows($exec_get_users);
                                        ?>
                                        <div class="huge"><?=$users_count;?></div>
                                        <div>Users!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                            $get_categories_sql = "SELECT * FROM categories";
                                            $exec_get_categories = mysqli_query($connect, $get_categories_sql);
                                            $categories_count = mysqli_num_rows($exec_get_categories);
                                    ?>
                                        <div class="huge"><?=$categories_count;?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <?php
                    $get_draft_posts_sql = "SELECT * FROM posts WHERE post_status = 0";
                    $exec_get_draft_posts_sql = mysqli_query($connect, $get_draft_posts_sql);
                    $draft_posts_count = mysqli_num_rows($exec_get_draft_posts_sql);

                    $get_published_posts_sql = "SELECT * FROM posts WHERE post_status = 1";
                    $exec_get_published_posts_sql = mysqli_query($connect, $get_published_posts_sql);
                    $published_posts_count = mysqli_num_rows($exec_get_published_posts_sql);
                    
                    $get_unapproved_comments_sql = "SELECT * FROM comments WHERE comment_status = 0";
                    $exec_get_unapproved_comments_sql = mysqli_query($connect, $get_unapproved_comments_sql);
                    $unapproved_comments_count = mysqli_num_rows($exec_get_unapproved_comments_sql);
                    
                    $get_subscribers_sql = "SELECT * FROM users WHERE role = 'subsriber'";
                    $exec_get_subscribers_sql = mysqli_query($connect, $get_subscribers_sql);
                    $subscriber_count = mysqli_num_rows($exec_get_subscribers_sql);

                ?>

                <div class="row">
                <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php  
                            $staticts_element = ['All Posts', 'Published Posts', 'Draft Posts','Comments','Pending Comments','Users','Subscriber','Categories'];
                            $staticts_count = [$posts_count, $published_posts_count, $draft_posts_count, $comments_count, $unapproved_comments_count, $users_count, $subscriber_count, $categories_count];
                            for ($i = 0; $i < 7; $i++) {
                            echo "['{$staticts_element[$i]}'" . "," . "{$staticts_count[$i]}],";
                            }

                            ?>
                        ]);

                        var options = {
                         chart: {
                            title: '',
                            subtitle: '',
                         }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, options);
                      }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>  
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php require_once "includes/admin-footer-html.php"; ?>