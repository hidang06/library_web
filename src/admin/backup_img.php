<?php
session_start();
error_reporting(0);
include('includes/config.php');

if($_SESSION['alogin'] == ''){
    $_SESSION['alogin']='';
}

if(isset($_POST['zip'])) {

    function backupImagesAndTar($sourceDirectory, $backupDirectory, $zipname) {
        // Create the backup directory if it does not exist
        if (!file_exists($backupDirectory)) {
            mkdir($backupDirectory, 0777, true);
        }

        // Use copy command to copy all image files from source to backup directory
        $commandCopy = "xcopy \"{$sourceDirectory}\\*.jpg\" \"{$backupDirectory}\" /s /i /y";
        exec($commandCopy, $outputCopy, $exitCodeCopy);

        // Check if the xcopy command was executed successfully
        if ($exitCodeCopy === 0) {
            echo "All image files have been successfully backed up to '{$backupDirectory}'." . PHP_EOL;

            // Use tar command to create a tar archive of the backup directory
            $tarFileName = "{$backupDirectory}/" . $zipname . ".tar";
            $commandTar = "tar -cf \"{$tarFileName}\" -C \"{$backupDirectory}\" .";
            exec($commandTar, $outputTar, $exitCodeTar);

            // Check if the tar command was executed successfully
            if ($exitCodeTar === 0) {
                echo "The backup directory has been successfully archived into '{$zipname}.tar'." . PHP_EOL;
            } else {
                echo "An error occurred while archiving the backup directory. Please check the tar command." . PHP_EOL;
            }
        } else {
            echo "An error occurred while copying image files. Please check the source and backup directories." . PHP_EOL;
        }
    }

    // Call the function to backup images and archive the backup directory
    $sourceDirectory = 'D:/xampp/htdocs/library/admin/bookimg';
    $backupDirectory = 'D:/xampp/htdocs/library/admin/backup';
    $zipname = $_POST['zipname'];
    backupImagesAndTar($sourceDirectory, $backupDirectory, $zipname);
    echo "<script>alert('Successfully backup images');</script>";
    echo "<script>window.location.href='backup_img.php'</script>";
    exit();
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
<h4 class="header-line">BACK UP BOOK IMAGES</h4>
</div>
</div>
             
          
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
ZIP
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Enter ZIP Name</label>
<input class="form-control" type="text" name="zipname" required />
</div>

 <button type="submit" name="zip" class="btn btn-info">SEND </button>
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
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</script>
</body>
</html>

