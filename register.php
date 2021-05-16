<?php 
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body class="register-body">
<?php
    $error = '';
    $first_name = '';
    $last_name = '';
    $email = '';
    $user = '';
    $pass = '';
    $pass_confirm = '';
    
    if (isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email'])
    && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['check_password']))
    {
        $first_name = $_POST['first'];
        $last_name = $_POST['last'];
        $email = $_POST['email'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $pass_confirm = $_POST['check_password'];
        
        if (empty($first_name) and empty($last_name)) {
            $error = 'Vui lòng nhập tên';
        }
        else if (empty($email)) {
            $error = 'Vui lòng nhập email';
        }
        else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $error = 'Email không hợp lệ';
        }
        else if (empty($user)) {
            $error = 'Vui lòng nhập tài khoản';
        }
        else if (empty($pass)) {
            $error = 'Vui lòng nhập mật khẩu';
        }
        else if (strlen($pass) < 6) {
            $error = 'Mật khẩu có ít nhất 6 ký tự';
        }
        else if ($pass != $pass_confirm) {
            $error = 'Mật khẩu không khớp';
        }
        else {
            // register a new account
            $result = register($user, $pass, $first_name, $last_name, $email);

            $sql1 = "INSERT into image_avatar(userimage) values ('$user')";
            $conn = open_database();
            mysqli_query($conn, $sql1);

            if($result['code'] == 0){
                $error = 'Đăng ký thành công!';
            }
            else if($result['code'] == 1){
                $error = 'Email này đã đăng ký';
            }
            else{
                $error = 'Tài khoản này đã trùng';
            }
        }
    }
?>
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col">
                <form action="" method ="post" novalidate>
                    <div class = "register-form">
                        <h3>TẠO TÀI KHOẢN</h3>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="lastname">Tên</label>
                                <div class="input-container">
                                    <input value="" type="text" required class="formcontrol" id="last" name="last" placeholder="Tên">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="firstname">Họ</label>
                                <div class="input-container">
                                    <input value="" type="text" required class="formcontrol" id="first" name="first" placeholder="Họ">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-container">
                                <input value="" type="email" class="control-form" id="email" name="email" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="user"for="username">Tên đăng nhập</label>
                            <div class="input-container">
                                <input value=""type="text" required class="control-form" id="user" name="user" placeholder=" Tài khoản">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="pass">Mật khẩu</label>
                            <div class="input-container">
                                <input value=""type="password" required class="control-form" name="pass" id="password" placeholder="Mật khẩu">
                            </div>
                            <label for="pass">Xác nhận</label>
                            <div class="input-container">
                                <input value=""type="password" required class="control-form" id="check_password" name="check_password" placeholder="Xác nhận">
                            </div>
                            <div><p id="error"></p></div>
                            <div><input type="checkbox" onclick="show_pass()"> Hiện mật khẩu</div>
                            <div>
                                <?php
                                    if (!empty($error)) {
                                        echo "<div class='alert alert-danger'>$error</div>";
                                    }
                                ?>
                                <button class ="bt" type="submit">Đăng ký</button>
                            </div>
                            <div class="but_login">
                                <p>Bạn đã có tài khoản? <a class="logg" href="login.php"> Đăng nhập</a>.</p>
                              </div>
                        </div>

                    </div>
                </form>
            </div>  
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>
