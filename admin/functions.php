<?php 
function users_online() {
	global $connect;
	$session = session_id(); 
	$time = time();
	$time_out_in_seconds = 30;
	$time_out = $time - $time_out_in_seconds;
	$query = "SELECT * FROM users_online WHERE session = '$session'";
	$send_query = mysqli_query($connect, $query);
	if($count = mysqli_num_rows($send_query) == NULL) {
	    mysqli_query($connect, "INSERT INTO users_online (session, time) VALUES ('$session', '$time')");
	} else {
	    mysqli_query($connect, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
	}

	$users_online_query = mysqli_query($connect, "SELECT * FROM users_online WHERE time > '$time_out'");
	return $count_users_online = mysqli_num_rows($users_online_query);
}

function confirmQuery($result) {
	global $connect;
	if(!$result) {
		die("QUERY FAILED ." . mysqli_error($connect));
	}
}

function add_category() {
	global $connect;
	if(isset($_POST['submit'])) { 
		$cat_title = $_POST['cat_title'];
		if(!empty($cat_title)) {
			$cat_sql = "INSERT INTO categories (cat_title) VALUES ('{$cat_title}')";
			$insert_cat_query = mysqli_query($connect, $cat_sql);
			if(!$insert_cat_query) {
				die("QUERY FAILED ". mysqli_error($connect));
			}
		} else {
			$msg = "<div class='alert alert-danger'><p>This field should not be empty</p></div>";
		}
	}
}


function delete_category() {
	global $connect;
	if(isset($_GET['delete'])) {
		$cat_id = (int) $_GET['delete'];
		$delete_cat_sql = "DELETE FROM categories WHERE cat_id = '$cat_id'";
		$execute_delete_cat = mysqli_query($connect, $delete_cat_sql);
		header("Location: categories.php");
	}
}

function edit_category() {
	global $connect;
	if(isset($_GET['edit'])) {
		$cat_id = $_GET['edit'];
		$get_cat_by_id_sql = "SELECT * FROM categories WHERE cat_id = '{$cat_id}'";
		$execute_get_cat_by_id = mysqli_query($connect, $get_cat_by_id_sql);
		$cat = mysqli_fetch_object($execute_get_cat_by_id);
		require_once "includes/admin-edit-category-form-html.php";
		if(isset($_POST['updateCategory'])) {
			$new_cat_title = $_POST['update_category'];
			$update_cat_sql = "UPDATE categories SET cat_title = '{$new_cat_title}' WHERE cat_id = '{$cat_id}'";
			$execute_update_cat = mysqli_query($connect, $update_cat_sql);
			header("Location: categories.php?edit=$cat_id");
		}
	}
}

function clear($string){
  $string=trim($string);
  $string=stripslashes($string);
  $string=htmlspecialchars($string);
  $string= preg_replace("/[^ \w]+/", "", $string);
  return filter_var($string,FILTER_SANITIZE_STRING);
}