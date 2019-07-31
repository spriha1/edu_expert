<?php 
session_start();
include_once 'db_credentials.php';
include_once 'db_connection.php';
if (isset($_SESSION["username"])) {
	$obj = new DB_connect();
    $table = "users";
    $columns = array("login_status" => 0);
    $conditions = array("username" => $_SESSION['username']);
    $obj->update($conn, $table, $columns, $conditions);
	session_unset();
	header("Location:index.php");
}
?>
