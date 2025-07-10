<?php 
session_start();
require_once '../koneksi/koneksi.php';

if(!isset($_SESSION['username'])){
    header("Location: ../index.php");
    exit;
}

$mahasiswa = $conn->query("SELECT * FROM mahasiswa")->fetch_all(MYSQLI_ASSOC);
$matkul = $conn->query("SELECT * FROM mata_kuliah")->fetch_all(MYSQLI_ASSOC);

$result = $conn->query("SELECT * FROM laporan");
$nomor = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Portal Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>
<body>
    <section class="contain" id="contain">
        <div class="wrap" id="wrap">
            <div class="navbar-lg d-flex flex-column">
                <div class="admin-logo d-flex align-items-center">
                    <img src="../img/logo.png" alt="" width="50px">
                    <span>Admin Panel</span>
                </div>
                <div class="navigation list-group gap-2 mt-2 px-4 d-flex">
                    <a href="../dashboard/dashboard.php" class="navigation underline"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <a href="../mahasiswa/mahasiswa.php" class="navigation underline"><i class="fas fa-users"></i> Mahasiswa</a>
                    <a href="../dosen/dosen.php" class="navigation underline"><i class="fas fa-box-open"></i> Dosen</a>
                    <a href="../matkul/matkul.php" class="navigation underline"><i class="fas fa-file-alt"></i> Mata Kuliah</a>
                    <a href="#" class="navigation underline active-canvas"><i class="fas fa-cog "></i> Laporan</a>
                    <a href="../owner/owner.php" class="navigation underline"><i class="fa-solid fa-copyright"></i> Owner</a>
                </div>
            </div>
        </div>

        <div class="content" id="content">
            <nav class="navbar navbar-expand-lg nav-header ">
                <div class="container-fluid d-flex align-items-center">
                    <div class="hamburger mx-4 d-lg-block d-none" id="sidebar">
                        <i class="fas fa-bars"></i>
                        <span class="mx-4 fs-5">Administrasi</span>
                    </div>
                    <div class="hamburger d-lg-none d-block" data-bs-toggle="offcanvas" data-bs-target="#canvasHamburgerMenu" aria-controls="canvasHamburgerMenu">
                        <span class="mx-2 fs-5"><i class="fas fa-bars me-2"></i> Administrasi</span>
                    </div>
                    <a href="../destroy.php" class="text-white text-decoration-none">Logout</a>
                </div>
            </nav>
            <section class="main-content">
                <div class="absolute-bg " id="absolutebg"></div>
                <div class="container-matkul p-2 mt-5">
                    <div class="main-container-matkul table-responsive p-lg-5 p-4">
                        <div class="header-container-matkul d-flex justify-content-between my-2">
                            <div class="filter-matkul d-flex">
                                <div class="select-prodi">
                                   <form action="" class="text-nowrap row gap-2 gap-lg-0">
                                        <div class="select-prodi col-9 col-lg-5">
                                            <select class="form-select form-select-sm" aria-label="Default select example">
                                                <option selected disabled>Semua Prodi</option>
                                                <option value="ilmu_komputer">Ilmu Komputer</option>
                                                <option value="sistem_informasi">Sistem Informasi</option>
                                                <option value="teknik_industri">Teknik Industri</option>
                                            </select>
                                        </div>
                                        <div class="select-semester col-9 col-lg-5">
                                            <select class="form-select form-select-sm" aria-label="Default select example">
                                                <option selected disabled>Semua Mata Kuliah</option>
                                                <option value="pemrograman_web">Pemrograman Web</option>
                                            </select>
                                        </div>
                                        <div class="submit-form col-auto col-lg-2">
                                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-filter"></i> Filter</button>
                                        </div>
                                   </form>
                                </div>
                            </div>
                            <div class="add-matkul">
                                <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahLaporan">Tambah</a>
                            </div>
                        </div>
                        <div class="table-container text-nowrap">
                            <div class="table-responsive border-rounded">
                                <table class="table table-bordered">
                                    <thead class="bg-body-secondary">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Mata Kuliah</th>
                                            <th scope="col">Prodi</th>
                                            <th scope="col">SKS</th>
                                            <th scope="col">Nilai</th>
                                            <th scope="col">Grade</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-success">
                                        <?php while($laporan = $result->fetch_assoc()) : ?>

                                        <tr>
                                            <th scope="row"><?= $nomor ?></th>
                                            <td><?= $laporan['nama'] ?></td>
                                            <td><?= $laporan['matkul'] ?></td>
                                            <td><?= $laporan['prodi'] ?></td>
                                            <td><?= $laporan['sks'] ?></td>
                                            <td><?= $laporan['nilai'] ?></td>
                                            <td>
                                                <span class="badge text-bg-<?= 
                                                    (strpos($laporan['grade'], 'A') === 0) ? 'success' : 
                                                    ((strpos($laporan['grade'], 'B') === 0) ? 'primary' : 
                                                    ((strpos($laporan['grade'], 'C') === 0) ? 'warning' : 'danger')); ?>">
                                                    <?= $laporan['grade'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action d-flex gap-2 justify-content-center">
                                                    <a href="" class="btn btn-outline-primary d-flex align-items-center gap-1 btn-responsive"  data-bs-toggle="modal" data-bs-target="#modal-laporan-<?= $laporan['id']; ?>"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                                    <form action="deleteLaporan.php" method="POST">
                                                        <input type="hidden" name="id" value="<?= $laporan['id'] ?>">
                                                        <button type="submit" onclick="return confirm('Yakin Ingin Menghapus Data ini?')" class="btn btn-outline-danger d-flex align-items-center gap-1 btn-responsive"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>


                                        <div class="modal fade" id="modal-laporan-<?= $laporan['id']; ?>" tabindex="-1" aria-labelledby="modal-mahasiswa-label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="modal-matkul-label">Laporan <?= $laporan['nama'] ?></h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="data-diri">
                                                                <form action="editLaporan.php" method="POST">
                                                                <input type="hidden" name="id" value="<?= $laporan['id'] ?>">
                                                                <div class="biodata-mahasiswa row m-0 gap-2">
                                                                    
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text">Nama </span>
                                                                        <input class="form-control" type="text" name="matkul" value="<?= $laporan['nama'] ?>" readonly>
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text">Mata Kuliah</span>
                                                                        <select class="form-select" aria-label="Default select example" name="matkul" required>
                                                                            <?php foreach ($matkul as $Matkul) : ?>
                                                                                <option value="<?= $Matkul['matkul'] ?>|<?= $Matkul['sks'] ?>"
                                                                                    <?php 
                                                                                        if ($Matkul['matkul'] == $laporan['matkul']) echo 'selected'; 
                                                                                    ?>>
                                                                                    <?= $Matkul['matkul'] ?> (<?= $Matkul['sks'] ?> SKS)
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>


                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text">Nilai </span>
                                                                        <select class="form-select" aria-label="Default select example" name="grade" required>
                                                                            <option value="A" <?= $laporan['grade'] == 'A' ? 'selected' : '' ?>>A</option>
                                                                            <option value="A-" <?= $laporan['grade'] == 'A-' ? 'selected' : '' ?>>A-</option>
                                                                            <option value="B+" <?= $laporan['grade'] == 'B+' ? 'selected' : '' ?>>B+</option>
                                                                            <option value="B" <?= $laporan['grade'] == 'B' ? 'selected' : '' ?>>B</option>
                                                                            <option value="B-" <?= $laporan['grade'] == 'B-' ? 'selected' : '' ?>>B-</option>
                                                                            <option value="C+" <?= $laporan['grade'] == 'C+' ? 'selected' : '' ?>>C+</option>
                                                                            <option value="C" <?= $laporan['grade'] == 'C' ? 'selected' : '' ?>>C</option>
                                                                            <option value="C-" <?= $laporan['grade'] == 'C-' ? 'selected' : '' ?>>C-</option>
                                                                            <option value="D" <?= $laporan['grade'] == 'D' ? 'selected' : '' ?>>D</option>
                                                                            <option value="E" <?= $laporan['grade'] == 'E' ? 'selected' : '' ?>>E</option>
                                                                        </select>       
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-warning" data-bs-dismiss="modal">Ubah Data</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php $nomor++ ?>
                                        <?php endwhile ; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="footer-content d-flex justify-content-between mt-2">
                            <div class="thispage">
                                <span class="small">Menampilkan 1 - 10 dari 1 Mata Kuliah</span>
                            </div>
                            <div class="pagination-matkul">
                                <nav aria-label="...">
                                    <ul class="pagination pagination-sm">
                                        <li class="page-item disabled">
                                            <a class="page-link">&laquo;</a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#" aria-current="page">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">&raquo;</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </section>

   

    <!-- Bagian Canvas Hamburger -->

    <div class="offcanvas offcanvas-start canvas-body" data-bs-scroll="true" tabindex="-1" id="canvasHamburgerMenu" aria-labelledby="offcacanvasHamburgerMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
                <div class="admin-logo-md d-flex align-items-center">
                <img src="../img/logo.png" alt="" width="40px">
                <span>Admin Panel</span>
            </div>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="list-group gap-2 mt-2 px-4">
                <a href="../dashboard/dashboard.php" class="navigation-md underline-md"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="../mahasiswa/mahasiswa.php" class="navigation-md underline-md"><i class="fas fa-users"></i> Mahasiswa</a>
                <a href="../dosen/dosen.php" class="navigation-md underline-md"><i class="fas fa-box-open"></i> Dosen</a>
                <a href="../matkul/matkul.php" class="navigation-md underline-md"><i class="fas fa-file-alt"></i> Mata Kuliah</a>
                <a href="#" class="navigation-md underline-md active-canvas"><i class="fas fa-cog "></i> Laporan</a>
                <a href="../owner/owner.php" class="navigation-md underline-md"><i class="fa-solid fa-copyright"></i> Owner</a>
            </div>
        </div>
    </div>



<!-- Bagian Tambah matkul -->
    <div class="modal fade" id="modalTambahLaporan" tabindex="-1" aria-labelledby="addMatkul-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addMatkul-modal">Tambahkan Laporan Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="data-diri">
                        <div class="biodata-matkul row m-0 gap-2">
                            <form action="addLaporan.php" method="POST">
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Mahasiswa </span>
                                    <select class="form-select" aria-label="Default select example" name="mahasiswa" required>
                                       <?php foreach ($mahasiswa as $Mahasiswa) : ?>
                                            <option value="<?= $Mahasiswa['nama'] ?>|<?= $Mahasiswa['prodi'] ?>">
                                                <?= $Mahasiswa['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>  
                                </div>
                               <div class="input-group mb-2">
                                    <span class="input-group-text">Mata Kuliah </span>
                                    <select class="form-select" aria-label="Default select example" name="matkul" required>
                                        <?php foreach ($matkul as $Matkul) : ?>
                                            <option value="<?= $Matkul['matkul'] ?>|<?= $Matkul['sks'] ?>">
                                                <?= $Matkul['matkul'] ?> (<?= $Matkul['sks'] ?> SKS)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>  
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Nilai </span>
                                    <select class="form-select" aria-label="Default select example" name="grade" required>
                                         <option value="A">A</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B">B</option>
                                        <option value="B-">B-</option>
                                        <option value="C+">C+</option>
                                        <option value="C">C</option>
                                        <option value="C-">C-</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                    </select>       
                                </div>
                                
                                
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah Mahasiswa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>