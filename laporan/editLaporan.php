<?php 
require_once '../koneksi/koneksi.php';
require_once 'function.php';

if(empty($_POST)){
    echo "<script>
        alert('Mohon masukan data!');
        window.location.href = 'mahasiswa.php';
        </script>";
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];


    $matkulData = $_POST['matkul'];
    $grade = $_POST['grade'];

    $nilai = konversiNilaiKePoin($grade);

    list($matkul, $sks) = explode('|', $matkulData);

    $stmt = $conn->prepare("UPDATE laporan SET matkul = ?,sks = ?, nilai = ?, grade = ? WHERE id = ?");
    $stmt->bind_param("siisi", $matkul, $sks, $nilai, $grade, $id);
    $stmt->execute();

    header("Location: laporan.php");
}




?>