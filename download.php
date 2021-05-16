<?php

	session_start();
	if(!isset($_SESSION['user'])){
		die('Vui lòng <a href="login.php">Đăng nhập</a>');
	}
	if (empty($_SESSION['download_files'])){
		die('<a href="/files/avatar_basic.jpg" download="">Tải</a>');
	}
	if (empty($_GET['fileId'])){
		die('Vui lòng cấp file Id');
	}
	
	$id = $_GET['fileId'];
	
	$filePath = $_SESSION['download_files'][$id];

	if(!file_exists($filePath)){
		die('Tạp tin không có');
	}

	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
	header('Expire: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: '.filesize($filePath));
	flush();
	readfile($filePath);
	die();


?>