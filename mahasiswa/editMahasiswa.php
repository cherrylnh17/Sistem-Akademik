<?php 
require_once '../koneksi/koneksi.php';

if(empty($_POST)){
    echo "<script>
        alert('Mohon masukan data!');
        window.location.href = 'mahasiswa.php';
        </script>";
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id_mahasiswa'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $kelamin = $_POST['kelamin'];
    $kota = $_POST['kota'];
    $perwalian = $_POST['perwalian'];

    $stmt = $conn->prepare("UPDATE mahasiswa SET nama = ?,email = ?, nim = ?, prodi = ?, tanggal_lahir = ?,
    kelamin = ?, kota = ?, perwalian = ? WHERE id_mahasiswa = ?");
    $stmt->bind_param("ssisssssi", $nama, $email, $nim, $prodi, $tanggal_lahir, $kelamin, $kota, $perwalian, $id);
    $stmt->execute();

    header("Location: mahasiswa.php");
}




?>