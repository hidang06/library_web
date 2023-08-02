<?php
session_start();
error_reporting(0);
include('includes/config.php');
     
if(isset($_POST['update']))
{
    $name=$_POST['name'];
    $email=$_POST['mail'];
    $phone=$_POST['phone'];
    $pass=md5($_POST['pass']);
    $id=intval($_GET['stdid']);
    $sql="update  tblstudents set FullName=:name,EmailId=:email,MobileNumber=:phone,Password=:pass where id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':phone',$phone,PDO::PARAM_STR);
    $query->bindParam(':pass',$pass,PDO::PARAM_STR);
    $query->bindParam(':id',$id,PDO::PARAM_INT);
    $query->execute();
    echo "<script>alert('Student info updated successfully');</script>";
    echo "<script>window.location.href='reg-students.php'</script>";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Edit Student</title>
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
                <h4 class="header-line">Add Student</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md12 col-sm-12 col-xs-12">
<div class="panel panel-info">
<div class="panel-heading">
Student Info
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$id=intval($_GET['stdid']);
$sql = "SELECT FullName, EmailId, MobileNumber, Password FROM tblstudents WHERE id=:id";
$query = $dbh -> prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_INT);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<div class="col-md-6">
<div class="form-group">
<label>Student Name</label>
<input class="form-control" type="text" name="name" value="<?php echo htmlentities($result->FullName);?>"  />
</div></div>

<div class="col-md-6">
<div class="form-group">
<label>Mobile Phone Number</label>
<input class="form-control" type="text" name="phone" value="<?php echo htmlentities($result->MobileNumber);?>" />
</div></div>

<div class="col-md-6">
<div class="form-group">
<label>Email</label>
<input class="form-control" type="text" name="mail" value="<?php echo htmlentities($result->EmailId);?>"  />
</div></div>

<div class="col-md-6">
<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="pass" value="<?php echo htmlentities($result->Password);?>"  />
</div></div>


 <?php }} ?><div class="col-md-12">
<button type="submit" name="update" class="btn btn-info">Update </button></div>

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

