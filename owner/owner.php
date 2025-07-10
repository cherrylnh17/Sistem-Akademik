<?php 
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../index.php");
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah - Portal Admin</title>
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
                    <a href="../laporan/laporan.php" class="navigation underline"><i class="fas fa-cog "></i> Laporan</a>
                    <a href="#" class="navigation underline active-canvas"><i class="fa-solid fa-copyright"></i> Owner</a>
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
                

                <div class="technology-owner mt-lg-4 mt-2 d-flex flex-column justify-content-center align-items-center mb-lg-4 mb-2">
                    <div class="main-technology text-center mb-3">
                        <span class="h5 fw-bold">Technology</span>
                    </div>
                    <div class="detail-technology d-flex justify-content-center align-items-center">
                        <div class="html">
                            <img src="../img/html.png" alt="" >
                        </div>
                        <div class="css">
                            <img src="../img/css.png" alt="">
                        </div>
                        <div class="bootstrap">
                            <img src="../img/bootstrap.png" alt="">
                        </div>
                        <div class="javascript">
                            <img src="../img/javascript.png" alt="">
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
                <a href="../laporan/laporan.php" class="navigation-md underline-md"><i class="fas fa-cog "></i> Laporan</a>
                <a href="#" class="navigation-md underline-md active-canvas"><i class="fa-solid fa-copyright"></i> Owner</a>
            </div>
        </div>
    </div>





    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>