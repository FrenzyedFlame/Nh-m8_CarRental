<?php
session_start();
include 'db.php'; // Kết nối cơ sở dữ liệu, đảm bảo file này đúng

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn cơ sở dữ liệu để xác thực người dùng
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Người dùng tồn tại, lưu thông tin vào session
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['avatar'] = $user['avatar']; // Nếu có ảnh đại diện

        // Chuyển hướng về trang index.php
        header("Location: index.php");
        exit();
    } else {
        // Nếu thông tin không đúng, báo lỗi
        echo "Thông tin đăng nhập không chính xác.";
    }
}
?>
