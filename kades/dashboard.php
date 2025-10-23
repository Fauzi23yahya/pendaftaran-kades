 <?php include('../config/auto_load.php'); ?>

 <?php include('dashboard_control.php'); ?>

 <?php include('../template/header.php'); ?>
 
 <!-- Begin Page Content -->
        <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
                    <div class="row">

                        <?php if(!isset($status)) { ?>
                        <div class="col-md-6">
                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">SELAMAT DATANG DI APLIKASI PENDAFTARAN KEPALA DESA BARU 2027 KAB. GARUT</h6>
                                </div>
                                <div class="card-body">
                                    <p class="text-danger">* INFORMASI!</p>
                                        <div class="form-group">
                                            <ul class="list-group mb-3">
                                        <li class="list-group-item">Silahkan Masukan File yang Dibutuhkan
                                        </li>
                                        <li class="list-group-item">Klik Tautan Nilai
                                        </li>
                                        <li class="list-group-item">Lalu Masukan Data sesuai Intruksi
                                        </li>
                                        <div class="text-right">
                                        </div>    
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php } else if(isset($status) && $status == 0) { ?>

                            <div class="col-md-6">
                                    <!-- Illustrations -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">PENGUMUMAN HASIL SELEKSI</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="card text-center">
                                                <h5 class="card-title mb-3 mt-3">Proses Penilaian</h5>
                                                <div class="col-auto">
                                                <i class="fa-solid fa-spinner text-warning" style="font-size: 90px;"></i>
                                                </div>
                                                <p class="card-text">Terima Kasih Telah Melakukan Pendaftaran, Pengumuman Pada Tanggal :</p>
                                                <span class="badge badge-danger" style="font-size: 18px;">4 OKTOBER 2025</span>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <marquee style="margin-bottom: -5px;">DINAS PEMBERDAYAAN MASYARAKAT DAN DESA - GARUT</marquee>

                                        </div>
                                    </div>
                            </div>

                        <?php } else if(isset($status) && $status == 1) { ?>

                            <div class="col-md-6">
                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">PENGUMUMAN HASIL SELEKSI</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card text-center">
                                        <h5 class="card-title mb-3 mt-3">Anda Lolos</h5>
                                        <div class="col-auto">
                                        <i class="fa-regular fa-circle-check text-success" style="font-size: 90px;"></i>
                                        </div>
                                        <p class="card-text">Selamat anda lolos Seleksi Bakal Calon Kepala Desa Serentak tahun 2027, nantikan informasi selanjutnya pada tanggal :</p>
                                        <span class="badge badge-danger" style="font-size: 18px;">10 OKTOBER 2025</span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <marquee style="margin-bottom: -5px;">DINAS PEMBERDAYAAN MASYARAKAT DAN DESA - GARUT</marquee>

                                </div>
                            </div>
                        </div>

                        <?php } else if(isset($status) && $status == 2) { ?>


                        <div class="col-md-6">
                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">PENGUMUMAN HASIL SELEKSI</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card text-center">
                                        <h5 class="card-title mb-3 mt-3">Anda Tidak Lolos</h5>
                                        <div class="col-auto">
                                        <i class="fa-solid fa-xmark text-danger" style="font-size: 90px;"></i>
                                        </div>
                                        <p class="card-text">Anda tidak Lolos. Terima Kasih</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <marquee style="margin-bottom: -5px;">DINAS PEMBERDAYAAN MASYARAKAT DAN DESA - GARUT</marquee>
                                </div>
                            </div>
                        </div>
                        
                        <?php } ?>
                        
                        <!-- Data Diri-->
                    <div class="col-md-6">
                                <!-- Illustrations -->
                        <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Diri</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <?php
                                        if(isset($data_pendaftar['foto'])) {
                                            $foto = '../uploads/' . $data_pendaftar['foto'];
                                        } else {
                                            $foto = '../style/img/user.png';
                                        }
                                        ?>
                                        <img src="<?= $foto ?>" alt="fotoprofil" class="img-fluid rounded-circle" style="width: 170px;">
                                    </div>
                                    <div class="text-right">
                                        <a href="editprofile.php" class="btn btn-warning btn-sm">Edit profile</a>
                                    </div>
                                    <h5 class="text-center card-title mb-3">
                                        <?= $data_pendaftar['nama'] ?>
                                    </h5>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color: black;">Tempat, Tanggal lahir</h6>
                                            <small class="text-muted"><?= $data_pendaftar['tmpt_lahir'] ?>, <?= date("d-m-y", strtotime( $data_pendaftar['tgl_lahir'])) ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color: black;">Jenis Kelamin</h6>
                                            <?php
                                            if($data_pendaftar['jenis_kelamin'] == 'L'){
                                                $kelamin = "Laki-Laki";
                                             } else {
                                                $kelamin = "Perempuan";
                                            }
                                            ?>
                                            <small class="text-muted"><?= $kelamin?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color: black;">Agama</h6>
                                            <small class="text-muted"><?= $data_pendaftar['agama'] ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color: black;">Alamat</h6>
                                            <small class="text-muted"><?= $data_pendaftar['alamat'] ?></small>
                                         </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color: black;">Email</h6>
                                            <small class="text-muted"><?= $data_pendaftar['email'] ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color: black;">Telepon</h6>
                                            <small class="text-muted"><?= $data_pendaftar['telepon'] ?></small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
                <!-- /.container-fluid -->

<?php include('../template/footer.php'); ?>