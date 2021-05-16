<?php
	include './config.php';
    include './db.php';
	$conc = open_database();
	session_start();
	$conn = openDB();

	$sql="select * from all_game_free";
	$result = mysqli_query($conn, $sql);
	$sqln = "select * from all_game_not_free";
	$resultn = mysqli_query($conn,$sqln);

    $sql3="select * from theloaigame";
    $result3 = mysqli_query($conn, $sql3);
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

						    if (mysqli_num_rows($resultd) > 0) {
						        while ($row = $resultd->fetch_assoc()) {
						            $money = $row['money'];
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
	<div>
		<div>
		<ul>
			<li><a class="apps-trochoi" href="game_info.php"><button class="but" disabled="disabled"><i class="fas fa-th-large"></button></i>  Trò chơi</a></li>
	  		<li><a class="home-trochoi" href="index.php"><button class="bbt" disabled="disabled"><i class="fas fa-house-user"></button></i>  Trang chủ</a></li>
	  		<li><a class="movie" href="movie_info.php"><button class="butt" disabled="disabled"><i class="fas fa-video"></button></i>  Phim</a></li>
	  		<li><a class="account" href="taikhoan.php"><button class="buutt" disabled="disabled"><i class="fas fa-user-circle"></button></i>  Tài khoản</a></li>
			<li><a class="cash" href="naptien.php"><button class="buttt" disabled="disabled"><i class="fas fa-money-check"></button></i>  Nạp tiền</a></li>	
		</ul>
			<div class="main">
				<div class="dropdown">
					<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
				   		Thể loại
				    </button>
				    <div class="dropdown-menu">
				    	<?php
				    		if (mysqli_num_rows($result3) > 0) {
		                        while ($row = $result3->fetch_assoc()) {
						    	echo'<a class="dropdown-item" href="theloaigame.php?id='.$row['id'].'">'.$row['theloai'].'</a>';
						    	}
							}
				    	?>
				    </div>
				</div>
				<h1><a href="game_info.php">Trò chơi miễn phí chơi nhiều</a></h1>
				<div class="row">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
	                	<div class="game">
		                    <a href="./all_game_free.php?gameid='.$row['gameid'].'">
		                    	<img src="'.$row['image_url'].'">
		                    </a>
		                    <div class="game-information">
		                        <span class="game-title"><a href="./all_game_free.php?gameid='.$row['gameid'].'">'.$row['gamename'].'</a></span>
		                        <span class="game-author"><a href="./all_game_free.php?gameid='.$row['gameid'].'">'.$row['name_author'].'</a></span>
		                        <span class="game-rate">
		                        	<i class="fa fa-star"></i>
		                        	<i class="fa fa-star"></i>
		                        	<i class="fa fa-star"></i>
		                        	<i class="fa fa-star"></i>
		                        	<i class="fa fa-star-half-empty"></i>
		                        </span>
		                        <span class="money"><a href="./all_game_free.php?gameid='.$row['gameid'].'">'.$row['game_money'].'</a></span>
		                    </div>
	                	</div>
	            	</div>';
                        }
                    }
                    ?>
	            	</div>
				<h1><a href="game_info.php">Trò chơi mua nhiều</a></h1>
				<div class="row">
                    <?php
                    if (mysqli_num_rows($resultn) > 0) {
                        while ($row = $resultn->fetch_assoc()) {
                            echo '<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
	                	<div class="game">
		                    <a href="./all_game_not_free.php?gameid='.$row['gameid'].'">
		                    	<img src="'.$row['image_url'].'">
		                    </a>
		                    <div class="game-information">
		                        <span class="game-title"><a href="./all_game_not_free.php?gameid='.$row['gameid'].'">'.$row['gamename'].'</a></span>
		                        <span class="game-author"><a href="./all_game_not_free.php?gameid='.$row['gameid'].'">'.$row['name_author'].'</a></span>
		                        <span class="game-rate">
		                        	<i class="fa fa-star"></i>
		                        	<i class="fa fa-star"></i>
		                        	<i class="fa fa-star"></i>
		                        	<i class="fa fa-star"></i>
		                        	<i class="fa fa-star-half-empty"></i>
		                        </span>
		                        <span class="money"><a href="./all_game_not_free.php?gameid='.$row['gameid'].'">'.$row['game_money'].'</a></span>
		                    </div>
	                	</div>
	            	</div>';
                        }
                    }
                    ?>

	            	</div>					
				</div>
		</div>
	</div>
</body>
</html>