<br><br>
<div class='container'>
	<div class="table-responsive">
		<table class="table table-bordered table-hover table-striped" align="center" style="width:90%">
			<?php if ($file === "regd_users.php") { ?>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Username</th>
				<th>Email</th>
				<th></th>
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
				
				<td>
					<button type="button" class="btn btn-success start_chat" data-tousername="<?php echo $value["username"]; ?>" data-tofirstname="<?php echo $value['firstname']; ?>">Chat</button>
				</td>
				<td><a href="remove_users.php?username='<?php echo $value["username"]; ?>'&t='<?php echo $token; ?>'"><button class="btn btn-success">Remove</button></a></td>
				<?php 
				if ($value['block_status']==0) { ?>
					<td><a href="block_users.php?username='<?php echo $value["username"]; ?>'&t='<?php echo $token; ?>'"><button class="btn btn-success">Block</button></a></td>
			</tr>
			<?php
					}
					else if($value['block_status']==1)
					{ ?>
						<td><a href="unblock_users.php?username='<?php echo $value["username"]; ?>'&t='<?php echo $token; ?>'"><button class="btn btn-success">Unblock</button></a></td>
					</tr>
					<?php
					}

	    }
	    } else if ($file === "pending_requests.php") { ?> 
	    			<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Username</th>
					<th>Email</th>
					<th></th>
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
					<td><a href="add_users.php?username='<?php echo $value["username"]; ?>'&t='<?php echo $token; ?>'"><button class="btn btn-success">Add</button></a></td>
					<td><a href="remove_users.php?username='<?php echo $value["username"]; ?>'&t='<?php echo $token; ?>'"><button class="btn btn-success">Remove</button></a></td>
					<?php
					if ($value['block_status']==0) { ?>
						<td><a href="block_users.php?username='<?php echo $value["username"]; ?>'&t='<?php echo $token; ?>'"><button class="btn btn-success">Block</button></a></td>
				</tr>
				<?php 
						}
						else if ($value['block_status']==1) { ?>
							<td><a href="unblock_users.php?username='<?php echo $value["username"]; ?>'&t='<?php echo $token; ?>'"><button class="btn btn-success">Unblock</button></a></td>
						</tr>
						<?php
						}
		    }
		} ?>
	    </table></div>
	    <div id="user_modal_details"></div>
<script src="<?php autoVer('/scripts/chat.js'); ?>"></script>