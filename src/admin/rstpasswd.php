<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
}

function generateRandomPassword($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = "";
    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($chars) - 1);
        $password .= $chars[$index];
    }
    return $password;
}

if(isset($_POST['rstpass']))
{ 
    
    $newPassword1 = generateRandomPassword(10);
    $newPassword = md5($newPassword1);
    $mail=$_POST['mail'];
    echo $mail;
    $sql = "UPDATE tblstudents SET Password = :password WHERE EmailId = :mail";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':mail', $mail, PDO::PARAM_STR);
    $query-> bindParam(':password', $newPassword, PDO::PARAM_STR);
    $query-> execute();
    $receiver = $mail;
    $subject = "Email Test via PHP using Localhost";
    $body = "Hi, there...This is reset password send from Localhost: " . $newPassword1;
    $sender = "From: buitanhaidang@gmail.com";

    if(mail($receiver, $subject, $body, $sender)){
        echo "Email sent successfully to $receiver";
    }else{
        echo "Sorry, failed while sending mail!";
    }
    echo "<script>alert('Successfully send new password to your email!s');</script>";
    echo "<script>window.location.href='rstpasswd.php'</script>";
}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">RESET USER PASSWORD</h4>
</div>
</div>
             
<!--LOGIN PANEL START-->           
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>ENTER YOUR GMAIL</label>
<input class="form-control" type="text" name="mail" autocomplete="off" required />
</div>
 <button type="submit" name="rstpass" class="btn btn-info">SEND </button>
</form>
 </div>
</div>
</div>
</div>  
<!---LOGIN PABNEL END-->            
             
 
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
 <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</script>
</body>
</html>
