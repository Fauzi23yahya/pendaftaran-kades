<?php
// detailpendaftar.php (versi aman, bebas warning)
include('../config/auto_load.php');          // pastikan ini meng-set $koneksi dan session
include('detailpendaftar_control.php');      // pastikan file control sudah menghasilkan $data_pendaftar & $data_nilai
include('../template/header.php');

// helper kecil supaya tidak terus-terusan cek isset
function g($arr, $key, $default = '-') {
    if (!is_array($arr)) return $default;
    return isset($arr[$key]) && $arr[$key] !== '' ? $arr[$key] : $default;
}

// ambil role session (aman)
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// ambil id pendaftar (dari control atau GET)
$id_pendaftar = isset($id_pendaftar) ? $id_pendaftar : (isset($_GET['id']) ? intval($_GET['id']) : 0);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Pendaftar</h1>
    
    <div class="row">

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Diri</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <?php
                        // foto bisa ada di users atau di nilai, cek keduanya
                        $foto_file = null;
                        if (!empty($data_pendaftar) && isset($data_pendaftar['foto']) && $data_pendaftar['foto'] !== '') {
                            $foto_file = '../uploads/' . $data_pendaftar['foto'];
                        } elseif (!empty($data_nilai) && isset($data_nilai['file_foto']) && $data_nilai['file_foto'] !== '') {
                            $foto_file = '../uploads/' . $data_nilai['file_foto'];
                        } else {
                            $foto_file = '../style/img/user.png';
                        }
                        ?>
                        <img src="<?= htmlspecialchars($foto_file) ?>" alt="fotoprofil" class="img-fluid rounded-circle" style="width: 200px;">
                    </div>

                    <h5 class="text-center card-title mt-3">
                        <?= htmlspecialchars(g($data_pendaftar, 'nama', g($data_pendaftar, 'full_name', '-'))) ?>
                    </h5>

                    <ul class="list-group">
                        <li class="list-group-item">
                            <h6 class="mb-0" style="color: black;">Tempat, Tanggal Lahir</h6>
                            <?php
                                $tmpt = g($data_pendaftar, 'tmpt_lahir',
                                          g($data_pendaftar, 'tempat_lahir', '-'));
                                $tgl_raw = g($data_pendaftar, 'tgl_lahir',
                                          g($data_pendaftar, 'tanggal_lahir', ''));
                                $tgl_formatted = '-';
                                if ($tgl_raw !== '' && $tgl_raw !== '-') {
                                    // coba parse dan format, fallback jika gagal
                                    $ts = strtotime($tgl_raw);
                                    if ($ts !== false && $ts > 0) {
                                        $tgl_formatted = date("d-m-Y", $ts);
                                    } else {
                                        $tgl_formatted = $tgl_raw;
                                    }
                                }
                            ?>
                            <small><?= htmlspecialchars($tmpt) ?>, <?= htmlspecialchars($tgl_formatted) ?></small>
                        </li>

                        <li class="list-group-item">
                            <h6 class="mb-0" style="color: black;">Jenis Kelamin</h6>
                            <?php
                                $jk = g($data_pendaftar, 'jenis_kelamin',
                                      g($data_pendaftar, 'jk', ''));
                                if ($jk === '-' || $jk === '') {
                                    $kelamin_txt = '-';
                                } else {
                                    // normalize common values
                                    $jk_low = strtolower($jk);
                                    if (in_array($jk_low, ['l', 'laki', 'laki-laki', 'male'])) $kelamin_txt = 'Laki-Laki';
                                    elseif (in_array($jk_low, ['p', 'perempuan', 'female'])) $kelamin_txt = 'Perempuan';
                                    else $kelamin_txt = $jk;
                                }
                            ?>
                            <small><?= htmlspecialchars($kelamin_txt) ?></small>
                        </li>

                        <li class="list-group-item">
                            <h6 class="mb-0" style="color: black;">Agama</h6>
                            <small><?= htmlspecialchars(g($data_pendaftar, 'agama')) ?></small>
                        </li>

                        <li class="list-group-item">
                            <h6 class="mb-0" style="color: black;">Alamat</h6>
                            <small><?= nl2br(htmlspecialchars(g($data_pendaftar, 'alamat', g($data_pendaftar, 'address')))) ?></small>
                        </li>

                        <li class="list-group-item">
                            <h6 class="mb-0" style="color: black;">Email</h6>
                            <small><?= htmlspecialchars(g($data_pendaftar, 'email')) ?></small>
                        </li>

                        <li class="list-group-item">
                            <h6 class="mb-0" style="color: black;">Telepon</h6>
                            <small><?= htmlspecialchars(g($data_pendaftar, 'telepon', g($data_pendaftar, 'phone'))) ?></small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- kolom kanan: file & validasi -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DATA NILAI & DOKUMEN</h6>
                </div>
                <div class="card-body">
                    <?php
                    $status = isset($data_nilai['status']) ? intval($data_nilai['status']) : 0;
                    if ($status === 0) {
                        echo '<div class="alert alert-info">Data Pendaftar belum divalidasi</div>';
                    } elseif ($status === 1) {
                        echo '<div class="alert alert-success">✅ Pendaftar Lolos</div>';
                    } elseif ($status === 2) {
                        echo '<div class="alert alert-danger">❌ Pendaftar Tidak Lolos</div>';
                    } else {
                        echo '<div class="alert alert-secondary">Status: ' . htmlspecialchars($status) . '</div>';
                    }
                    ?>

                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <h6 class="mb-0">Kartu Keluarga</h6>
                            <?php if (!empty($data_nilai['file_kk'])): ?>
                                <a href="../kades/<?= htmlspecialchars($data_nilai['file_kk']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File</a>
                            <?php else: ?>
                                <small>Belum diunggah</small>
                            <?php endif; ?>
                        </li>

                        <li class="list-group-item">
                            <h6 class="mb-0">KTP</h6>
                            <?php if (!empty($data_nilai['file_ktp'])): ?>
                                <a href="../kades/<?= htmlspecialchars($data_nilai['file_ktp']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File</a>
                            <?php else: ?>
                                <small>Belum diunggah</small>
                            <?php endif; ?>
                        </li>

                        <li class="list-group-item">
                            <h6 class="mb-0">Ijazah</h6>
                            <?php if (!empty($data_nilai['file_ijazah'])): ?>
                                <a href="../kades/<?= htmlspecialchars($data_nilai['file_ijazah']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File</a>
                            <?php else: ?>
                                <small>Belum diunggah</small>
                            <?php endif; ?>
                        </li>

                        <li class="list-group-item">
                            <h6 class="mb-0">Surat dari Desa</h6>
                            <?php if (!empty($data_nilai['file_surat_desa'])): ?>
                                <a href="../kades/<?= htmlspecialchars($data_nilai['file_surat_desa']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File</a>
                            <?php else: ?>
                                <small>Belum diunggah</small>
                            <?php endif; ?>
                        </li>

                        <li class="list-group-item">
                            <h6 class="mb-0">Surat dari Kecamatan</h6>
                            <?php if (!empty($data_nilai['file_surat_kecamatan'])): ?>
                                <a href="../kades/<?= htmlspecialchars($data_nilai['file_surat_kecamatan']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File</a>
                            <?php else: ?>
                                <small>Belum diunggah</small>
                            <?php endif; ?>
                        </li>

                        <li class="list-group-item">
                            <h6 class="mb-0">Foto</h6>
                            <?php if (!empty($data_nilai['file_foto'])): ?>
                                <a href="../kades/<?= htmlspecialchars($data_nilai['file_foto']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File</a>
                            <?php else: ?>
                                <small>Belum diunggah</small>
                            <?php endif; ?>
                        </li>
                    </ul>

                    <!-- Tombol validasi: hanya tampil untuk admin -->
                    <?php if ($role === 'admin' && $status === 0): ?>
                        <div class="d-flex">
                            <a href="detailpendaftar.php?id=<?= $id_pendaftar ?>&action=lolos" class="btn btn-success btn-block mr-2" onclick="return confirm('Yakin ingin meloloskan pendaftar ini?')">Tandai Lolos ✅</a>
                            <a href="detailpendaftar.php?id=<?= $id_pendaftar ?>&action=tidak_lolos" class="btn btn-danger btn-block ml-2" onclick="return confirm('Yakin ingin menyatakan tidak lolos?')">Tandai Tidak Lolos ❌</a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
          
</div>
<!-- /.container-fluid -->

<?php include('../template/footer.php'); ?>