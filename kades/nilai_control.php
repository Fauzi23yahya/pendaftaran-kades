<?php
include '../config/koneksi.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} include('../config/koneksi.php');
// Ambil ID user dari session
$id_user = $_SESSION['id_users'];

// Ambil data pendaftar berdasarkan user
$sql_pendaftar = "SELECT * FROM pendaftar WHERE users_id = '$id_user'";
$result_pendaftar = mysqli_query($koneksi, $sql_pendaftar);

if (mysqli_num_rows($result_pendaftar)) {

    $data_pendaftar = mysqli_fetch_array($result_pendaftar);
    $id_pendaftar = $data_pendaftar['id'];

    // Cek apakah sudah ada data nilai (file) untuk pendaftar ini
    $sql_nilai = "SELECT * FROM nilai WHERE pendaftar_id = '$id_pendaftar'";
    $result_nilai = mysqli_query($koneksi, $sql_nilai);

    if (mysqli_num_rows($result_nilai)) {
        $data_nilai = mysqli_fetch_array($result_nilai);
        $id_nilai = $data_nilai['id'];
    } else {
        $id_nilai = null;
    }

    // ====== BAGIAN UPLOAD FILE ======
    if (isset($_POST['upload'])) {

        // kalau belum ada record di tabel nilai → buat dulu
        if (!$id_nilai) {
            $sql_create_nilai = "INSERT INTO nilai (status, pendaftar_id) VALUES (0, '$id_pendaftar')";
            if (mysqli_query($koneksi, $sql_create_nilai)) {
                $id_nilai = mysqli_insert_id($koneksi);
            } else {
                echo "Gagal membuat data nilai baru: " . mysqli_error($koneksi);
                die;
            }
        }

        // Folder upload
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Ambil nama file dari input
        $fileKK = basename($_FILES["file_kk"]["name"]);
        $fileKTP = basename($_FILES["file_ktp"]["name"]);
        $fileIjazah = basename($_FILES["file_ijazah"]["name"]);
        $fileSuratDesa = basename($_FILES["file_surat_desa"]["name"]);
        $fileSuratKecamatan = basename($_FILES["file_surat_kecamatan"]["name"]);
        $fileFoto = basename($_FILES["file_foto"]["name"]);

        // Buat nama unik supaya gak tabrakan
        $timestamp = time();
        $targetFileKK = $targetDir . "kk_{$timestamp}_" . $fileKK;
        $targetFileKTP = $targetDir . "ktp_{$timestamp}_" . $fileKTP;
        $targetFileIjazah = $targetDir . "ijazah_{$timestamp}_" . $fileIjazah;
        $targetFileSuratDesa = $targetDir . "surat_desa_{$timestamp}_" . $fileSuratDesa;
        $targetFileSuratKecamatan = $targetDir . "surat_kecamatan_{$timestamp}_" . $fileSuratKecamatan;
        $targetFileFoto = $targetDir . "foto_{$timestamp}_" . $fileFoto;

        // Upload semua file (kalau diisi)
        $uploadOk = true;

        if (!empty($fileKK)) $uploadOk &= move_uploaded_file($_FILES["file_kk"]["tmp_name"], $targetFileKK);
        if (!empty($fileKTP)) $uploadOk &= move_uploaded_file($_FILES["file_ktp"]["tmp_name"], $targetFileKTP);
        if (!empty($fileIjazah)) $uploadOk &= move_uploaded_file($_FILES["file_ijazah"]["tmp_name"], $targetFileIjazah);
        if (!empty($fileSuratDesa)) $uploadOk &= move_uploaded_file($_FILES["file_surat_desa"]["tmp_name"], $targetFileSuratDesa);
        if (!empty($fileSuratKecamatan)) $uploadOk &= move_uploaded_file($_FILES["file_surat_kecamatan"]["tmp_name"], $targetFileSuratKecamatan);
        if (!empty($fileFoto)) $uploadOk &= move_uploaded_file($_FILES["file_foto"]["tmp_name"], $targetFileFoto);

        // Jika semua upload berhasil
        if ($uploadOk) {

            // Update data file di tabel nilai
            $update_files = "UPDATE nilai SET 
                                file_kk = IF('$fileKK' != '', '$targetFileKK', file_kk),
                                file_ktp = IF('$fileKTP' != '', '$targetFileKTP', file_ktp),
                                file_ijazah = IF('$fileIjazah' != '', '$targetFileIjazah', file_ijazah),
                                file_surat_desa = IF('$fileSuratDesa' != '', '$targetFileSuratDesa', file_surat_desa),
                                file_surat_kecamatan = IF('$fileSuratKecamatan' != '', '$targetFileSuratKecamatan', file_surat_kecamatan),
                                file_foto = IF('$fileFoto' != '', '$targetFileFoto', file_foto)
                             WHERE id = '$id_nilai'";

            if (mysqli_query($koneksi, $update_files)) {
                echo "<script>alert('File berhasil diupload!'); window.location='nilai.php';</script>";
            } else {
                echo "Gagal menyimpan data file: " . mysqli_error($koneksi);
            }

        } else {
            echo "Gagal mengupload file!";
        }
    }

} else {
    echo "Data pendaftar tidak ditemukan!";
}
?>