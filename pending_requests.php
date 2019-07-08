<?php 
	session_start();
	if(isset($_SESSION["username"]))
	{
		echo '<body class="body1">';
		include_once 'header.html';
		include_once 'admin_sidenav.php';
		include_once 'db_connection.php';
		include_once 'db_credentials.php';
		$obj = new DB_connect();
		$conn = $obj->connect('localhost','php_project',$db_username,$db_password);
		$query = "SELECT user_type FROM user_types WHERE user_type != 'Admin'";
		$result = $obj->select_records($query);
	    echo '<nav class="navbar navbar-transparent justify-content-center">
				  <form class="form-inline" method="POST" action="">
				    <select class="form-control" id="user_type" name="user_type">
					        <option value="0">Select User Type</option>';
	            				foreach ($result as $key => $value) {
	            					echo '<option value="'.$value['user_type'].'" '.(($value['user_type']==$_POST['user_type'])?"selected":"").'>'.$value['user_type'].'</option>';
	            				}
				      	echo '</select>
				      	<button class="btn btn-success form-control mr-sm-2" type="submit">Go</button>
				  </form>
				</nav>';

		if (isset($_POST['user_type'])) {
		    $query = "SELECT firstname, lastname, email, username, block_status FROM users where user_reg_status = 0 AND user_type_id = (SELECT id FROM user_types where user_type = '".$_POST['user_type']."')";

		    $result = $obj->select_records($query);
		    if($result)
		    {
			    echo "<br><br>";
			    echo "<div class='container'>";
			    echo '<div class="table-responsive">
							<table class="table table-hover table-bordered" align="center" style="width:90%">
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Username</th>
									<th>Email</th>
									<th></th>
									<th></th>
									<th></th>
								</tr>';
			    foreach ($result as $key => $value) {
			     	echo '<tr>
									<td>'.$value['firstname'].'</td>
									<td>'.$value['lastname'].'</td>
									<td>'.$value['username'].'</td>
									<td>'.$value['email'].'</td>
									<td><a href="add_users.php?username='.$value["username"].'"><button class="btn btn-success">Accept</button></a></td>
									<td><a href="remove_users.php?username='.$value["username"].'"><button class="btn btn-success">Reject</button></a></td>';

									if($value['block_status']==0){
										echo '<td><a href="block_users.php?username='.$value["username"].'"><button class="btn btn-success">Block</button></a></td>
										</tr>';
									}
								else if($value['block_status']==1)
								{
									echo '<td><a href="unblock_users.php?username='.$value["username"].'"><button class="btn btn-success">Unblock</button></a></td>
									</tr>';
								}
			    } 
			    echo '</table></div>';
			}
			else
			{
				echo '<div style="text-align:center;"><h4 style="color : #ff0000;">There is no record for the selected category</h4></div>';
			}
		}

	}
	else
	{
		header("Location:index.php");
	}

?>