<?php
	$total = count( $result );   
	$limit = 10;   
	$totalPages = ceil( $total/ $limit );

	if(isset($_POST['search']))
	{
		$previous = "";
		$next = 2;
		$offset = 0;
		$res = array_slice( $result, $offset, $limit );

		echo '<ul class="pagination justify-content-center">
		    <li class="page-item"><a class="page-link" href="regd_users.php?page='.$previous.'&s='.$_POST['search'].'">Previous</a></li>';
		    for ($i=1; $i < $totalPages; $i++) { 
		    	echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$i.'&s='.$_POST['search'].'">'.$i.'</a></li>';
		    }
		echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$next.'&s='.$_POST['search'].'">Next</a></li>
		</ul>';
	}
	else
	{
		$page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
		
		$page = max($page, 1);
		$page = min($page, $totalPages);
		$offset = ($page - 1) * $limit;
		if( $offset < 0 ) $offset = 0;
		$previous = $page-1;
		$next = $page+1;

		$res = array_slice( $result, $offset, $limit );

		
		if(isset($_GET['s']) && !empty($_GET['s']))
		{
			echo '<ul class="pagination justify-content-center">
			    <li class="page-item"><a class="page-link" href="regd_users.php?page='.$previous.'&s='.$_GET['s'].'">Previous</a></li>';
			    for ($i=1; $i < $totalPages; $i++) { 
			    	echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$i.'&s='.$_GET['s'].'">'.$i.'</a></li>';
			    }
			echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$next.'&s='.$_GET['s'].'">Next</a></li>
			</ul>';
		}
		else
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
    	include_once 'pagination.php';
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