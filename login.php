<?php 
    session_start();
    require_once('db.php');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="main.js"></script>
</head>
<body class="bg-login">
    <?php
        $user = '';
        $pass = '';
        $error = '';

        if (isset($_POST['user']) && isset($_POST['pass'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];

            if (empty($user)) {
            $error = 'Vui lòng nhập tài khoản';
            }
            else if (empty($pass)) {
                $error = 'Vui lòng nhập mật khẩu';
            }
            else if (strlen($pass) < 6) {
                $error = 'Mật khẩu phải có ít nhất 6 ký tự';
            }
            else{ 
                if($user === 'developer' && $pass === '123123'){
                    $result = login($user, $pass);
                    $data = $result['data'];
                    $_SESSION['user'] = $user;
                    $_SESSION['name'] = $data['firstname'].' '.$data['lastname'];
                    header('location: developer.php');
                }
                else if($user === 'admin' && $pass === '123123'){
                    $result = login($user, $pass);
                    $data = $result['data'];
                    $_SESSION['user'] = $user;
                    $_SESSION['name'] = $data['firstname'].' '.$data['lastname'];
                    header('location: admin.php');
                }
                else{
                    $result = login($user, $pass);
                    if($result['code'] == 0){
                        $data = $result['data'];
                        $_SESSION['user'] = $user;
                        $_SESSION['name'] = $data['firstname'].' '.$data['lastname'];
                        header('Location: taikhoan.php');
                        exit();
                    }
                    else{
                        $error = $result['error'];
                    }

                }
            }

        }
    ?>
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col">
                <form onsubmit="return check_login()" action="" method ="post">
                    <div class = "login-form">
                        <h4>ĐĂNG NHẬP</h4>
                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <div class="input-container">
                                <i class="fa fa-user icon"></i>
                                <input type="text" class="control-form" id="user" name="user" placeholder=" Tài khoản" value="<?= $user?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <div class="input-container">
                                <i class="fa fa-key icon"></i>
                                <input type="password" name="pass" class="control-form" id="password" placeholder="Mật khẩu" value="<?= $pass ?>">
                            </div>
                            <div>
                                <label>
                                    <input <?= isset($_POST['remember']) ? 'checked' : '' ?> type="checkbox" name="remember" id="remember">  Nhớ mật khẩu
                                </label>
                                <?php
                                        if (!empty($error)) {
                                        echo "<div class='alert alert-danger'>$error</div>";
                                        }
                                    ?>
                                <button class ="bttn" type="submit">Đăng nhập</button>
                            </div>
                            <div class="hr"></div>

                        
                        </div>
                    </div>
                </form>
                    <div>
                        <a href="register.php" class="btf"><button class ="bt">Đăng ký</button></a>
                    </div>
                    <div>
                        <span class="psw">
                        <a href="forgot.php" class="pswf">Quên mật khẩu?</a>
                        </span>
                        <span class="pswl">
                        <a href="index.php" class="pswf">Quay về trang chủ <i class="fa fa-mail-reply"></i></a>
                        </span>
                    </div>
            </div>  
        </div>
    </div>
</body>
</html>