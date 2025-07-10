<?php 
session_start();
require_once '../koneksi/koneksi.php';

if(!isset($_SESSION['username'])){
    header("Location: ../index.php");
    exit;
}

$result = $conn->query("SELECT * FROM dosen");



$nomor = 1

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen - Portal Admin</title>
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
                    <a href="#" class="navigation underline active-canvas"><i class="fas fa-box-open"></i> Dosen</a>
                    <a href="../matkul/matkul.php" class="navigation underline"><i class="fas fa-file-alt"></i> Mata Kuliah</a>
                    <a href="../laporan/laporan.php" class="navigation underline"><i class="fas fa-cog "></i> Laporan</a>
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
                <div class="container-dosen p-2 mt-5">
                    <div class="main-container-dosen table-responsive p-lg-5 p-4">
                        <div class="header-container-dosen d-flex justify-content-between my-2">
                            <div class="search-dosen d-flex">
                                <form action="" class="d-flex" role="search">
                                    <input class="form-control me-2 form-control-sm" type="search" placeholder="Nama Dosen" aria-label="Search"/>
                                    <button class="btn btn-outline-success btn-sm" type="submit">Cari</button>
                                </form>
                            </div>
                            <div class="add-dosen">
                                <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahDosen">Tambah</a>
                            </div>
                        </div>
                        <div class="table-container text-nowrap">
                            <div class="table-responsive border-rounded">
                                <table class="table table-bordered">
                                    <thead class="bg-body-secondary">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Program Studi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-success">
                                        <?php while($dosen = $result->fetch_assoc()) : ?>
                                        <?php if($dosen['status'] == 'Dosen Tetap'){
                                            $class = 'text-bg-success';
                                            } elseif($dosen['status'] == 'Dosen Tidak Tetap'){
                                                $class = 'text-bg-danger';
                                            } else {
                                                $class = 'text-bg-warning';
                                            }
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $nomor ?></th>
                                            <td><?= $dosen['nama'] ?></td>
                                            <td><?= $dosen['prodi'] ?></td>
                                            <td>
                                                <span class="badge <?= $class ?>"><?= $dosen['status'] ?></span>
                                            </td>
                                            <td>
                                                <div class="action d-flex gap-2 justify-content-center">
                                                    <a href="" class="btn btn-outline-primary d-flex align-items-center gap-1 btn-responsive"  data-bs-toggle="modal" data-bs-target="#modal-dosen-<?= $dosen['id'] ?>"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                                    <form action="hapusDosen.php" method="POST">
                                                        <input type="hidden" name="id" value="<?= $dosen['id'] ?>">
                                                        <button type="submit" onclick="return confirm('Yakin Ingin Menghapus Data ini?')" class="btn btn-outline-danger d-flex align-items-center gap-1 btn-responsive"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>



                                        <div class="modal fade" id="modal-dosen-<?= $dosen['id'] ?>" tabindex="-1" aria-labelledby="modal-dosen-label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="modal-dosen-label"><?= $dosen['nama'] ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="data-diri">
                                                            <div class="biodata-dosen row m-0 gap-2">
                                                                <form action="editDosen.php" method="POST">
                                                                    <input type="hidden" value="<?= $dosen['id'] ?>" name="id">
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text">Nama </span>
                                                                        <input class="form-control" name="nama" type="text" value="<?= $dosen['nama'] ?>">
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text">Prodi </span>
                                                                        <select class="form-select" aria-label="Default select example" name="prodi" required>
                                                                            <option value="Ilmu Komputer" <?= $dosen['prodi'] == 'Ilmu Komputer' ? 'selected' : '' ?>>Ilmu Komputer</option>
                                                                            <option value="Sistem Informasi" <?= $dosen['prodi'] == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                                                                            <option value="Teknik Industri" <?= $dosen['prodi'] == 'Teknik Industri' ? 'selected' : '' ?>>Teknik Industri</option>
                                                                            <option value="Matematika" <?= $dosen['prodi'] == 'Matematika' ? 'selected' : '' ?>>Matematika</option>
                                                                        </select>       
                                                                    </div>
                                                                    <div class="input-group mb-2">
                                                                        <span class="input-group-text">Status Dosen</span>
                                                                        <select class="form-select" name="status" aria-label="Default select example">
                                                                            <option value="Dosen Tetap" <?= $dosen['status'] == 'Dosen Tetap' ? 'selected' : '' ?>>Dosen Tetap</option>
                                                                            <option value="Dosen Tidak Tetap" <?= $dosen['status'] == 'Dosen Tidak Tetap' ? 'selected' : '' ?>>Dosen Tidak Tetap</option>
                                                                            <option value="Dosen Kontrak" <?= $dosen['status'] == 'Dosen Kontrak' ? 'selected' : '' ?>>Dosen Kontrak</option>
                                                                        </select>       
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Jenis Kelamin </span>
                                                                        <select class="form-select" aria-label="Default select example" name="kelamin">
                                                                            <option value="Laki-Laki" <?= $dosen['kelamin'] == 'Laki-Laki' ? 'selected' : '' ?>>Laki-laki</option>
                                                                            <option value="Perempuan" <?= $dosen['kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                                                        </select>       
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Ubah Data</button>
                                                        </form>
                                                    </div>
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
                                <span class="small">Menampilkan 1 - 10 dari 1 Dosen</span>
                            </div>
                            <div class="pagination-dosen">
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
                <a href="#" class="navigation-md underline-md  active-canvas"><i class="fas fa-box-open"></i> Dosen</a>
                <a href="../matkul/matkul.php" class="navigation-md underline-md"><i class="fas fa-file-alt"></i> Mata Kuliah</a>
                <a href="../laporan/laporan.php" class="navigation-md underline-md"><i class="fas fa-cog "></i> Laporan</a>
                <a href="../owner/owner.php" class="navigation-md underline-md"><i class="fa-solid fa-copyright"></i> Owner</a>
            </div>
        </div>
    </div>





    <!-- Bagian modal tambah Dosen-->


    <div class="modal fade" id="modalTambahDosen" tabindex="-1" aria-labelledby="addDosen-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDosen-modal">Tambah Dosen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="data-diri">
                        <div class="biodata-dosen row m-0 gap-2">
                            <form action="tambahDosen.php" method="POST">
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Nama </span>
                                    <input class="form-control" name="nama" type="text" required>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Prodi </span>
                                    <select class="form-select" aria-label="Default select example" name="prodi" required>
                                        <option selected value="Ilmu Komputer">Ilmu Komputer</option>
                                        <option value="Sistem Informasi">Sistem Informasi</option>
                                        <option value="Teknik Industri">Teknik Industri</option>
                                        <option value="Matematika">Matematika</option>
                                    </select>       
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Status Dosen</span>
                                    <select class="form-select" name="status" aria-label="Default select example">
                                        <option selected value="Dosen Tetap">Dosen Tetap</option>
                                        <option value="Dosen Tidak Tetap">Dosen Tidak Tetap</option>
                                        <option value="Dosen Kontrak">Dosen Kontrak</option>
                                    </select>       
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">Jenis Kelamin </span>
                                    <select class="form-select" aria-label="Default select example" name="kelamin">
                                        <option selected value="Laki-Laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>       
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah Dosen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- end modal -->

    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>