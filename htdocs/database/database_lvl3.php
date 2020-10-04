<?php
// DATABASE LVL 3 ASSUME
$con = mysqli_connect('localhost', 'root', '', 'test');
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
		}
$link = mysqli_connect("localhost", "root", "", "test");
?>