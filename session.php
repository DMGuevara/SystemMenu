<?php
	session_start();
	include('db.php');

	$user = $_SESSION['user'];

    if(isset($_SESSION['user'])){

	$query=$con->query("select * from user where userid='".$_SESSION['user']."'");
	$row=$query->fetch_array();

	$user=$row['username'];

}else{

	header('Location: index.php');
}
?>