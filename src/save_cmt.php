<?php
// Kiểm tra session trước khi xử lý upload
session_start();
include('includes/config.php');
if (strlen($_SESSION['ulogin']) == 0) {
    header('location: index.php');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    // Lấy dữ liệu từ form
    $comment = htmlentities($_POST['comment']);
    $bookId = $_SESSION['bookid'];
    $commentId = mt_rand(10, 30);


    $sql = "INSERT INTO tblcomment (comment_id, book_id, comment_text) VALUES (:comment_id, :book_id, :comment_text)";
    // Chuẩn bị và thực thi câu truy vấn
    $query = $dbh->prepare($sql);
    $query->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $query->bindParam(':book_id', $bookId, PDO::PARAM_INT);
    $query->bindParam(':comment_text', $comment, PDO::PARAM_STR);
    // Thực hiện câu truy vấn
    $location = "comment.php?bookid=" . $bookId;
    if ($query->execute()) {
        echo "Bình luận đã được lưu thành công!";
        header('Location: ' . $location);
    } else {
        echo "Lỗi: Không thể lưu bình luận vào cơ sở dữ liệu.";
    }
}


?>




