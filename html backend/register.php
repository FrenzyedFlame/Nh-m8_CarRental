<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu

    // Thực hiện chèn người dùng mới vào cơ sở dữ liệu
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Đăng ký thành công!";
        header("Location: success.php"); // Chuyển hướng đến trang thành công
    } else {
        $_SESSION['message'] = "Đăng ký thất bại. Vui lòng thử lại.";
        header("Location: register.html"); // Quay lại trang đăng ký
    }

    $stmt->close();
    $conn->close();
}
?>
