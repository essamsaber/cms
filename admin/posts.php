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
                        <?php  
                            if(isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = '';
                            }
                            switch ($source) {
                                case 'add-post':
                                    require_once "includes/admin-add-post-html.php";
                                    break;
                                case 'edit-post':
                                    require_once "includes/admin-edit-post-html.php";
                                break;
// case 'publish':
//     $post_id = $_GET['post_id'];
//     $publish_sql = "UPDATE posts SET post_status = 1 WHERE post_id = {$post_id}";
//     mysqli_query($connect, $publish_sql);
//     header("Location: posts.php");
// break;
// case 'unpublish':
//     $post_id = $_GET['post_id'];
//     $unpublish_sql = "UPDATE posts SET post_status = 0 WHERE post_id = {$post_id}";
//     mysqli_query($connect, $unpublish_sql);
//     header("Location: posts.php");                               
// break;
                                default:
                                    require_once "./includes/admin-view-all-posts.php";
                                break;
                            }
                        ?>            
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php require_once "includes/admin-footer-html.php"; ?>