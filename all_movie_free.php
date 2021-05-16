<?php
    include './config.php';
    include './db.php';
    $conc = open_database();
    session_start();
    $conn = openDB();


    $movie_id = $_GET['movie_id'];
    $sqlm="select * from all_movie where movie_id='$movie_id'";
    $resultm = mysqli_query($conn, $sqlm);
    $movie_name='';
    $des ='';
    $des_extra = '';
    $name_author = '';
    $money = '';
    $id = '';
    if (mysqli_num_rows($resultm) > 0) {
        while ($row = $resultm->fetch_assoc()) {
            $movie_name = $row['movie_name'];
            $des = $row['movie_description'];
            $des_extra = $row['movie_description_extra'];
            $name_author = $row['movie_author'];
            $money = $row['movie_money'];
            $id = $row['id_theloai'];
        }
    }
    $sql1="select * from phimcomment where idcomment='$movie_id'";
    $result1 = mysqli_query($conn, $sql1);

    $sql2="select * from phimimage where image_id='$movie_id'";
    $result2 = mysqli_query($conn, $sql2);
    if(isset($_POST['submit'])){
        if(isset($_SESSION['user'])){

                $usercomment = $_SESSION['user'];
                $cmt = $_POST['uploadComment'];
                $rating = $_POST['rating'];

                $check_cmt = '';
                $check_rate = '';
                $sql1="select * from phimcomment where idcomment = '$usercomment'";
                $result1 = mysqli_query($conn, $sql1);
   
                
                
                $sql2 = "INSERT into phimcomment(usercomment, idcomment, comments, date_time, rating) values('$usercomment','$movie_id','$cmt',now(),'$rating')";
                    mysqli_query($conn, $sql2);
                    
                $sql3 = "UPDATE phimcomment set usercomment = '$usercomment' and idcomment = '$movie_id' and comments = $cmt and date_time = now() and rating = '$rating'";
                    mysqli_query($conn, $sql3);

                    header('refresh:0');
                
        }
        else {
            $error = 'Vui lòng đăng nhập trước khi bình luận!';
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
    <script src="https://kit.fontawesome.com/1f93e99ed1.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1f93e99ed1.js" crossorigin="anonymous"></script>
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
                            $ss_user = $_SESSION['user'];
                            $sqld = "select * from account where username = '$ss_user'";
                            $resultd = mysqli_query($conc,$sqld);
                            $moneys = '';

                            if (mysqli_num_rows($resultd) > 0) {
                                while ($row = $resultd->fetch_assoc()) {
                                    $moneys = $row['money'];
                                }
                            }
                        echo '<p class="stylechao"> <img class="img-thumbnail" src="'.$img_ava.'"> Xin chào, '.$_SESSION['name'].'</p>';
                        echo '<p class="stylemoney"><i class="fas fa-money-bill-wave-alt"></i> '.$moneys.' VNĐ</p>';
                        echo '<a href="logout.php"><button class="loginn" type="submit">Đăng xuất</button></a>';
                    } else { 
                        echo '<a href="login.php"><button class="login" type="submit">Đăng nhập</button></a>';
                    }
                ?>
                
            </div>
    </div>
</div>
<div>
    <div>
        <ul>
            <li><a class="movie-phim" href="movie_info.php"><button class="butt" disabled="disabled"><i class="fas fa-video"></button></i>  Phim</a></li>
            <li><a class="home-phim" href="index.php"><button class="bbt" disabled="disabled"><i class="fas fa-house-user"></button></i>  Trang chủ</a></li>
            <li><a class="apps" href="game_info.php"><button class="but" disabled="disabled"><i class="fas fa-th-large"></button></i>  Trò chơi</a></li>
            <li><a class="account" href="taikhoan.php"><button class="buutt" disabled="disabled"><i class="fas fa-user-circle"></button></i>  Tài khoản</a></li>
            <li><a class="cash" href="naptien.php"><button class="buttt" disabled="disabled"><i class="fas fa-money-check"></button></i>  Nạp tiền</a></li>
        </ul>

        <div class="genshin-main">
            <div class="row">
                <div class="col-sm-4">
                <?php 
                            if (mysqli_num_rows($result2) > 0) {
                                while ($row = $result2->fetch_assoc()){
                                    echo '<img src='.$row['image_url'].'>';
                                }
                            }
                        ?>
                </div>
                <div class="col-sm-8">
                    <h2><span class="app-title"><?= $movie_name?> </span></h2>
                    <span class="app-name">
                        <a href="theloaiphim.php?id=<?= $id ?>"><?= $name_author ?></a>
                    </span>
                    <span class="app-rate">
		                    <i class="fa fa-star"></i>
		                  	<i class="fa fa-star"></i>
		                    <i class="fa fa-star"></i>
		                    <i class="fa fa-star"></i>
		                    <i class="fa fa-star-half-empty"></i>
		                    <i>1.001.121</i>
		                    <i class="fa fa-user"></i>
		                    <span class="money"><?= $money?></span>
		                </span>
                    <button class="btn">
                        <?php
                        $uid = uniqid();
                        ?>
                        <a href="download.php?fileId=<?= $uid ?>"><i class="fa fa-download"></i>
                            Tải</a>
                    </button>

                </div>
            </div>

            <div>
                <div id="demo" class="img_slide carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                    </ul>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./pictures/gen1.jpg" />
                        </div>
                        <div class=" carousel-item ">
                            <img src="./pictures/gen2.jpg" />
                        </div>
                        <div class="carousel-item">
                            <img src="./pictures/gen3.jpg" />
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
            <div class="nd">
                <p class="noidung"><?= $des?><br></p>
                <button aria-expanded="false" class="btn btn-primary" id="button" data-toggle="collapse" data-target="#docthem" >Đọc thêm</button>
                <div class="collapse mt-4" id="docthem">
                    <p class="noidung"><?= $des_extra?></p>
                </div>
                <div class="comment">
                    <h3>Bình luận</h3>
                    <form role="form" method="post">
                        <div class="form-group">
                            <textarea class="form-control" rows="2" name="uploadComment"></textarea>
                            <h3>Đánh giá</h3>
                            <input type="number" min="0" max="10" name="rating" value="">/10
                        </div>
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        ?>
                        <button type="submit" name="submit" class="btn btn-success">Đăng</button>

                    </form>
                    <div class="userComments">
                        <div class="comment">
                            <?php
                                    if (mysqli_num_rows($result1) > 0) {
                                        while ($row = $result1->fetch_assoc()) {
                                            echo'           
                                                <div class = "media border border-dark bg-white p-3"> 
                                     
                                                    <div class= "media-body">
                                                        <h5>Tên: '.$row['usercomment'].' <small><i>Ngày đăng: '.$row['date_time'].'</i></small></h5>    
                                                        <p>Đánh giá: '.$row['rating'].'/10</p>
                                                         <p>Bình luận: '.$row['comments'].'</p>
                                                    </div>
                                                </div>

                                             ';
                                         }    
                                     }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>