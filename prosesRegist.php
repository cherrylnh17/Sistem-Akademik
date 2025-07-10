<?php 
session_start();
require_once 'koneksi/koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username_regist = $_POST['username_regist'];
    $email_regist = $_POST['email_regist'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email_regist);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        echo "<script>alert('Email sudah digunakan!'); window.location.href = 'index.php';</script>";
        exit;
    }




    $password_input = $_POST['password_regist'];
    $errors = [];

    if(!isset( $_POST['ketentuan'])){
        $errors['alert'] = "Anda harus menyetujui ketentuan dan layanan";
    }

    if(empty($username_regist) || strlen($username_regist) <= 6){
        $errors['alert'] = "Username harus lebih dari 6 huruf";
    }

    if(empty($password_input) || strlen($password_input) < 8){
        $errors['alert'] = "Password minimal 8 karakter";
    }

    if(!filter_var($email_regist,FILTER_VALIDATE_EMAIL)){
        $errors['alert'] = "Email tidak valid";
    }

    if(count($errors) > 0){
        $_SESSION['errors'] = $errors; // Menyimpan errors di session
        echo "<script>
        window.location.href = 'index.php';
        </script>";
        exit;
    }


    $password_regist = password_hash($password_input, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?,?,?)");
    $stmt->bind_param("sss", $username_regist, $email_regist, $password_regist);
    $stmt->execute();

    header("Location: index.php");
    exit;
}




?>