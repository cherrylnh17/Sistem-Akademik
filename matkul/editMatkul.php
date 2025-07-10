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
    $id = $_POST['id'];
    $dataLama = $conn->query("SELECT * FROM mata_kuliah WHERE id = $id")->fetch_assoc();


    $matkul = $_POST['matkul'] ?? $dataLama['matkul'];
    $prodi = $_POST['prodi'] ?? $dataLama['prodi'];
    $dosen = $_POST['dosen'] ?? $dataLama['pengampu'];
    $sks = $_POST['sks'] ?? $dataLama['sks'];

    $stmt = $conn->prepare("UPDATE mata_kuliah SET matkul = ?,prodi = ?, pengampu = ?, sks = ? WHERE id = ?");
    $stmt->bind_param("sssii", $matkul, $prodi, $dosen, $sks, $id);
    $stmt->execute();

    header("Location: matkul.php");
}




?>