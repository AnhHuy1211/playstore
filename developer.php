<?php
	include './config.php';
    include './db.php';
    $conc = open_database();
    session_start();
    $conn = openDB();

    $sqld = "select * from account";
    $resultd = mysqli_query($conc,$sqld);

    if (mysqli_num_rows($resultd) > 0) {
        while ($row = $resultd->fetch_assoc()) {
            $money = $row['money'];
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://kit.fontawesome.com/1f93e99ed1.js" crossorigin="anonymous"></script>
  	<script src="main.js"></script>
</head>
<body>
	<?php
        $email = '';
    	$gameid = '';
    	$gamename = '';
    	$name_author = '';
    	$game_money = '';
    	$description = '';
    	$description_extra = '';
    	$image_url = '';
        $file_url = '';
    	$id_theloai = '';
        $error = '';

    	if (isset($_POST['submit'])) {
    		if(isset($_POST['email']) && isset($_POST['dev_game_id']) && isset($_POST['dev_game_name']) && isset($_POST['dev_game_author']) && isset($_POST['dev_game_money']) && isset($_POST['dev_game_des']) && isset($_POST['dev_game_des_ex'])  && isset($_POST['dev_game_theloai']) && $_FILES['uploadImage']['name'] != NULL && $_FILES['uploadFile']['name'] != NULL){
                if($_FILES['uploadImage']['type'] == "image/jpeg" || $_FILES['uploadImage']['type'] == "image/png"){      
                    $path = "pictures/"; 
                    $tmp_name = $_FILES['uploadImage']['tmp_name'];
                    $name = $_FILES['uploadImage']['name'];    
                    move_uploaded_file($tmp_name, $path.$name);     
                                                        
                    $image_url = $path.$name;
                }
                    $path = "files/";
                    $tmp_name = $_FILES['uploadFile']['tmp_name'];
                    $name = $_FILES['uploadFile']['name']; 

                    move_uploaded_file($tmp_name, $path.$name);
                    $file_url = $path.$name;

                    $email = $_POST['email'];
        			$gameid = $_POST['dev_game_id'];
        			$gamename = $_POST['dev_game_name'];
        			$name_author =$_POST['dev_game_author'];
        			$game_money = $_POST['dev_game_money'];
        			$description = $_POST['dev_game_des'];
        			$description_extra = $_POST['dev_game_des_ex'];
        			$id_theloai = $_POST['dev_game_theloai'];

        			$sql= "INSERT into develop_draft(email, gameid, gamename, name_author, game_money, description, description_extra, image_url, file_url, id_theloai) values ('$email','$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$file_url','$id_theloai')";
        			$conn = openDB();
        			mysqli_query($conn, $sql); 
                }
    	}
        if (isset($_POST['SUBMIT'])) {
            if(isset($_POST['email']) && isset($_POST['dev_phim_id']) && isset($_POST['dev_phim_name']) && isset($_POST['dev_phim_author']) && isset($_POST['dev_phim_money']) && isset($_POST['dev_phim_des']) && isset($_POST['dev_phim_des_ex'])  && isset($_POST['dev_phim_theloai']) && $_FILES['uploadImage']['name'] != NULL && $_FILES['uploadFile']['name'] != NULL){
                if($_FILES['uploadImage']['type'] == "image/jpeg" || $_FILES['uploadImage']['type'] == "image/png"){      
                    $path = "pictures/"; 
                    $tmp_name = $_FILES['uploadImage']['tmp_name'];
                    $name = $_FILES['uploadImage']['name'];    
                    move_uploaded_file($tmp_name, $path.$name);     
                                                        
                    $image_url = $path.$name;
                }
                    $path = "files/";
                    $tmp_name = $_FILES['uploadFile']['tmp_name'];
                    $name = $_FILES['uploadFile']['name']; 

                    move_uploaded_file($tmp_name, $path.$name);
                    $file_url = $path.$name;

                    $email = $_POST['email'];
                    $gameid = $_POST['dev_phim_id'];
                    $gamename = $_POST['dev_phim_name'];
                    $name_author =$_POST['dev_phim_author'];
                    $game_money = $_POST['dev_phim_money'];
                    $description = $_POST['dev_phim_des'];
                    $description_extra = $_POST['dev_phim_des_ex'];
                    $id_theloai = $_POST['dev_phim_theloai'];

                    $sql= "INSERT into develop_draft_phim(email, gameid, gamename, name_author, game_money, description, description_extra, image_url, file_url, id_theloai) values ('$email','$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$file_url','$id_theloai')";
                    $conn = openDB();
                    mysqli_query($conn, $sql); 
                }
        }
	
	?>
	<div class="header">
		<div class="row">
            <div class="col row">
                <a href="index.php">
                    <img class="logo" src="./pictures/logo.png" alt="logo">
                </a>
            </div>
            <div class="aaa">
                <?php
                    $userimg = '';

                    if (isset($_SESSION['user'])){

                        $userimg = $_SESSION['user'];

                        $sql5 = "SELECT * from image_avatar where userimage = '$userimg' ";
                        $result5 = mysqli_query($conn, $sql5);

                        $img_ava = '';
                        if(mysqli_num_rows($result5) > 0){
                            while ($row = $result5 -> fetch_assoc()) {
                                $img_ava = $row['image_url'];
                            }
                        }
                        echo '<p class="stylechao"> <img class="img-thumbnail" src="'.$img_ava.'"> Xin chào, '.$_SESSION['name'].'</p>';
                        echo '<p class="stylemoney"><i class="fas fa-money-bill-wave-alt"></i> '.$money.' VNĐ</p>';
                        echo '<a href="logout.php"><button class="loginn" type="submit">Đăng xuất</button></a>';
                    } else { 
                        echo '<a href="login.php"><button class="login" type="submit">Đăng nhập</button></a>';
                    }
                ?>
                
            </div>
        </div>
	</div>

	<div class="dev">
        
        <h1> Nơi dành cho developer</h1>
        <div class="row">
                <div class="col-lg-6">
                    <button data-toggle="collapse" class="btn btn-success" data-target="#trochoi">Ứng dụng</button>

                    <div id="trochoi" class="collapse">
                        <form class="form_user" method="POST" action="" enctype="multipart/form-data" >      
                        
                        <label for="email">Email: </label>
                        <input type="text" id="email" name="email" value="">
                                    <br>
                        <label for="dev_game_id">Id game: </label>
                        <input type="text" id="dev_game_id" name="dev_game_id" value="game00">
                                    <br>
                        <label for="dev_game_name">Tên game: </label>
                        <input type="text" id="dev_game_name" name="dev_game_name" value="">
                                    <br>
                        <label for="dev_game_author">Tác giả: </label>
                        <input type="text" id="dev_game_author" name="dev_game_author" value="">
                                    <br>
                        <label for="dev_game_money">Tiền: </label>
                        <input type="text" id="dev_game_money" name="dev_game_money" value="0 ₫">
                                    <br>
                        <label for="dev_game_des">Mô tả chính: </label>
                        <input type="text" id="dev_game_des" name="dev_game_des" value="">
                                    <br>   
                        <label for="dev_game_des_ex">Mô tả thêm: </label>
                        <input type="text" id="dev_game_des_ex" name="dev_game_des_ex" value="">
                                    <br>
                        <label for="uploadImage">Chọn hình đại diện: </label>
                        <input type="file" name="uploadImage">
                                    <br>
                        <label for="uploadFile">Chọn ứng dụng: </label>
                        <input type="file" name="uploadFile">
                                    <br>            
                        <label for="dev_game_theloai">Thể loại: </label>
                        <input type="text" id="dev_game_theloai" name="dev_game_theloai" value="">
                                    <br>
                        <input type="submit" name="submit" value="Gửi">
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <button data-toggle="collapse" class="btn btn-warning" data-target="#phim">Phim ảnh</button>

                    <div id="phim" class="collapse">
                            <form class="form_user" method="POST" action="" enctype="multipart/form-data" >      
                            
                            <label for="email">Email: </label>
                            <input type="text" id="email" name="email" value="">
                                        <br>
                            <label for="dev_phim_id">Id phim: </label>
                            <input type="text" id="dev_phim_id" name="dev_phim_id" value="movie00">
                                        <br>
                            <label for="dev_phim_name">Tên phim: </label>
                            <input type="text" id="dev_phim_name" name="dev_phim_name" value="">
                                        <br>
                            <label for="dev_phim_author">Tác giả: </label>
                            <input type="text" id="dev_phim_author" name="dev_phim_author" value="">
                                        <br>
                            <label for="dev_phim_money">Tiền: </label>
                            <input type="text" id="dev_phim_money" name="dev_phim_money" value="0 ₫">
                                        <br>
                            <label for="dev_phim_des">Mô tả chính: </label>
                            <input type="text" id="dev_phim_des" name="dev_phim_des" value="">
                                        <br>   
                            <label for="dev_phim_des_ex">Mô tả thêm: </label>
                            <input type="text" id="dev_phim_des_ex" name="dev_phim_des_ex" value="">
                                        <br>
                            <label for="uploadImage">Chọn hình phim: </label>
                            <input type="file" name="uploadImage">
                                        <br>
                            <label for="uploadFile">Chọn video: </label>
                            <input type="file" name="uploadFile">
                                        <br>            
                            <label for="dev_phim_theloai">Thể loại: </label>
                            <input type="text" id="dev_phim_theloai" name="dev_phim_theloai" value="">
                                        <br>
                            <input type="submit" name="SUBMIT" value="Gửi">
                            </form>
                    </div>
                </div>
        </div>
       
    </div>
</body>
</html>