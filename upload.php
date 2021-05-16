<?php
	session_start();
    include_once './config.php';
	$conn = openDB();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Developer</title>
</head>
	<body>
		<form action="" enctype="multipart/form-data" method="POST">
		   Chọn file ảnh: <input type="file" name="uploadFile"><br>
		   <input type="submit" name="submit" value="Upload">
		</form>
		<?php 
		if(isset($_POST['submit'])) {
       
            if($_FILES['uploadFile']['name'] != NULL){
                if($_FILES['uploadFile']['type'] == "image/jpeg" || $_FILES['uploadFile']['type'] == "image/png" || $_FILES['uploadFile']['type'] == "image/gif"){      
                    $path = "images/"; 
                    $tmp_name = $_FILES['uploadFile']['tmp_name'];
                    $name = $_FILES['uploadFile']['name'];          
                                    
                    move_uploaded_file($tmp_name,$path.$name);
                    $image_url = $path.$name; 

                    $sql = "INSERT INTO `image_avatar` (`userdevelop`,`image_url`) VALUES ('$ss_user','$image_url')";    
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
            header("refresh:1,url=taikhoan.php");
        }

		?>
	</body>
</html>
