<br><br>
<div class='container'>
	<div class="table-responsive">
		<table class="table table-bordered" align="center" style="width:90%">
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Username</th>
				<th>Email</th>
				<th></th>
				<th></th>
			</tr>
		<?php
	    foreach ($res as $key => $value) { ?>
	     	<tr>
				<td><?php echo $value['firstname']; ?></td>
				<td><?php echo $value['lastname']; ?></td>
				<td><?php echo $value['username']; ?></td>
				<td><?php echo $value['email']; ?></td>
				<?php echo '<td><a href="remove_users.php?username='.$value["username"].'&t='.$token.'"><button class="btn btn-success">Remove</button></a></td>';
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
	    ?>