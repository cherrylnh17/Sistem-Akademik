<?php 
session_start();
require_once 'koneksi/koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email= htmlspecialchars($_POST['email_login']);
    $password = htmlspecialchars($_POST['password_login']);

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && password_verify($password, $user['password'])){
        $_SESSION['username'] = $user['username'];
        echo "<script>
        alert('Login Berhasil!');
        window.location.href = 'dashboard/dashboard.php';
        </script>";
    } else {
        echo "<script>
        alert('Akun tidak ditemukan!');
        window.location.href = 'index.php';
        </script>";
    }


}




?>