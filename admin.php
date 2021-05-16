<?php
	include './config.php';
	include './db.php';
    $conc = open_database();

	session_start(); 
	$conn = openDB();

	$sql = "select * from develop_draft";
	$result = mysqli_query($conn, $sql);

	if(isset($_POST['admin_duyet'])){
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
		if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
            	$email = $row['email'];
            	$gameid = $row['gameid'];
        		$gamename = $row['gamename'];
        		$name_author =$row['name_author'];
        		$game_money = $row['game_money'];
        		$description = $row['description'];
        		$description_extra = $row['description_extra'];
        		$image_url = $row['image_url'];
        		$file_url = $row['file_url'];
        		$id_theloai =$row['id_theloai'];
            }
        }

        sendDeveloper($email);
        if($game_money='0 ₫') {
        	$sql1= "INSERT into all_game(gameid, gamename, name_author, game_money, description, description_extra, image_url, file_url, id_theloai) values ('$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$file_url','$id_theloai')";
	        mysqli_query($conn, $sql1);
	        $sql1= "INSERT into all_game_free(gameid, gamename, name_author, game_money, description, description_extra, image_url, file_url, id_theloai) values ('$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$file_url','$id_theloai')";
	        mysqli_query($conn, $sql1);
	        $sql1= "INSERT into trangchu(gameid, gamename, name_author, game_money, description, description_extra, image_url, id_theloai) values ('$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$id_theloai')";
	        mysqli_query($conn, $sql1);
        }
        else{
	        $sql1= "INSERT into all_game(gameid, gamename, name_author, game_money, description, description_extra, image_url, file_url, id_theloai) values ('$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$file_url','$id_theloai')";
	        mysqli_query($conn, $sql1);
	        $sql1= "INSERT into all_game_not_free(gameid, gamename, name_author, game_money, description, description_extra, image_url, file_url, id_theloai) values ('$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$file_url','$id_theloai')";
	        mysqli_query($conn, $sql1);
	        $sql1= "INSERT into trangchu(gameid, gamename, name_author, game_money, description, description_extra, image_url, id_theloai) values ('$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$id_theloai')";
	        mysqli_query($conn, $sql1);
        }

        $sql3 = "delete from develop_draft where gameid = '$gameid'";
        mysqli_query($conn, $sql3);

        header('location: admin.php');
	}
	if(isset($_POST['admin_huy'])){
		$gameid = '';
		$email = '';
		if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
            	$email = $row['email'];
            	$gameid = $row['gameid'];
            }
        }
        unsendDeveloper($email);
		$sql3 = "delete from develop_draft where gameid = '$gameid'";
        mysqli_query($conn, $sql3);
        header('location: admin.php');
	}

    $sql1= "select * from develop_draft_phim";
    $result1 = mysqli_query($conn, $sql1);
    if(isset($_POST['phim_duyet'])){
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
        if (mysqli_num_rows($result1) > 0) {
            while ($row = $result1->fetch_assoc()) {
                $email = $row['email'];
                $gameid = $row['gameid'];
                $gamename = $row['gamename'];
                $name_author =$row['name_author'];
                $game_money = $row['game_money'];
                $description = $row['description'];
                $description_extra = $row['description_extra'];
                $image_url = $row['image_url'];
                $file_url = $row['file_url'];
                $id_theloai =$row['id_theloai'];
            }
        }

        sendDeveloper($email);
        if($game_money='0 ₫') {
            $sql1= "INSERT into all_movie(movie_id, movie_name, movie_author, movie_money, movie_description, movie_description_extra, image_url, file_url, id_theloai) values ('$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$file_url','$id_theloai')";
            mysqli_query($conn, $sql1);
            $sql1= "INSERT into all_movie_free(movie_id, movie_name, movie_author, movie_money, movie_description, movie_description_extra, image_url, file_url, id_theloai) values ('$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$file_url','$id_theloai')";
            mysqli_query($conn, $sql1);
            $sql1= "INSERT into trangchu(gameid, gamename, name_author, game_money, description, description_extra, image_url, id_theloai) values ('$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$id_theloai')";
            mysqli_query($conn, $sql1);
        }
        else{
           $sql1= "INSERT into all_movie(movie_id, movie_name, movie_author, movie_money, movie_description, movie_description_extra, image_url, file_url, id_theloai) values ('$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$file_url','$id_theloai')";
            mysqli_query($conn, $sql1);
            $sql1= "INSERT into all_movie_not_free(movie_id, movie_name, movie_author, movie_money, movie_description, movie_description_extra, image_url, file_url, id_theloai) values ('$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$file_url','$id_theloai')";
            mysqli_query($conn, $sql1);
            $sql1= "INSERT into trangchu(gameid, gamename, name_author, game_money, description, description_extra, image_url, id_theloai) values ('$gameid','$gamename','$name_author','$game_money','$description','$description_extra','$image_url','$id_theloai')";
            mysqli_query($conn, $sql1);
        }

        $sql3 = "delete from develop_draft_phim where gameid = '$gameid'";
        mysqli_query($conn, $sql3);

        header('location: admin.php');
    }
    if(isset($_POST['phim_huy'])){
        $gameid = '';
        $email = '';
        if (mysqli_num_rows($result1) > 0) {
            while ($row = $result1->fetch_assoc()) {
                $email = $row['email'];
                $gameid = $row['gameid'];
            }
        }
        unsendDeveloper($email);
        $sql3 = "delete from develop_draft_phim where gameid = '$gameid'";
        mysqli_query($conn, $sql3);
        header('location: admin.php');
    }

    if(isset($_POST['add_tl'])){
        if (isset($_POST['add_game']) && isset($_POST['add_game_mota'])) {
            $add_game = $_POST['add_game'];
            $add_mota = $_POST['add_game_mota'];

            $sql2 = "INSERT into  theloaigame(theloai, tieude) values ('$add_game','$add_mota')";
            mysqli_query($conn, $sql2);
        }
        
    }
    if(isset($_POST['add_phim'])){
        if (isset($_POST['add_phim_tl']) && isset($_POST['add_motaphim'])) {
            $add_game = $_POST['add_phim_tl'];
            $add_mota = $_POST['add_motaphim'];

            $sql2 = "INSERT into  theloaiphim(theloai, tieude) values ('$add_game','$add_mota')";
            mysqli_query($conn, $sql2);
        }
        
    }

    if(isset($_POST['change_tl'])){
        if (isset($_POST['change_game']) && isset($_POST['gametl'])) {
            $change_game = $_POST['change_game'];
            $chon_gametl = $_POST['gametl'];



            $check = '';
            $sql2 = "select * from theloaigame where theloai = '$chon_gametl'";
            $result2 = mysqli_query($conn, $sql2);

            if(mysqli_num_rows($result2)>0){
                while($row = $result2->fetch_assoc()){
                    $check = $row['theloai'];
                }
            }
            if($chon_gametl === $check){
                $sql3 = "UPDATE theloaigame set theloai = '$change_game' where theloai = '$chon_gametl'";
                mysqli_query($conn, $sql3);
            }
        } 
    }
    if(isset($_POST['change_tl_phim'])){
            if (isset($_POST['change_phim']) && isset($_POST['phimtl'])) {
                $change_game = $_POST['change_phim'];
                $chon_gametl = $_POST['phimtl'];

                $check = '';
                $sql2 = "select * from theloaiphim where theloai = '$chon_gametl'";
                $result2 = mysqli_query($conn, $sql2);

                if(mysqli_num_rows($result2)>0){
                    while($row = $result2->fetch_assoc()){
                        $check = $row['theloai'];
                    }
                }
                if($chon_gametl === $check){
                    $sql3 = "UPDATE theloaiphim set theloai = '$change_game' where theloai = '$chon_gametl'";
                    mysqli_query($conn, $sql3);
                }
            } 
    }

    if(isset($_POST['delete_tl'])){
        if(isset($_POST['del_game'])){
            $del_game = $_POST['del_game'];

            $sql2 = "DELETE from theloaigame where theloai = '$del_game'";
            mysqli_query($conn, $sql2);
        }
    }
    if(isset($_POST['delete_tl_phim'])){
        if(isset($_POST['del_phim'])){
            $del_game = $_POST['del_phim'];

            $sql2 = "DELETE from theloaiphim where theloai = '$del_game'";
            mysqli_query($conn, $sql2);
        }
    }
    $code = 'k';
    if(isset($_POST['submit_mathe'])){
        if(isset($_POST['soluongthe']) && isset($_POST['menhgia'])){
            $soluong = $_POST['soluongthe'];
            $gia = $_POST['menhgia'];

            for($i = 0; $i <= $soluong; $i++ ){
                $rand = $code.random_int(0, 9999999999);
                $sql2 = "INSERT into donate(maThe, giaTien) values ('$rand','$gia') ";
                mysqli_query($conn, $sql2);
            }
        }
    }

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
	<div class="header">
		<div class="row">
            <div class="col row">
                <a href="admin.php">
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

	<div class="admin">    
        <div>
            <h1> Ứng dụng đang chờ duyệt</h1>
            <form method="post" action=""> 
                <div class="row">
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="game">
                                    img src="'.$row['image_url'].'">
                                        <div class="game-information">
                                            <span class="game-title"><h1 class="admin">'.$row['gamename'].'</h1></span>
                                            <span class="game-author"><p>'.$row['name_author'].'</p></span>
                                            <span class="admin_money">'.$row['game_money'].'</span>
                                            <br>
                                            <span> 
                                                <button class="btn btn-success" type="submit" name="admin_duyet"><i class="fa fa-check"></i></button>
                                                <button class="btn btn-danger" name="admin_huy" type="submit"><i class="fa fa-close"></i></button>
                                            </span>
                                        </div>
                                </div>
                                </div>';
                            }
                        }
                     ?>
                </div>
            </form>
            <form method="post" action=""> 
                    <div class="row">
                        <?php
                            if (mysqli_num_rows($result1) > 0) {
                                while ($row = $result1->fetch_assoc()) {
                                    echo '<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                                        <div class="game">
                                        <img src="'.$row['image_url'].'">
                                        <div class="game-information">
                                            <span class="game-title"><h1 class="admin">'.$row['gamename'].'</h1></span>
                                            <span class="game-author"><p>'.$row['name_author'].'</p></span>
                                            <span class="admin_money">'.$row['game_money'].'</span>
                                            <br>
                                            <span> 
                                                <button class="btn btn-success" type="submit" name="phim_duyet"><i class="fa fa-check"></i></button>
                                                <button class="btn btn-danger" name="phim_huy" type="submit"><i class="fa fa-close"></i></button>
                                            </span>
                                        </div>
                                        </div>
                                        </div>';
                                 }
                            }
                        ?>
                    </div>
            </form>
        </div>

        <div>
            <h1>Quản lý thể loại</h1>
            <button data-toggle="collapse" class="btn btn-warning" data-target="#trochoitl">Trò chơi</button>
            <div id="trochoitl" class="collapse">
                <form method="post" action="">
                    <label for="add_game"><b>Thêm thể loại game: </b></label>
                    <input type="text" name="add_game">
                    <br>
                    <label for="add_game_mota"><b>Thêm mô tả thể loại: </b></label>
                    <input type="text" name="add_game_mota">
                    <br>
                    <input type="submit" name="add_tl">
                </form>
                <form method="post">
                    <span><b>Hiện có các thể loại:</b></span>
                    <?php
                        $sql2 = "select * from theloaigame";
                        $result2 = mysqli_query($conn, $sql2);
                        
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                
                                echo '
                                <ul>
                                    <li>'.$row['theloai'].'</li>
                                </ul>
                                ';
                            }
                        }
                    ?>
                    <label for="gametl"><b>Chọn tên thể loại: </b></label>
                    <input type="text" name="gametl">
                    <br>
                    <label for="change_game"><b>Đổi tên thể loại: </b></label>
                    <input type="text" name="change_game">
                    <br>
                    <input type="submit" name="change_tl">
                </form>
                <form method="post">
                    <label for="del_game"><b>Xoá thể loại: </b></label>
                    <input type="text" name="del_game">
                    <br>
                    <input type="submit" name="delete_tl">
                </form>
            </div>
            <button data-toggle="collapse" class="btn btn-info" data-target="#phim">Phim ảnh</button>
            <div id="phim" class="collapse">
                <form method="post" action="">
                    <label for="add_phim_tl"><b>Thêm thể loại phim: </b></label>
                    <input type="text" name="add_phim_tl">
                    <br>
                    <label for="add_motaphim"><b>Thêm mô tả thể loại: </b> </label>
                    <input type="text" name="add_motaphim">
                    <br>
                    <input type="submit" name="add_phim">
                </form>
                <form method="post">
                    <span><b>Hiện có các thể loại:</b></span>
                    <?php
                        $sql2 = "select * from theloaiphim";
                        $result2 = mysqli_query($conn, $sql2);
                        
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                
                                echo '
                                <ul>
                                    <li>'.$row['theloai'].'</li>
                                </ul>
                                ';
                            }
                        }
                    ?>
                    <label for="phimtl"><b>Chọn tên thể loại:</b> </label>
                    <input type="text" name="phimtl">
                    <br>
                    <label for="change_phim"><b>Đổi tên thể loại: </b></label>
                    <input type="text" name="change_phim">
                    <br>
                    <input type="submit" name="change_tl_phim">
                </form>
                <form method="post">
                    <label for="del_phim"><b>Xoá thể loại: </b></label>
                    <input type="text" name="del_phim">
                    <br>
                    <input type="submit" name="delete_tl_phim">
                </form>
            </div>

        </div>
        <div>
            <h1> Tạo mã thẻ </h1>
            <button data-toggle="collapse" class="btn btn-danger" data-target="#mathe">Tạo mã thẻ</button>
            <div id="mathe" class="collapse">
                <form method="post">
                    <label><b>Số lượng thẻ: </b></label>
                    <input type="text" name="soluongthe">
                    <br>
                    <label><b>Mệnh giá: </b></label>
                    <input type="text" name="menhgia">
                    <br>
                    <input type="submit" name="submit_mathe">
                </form>
            </div>
            <button data-toggle="collapse" class="btn btn-success" data-target="#hienmathe">Hiện mã thẻ</button>
            <div id="hienmathe" class="collapse">
                <?php 
                    $sql = "select * from lich_su_nap_tien";
                    $conn = open_database();
                    $ldata = mysqli_query($conn,$sql);

                    $sql1 = "select * from donate";
                    $result1 = mysqli_query($conn, $sql1);


                ?>
                <div class="history_donate">
                    <table>
                        <thead>
                        <tr>
                            <th>Mã thẻ</th>
                            <th>Số tiền </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $result1->fetch_assoc()) :?>
                            <tr>
                                <td><?php echo $row['maThe']; ?></td>
                                <td><?php echo $row['giaTien']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                    <table>
                        <thead>
                        <tr>
                            <th>Mã thẻ đã nạp</th>
                            <th>Số tiền </th>
                            <th>Ngày nạp </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $ldata->fetch_assoc()) :?>
                            <tr>
                                <td><?php echo $row['maThe']; ?></td>
                                <td><?php echo $row['soTien']; ?></td>
                                <td><?php echo $row['ngayNapTien']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>
</html>