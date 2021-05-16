<?php

	include_once './config.php';
	$conn = openDB();
	$error = '';

	if(isset($_POST['submit'])) { 	
		if($_FILES['uploadFile']['name'] != NULL){
			if($_FILES['uploadFile']['type'] == "image/jpeg" || $_FILES['uploadFile']['type'] == "image/png" || $_FILES['uploadFile']['type'] == "image/gif"){ 		
				$path = "./images/"; 
				$tmp_name = $_FILES['uploadFile']['tmp_name'];
				$name = $_FILES['uploadFile']['name'];			
				
				move_uploaded_file($tmp_name,$path.$name);
				$image_url = './'.$path.$name; 

				$sql = "INSERT INTO `image_avatar` (`image_url`) VALUES ('$image_url')";    
				$smt = mysqli_prepare($conn, $sql);

				if(mysqli_stmt_execute($smt)){			
					echo 'Thêm thành công ảnh';
				}else{
					echo 'Không thể thêm được ảnh';
				}			
			}else{
			 
				echo "Kiểu file không phải là ảnh";
			}  
		}else{
			echo "Bạn chưa chọn ảnh upload";
		}
	}
?>