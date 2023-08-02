<?php
session_start();
error_reporting(0);
include('includes/config.php');

if($_SESSION['ulogin']==''){
    header('location:index.php');
}
?>

<?php
    $bookId = $_GET['bookid'];
    $_SESSION['bookid'] = $bookId;
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
                <h4 class="header-line">BOOK DETAILS</h4>
            </div>
        </div>       
        <?php
            // Giả sử bạn đã kết nối đến cơ sở dữ liệu trong $dbh

            // Biến $bookId lấy giá trị từ tham số "bookid" trong URL
            $bookId = $_GET['bookid'];

            // Sử dụng câu truy vấn SQL để lấy tên sách dựa trên $bookId
            // $sql = "SELECT tblbooks.BookName, tblbooks.CatId FROM tblbooks and tblauthors WHERE tblbooks.id = :bookId and tblbook.AuthorId = tblauthors.id"; // Sử dụng cú pháp parameter binding
            $sql = "SELECT tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName, tblbooks.ISBNNumber, tblbooks.BookPrice, tblbooks.bookImage, tblcomment.comment_text
            FROM tblbooks 
            JOIN tblauthors ON tblbooks.AuthorId = tblauthors.id
            JOIN tblcategory ON tblbooks.Catid = tblcategory.id
            JOIN tblcomment ON tblbooks.id = tblcomment.book_id
            WHERE tblbooks.id = :bookId";
            
    

            // Chuẩn bị và thực thi câu truy vấn
            $query = $dbh->prepare($sql);
            $query->bindParam(':bookId', $bookId, PDO::PARAM_INT); // Parameter binding để tránh lỗi SQL injection và đảm bảo kiểu dữ liệu
            $query->execute();

            // Lấy kết quả trả về dưới dạng một mảng các đối tượng (FETCH_OBJ)
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            // Kiểm tra nếu có kết quả
            if ($results) {
                // Truy xuất tên sách từ kết quả trả về và hiển thị nó
                $bookName = $results[0]->BookName;
                $catName = $results[0]->CategoryName;
                $authorName = $results[0]->AuthorName;
                $isbnnum = $results[0]->ISBNNumber;
                $price = $results[0]->BookPrice;
                $bookImage = $results[0]->bookImage;
                $cmt = $results[0]->comment_text;
                

                echo "<strong>Book Name:</strong> " . $bookName . "<br>";
                echo "<strong>Author Name:</strong> " . $catName . "<br>";
                echo "<strong>Category Name:</strong> " . $authorName . "<br>";
                echo "<strong>ISBN Number:</strong> " . $isbnnum . "<br>";
                echo "<strong>Book Price:</strong> " . $price . "<br>";
                // echo "<strong>Comment:</strong> " . $cmt . "<br>";
                // Kiểm tra nếu có comment
                if (count($results) > 0) {
                    echo "<strong>Comments:</strong><br>";
                    foreach ($results as $result) {
                        $comment = $result->comment_text;
                        echo "<strong>User:</strong><br>" . $comment . "<br>";
                    }
                } else {
                    echo "No comments for this book.";
                }

            } else {
                echo "Book not found with the given ID.";
            }
        ?>
            <!-- <img src="./assets/bookimg/
            <?php 
                // echo htmlentities($result->bookImage);
            ?>" width="100"> -->

            <form method="POST" action="save_cmt.php">
                <label for="comment">WRITE YOUR COMMENT:</label><br>
                <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br>
                <input type="submit" value="SEND">
            </form>            
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

