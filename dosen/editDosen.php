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
    $id_dosen = $_POST['id'];
    $dataLama = $conn->query("SELECT * FROM dosen WHERE id = $id_dosen")->fetch_assoc();

    $nama = $_POST['nama'] ?? $dataLama['nama'];
    $kelamin = $_POST['kelamin'] ?? $dataLama['kelamin'];
    $status = $_POST['status'] ?? $dataLama['status'];
    $prodi = $_POST['prodi'] ?? $dataLama['prodi'];

    

    if(empty($nama) || empty($kelamin) || empty($status) || empty($prodi)){
        echo "<script>
        alert('Gagal Mengubah Data!');
        window.location.href = 'dosen.php';
        </script>";
        exit;
    }


    $stmt = $conn->prepare("UPDATE dosen SET nama = ?,prodi = ?, status = ?, kelamin = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nama, $prodi, $status, $kelamin, $id_dosen);
    $stmt->execute();

    header("Location: dosen.php");
}




?>