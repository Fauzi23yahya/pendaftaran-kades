<?php include('../config/auto_load.php'); ?>

<?php include('nilai_control.php'); ?>

<?php include('../template/header.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">UPLOAD DATA</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data File</h6>
                                </div>
                                <div class="card-body">
                                    <p class="text-danger">* Ubah jika ada kesalahan</p>
                                    <form action="nilai_control.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="pendaftar_id" value="<?php echo $pendaftar_id; ?>">

                                        <div class="form-group">
                                            <label>Masukkan File Kartu Keluarga:</label><br>
                                            <input type="file" name="file_kk" required><br>
                                        </div>

                                        <div class="form-group">
                                            <label>Masukkan File KTP Anda:</label><br>
                                            <input type="file" name="file_ktp" required><br>
                                        </div>
                                        <div class="form-group">
                                            <label>Masukkan File Ijazah:</label><br>
                                            <input type="file" name="file_ijazah" required><br>
                                        </div>

                                        <div class="form-group">
                                            <label>Masukkan File Surat dari Desa:</label><br>
                                            <input type="file" name="file_surat_desa" required><br>
                                        </div>

                                        <div class="form-group">
                                            <label>Masukkan File Surat dari Kecamatan:</label><br>
                                            <input type="file" name="file_surat_kecamatan" required><br>
                                        </div>

                                        <div class="form-group">
                                            <label>Masukkan Foto Anda:</label><br>
                                            <input type="file" name="file_foto" required><br>
                                        </div>                                  
                                        <hr>
                                        <div class="text-right">
                                        <button type="submit" name="upload" class="btn-simpan">Simpan</button>
                                        <button type="button" class="btn-kembali" onclick="window.location.href='dashboard.php'">Kembali</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
                <!-- /.container-fluid -->
                 
<?php include('../template/footer.php'); ?>