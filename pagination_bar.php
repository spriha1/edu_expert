<?php
	if($total > $limit)
	{
	?>
		<ul class="pagination justify-content-center">
		    <li class="page-item"><a class="page-link" href="<?php echo $prev_link; ?>">Previous</a></li>
		    <?php
		    for ($i=1; $i < $totalPages; $i++) { 
		    	$link = $link_part1.$i.$link_part2.$link_part3;
		    	?>
		    	<li class="page-item"><a class="page-link" href="<?php echo $link; ?>"><?php echo $i; ?></a></li>
		    <?php } ?>
		<li class="page-item"><a class="page-link" href="<?php echo $next_link; ?>">Next</a></li>
		</ul>
	<?php } ?>
?>