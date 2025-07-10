<?php 
require_once '../koneksi/koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
   
    $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id_mahasiswa = ?");
    $stmt->bind_param('i', $id);
    if($stmt->execute()){
        echo "<script>
        alert('Data Mahasiswa Berhasil Dihapus!');
        window.location.href = 'mahasiswa.php';
        </script>";
    }
        echo "<script>
        alert('Data Mahasiswa Gagal Dihapus!');
        window.location.href = 'mahasiswa.php';
        </script>";
}




?>