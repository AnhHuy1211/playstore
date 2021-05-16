<?php
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require 'vendor/autoload.php';


	define('HOST','localhost');
	define('USER','id16501783_ak2');
	define('PASS','51900@Ak1234');
	define('DB','id16501783_doanweb');

	function open_database(){
		$conn = new mysqli(HOST, USER, PASS, DB);
		if($conn -> connect_error){
			die('Connect error: ' . $conn -> connect_error);
		}
		return $conn;
	}
	function login($user, $pass){
		$sql = "select * from account where username = ?";
		$conn = open_database();

		$stm = $conn->prepare($sql);
		$stm->bind_param('s', $user);
		if(!$stm->execute()){
			return array('code' => 1, 'error' => 'Can not execute command');
		}

		$result = $stm->get_result();
		if($result-> num_rows == 0){
			return array('code' => 1, 'error' => 'Chưa đăng ký tài khoản');
		}

		$data = $result->fetch_assoc();

		$hashed_password = $data['password'];
		if(!password_verify($pass, $hashed_password)){
			return array('code' => 2, 'error' => 'Mật khẩu không hợp lệ');
		}
		else return array('code' => 0, 'error' => '', 'data' => $data);		
	}
	function is_email_exists($email){
		$sql = 'select username from account where email = ?';
		$conn = open_database();

		$stm = $conn->prepare($sql);
		$stm->bind_param('s', $email);
		if(!$stm->execute()){
			die('Query error: '.$stm->error);
		}
		$result = $stm->get_result();
		if($result -> num_rows > 0){
			return true;
		}
		else{
			return false;
		}
	}
	function register($user, $pass, $first, $last, $email){

		if(is_email_exists($email)){
			return array('code' => 1, 'error' => 'Email exists');
		}
		$hash = password_hash($pass, PASSWORD_DEFAULT);
		$rand = random_int(0, 999999);
		$token = md5($user.'+'.$rand);

		$sql = 'insert into account(username, firstname, lastname, email, password, activate_token) values(?, ?, ?, ?, ?, ?)';

		$conn = open_database();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ssssss', $user, $first, $last, $email, $hash, $token);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Can not execute command');
		}

		//send verification email
		return array('code' => 0, 'error' => 'Create account successful');
	}
	function sendReSetEmail($email, $token){
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = 'ssl://smtp.gmail.com';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'donguyenkhoi672001@gmail.com';                     //SMTP username
		    $mail->Password   = '51900515khoi';                               //SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		    //Recipients
		    $mail->setFrom('donguyenkhoi672001@gmail.com', 'Admin');
		    $mail->addAddress($email, 'Người nhận');     //Add a recipient
		    /*$mail->addAddress('ellen@example.com');               //Name is optional
		    $mail->addReplyTo('info@example.com', 'Information');
		    $mail->addCC('cc@example.com');
		    $mail->addBCC('bcc@example.com');*/

		    //Attachments
		    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		    //$mail->addAttachment('/htdocs', 'unnamed.jpg');    //Optional name

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->CharSet = 'UTF-8';
		   
		    $mail->Subject = 'Reset mật khẩu';
		    $mail->Body    = "Click <a href = 'http://localhost/reset_password.php?email=$email&&token=$token'> vào đây </a>";
		    //$mail->AltBody = '';

		    $mail->send();
		    return true;
		} catch (Exception $e) {
		    return false;
		}
	}
	function reset_password($email){
		if(!is_email_exists($email)){
			return array('code' => 1, 'error' => 'Email does not exists');
		}
		$token = md5($email. '+'. random_int(10000,99999));
		$sql = 'update reset_token set token = ? where email = ?';
	
		$conn = open_database();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ss', $token, $email);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Can not execute command');

		}
		if($stm->affected_rows == 0){

			$exp = time() + 3600 * 24; //het han sau 24h

			$sql = 'insert into reset_token values (?,?,?)';
			$stm = $conn->prepare($sql);
			$stm->bind_param('ssi', $email, $token, $exp);

			if($stm->execute()){
				return array('code' => 1, 'error' => 'Can not execute command');

			}
		}

		$success = sendReSetEmail($email, $token);
		return array('code' => 0, 'success' => $success);
	}
	function change_Password($pass,$email){

		$hash = password_hash($pass, PASSWORD_DEFAULT);

		$sql = 'update account set password = ? where email = ?';

		$conn = open_database();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ss', $hash, $email);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Can not execute command');
		}
		return array('code' => 0, 'error' => 'Change successful');
	}
	function change_name($user,$first,$last){
        $sql = "update account set firstname = ?, lastname = ?
                where email = ?";
        $conn = open_database();

        $stm = $conn->prepare($sql);
        $stm->bind_param('sss', $first, $last,  $user);

        if(!$stm->execute()){
            return array('code' => 2, 'error' => 'Can not execute command');
        }
        return array('code' => 0, 'error' => 'Change successful');
    }
    function sendDeveloper($email){
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = 'ssl://smtp.gmail.com';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'donguyenkhoi672001@gmail.com';                     //SMTP username
		    $mail->Password   = '51900515khoi';                               //SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		    //Recipients
		    $mail->setFrom('donguyenkhoi672001@gmail.com', 'Admin');
		    $mail->addAddress($email, 'Người nhận');     //Add a recipient
		    /*$mail->addAddress('ellen@example.com');               //Name is optional
		    $mail->addReplyTo('info@example.com', 'Information');
		    $mail->addCC('cc@example.com');
		    $mail->addBCC('bcc@example.com');*/

		    //Attachments
		    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		    //$mail->addAttachment('/htdocs', 'unnamed.jpg');    //Optional name

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->CharSet = 'UTF-8';
		   
		    $mail->Subject = 'Thông báo từ K&K Play!!!';
		    $mail->Body    = "Chúc mừng! Ứng dụng của bạn đã được thông qua.";
		    //$mail->AltBody = '';

		    $mail->send();
		    return true;
		} catch (Exception $e) {
		    return false;
		}
	}
	function unsendDeveloper($email){
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = 'ssl://smtp.gmail.com';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'donguyenkhoi672001@gmail.com';                     //SMTP username
		    $mail->Password   = '51900515khoi';                               //SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		    //Recipients
		    $mail->setFrom('donguyenkhoi672001@gmail.com', 'Admin');
		    $mail->addAddress($email, 'Người nhận');     //Add a recipient
		    /*$mail->addAddress('ellen@example.com');               //Name is optional
		    $mail->addReplyTo('info@example.com', 'Information');
		    $mail->addCC('cc@example.com');
		    $mail->addBCC('bcc@example.com');*/

		    //Attachments
		    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		    //$mail->addAttachment('/htdocs', 'unnamed.jpg');    //Optional name

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->CharSet = 'UTF-8';
		   
		    $mail->Subject = 'Thông báo từ K&K Play!!!';
		    $mail->Body    = "Rất tiếc! Ứng dụng của bạn không phù hợp.";
		    //$mail->AltBody = '';

		    $mail->send();
		    return true;
		} catch (Exception $e) {
		    return false;
		}
	}
	?>