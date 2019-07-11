<?php
	$total = count( $result );   
	$limit = 10;   
	$totalPages = ceil( $total/ $limit );

	if($_POST)
	{
		$previous = "";
		$next = "";
		$offset = 0;
	 	if (isset($_POST['user_type']) && isset($_POST['search']))
	 	{
			$query = "SELECT firstname, lastname, email, username, block_status FROM users WHERE user_reg_status = 1 AND user_type_id = (SELECT id FROM user_types WHERE user_type = '".$_POST['user_type']."') AND firstname LIKE '%".$_POST['search']."%' LIMIT ".$offset." , ".$limit."";
			$res = $obj->select_records($query);

			if($total > $limit)
			{
				echo '<ul class="pagination justify-content-center">
				    <li class="page-item"><a class="page-link" href="regd_users.php?page='.$previous.'&s='.$_POST['search'].'&u='.$_POST['user_type'].'">Previous</a></li>';
				    for ($i=1; $i < $totalPages; $i++) { 
				    	echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$i.'&s='.$_POST['search'].'&u='.$_POST['user_type'].'">'.$i.'</a></li>';
				    }
				echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$next.'&s='.$_POST['search'].'&u='.$_POST['user_type'].'">Next</a></li>
				</ul>';
			}
	 	}
	 	else if(isset($_POST['search']))
		{
			$query = "SELECT firstname, lastname, email, username, block_status FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_reg_status = 1 AND user_type_id != (SELECT id FROM user_types WHERE user_type = 'Admin') AND firstname LIKE '%".$_POST['search']."%' LIMIT ".$offset." , ".$limit."";
		    $res = $obj->select_records($query);
			if($total > $limit)
			{
				echo '<ul class="pagination justify-content-center">
				    <li class="page-item"><a class="page-link" href="regd_users.php?page='.$previous.'&s='.$_POST['search'].'">Previous</a></li>';
				    for ($i=1; $i < $totalPages; $i++) { 
				    	echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$i.'&s='.$_POST['search'].'">'.$i.'</a></li>';
				    }
				echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$next.'&s='.$_POST['search'].'">Next</a></li>
				</ul>';
			}
		} 
		else if(isset($_POST['user_type']))
		{
			$query = "SELECT firstname, lastname, email, username, block_status FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_reg_status = 1 AND user_type = '".$_POST['user_type']."' LIMIT ".$offset." , ".$limit."";
		    $res = $obj->select_records($query);
			if($total > $limit)
			{
				echo '<ul class="pagination justify-content-center">
				    <li class="page-item"><a class="page-link" href="regd_users.php?page='.$previous.'&u='.$_POST['user_type'].'">Previous</a></li>';
				    for ($i=1; $i < $totalPages; $i++) { 
				    	echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$i.'&u='.$_POST['user_type'].'">'.$i.'</a></li>';
				    }
				echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$next.'&u='.$_POST['user_type'].'">Next</a></li>
				</ul>';
			}
		}
	}

	else if($_GET)
	{
		$page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
		
		$page = max($page, 1);
		$page = min($page, $totalPages);
		$offset = ($page - 1) * $limit;
		if( $offset < 0 ) $offset = 0;
		$previous = $page-1;
		$next = $page+1;

		if(isset($_GET['s']) && isset($_GET['u']))
		{
			$query = "SELECT firstname, lastname, email, username, block_status FROM users WHERE user_reg_status = 1 AND user_type_id = (SELECT id FROM user_types WHERE user_type = '".$_GET['u']."') AND firstname LIKE '%".$_GET['s']."%' LIMIT ".$offset." , ".$limit."";
		    $res = $obj->select_records($query);
			if($total > $limit)
			{
				echo '<ul class="pagination justify-content-center">
				    <li class="page-item"><a class="page-link" href="regd_users.php?page='.$previous.'&s='.$_GET['s'].'&u='.$_GET['u'].'">Previous</a></li>';
				    for ($i=1; $i < $totalPages; $i++) { 
				    	echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$i.'&s='.$_GET['s'].'&u='.$_GET['u'].'">'.$i.'</a></li>';
				    }
				echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$next.'&s='.$_GET['s'].'&u='.$_GET['u'].'">Next</a></li>
				</ul>';
			}
		}
		else if(isset($_GET['s']))
		{
			$query = "SELECT firstname, lastname, email, username, block_status FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_reg_status = 1 AND user_type_id != (SELECT id FROM user_types WHERE user_type = 'Admin') AND firstname LIKE '%".$_GET['s']."%' LIMIT ".$offset." , ".$limit."";
		    $res = $obj->select_records($query);
			if($total > $limit)
			{
				echo '<ul class="pagination justify-content-center">
				    <li class="page-item"><a class="page-link" href="regd_users.php?page='.$previous.'&s='.$_GET['s'].'">Previous</a></li>';
				    for ($i=1; $i < $totalPages; $i++) { 
				    	echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$i.'&s='.$_GET['s'].'">'.$i.'</a></li>';
				    }
				echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$next.'&s='.$_GET['s'].'">Next</a></li>
				</ul>';
			}
		}
		else if(isset($_GET['u']))
		{
			$query = "SELECT firstname, lastname, email, username, block_status FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_reg_status = 1 AND user_type = '".$_GET['u']."' LIMIT ".$offset." , ".$limit."";
		    $res = $obj->select_records($query);
			if($total > $limit)
			{
				echo '<ul class="pagination justify-content-center">
				    <li class="page-item"><a class="page-link" href="regd_users.php?page='.$previous.'&u='.$_GET['u'].'">Previous</a></li>';
				    for ($i=1; $i < $totalPages; $i++) { 
				    	echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$i.'&u='.$_GET['u'].'">'.$i.'</a></li>';
				    }
				echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$next.'&u='.$_GET['u'].'">Next</a></li>
				</ul>';
			}
		}

	}
	else
	{
		$offset = 0;
		$query = "SELECT firstname, lastname, email, username, block_status FROM users where user_reg_status = 1 AND user_type_id NOT IN (SELECT id FROM user_types WHERE user_type = 'Admin') LIMIT ".$offset." , ".$limit."";

		$res = $obj->select_records($query);
		
		if($total > $limit)
		{
			echo '<ul class="pagination justify-content-center">
			    <li class="page-item"><a class="page-link" href="regd_users.php?page='.$previous.'">Previous</a></li>';
			    for ($i=1; $i < $totalPages; $i++) { 
			    	echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$i.'">'.$i.'</a></li>';
			    }
			echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$next.'">Next</a></li>
			</ul>';
		}
	}
	
	if($res)
    {
	    echo "<br><br>";
	    echo "<div class='container'>";
	    echo '<div class="table-responsive">
					<table class="table table-bordered" align="center" style="width:90%">
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Username</th>
							<th>Email</th>
							<th></th>
							<th></th>
						</tr>';
	    foreach ($res as $key => $value) {
	     	echo '<tr>
							<td>'.$value['firstname'].'</td>
							<td>'.$value['lastname'].'</td>
							<td>'.$value['username'].'</td>
							<td>'.$value['email'].'</td>
							<td><a href="remove_users.php?username='.$value["username"].'&t='.$token.'"><button class="btn btn-success">Remove</button></a></td>';
							if($value['block_status']==0){
								echo '<td><a href="block_users.php?username='.$value["username"].'&t='.$token.'"><button class="btn btn-success">Block</button></a></td>
						</tr>';
					}
						else if($value['block_status']==1)
						{
							echo '<td><a href="unblock_users.php?username='.$value["username"].'&t='.$token.'"><button class="btn btn-success">Unblock</button></a></td>
						</tr>';
						}
	    } 
	    echo '</table></div>';
	}
?>