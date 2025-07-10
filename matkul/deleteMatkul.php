<?php 
require_once '../koneksi/koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
   
    $stmt = $conn->prepare("DELETE FROM mata_kuliah WHERE id = ?");
    $stmt->bind_param('i', $id);
    if($stmt->execute()){
        echo "<script>
        alert('Data Mata Kuliah Berhasil Dihapus!');
        window.location.href = 'matkul.php';
        </script>";
    }
        echo "<script>
        alert('Data Mata Kuliah Gagal Dihapus!');
        window.location.href = 'matkul.php';
        </script>";
}




?>