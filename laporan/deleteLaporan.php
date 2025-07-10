<?php 
require_once '../koneksi/koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
   
    $stmt = $conn->prepare("DELETE FROM laporan WHERE id = ?");
    $stmt->bind_param('i', $id);
    if($stmt->execute()){
        echo "<script>
        alert('Data Nilai Mahasiswa Berhasil Dihapus!');
        window.location.href = 'laporan.php';
        </script>";
    }
        echo "<script>
        alert('Data Nilai Mahasiswa Gagal Dihapus!');
        window.location.href = 'laporan.php';
        </script>";
}




?>