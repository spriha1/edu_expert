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
?>