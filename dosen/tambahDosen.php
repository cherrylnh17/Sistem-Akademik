<?php 
require_once '../koneksi/koneksi.php';

if(empty($_POST)){
    echo "<script>
        alert('Mohon masukan data!');
        window.location.href = 'dosen.php';
        </script>";
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = $_POST['nama'];
    $kelamin = $_POST['kelamin'];
    $status = $_POST['status'];
    $prodi = $_POST['prodi'];

    if(empty($nama) || empty($kelamin) || empty($status) || empty($prodi)){
        echo "<script>
        alert('Gagal Menambahkan Data!');
        window.location.href = 'dosen.php';
        </script>";
        exit;
    }


    $stmt = $conn->prepare("INSERT INTO dosen (nama, prodi, status, kelamin) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $nama, $prodi, $status, $kelamin);
    $stmt->execute();

    header("Location: dosen.php");
}




?>