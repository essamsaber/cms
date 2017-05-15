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
                        /*
							* Check if the add category button was clicked
							* if yes do it else print the error message
                        */   
                        	add_category();

                    	/*
							* Check if there is any GET request on delete 
							* Then delete the category 
                    	*/
							delete_category();
						
                        ?>
                        <div class="col-xs-6">
                        	<form method="post" action="">
                        	<?php if(isset($msg)) echo $msg; ?>
								<div class="form-group">
									<label for="cat-title">Add category</label>
									<input type="text" name="cat_title" class="form-control">
								</div>
								<div class="form-group">
									<input type="submit" name="submit" value="Add Category" class="btn btn-primary">
								</div>
                        	</form>
                        </div>
                        <div class="col-xs-6">
                        	<table class="table table-bordered table-hover">
                        		<thead>
                        			<tr>
                        				<th>ID</th>
                        				<th>Category Title</th>
                        				<th>Action</th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        			<?php
                        			// List all categories that exist in the database  
                        				$cats_sql = "SELECT * FROM categories";
                        				$cats_query = mysqli_query($connect, $cats_sql);
                        				while($cat = mysqli_fetch_object($cats_query)) : 
                					?>                       					
                					<tr>
                						<td><?php echo $cat->cat_id; ?></td>
                						<td><?php echo $cat->cat_title; ?></td>
                						<td>
                							<a href="categories.php?edit=<?php echo $cat->cat_id; ?>">Edit</a> - 
                                            <a onClick='javascript: return confirm("Are use sure that you want to delete it?");' href="categories.php?delete=<?php echo $cat->cat_id; ?>">Delete</a>
            							</td>
                					</tr>
                						<?php endwhile; ?>
                						<!-- End of While loop################### -->
                        		</tbody>
                        	</table>
                        </div>
                        <?php  
                    	/*
							* Check if there a GET request on update
							* Include the update form then get the update processes done
						*/
							edit_category();

                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php require_once "includes/admin-footer-html.php"; ?>