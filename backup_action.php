<?php
	ini_set('display_errors', 'On');
	include 'helper/dbconn.php';
	$table = $_GET['table'];
	$time = date("Y-m-d-H-i-s");
	$backup_path = '/home/lihuaz/Desktop/'.$time.'-'.$table.'.sql';
	$cmd = 'mysqldump -h localhost -u root -p123 test_mpi4 '.$table.' > ' . $backup_path;
	echo $cmd;
	passthru($cmd);
?>