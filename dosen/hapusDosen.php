<?php 
require_once '../koneksi/koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
   
    $stmt = $conn->prepare("DELETE FROM dosen WHERE id = ?");
    $stmt->bind_param('i', $id);
    if($stmt->execute()){
        echo "<script>
        alert('Data Dosen Berhasil Dihapus!');
        window.location.href = 'dosen.php';
        </script>";
    }
        echo "<script>
        alert('Data Dosen Gagal Dihapus!');
        window.location.href = 'dosen.php';
        </script>";
}




?>