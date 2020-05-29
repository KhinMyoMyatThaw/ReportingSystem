<?php

session_start();

$mysqli = new mysqli('localhost','root','','register_form') or die (mysqli_error($mysqli));
if (isset($_POST['add'])){

	$date = $_POST['date'];
	$morning_plan = $_POST['morning_plan'];
	$evening_plan = $_POST['evening_plan'];
	$remark= $_POST['remark'];

	$_SESSION['message'] = "Record has been saved";
	$_SESSION['msg_type'] = "success";

	header("location: homeview.php");

	$mysqli->query("INSERT INTO report_plan(date, morning_plan, evening_plan, remark) VALUES ('$date', '$morning_plan', '$evening_plan', '$remark') ") or die ($mysqli->error);
}

if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM report_plan WHERE id=$id")or die($mysqli->error());

	$_SESSION['message'] = "Record has been deleted";
	$_SESSION['msg_type'] = "danger";

	header("location: homeview.php");
}

?>