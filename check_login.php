<?php

include_once './config.php';
$error = array();
$conn = openDB();

if (isset($_POST['submit'])) {
    if (isset($_POST['user']) && isset($_POST['pass'])) {
        session_start();
        $username = $_POST['user'];
        $password = md5($_POST['pass']);
        if (empty($username)) {
            $_SESSION['error'] = 'Ten đăng nhập không hợp lệ';
        }

        if(!empty($username) && !empty($password)) {
            $sql = "select * from account where username='$username' and password='$password'";
            $user = mysqli_query($conn,$sql);
            if(mysqli_num_rows($user)==0) {
                $_SESSION['error'] = 'Tên đăng nhập hoặc mật khẩu không hợp lệ.';
            } else if (mysqli_num_rows($user)>0) {
                while($row = $user -> fetch_assoc()) {
                    $_SESSION['user'] = $row['username'];
                }
                
            }

        }
        //header('location: ./login.php');
    }
}
?>
