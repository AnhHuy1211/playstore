<?php
    include './config.php';
    include './db.php';
    session_start();
    $conn = openDB();

    $conc = open_database();
    $money = '';
    



    $ss_user = $_SESSION['user'];
    $sql = "select * from lich_su_nap_tien where username = '$ss_user'";

    $conn = open_database();

    $ldata = mysqli_query($conn,$sql);
    $user='';
    $email='';
    $mathe = '';
    $sotien = '';
    $ngay = '';


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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.9.0/css/all.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
                        $sql2 = "SELECT * from account where username = '$ss_user'";
                        $result2 = mysqli_query($conn, $sql2);
                         if(mysqli_num_rows($result2) > 0){
                            while ($row = $result2-> fetch_assoc()) {
                                $money = $row['money'];
                            }
                        }

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
    </div>
    <div class="history_donate">
        <table>
            <thead>
            <tr>
                <th>Username </th>
                <th>Email </th>
                <th>Mã Thẻ </th>
                <th>Số Tiền </th>
                <th>Ngày Nạp </th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $ldata->fetch_assoc()) :?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['maThe']; ?></td>
                    <td><?php echo $row['soTien']; ?></td>
                    <td><?php echo $row['ngayNapTien']; ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
