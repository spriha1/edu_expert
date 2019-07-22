<?php
	$total = count( $result ); 
	if (isset($_POST['record']) && $check1) {
		$limit = $_POST['record'];
	}

	else if ($_GET['r']) {
		$limit = $_GET['r'];
	}

	else {
		$limit = 10;   
	}
	$totalPages = ceil( $total/ $limit );
	$link_part3 = "";

	if ($_POST) {
		$previous = "";
		$next = "";
		$offset = 0;
		if (isset($_POST['record']) && $check1) {
			$link_part3 = "&r=".$_POST['record'];
		}
	 	if (isset($_POST['user_type']) && $check &&  isset($_POST['search'])) {
			$query = "SELECT firstname, lastname, email, username, block_status FROM users WHERE user_reg_status = ".$status." AND user_type_id = (SELECT id FROM user_types WHERE user_type = '".$_POST['user_type']."') AND firstname LIKE '%".$_POST['search']."%' LIMIT ".$offset." , ".$limit."";
			$res = $obj->select_records($conn, $query);

			$prev_link = $file."?page=".$previous."&s=".$_POST['search']."&u=".$_POST['user_type'].$link_part3;
			$link_part1 = $file."?page=";
			$link_part2 = "&s=".$_POST['search']."&u=".$_POST['user_type'];
			$next_link = $file."?page=".$next."&s=".$_POST['search']."&u=".$_POST['user_type'].$link_part3;
			include_once 'pagination_bar.php';
	 	}

	 	else if (isset($_POST['search'])) {
			$query = "SELECT firstname, lastname, email, username, block_status FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_reg_status = ".$status." AND user_type_id != (SELECT id FROM user_types WHERE user_type = 'Admin') AND firstname LIKE '%".$_POST['search']."%' LIMIT ".$offset." , ".$limit."";
		    $res = $obj->select_records($conn, $query);

		    $prev_link = $file."?page=".$previous."&s=".$_POST['search'].$link_part3;
			$link_part1 = $file."?page=";
			$link_part2 = "&s=".$_POST['search'];
			$next_link = $file."?page=".$next."&s=".$_POST['search'].$link_part3;
			include_once 'pagination_bar.php';
		} 

		else if (isset($_POST['user_type']) && $check) {
			$query = "SELECT firstname, lastname, email, username, block_status FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_reg_status = ".$status." AND user_type = '".$_POST['user_type']."' LIMIT ".$offset." , ".$limit."";
		    $res = $obj->select_records($conn, $query);

		    $prev_link = $file."?page=".$previous."&u=".$_POST['user_type'].$link_part3;
			$link_part1 = $file."?page=";
			$link_part2 = "&u=".$_POST['user_type'];
			$next_link = $file."?page=".$next."&u=".$_POST['user_type'].$link_part3;
			include_once 'pagination_bar.php';
		}
	}

	else if ($_GET) {
		$page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
		
		$page = max($page, 1);
		$page = min($page, $totalPages);
		$offset = ($page - 1) * $limit;
		if( $offset < 0 ) $offset = 0;
		$previous = $page-1;
		$next = $page+1;

		if (isset($_GET['r'])) {
			$link_part3 = "&r=".$_GET['r'];
		}

		if (isset($_GET['s']) && isset($_GET['u'])) {
			$query = "SELECT firstname, lastname, email, username, block_status FROM users WHERE user_reg_status = ".$status." AND user_type_id = (SELECT id FROM user_types WHERE user_type = '".$_GET['u']."') AND firstname LIKE '%".$_GET['s']."%' LIMIT ".$offset." , ".$limit."";
		    $res = $obj->select_records($conn, $query);

		    $prev_link = $file."?page=".$previous."&s=".$_GET['s']."&u=".$_GET['u'].$link_part3;
			$link_part1 = $file."?page=";
			$link_part2 = "&s=".$_GET['s']."&u=".$_GET['u'];
			$next_link = $file."?page=".$next."&s=".$_GET['s']."&u=".$_GET['u'].$link_part3;
			include_once 'pagination_bar.php';
		}

		else if (isset($_GET['s'])) {
			$query = "SELECT firstname, lastname, email, username, block_status FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_reg_status = ".$status." AND user_type_id != (SELECT id FROM user_types WHERE user_type = 'Admin') AND firstname LIKE '%".$_GET['s']."%' LIMIT ".$offset." , ".$limit."";
		    $res = $obj->select_records($conn, $query);

		    $prev_link = $file."?page=".$previous."&s=".$_GET['s'].$link_part3;
			$link_part1 = $file."?page=";
			$link_part2 = "&s=".$_GET['s'];
			$next_link = $file."?page=".$next."&s=".$_GET['s'].$link_part3;
			include_once 'pagination_bar.php';
		}

		else if (isset($_GET['u'])) {
			$query = "SELECT firstname, lastname, email, username, block_status FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_reg_status = ".$status." AND user_type = '".$_GET['u']."' LIMIT ".$offset." , ".$limit."";
		    $res = $obj->select_records($conn, $query);

		    $prev_link = $file."?page=".$previous."&u=".$_GET['u'].$link_part3;
			$link_part1 = $file."?page=";
			$link_part2 = "&u=".$_GET['u'];
			$next_link = $file."?page=".$next."&u=".$_GET['u'].$link_part3;
			include_once 'pagination_bar.php';
		}

		else {
			$query = "SELECT firstname, lastname, email, username, block_status FROM users where user_reg_status = ".$status." AND user_type_id != (SELECT id FROM user_types WHERE user_type = 'Admin') LIMIT ".$offset." , ".$limit."";

			$res = $obj->select_records($conn, $query);

			$prev_link = $file."?page=".$previous.$link_part3;
			$link_part1 = $file."?page=";
			$link_part2 = "";
			$next_link = $file."?page=".$next.$link_part3;
			include_once 'pagination_bar.php';
		}
	}
	else {
		$offset = 0;
		$previous = "";
		$next = "";
		$query = "SELECT firstname, lastname, email, username, block_status FROM users where user_reg_status = ".$status." AND user_type_id != (SELECT id FROM user_types WHERE user_type = 'Admin') LIMIT ".$offset." , ".$limit."";

		$res = $obj->select_records($conn, $query);

		$prev_link = $file."?page=".$previous.$link_part3;
		$link_part1 = $file."?page=";
		$link_part2 = "";
		$next_link = $file."?page=".$next.$link_part3;
		include_once 'pagination_bar.php';
	}
	
	if ($res) {
	    include_once 'display.php';
	}
?>