<?php include('../config/auto_load.php'); ?>

<?php include('pendaftaran_control.php'); ?>

<?php include('../template/header.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Data Pendaftar</h1>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>Alamat</td>
                                    <td>No Telepon</td>
                                    <td>Status</td>
                                    <td>Actions</td>
                                </tr>

                                <?php
                                $no = 1;
                                while($p = mysqli_fetch_array($all_pendaftar)) { ?>
                                
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $p['nama'] ?></td>
                                    <td><?= $p['alamat'] ?></td>
                                    <td><?= $p['telepon'] ?></td>

                                    <?php
                                    if($p['status'] == 0) {
                                        $status = '<span class="badge badge-info">BARU</span>';

                                    } else if($p['status'] == 1) {
                                        $status = '<span class="badge badge-success">LOLOS</span>';

                                    } else if($p['status'] == 2) {
                                        $status = '<span class="badge badge-danger">TIDAK LOLOS</span>';
                                    }

                                    ?>
                                    <td><?= $status ?></td>
                                    <td>
                                        <a href="detailpendaftar.php?id=<?= $p['id'] ?>" class="btn btn-primary btn-sm">Cek</a>
                                        <a href="" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            
                                <?php } 
                                
                                if(mysqli_num_rows($all_pendaftar) == 0) {
                                    echo "<tr><td colspan='8' align='center'><b>Belum ada pendaftar baru<b></td></tr>";
                                }
                                
                                ?>

                            </table>
                        </div>
                    </div>      
                </div>
                <!-- /.container-fluid -->

<?php include('../template/footer.php'); ?>
