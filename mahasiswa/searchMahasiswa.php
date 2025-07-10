<?php 
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../index.php");
    exit;
}

require_once '../koneksi/koneksi.php';

$search = $_GET['nama'];
$safe = $conn->real_escape_string($search);

$result = $conn->query("SELECT * FROM mahasiswa WHERE nama LIKE '%$safe%'");



$nomor = 1
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa - Portal Admin</title>
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
                    <a href="mahasiswa.php" class="navigation underline active-canvas"><i class="fas fa-users"></i> Mahasiswa</a>
                    <a href="../dosen/dosen.php" class="navigation underline"><i class="fas fa-box-open"></i> Dosen</a>
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
                <div class="container-mahasiswa p-2 mt-5">
                    <div class="main-container-mahasiswa table-responsive p-lg-5 p-4">
                        <div class="header-container-mahasiswa d-flex justify-content-between my-2">
                            <div class="search-mahasiswa d-flex">
                                <form action="" class="d-flex" role="search">
                                    <input class="form-control me-2 form-control-sm" name="nama" type="search" placeholder="Nama Mahasiswa" aria-label="Search" value="<?= $search ?>"/>
                                    <button class="btn btn-outline-success btn-sm" type="submit">Cari</button>
                                </form>
                            </div>
                            <div class="add-mahasiswa">
                                <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahMahasiswa">Tambah</a>
                            </div>
                        </div>
                        <div class="table-container text-nowrap">
                            <div class="table-responsive border-rounded">
                                <table class="table table-bordered">
                                    <thead class="bg-body-secondary">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jurusan</th>
                                            <th scope="col">Perwalian</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <?php if(empty($name)) : ?>

                                    <tbody class="table-success">
                                        <?php while($mahasiswa = $result->fetch_assoc()) : ?>
                                        <?php if($mahasiswa['perwalian'] == 'approve'){
                                            $class = 'text-bg-success';
                                            } elseif($mahasiswa['perwalian'] == 'reject'){
                                                $class = 'text-bg-danger';
                                            } else {
                                                $class = 'text-bg-warning';
                                            }
                                        ?>
                                            <tr>
                                                <th><?= $nomor ?></th>
                                                <td><?= $mahasiswa['nama'] ?></td>
                                                <td><?= $mahasiswa['prodi'] ?></td>
                                                <td>
                                                    <span class="badge <?= $class ?>"><?= $mahasiswa['perwalian'] ?></span>
                                                </td>
                                                <td>
                                                    <div class="action d-flex gap-2 justify-content-center">
                                                        <a href="" class="btn btn-outline-primary d-flex align-items-center gap-1 btn-responsive"  data-bs-toggle="modal" data-bs-target="#modal-mahasiswa-<?= $mahasiswa['id_mahasiswa']; ?>"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                                    </div>
                                                </td>
                                            </tr>


                                            <div class="modal fade" id="modal-mahasiswa-<?= $mahasiswa['id_mahasiswa']; ?>" tabindex="-1" aria-labelledby="modal-mahasiswa-label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="modal-mahasiswa-label">Data <?= $mahasiswa['nama'] ?></h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="data-diri">
                                                                <form action="editMahasiswa.php" method="POST">
                                                                <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa'] ?>">
                                                                <div class="biodata-mahasiswa row m-0 gap-2">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Nama </span>
                                                                        <input class="form-control" name="nama" type="text" value="<?= $mahasiswa['nama'] ?>" required>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Email </span>
                                                                        <input class="form-control" name="email" type="text" value="<?= $mahasiswa['email'] ?>" required>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Nim </span>
                                                                        <input class="form-control" name="nim" type="number" value="<?= $mahasiswa['nim'] ?>" required>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Prodi </span>
                                                                        <input class="form-control" name="prodi" type="text" value="<?= $mahasiswa['prodi'] ?>" required>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Tanggal Lahir </span>
                                                                        <input class="form-control" name="tanggal_lahir" type="date" value="<?= $mahasiswa['tanggal_lahir'] ?>" required>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Jenis Kelamin </span>
                                                                        <select class="form-select" name="kelamin" aria-label="Default select example" required>
                                                                            <option value="laki-laki" <?= $mahasiswa['kelamin'] == 'laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                                                            <option value="perempuan" <?= $mahasiswa['kelamin'] == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                                                        </select>       
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Asal Kota </span>
                                                                        <input class="form-control" name="kota" type="text" value="<?= $mahasiswa['kota'] ?>" required>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Perwalian</span>
                                                                        <select class="form-select" name="perwalian" aria-label="Default select example" required>
                                                                            <option value="pending" <?= $mahasiswa['perwalian'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                                            <option value="approve" <?= $mahasiswa['perwalian'] == 'approve' ? 'selected' : '' ?>>Approve</option>
                                                                            <option value="reject" <?= $mahasiswa['perwalian'] == 'reject' ? 'selected' : '' ?>>Reject</option>
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

                                    <?php else : ?>
                                        <tbody class="table-success">
                                            <tr class="text-center fw-bold">
                                                <td colspan="5">Data Tidak Ditemukan</td>
                                            </tr>
                                        </tbody>

                                    <?php endif ; ?>
                                </table>
                            </div>
                        </div>
                        <div class="footer-content d-flex justify-content-between mt-2">
                            <div class="thispage">
                                <span class="small">Menampilkan 1 - 10 dari 2 Mahasiswa</span>
                            </div>
                            <div class="pagination-mahasiswa">
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
                <a href="#" class="navigation-md underline-md active-canvas"><i class="fas fa-users"></i> Mahasiswa</a>
                <a href="../dosen/dosen.php" class="navigation-md underline-md"><i class="fas fa-box-open"></i> Dosen</a>
                <a href="../matkul/matkul.php" class="navigation-md underline-md"><i class="fas fa-file-alt"></i> Mata Kuliah</a>
                <a href="../laporan/laporan.php" class="navigation-md underline-md"><i class="fas fa-cog "></i> Laporan</a>
                <a href="../owner/owner.php" class="navigation-md underline-md"><i class="fa-solid fa-copyright"></i> Owner</a>
            </div>
        </div>
    </div>



    <!-- Bagian modal tambah mahasiswa -->


    <div class="modal fade" id="modalTambahMahasiswa" tabindex="-1" aria-labelledby="addMahasiswa-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addMahasiswa-modal">Tambah Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="data-diri">
                        <div class="biodata-mahasiswa row m-0 gap-2">
                            <form action="addMahasiswa.php" method="POST">
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Nama </span>
                                    <input class="form-control" type="text" name="nama" placeholder="Masukan Nama" required>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Email </span>
                                    <input class="form-control" type="email" name="email" placeholder="Masukan Email" required>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Nim </span>
                                    <input class="form-control" type="number" name="nim" placeholder="Masukan Nim" required>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Prodi </span>
                                    <input class="form-control" type="text" name="prodi" placeholder="Prodi" required>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Tanggal Lahir </span>
                                    <input class="form-control" type="date" name="tanggal_lahir" value="2025-06-12" required>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Jenis Kelamin </span>
                                    <select class="form-select" aria-label="Default select example" name="kelamin">
                                        <option selected value="laki-laki">Laki-laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>       
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Asal Kota </span>
                                    <input class="form-control" type="text" placeholder="Masukan Kota" name="kota" required>
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




    <!-- end modal -->

    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>