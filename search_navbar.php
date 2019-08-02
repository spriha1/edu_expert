<div class="content-wrapper">
<br><br>
<nav class="navbar navbar-transparent justify-content-center">
	<form class="form-inline" method="POST" action="">
	  	
		<div class="form-group mx-auto">
	    <select class="form-control mb-2 mr-sm-2" id="user_type" name="user_type">
	        <option value="0">Select User Type</option>
	        <?php
				foreach ($result as $key => $value) { ?>
					<option value=<?php echo $value['user_type']; ?> <?php echo (($value['user_type']==$search_value_usertype)?"selected":""); ?>><?php echo $value['user_type']; ?>
					</option>
			<?php } ?>
      	</select>
      	</div>
      	
      	<div class="form-group mx-auto">
      		<button class="btn btn-success form-control mr-sm-2 mb-2" type="submit">Go</button>
      	</div>
  </form>
</nav>