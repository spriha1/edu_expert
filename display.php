<br><br>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<input type="hidden" id="token" name="token" value="<?php echo $token=Token::generate(); ?>">
					<table id="regd_users" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Username</th>
								<th>Email</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
			<?php if ($file === "regd_users.php") { 
				    foreach ($res as $key => $value) { ?>
				     	<tr>
							<td><?php echo $value['firstname']; ?></td>
							<td><?php echo $value['lastname']; ?></td>
							<td><?php echo $value['username']; ?></td>
							<td><?php echo $value['email']; ?></td>
							
							<td>
								<button type="button" class="btn btn-success start_chat" data-tousername="<?php echo $value["username"]; ?>" data-tofirstname="<?php echo $value['firstname']; ?>">Chat</button>
							</td>
							<td><a href="remove_users.php?username=<?php echo $value["username"]; ?>&t=<?php echo $token; ?>"><button class="btn btn-success">Remove</button></a></td>
							<?php 
							if ($value['block_status']==0) { ?>
								<td><a href="block_users.php?username=<?php echo $value["username"]; ?>&t=<?php echo $token; ?>"><button class="btn btn-success">Block</button></a></td>
						</tr>
						<?php
								}
								else if($value['block_status']==1)
								{ ?>
									<td><a href="unblock_users.php?username=<?php echo $value["username"]; ?>&t=<?php echo $token; ?>"><button class="btn btn-success">Unblock</button></a></td>
								</tr>
								<?php
								}

				    }
				    } else if ($file === "pending_requests.php") { 
					    foreach ($res as $key => $value) { ?>
					     	<tr>
								<td><?php echo $value['firstname']; ?></td>
								<td><?php echo $value['lastname']; ?></td>
								<td><?php echo $value['username']; ?></td>
								<td><?php echo $value['email']; ?></td>
								<td><a href="add_users.php?username=<?php echo $value["username"]; ?>&t=<?php echo $token; ?>"><button class="btn btn-success">Add</button></a></td>
								<td><a href="remove_users.php?username=<?php echo $value["username"]; ?>&t=<?php echo $token; ?>"><button class="btn btn-success">Remove</button></a></td>
								<?php
								if ($value['block_status']==0) { ?>
									<td><a href="block_users.php?username=<?php echo $value["username"]; ?>&t=<?php echo $token; ?>"><button class="btn btn-success">Block</button></a></td>
							</tr>
							<?php 
									}
									else if ($value['block_status']==1) { ?>
										<td><a href="unblock_users.php?username=<?php echo $value["username"]; ?>&t=<?php echo $token; ?>"><button class="btn btn-success">Unblock</button></a></td>
									</tr>
									<?php
									}
					    }
					} ?>
				    </table></div>
				</div>
			</div>
		</div>
	</section>
	    <div id="user_modal_details"></div>
<script src="<?php autoVer('/scripts/chat.js'); ?>"></script>

</script>