<?php 
	session_start();
	if(isset($_SESSION["username"]))
	{
		echo '<body class="body2">';
		include_once 'header.html';
		include_once 'admin_sidenav.php';
		include_once 'db_connection.php';
		include_once 'db_credentials.php';

		require_once 'csrf_token.php';
		$token  = Token::generate();

		$obj = new DB_connect();
		$conn = $obj->connect('localhost','php_project',$db_username,$db_password);
		$query = "SELECT user_type FROM user_types WHERE user_type != 'Admin'";
		$result = $obj->select_records($query);
		
		$search_value_fname = "";
		$search_value_usertype = "";
		$status = 1;

		if (isset($_POST['search'])) 
		{
			$search_value_fname = $_POST['search'];
		}
		else if(isset($_GET['s']))
		{
			$search_value_fname = $_GET['s'];
		}
		if (isset($_POST['user_type'])) 
		{
			$search_value_usertype = $_POST['user_type'];
		}
		else if(isset($_GET['u']))
		{
			$search_value_usertype = $_GET['u'];
		}

	    echo '<nav class="navbar navbar-transparent justify-content-center">
				<form class="form-inline" method="POST" action="">
				  	<div class="form-group mx-auto">
						<input type="text" class="form-control mb-2 mr-sm-2" id="search" value="'.$search_value_fname.'" placeholder="Enter first name" name="search">
			      	</div>
					<div class="form-group mx-auto">
				    <select class="form-control mb-2 mr-sm-2" id="user_type" name="user_type">
				        <option value="0">Select User Type</option>';
            				foreach ($result as $key => $value) {
            					echo '<option value="'.$value['user_type'].'" '.(($value['user_type']==$search_value_usertype)?"selected":"").'>'.$value['user_type'].'</option>';
            				}
			      	echo '</select>
			      	</div>
			      	<div class="form-group mx-auto">
					    <select class="form-control mb-2 mr-sm-2" id="record" name="record">
					        <option value="0">Select Number of Records</option>
					        <option value="10">10</option>
					        <option value="20">20</option>
					        <option value="50">50</option>
					        <option value="100">100</option>
					    </select>
					</div>
			      	<div class="form-group mx-auto">
			      		<button class="btn btn-success form-control mr-sm-2 mb-2" type="submit">Go</button>
			      	</div>
			  </form>
			</nav>';

		if (isset($_POST['user_type'])) 
		{
			$c = 0;
			$query = "SELECT user_type FROM user_types WHERE user_type != 'Admin'";
			$result = $obj->select_records($query);
			foreach ($result as $key => $value) 
			{
				if($value['user_type'] === $_POST['user_type'])
				{
					$c++;
				}
			}
			if ($c > 0) {
				$check = true;
			}
			else
			{
				$check = false;
			}
		}

		if (isset($_POST['record'])) 
		{
			$c = 0;
			if($_POST['record'] > 0)
			{
				$c++;
			}
			if ($c > 0) {
				$check1 = true;
			}
			else
			{
				$check1 = false;
			}
		}
 		
 		if (isset($_POST['user_type']) && $check && isset($_POST['search'])) 
		{
			$query = "SELECT firstname, lastname, email, username, block_status FROM users WHERE user_reg_status = 1 AND user_type_id = (SELECT id FROM user_types WHERE user_type = '".$_POST['user_type']."') AND firstname LIKE '%".$_POST['search']."%'";
		    $result = $obj->select_records($query);
		    if($result)
		    {
		    	include_once 'pagination.php';
			}
			else
			{
				echo '<div style="text-align:center;"><h4 style="color : #ff0000;">There is no record for the selected category</h4></div>';
			}
		}

		else if (isset($_POST['user_type']) && $check && isset($_GET['s'])) 
		{
			$query = "SELECT firstname, lastname, email, username, block_status FROM users WHERE user_reg_status = 1 AND user_type_id = (SELECT id FROM user_types WHERE user_type = '".$_POST['user_type']."') AND firstname LIKE '%".$_GET['s']."%'";
		    $result = $obj->select_records($query);
		    if($result)
		    {
		    	include_once 'pagination.php';
			}
			else
			{
				echo '<div style="text-align:center;"><h4 style="color : #ff0000;">There is no record for the selected category</h4></div>';
			}
		}

		else if (isset($_POST['user_type']) && $check) 
		{
			$query = "SELECT firstname, lastname, email, username, block_status FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_reg_status = 1 AND user_type = '".$_POST['user_type']."'";
		    $result = $obj->select_records($query);
		    if($result)
		    {
		    	include_once 'pagination.php';
			}
			else
			{
				echo '<div style="text-align:center;"><h4 style="color : #ff0000;">There is no record for the selected category</h4></div>';
			}
		}

		else if (isset($_POST['search'])) 
		{
			$query = "SELECT firstname, lastname, email, username, block_status FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_reg_status = 1 AND user_type_id != (SELECT id FROM user_types WHERE user_type = 'Admin') AND firstname LIKE '%".$_POST['search']."%'";
		    $result = $obj->select_records($query);
		    if($result)
		    {
		    	include_once 'pagination.php';
			}
			else
			{
				echo '<div style="text-align:center;"><h4 style="color : #ff0000;">There is no record for the selected user</h4></div>';
			}
		}

		else if (isset($_GET['s'])) 
		{
			$query = "SELECT firstname, lastname, email, username, block_status FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_reg_status = 1 AND user_type_id != (SELECT id FROM user_types WHERE user_type = 'Admin') AND firstname LIKE '%".$_GET['s']."%'";
		    $result = $obj->select_records($query);
		    if($result)
		    {
		    	include_once 'pagination.php';
			}
			else
			{
				echo '<div style="text-align:center;"><h4 style="color : #ff0000;">There is no record for the selected user</h4></div>';
			}
		}

		else
		{
			$query = "SELECT firstname, lastname, email, username, block_status FROM users where user_reg_status = 1 AND user_type_id NOT IN (SELECT id FROM user_types WHERE user_type = 'Admin')";

		    $result = $obj->select_records($query);
		    if($result)
		    {
		    	include_once 'pagination.php';
			}
			else
			{
				echo '<div style="text-align:center;"><h4 style="color : #ff0000;">There is no record</h4></div>';
			}
		}
	}
	else
	{
		header("Location:index.php");
	}
?>