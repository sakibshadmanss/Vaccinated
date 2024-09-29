<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION['userdata'])){
    	echo "<script> location.href='../index.php'; </script>";
		exit();
    }else if(isset($_SESSION['GenLuserdata'])){ 
    	echo "<script> location.href='Dashboard.php'; </script>";
		exit();
    }

}

$conn = mysqli_connect('localhost', 'root', '', 'vaccinated_db');








if(isset($_REQUEST['pwdrst']))
{
  $Email = $_REQUEST['Email'];
  $check_Email = mysqli_query($conn,"select Email from hospital where Email='$Email'");
  $res = mysqli_num_rows($check_Email);
  if($res>0)
  {
    $message = '<div>
     <p><b>Hello!</b></p>
     <p>You are recieving this email because we recieved a password reset request for your account.</p>
     <br>
     <p><button class="btn btn-primary"><a href="http://localhost/vaccinated/Hospital/passwordresethospital.php?secret='.base64_encode($Email).'">Reset Password</a></button></p>
     <br>
     <p>If you did not request a password reset, no further action is required.</p>
    </div>';

include_once("../SMTP/class.phpmailer.php");
include_once("../SMTP/class.smtp.php");
$email = $Email; 
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->SMTPAuth = true;                 
$mail->SMTPSecure = "tls";      
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587; 
$mail->Username = "sakibshadmanss@gmail.com";   //Enter your username/emailid
$mail->Password = "pbdy xiyo ektj ggvs";   //Enter your password
$mail->FromName = "Baby Vaccine Donation System";
$mail->AddAddress($Email);
$mail->Subject = "Reset Password";
$mail->isHTML( TRUE );
$mail->Body =$message;
if($mail->send())
{
  $msg = "We have e-mailed your password reset link!";
}
}
else
{
  $msg = "We can't find a user with that email address";
}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - General User</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

	<div class="container">
		<div class="card-body">
		<div class="form-box">
			<div class="card card-outline card-primary">
			<legend class="mt-5 text-center text-light" style="font-size:2.5rem; font-weight:bolder;">Forget Password</legend>
			<hr>
		<form method="post" class="mx-auto" style="width: 50%;">
		<div class="input-group mb-3">
          <input type="text" class="form-control" name="Email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user form-control"></span>
            </div>
          </div>
        </div>

        <div class="row">
        
          <!-- /.col -->
          <div class="col-12">
          <input type="submit" id="login" name="pwdrst" value="Send Password Reset Link" class="btn btn-success" />
			
          </div>
          <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
          <!-- /.col -->
        </div>
		</div>
			

	<style type="text/css">
		<?php 

			$Cover_qry = "SELECT meta_value FROM system_info WHERE meta_field = 'cover'";
			$Cover_img = mysqli_fetch_assoc(mysqli_query($conn, $Cover_qry)); 

		?>

			body {
				background-image: url("../<?php echo $Cover_img['meta_value']; ?>");
				background-size: cover;
			}

			.alert {
				width: 70%;
	    		top: 20px;
	    		left: 20%;
	    		position: absolute;
			}
			.card.card-outline.card-primary {
    width: 602px;
    margin: 0 auto;
    margin-top: 280px;
    padding: 11px;
	background-color:#036657;
}
.card-primary.card-outline {
    border-top: 3px solid #a19105;
}
.input.form-control{
	background-color: #036657;
}
	</style>
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	 <script>
  // Function to toggle password visibility
  function togglePassword() {
    var passwordField = document.getElementById('password-field');
    var togglePassword = document.getElementById('toggle-password');

    if (passwordField.type === "password") {
      passwordField.type = "text";
      togglePassword.classList.remove("fa-eye");
      togglePassword.classList.add("fa-eye-slash");
    } else {
      passwordField.type = "password";
      togglePassword.classList.remove("fa-eye-slash");
      togglePassword.classList.add("fa-eye");
    }
  }

  // Add a click event listener to the toggle-password icon
  document.getElementById('toggle-password').addEventListener('click', togglePassword);
</script>

</body>
</html>