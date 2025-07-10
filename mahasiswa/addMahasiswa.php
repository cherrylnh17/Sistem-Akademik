<?php 
require_once '../koneksi/koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $kelamin = $_POST['kelamin'];
    $kota = $_POST['kota'];
    $perwalian = "pending";

    $stmt = $conn->prepare("INSERT INTO mahasiswa (nama, email, nim, prodi, tanggal_lahir, kelamin, kota, perwalian) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssisssss", $nama, $email, $nim, $prodi, $tanggal_lahir, $kelamin, $kota, $perwalian);
    $stmt->execute();

    header("Location: mahasiswa.php");
}




?>