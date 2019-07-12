<?php
	if($total > $limit)
	{
	?>
		<ul class="pagination justify-content-center">
		    <li class="page-item"><a class="page-link" href="regd_users.php?page=<?php echo $previous; ?>">Previous</a></li>
		    <?php
		    for ($i=1; $i < $totalPages; $i++) { 
		    	?>
		    	<li class="page-item"><a class="page-link" href="<?php echo $link; ?>"><?php echo $i; ?></a></li>
		    <?php } ?>
		<li class="page-item"><a class="page-link" href="regd_users.php?page=<?php echo $next; ?>">Next</a></li>
		</ul>
	<?php } ?>
?>