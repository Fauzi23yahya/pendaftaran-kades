<?php include('../config/auto_load.php'); ?>

<?php include('editprofile_control.php'); ?>

<?php include('../template/header.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">EDIT PROFIL</h1>
                    <form class="user" method="POST" action="<?= $base_url ?>/kades/editprofile.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8">
                                
                                    <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" placeholder="Nama Anda..." name="nama" value="<?= $data_pendaftar['nama'] ?>">
                                    </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                    <input type="text" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir Anda..." name="tempat_lahir" value="<?= $data_pendaftar['tmpt_lahir'] ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir Anda..." name="tanggal_lahir" value="<?= date("d-m-y", strtotime($data_pendaftar['tgl_lahir'])); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                                    <?php
                                                    $laki ="";
                                                    $perempuan ="";

                                                    if($data_pendaftar['jenis_kelamin'] == "L"){
                                                        $laki = "checked";
                                                    } else {
                                                        $perempuan = "checked";
                                                    }
                                                    ?>

                                                    <div class="form-check">
                                                        <input type="radio" name="jenis_kelamin" class="form-check-input" id="laki" value="L" <?= $laki ?>>
                                                        <label for="laki" class="form-check-label">Laki-laki</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name="jenis_kelamin" class="form-check-input" id="perempuan" <?= $perempuan ?>>
                                                        <label for="perempuan" class="form-check-label">Perempuan</label>
                                                    </div>
                                                    </div>    
                                                    <div class="col-md-6">
                                                        <label form="agama">Agama</label>
                                                        <select name="agama" id="agama" class="form-control">
                                                            <option value="">Pilih Agama</option>
                                                            <option value="islam" <?php if($data_pendaftar['agama'] == 'islam'){echo "selected"; } ?>>Islam</option>
                                                            <option value="kristen" <?php if($data_pendaftar['agama'] == 'kristen'){echo "selected"; } ?>>Kristen</option>
                                                            <option value="katolik" <?php if($data_pendaftar['agama'] == 'katolik'){echo "selected"; } ?>>Katolik</option>
                                                            <option value="budha" <?php if($data_pendaftar['agama'] == 'budha'){echo "selected"; } ?>>Budha</option>
                                                            <option value="hindu" <?php if($data_pendaftar['agama'] == 'hindu'){echo "selected"; } ?>>Hindu</option>
                                                            <option value="konghucu" <?php if($data_pendaftar['agama'] == 'konghucu'){echo "selected"; } ?>>Konghucu</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea name="alamat" id="alamat" class="form-control"><?= $data_pendaftar['alamat'] ?></textarea>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="email">Email Aktif</label>
                                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email Aktif Anda..." value="<?= $data_pendaftar['email'] ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="telepon">Telepon</label>
                                                        <input type="text" name="telepon" class="form-control" id="telepon" placeholder="Telepon Anda..." value="<?= $data_pendaftar['telepon'] ?>">
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="password">Password</label>
                                                        <input type="password" name="password" class="form-control" id="pasword" placeholder="Masukan Password Anda...">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="ulangi_password">Ulangi Password</label>
                                                        <input type="password" name="ulangi_password" class="form-control" id="ulang_password" placeholder="Ulangi Password Anda...">
                                                    </div>
                                                </div> -->
                                            
                                
                            </div>
                            <div class="col-md-4">
                                <?php
                                    if(isset($data_pendaftar['foto'])) {
                                    $foto = '../uploads/' . $data_pendaftar['foto'];
                                    } else {
                                    $foto = '../style/img/user.png';
                                    }
                                ?>
                                <img src="<?= $foto ?>" alt="foto profil" class="img-fluid">
                                <input type="file" name="gambar" class="from-control mt-2">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="btn_simpan" value="simpan_profil" class="btn btn-primary mb-5">Ubah</button>
                                <a href="dashboard.php" class="btn btn-danger mb-5">kembali</a>
                            </div>
                        </div>
                    </form>
                    

                </div>
                <!-- /.container-fluid -->
<?php include('../template/footer.php'); ?>