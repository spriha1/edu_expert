<?php 
	session_start();
	if (isset($_SESSION["username"])) {
		include_once 'header_dashboard.html';
		include_once 'admin_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		require_once 'csrf_token.php';
		include_once 'static_file_version.php';

		
		$obj = new DB_connect();
		$query = "SELECT user_type FROM user_types WHERE user_type != 'Admin'";
		$result = $obj->select_records($conn, $query);
		$file = "regd_users.php";
		$search_value_usertype = "";
		$status = 1;

		if (isset($_POST['user_type'])) {
			$search_value_usertype = $_POST['user_type'];
		}
		
	    include_once 'search_navbar.php';

		if (isset($_POST['user_type'])) {
			$c = 0;
			$query = "SELECT user_type FROM user_types WHERE user_type != 'Admin'";
			$result = $obj->select_records($conn, $query);
			foreach ($result as $key => $value) {
				if ($value['user_type'] === $_POST['user_type']) {
					$c++;
				}
			}
			if ($c > 0) {
				$check = true;
			}
			else {
				$check = false;
			}
		}

		if (isset($_POST['user_type']) && $check) {
			$query = "SELECT firstname, lastname, email, username, block_status FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_reg_status = 1 AND user_type = '".$_POST['user_type']."'";
		    $result = $obj->select_records($conn, $query);
		}

		else {
			$query = "SELECT firstname, lastname, email, username, block_status FROM users where user_reg_status = 1 AND user_type_id NOT IN (SELECT id FROM user_types WHERE user_type = 'Admin')";

		    $result = $obj->select_records($conn, $query);
		}

		if ($result) {
			
		    include_once 'display.php';
		}
		else {
			echo '<div style="text-align:center;"><h4 style="color : #ff0000;">There is no record</h4></div>';
		}
	}
	else {
		header("Location:index.php");
	}
?>
<?php 
	$file = 'timesheet_footer';
	include_once 'footer.php'; 
?>
<script src="<?php autoVer('/scripts/users_list.js'); ?>"></script>
</body>
</html>