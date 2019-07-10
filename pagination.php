<?php
	$page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
	$total = count( $result );   
	$limit = 10;   
	$totalPages = ceil( $total/ $limit );
	$page = max($page, 1);
	$page = min($page, $totalPages);
	$offset = ($page - 1) * $limit;
	if( $offset < 0 ) $offset = 0;
	$previous = $page-1;
	$next = $page+1;

	$res = array_slice( $result, $offset, $limit );

	echo '<ul class="pagination justify-content-center">
	    <li class="page-item"><a class="page-link" href="regd_users.php?page='.$previous.'">Previous</a></li>';
	    for ($i=1; $i < $totalPages; $i++) { 
	    	echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$i.'">'.$i.'</a></li>';
	    }
	echo '<li class="page-item"><a class="page-link" href="regd_users.php?page='.$next.'">Next</a></li>
	</ul>';
?>