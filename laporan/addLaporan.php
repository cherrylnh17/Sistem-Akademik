<?php 
require_once '../koneksi/koneksi.php';
require_once 'function.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $matkulData = $_POST['matkul'];
    $mahasiswaData = $_POST['mahasiswa'];
    $grade = $_POST['grade'];

    $nilai = konversiNilaiKePoin($grade);

    list($matkul, $sks) = explode('|', $matkulData);
    list($nama, $prodi) = explode('|', $mahasiswaData);

    
    $stmt = $conn->prepare("INSERT INTO laporan (nama, matkul, prodi, sks, nilai, grade) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("sssiis", $nama, $matkul, $prodi, $sks, $nilai, $grade);
    $stmt->execute();

    header("Location: laporan.php");
}

?>
