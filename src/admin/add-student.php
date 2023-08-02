<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['create']))
{
$stdname=$_POST['name'];
$stdmail=$_POST['email'];
$stdpass = md5($stdmail);
//Code for student ID
$count_my_page = ("./../studentid.txt");
$hits = file($count_my_page);
$hits[0] ++;
$fp = fopen($count_my_page , "w");
fputs($fp , "$hits[0]");
fclose($fp); 
$StudentId = $hits[0];

$avt_filepath = 'uploads/' . $StudentId;
$status = 1; 



$sql="INSERT INTO  tblstudents(StudentId, FullName, EmailId, Password, Status, avatar_filepath) VALUES(:stdid, :stdname, :stdmail, :stdpass, :status ,:avt_filepath)";
$query = $dbh->prepare($sql);   
$query->bindParam(':stdid',$StudentId,PDO::PARAM_STR);
$query->bindParam(':stdname',$stdname,PDO::PARAM_STR);
$query->bindParam(':stdmail',$stdmail,PDO::PARAM_STR);
$query->bindParam(':stdpass',$stdpass,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':avt_filepath',$avt_filepath,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
// $_SESSION['msg']="Student successfully added. Your password is the same as your email for the first time. Please rechange your password";
header('location:reg-students.php');
}
else 
{
// $_SESSION['error']="Something went wrong. Please try again";
header('location:reg-students.php');
}

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Add Student</title>
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
    <div class="content-wrap">
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Add Student</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<div class="panel panel-info">
<div class="panel-heading">
Student Info
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Student Name</label>
<input class="form-control" type="text" name="name" autocomplete="off"  required />
</div>

<div class="form-group">
<label>Student Email</label>
<input class="form-control" type="email" name="email" autocomplete="off"  required />
</div>

<button type="submit" name="create" class="btn btn-info">Add </button>
</form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
