<?php
    include './config.php';
    include './db.php';
    $conc = open_database();
    session_start();
    $conn = openDB();
    $ss_user = $_SESSION['user'];

    $sqld = "select * from account where username = '$ss_user'";
    $resultd = mysqli_query($conc,$sqld);

    if (mysqli_num_rows($resultd) > 0) {
        while ($row = $resultd->fetch_assoc()) {
            $money = $row['money'];
        }
    }
    $error = '';
    $ss_user = $_SESSION['user'];
    $sql = "select * from account where username = '$ss_user'";

    $conn = open_database();

    $ldata = mysqli_query($conn,$sql);
    $email='';
    $user='';

    if (mysqli_num_rows($ldata) > 0) {
        while ($row = $ldata->fetch_assoc()) {
            $email=$row['email'];
            $user= $row['username'];
        }
    }

    if (isset($_POST['submit'])) {
        $the = '';
        $gia = '';
        $maThe = $_POST['pin'];
        $sqld = "select * from donate where maThe = '$maThe'";

        $data = mysqli_query($conn,$sqld);
        if (mysqli_num_rows($data) > 0) {
            while ($row = $data->fetch_assoc()) {
                $the = $row['maThe'];
                $gia = $row['giaTien'];
            }
        }
        $sql= "select mathe from lich_su_nap_tien where mathe = '$maThe'";
        $checkthe = mysqli_query($conn, $sql);
        if(mysqli_num_rows($checkthe) == 0) {
            if ($maThe===$the) {
                $sql3 = "insert into lich_su_nap_tien values ('$user','$email','$maThe','$gia', now())";
                $data = mysqli_query($conn,$sql3);
                $sql4 = "update account set money= money + $gia where email = '$email'";
                $data = mysqli_query($conn,$sql4);
                $error = 'Nạp thành công '.$gia;
            }else{
                $error = 'Mã Thẻ không hợp lệ. Vui lòng nhập lại.';
            }
        }else{
            $error = 'Mã Thẻ đã được sử dụng. Vui lòng nhập lại.';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp tiền</title>
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
            <li><a class="cash-naptien" href="naptien.php"><button class="buttt" disabled="disabled"><i class="fas fa-money-check"></button></i>  Nạp tiền</a></li>
            <li><a class="home-naptien" href="index.php"><button class="bbt" disabled="disabled"><i class="fas fa-house-user"></button></i>  Trang chủ</a></li>
            <li><a class="apps" href="game_info.php"><button class="but" disabled="disabled"><i class="fas fa-th-large"></button></i>  Trò chơi</a></li>
            <li><a class="movie" href="movie_info.php"><button class="butt" disabled="disabled"><i class="fas fa-video"></button></i>  Phim</a></li>
            <li><a class="account" href="taikhoan.php"><button class="buutt" disabled="disabled"><i class="fas fa-user-circle"></button></i>  Tài khoản</a></li>

        </ul>
        <?php
        if(isset($_SESSION['user'])) {
            ?>
            <div class="main">
                <h1 class="text-center">Nạp tiền</h1>
                <form class="form_user" method="post" action="" enctype="multipart/form-data" >
                    <label for="email"><b>Email:</b></label>
                    <input type="email" class="form-control" id="email" name="email" value="<?=$email?>">
                    <br>
                    <label for="maThe"><b>Mã Thẻ:</b></label>
                    <input type="text" id="maThe" class="form-control" name="pin" value="">
                    <br>
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                    ?>
                    <input type="submit" name="submit" class="btn btn-success" value="Nạp">

                </form>
                <div>
                    <a href="view_naptien.php">Xem lịch sử nạp tiền.</a>
                </div>
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