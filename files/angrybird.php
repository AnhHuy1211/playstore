<?php 
	session_start();
	include 'xuly.php';
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
  	<script src="main.js"></script>
</head>
<body>
	<div class="header">
		<div class="row">
			<div class="col-lg-1">
				<a href="index.php">
					<img class="logo" src="./pictures/logo.png" alt="logo">
				</a>
			</div>
			<div class="col-lg-9">
				<a>
			    <input class="search-box" type="text" placeholder="Tìm kiếm">
			    <button class="search-button" type="submit"><i class="fa fa-search"></i>
				</button>
				</a>
			</div>
			<div class="col-lg-2">
                <?php
                    if (isset($_SESSION['user'])){
                        echo 'Xin chào, '.$_SESSION['name'];
                        echo '<a href="logout.php"><button class="login" type="submit">Đăng xuất</button></a>';
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
				<li><a class="apps-trochoi" href="trochoi.php"><i class="fa fa-delicious"></i>  Trò chơi</a></li>
  				<li><a class="home-trochoi" href="index.php"><i class="fa fa-home"></i>  Trang chủ</a></li>
  				<li><a class="movie" href="phim.php"><i class="fa fa-play-circle-o"></i>  Phim</a></li>
	  			<li><a class="account" href="taikhoan.php"><i class="fa fa-user-circle-o"></i>
				Tài khoản</a></li>
	  			<li><a class="cash" href="naptien.php"><i class="fa fa-money"></i>
				Nạp tiền</a></li>
			</ul>


			<div class="genshin-main">
				<div class="row">
					<div class="col-sm-4">
						<img src="./pictures/bird.png">
					</div>
					<div class="col-sm-8">
						<h2><span class="app-title">Angry Birds Friends</span></h2>
						<span class="app-name">Rovio Entertainment Corporation</span>		
						<span class="app-rate">
		                    <i class="fa fa-star"></i>
		                  	<i class="fa fa-star"></i>
		                    <i class="fa fa-star"></i>
		                    <i class="fa fa-star"></i>
		                    <i class="fa fa-star-o"></i>
		                    <i>1.058.933</i>
		                    <i class="fa fa-user"></i>
		                </span>

		                <button class="btn">
	               			
		          			<a href="upload/bird.png" download=""><i class="fa fa-download"></i>
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
		                    <img src="/pictures/bird1.jpg" />
		                </div>
		                <div class=" carousel-item ">
		                    <img src="/pictures/bird2.jpg" />
		                </div>
		                <div class="carousel-item">
		                    <img src="/pictures/bird3.jpg" />
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
		        	<p class="noidung">Enough with the boring golf games! Time for some 	thrilling excitement without the wait!<br>
						Enjoy the fast and easy golf battle with maximum of 8 players!
						<br>
						Are you ready to hit the green at EXTREME GOLF?
					<br></p>
		        	<button aria-expanded="false" class="btn btn-primary" id="button" data-toggle="collapse" data-target="#docthem" >Đọc thêm</button>
            		<div class="collapse mt-4" id="docthem">
						<p class="noidung">
						● Real-time Multiplayer Golf Battle<br>
						- A fast-paced real-time round of golf where you don't have to wait for others!<br>
						- Hit the green with golfers around the world through instant matchmaking!<br>
						- Rise up the ranks and become the king of golf!
						<br>
						● Simple Controls! Nothing could be easier! Easy and swift matches!
						<br>- Aim! Swing! It's that easy! Find the optimal direction and power. Then, simply pull and let go and to land your ball on the fairway!
						<br>- Golf and life is all about the timing! Pull and let go at the perfect timing for the perfect putt.
						<br>- Don't worry if you are new to golf. With these simple controls, hitting a Birdie, Albatross, or a Hole-In-One won't only be a dream!
						<br>
						<br>● Golf clubs and balls are your best friends on the field!
						<br>- Drivers, Woods, Long Irons, Short Irons, Rough Irons, Wedges, Sand Wedges, and Putters. We've got everything you need!
						<br>- Master the beautiful Courses with various Clubs and unique Balls!
						<br>- Build your very own Club by upgrading its Power, Accuracy, Top Spin, Back Spin, etc.!
						<br>- Improve your Club to perfection through Club Fitting!
						<br>
						</p>
					</div>
					<div class="comment">
            			<h3>Bình luận</h3>
            			<form role="form">
                			<div class="form-group">
                    			<textarea class="form-control" rows="2"></textarea>
                			</div>
                			<button type="submit" class="btn btn-success">Đăng</button>
            			</form>
        			</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>