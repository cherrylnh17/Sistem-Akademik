<?php 
require_once '../koneksi/koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $matkul = $_POST['matkul'];
    $prodi = $_POST['prodi'];
    $dosen = $_POST['dosen'];
    $sks = $_POST['sks'];

    // Ambil 2 huruf pertama dari nama mata kuliah
    $duaHurufMatkul = strtoupper(substr(trim($matkul), 0, 2));

    // Ambil tahun sekarang
    $tahun = date("Y");

    // Buat kode awal
    $kode = $duaHurufMatkul . $tahun;

    // Cek kode sudah ada di database
    $stmt = $conn->prepare("SELECT COUNT(*) FROM mata_kuliah WHERE kode = ?");
    $stmt->bind_param("s", $kode);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Jika kode sudah ada, tambahkan angka untuk memastikan kode unik
    $counter = 1;
    while ($count > 0) {
        $kode = $duaHurufMatkul . $tahun . str_pad($counter, 2, '0', STR_PAD_LEFT);  // Menambahkan angka untuk variasi kode
        $stmt = $conn->prepare("SELECT COUNT(*) FROM mata_kuliah WHERE kode = ?");
        $stmt->bind_param("s", $kode);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        $counter++;
    }

    // Setelah mendapatkan kode yang unik, lakukan insert data
    $stmt = $conn->prepare("INSERT INTO mata_kuliah (matkul, prodi, pengampu, kode, sks) VALUES (?,?,?,?,?)");
    $stmt->bind_param("ssssi", $matkul, $prodi, $dosen, $kode, $sks);
    $stmt->execute();

    header("Location: matkul.php");
}

?>
