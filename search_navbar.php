<div class="content-wrapper">
<br><br>
<nav class="navbar navbar-transparent justify-content-center">
	<form class="form-inline" method="POST" action="">
	  	<div class="form-group mx-auto">
			<input type="text" class="form-control mb-2 mr-sm-2" id="search" value="<?php echo $search_value_fname; ?>" placeholder="Enter first name" name="search">
      	</div>
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
		    <select class="form-control mb-2 mr-sm-2" id="record" name="record">
		        <option value="0">Select Number of Records</option>
		        <option value="10" <?php if ($record==10) echo 'selected';?>>10</option>
		        <option value="20" <?php if ($record==20) echo 'selected';?>>20</option>
		        <option value="50" <?php if ($record==50) echo 'selected';?>>50</option>
		        <option value="100" <?php if ($record==100) echo 'selected';?>>100</option>
		    </select>
		</div>
      	<div class="form-group mx-auto">
      		<button class="btn btn-success form-control mr-sm-2 mb-2" type="submit">Go</button>
      	</div>
  </form>
</nav>