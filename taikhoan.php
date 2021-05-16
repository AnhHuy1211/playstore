<?php
    include './config.php';
    include './db.php';

    
    session_start();
    $conn = openDB();
    $conc = open_database();

    $ss_user = $_SESSION['user'];
    $money = '';
    $sqld = "select * from account where username = '$ss_user'";
    $resultd = mysqli_query($conc,$sqld);

    if (mysqli_num_rows($resultd) > 0) {
        while ($row = $resultd->fetch_assoc()) {
            $money = $row['money'];
        }
    }
    

    $ss_user = $_SESSION['user'];
    $sql = "select * from account where username = '$ss_user'";

    $conn = open_database();

    $ldata = mysqli_query($conn,$sql);
    $email='';
    $first = '';
    $last='';
    $pass='';
    $user='';
    if (mysqli_num_rows($ldata) > 0) {
        while ($row = $ldata->fetch_assoc()) {
            $email=$row['email'];
            $user= $row['username'];
            $first = $row['firstname'];
            $last = $row['lastname'];
            $pass = $row['password'];
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
    <script src="https://kit.fontawesome.com/1f93e99ed1.js" crossorigin="anonymous"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" type="text/css" href="style.css">
  	<script src="main.js"></script>
</head>
<body>
	<div class="header">
		<div class="row">
            <div class="col row">
                <a href="index.php">
                    <img class="logo" src="./pictures/logo.png" alt="logo">
                </a>
                <div>
                    <div>
                        <input class="search-input text-dark" type="text" name="search-result" onkeyup="search()" placeholder=" Search...">
                        <ul class="list-group search-result-list">
                        </ul>
                    </div>
                </div>
                <div class="search-icon text-center" oninput="enableSearchBox()"><i class="fas fa-search"></i></div>
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
	<div class="body">
		<div>
			<ul>
                <li><a class="account-taikhoan" href="taikhoan.php"><button class="buutt" disabled="disabled"><i class="fas fa-user-circle"></button></i>  Tài khoản</a></li>
                <li><a class="home-taikhoan" href="index.php"><button class="bbt" disabled="disabled"><i class="fas fa-house-user"></button></i>  Trang chủ</a></li>
                <li><a class="apps" href="game_info.php"><button class="but" disabled="disabled"><i class="fas fa-th-large"></button></i>  Trò chơi</a></li>
                <li><a class="movie" href="movie_info.php"><button class="butt" disabled="disabled"><i class="fas fa-video"></button></i>  Phim</a></li>
                <li><a class="cash" href="naptien.php"><button class="buttt" disabled="disabled"><i class="fas fa-money-check"></button></i>  Nạp tiền</a></li>
            </ul>
            <?php
            if(isset($_SESSION['user'])) {
                ?>
                

                <div class="main">
                    <h1>Cập Nhật Thông Tin Cá Nhân</h1>
                    <form class="form_user" method="post" action="" enctype="multipart/form-data" >

                        <div class="form-group">
                            <label for="username">Họ:</label>
                            <div ><input type="text" id="username" name="first" value="<?=$first?>"></div>
                        </div>
                        <div class="form-group">
                            <label for="username">Tên:</label>
                            <div><input type="text" id="username" name="last"value="<?=$last?>"></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Đổi mật khẩu:</label>
                            <div ><input type="password" id="password" name="password"></div>
                        </div>
                        <p>Cập nhật ảnh đại diện.</p>

                        <input type="file" name="uploadImage">
                        <br>
                        <br>
                        <input type="submit" name="submit" value="Gửi">
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                            if(isset($_POST['submit'])) {
                                change_name($email, $_POST['first'], $_POST['last']);
                                $first = $_POST['first'];
                                $last =$_POST['last'];

                                $_SESSION['name']= $_POST['first']." ".$_POST['last'];
                                if(strlen($_POST['password']) != 0) {
                                    change_Password($_POST['password'], $email);
                                }
                                if($_FILES['uploadImage']['name'] != NULL){
                                    if($_FILES['uploadImage']['type'] == "image/jpeg" || $_FILES['uploadImage']['type'] == "image/png"){      
                                        $path = "images/"; 
                                        $tmp_name = $_FILES['uploadImage']['tmp_name'];
                                        $name = $_FILES['uploadImage']['name'];          
                                        
                                        move_uploaded_file($tmp_name, $path.$name);
                                        $image_url = $path.$name; 

                                        $sql = "UPDATE image_avatar 
                                                SET image_url = '$image_url'
                                                WHERE userimage = '$ss_user'";    
                                        $smt = mysqli_query($conn, $sql);  

                                        header("refresh:0");
      
                                    }
                                    
                                                                            
                                }
                                ?>
                                <script type="text/javascript">
                                    window.location.href = './taikhoan.php';
                                </script>
                                <?php
                                
                            }  
                        ?>
                    </form>
                </div>
                <?php
            }
            else{
            header('location: login.php');
        }
            ?>
		</div>
	</div>
</body>
</html>