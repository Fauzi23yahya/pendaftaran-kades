<?php

// tabel pendaftar
$all_pendaftar = mysqli_query($koneksi, "SELECT pendaftar.*, nilai.file_kk, nilai.file_ktp, nilai.file_ijazah, nilai.file_surat_desa, nilai.file_surat_kecamatan, nilai.file_foto, nilai.status FROM pendaftar, nilai WHERE pendaftar.id = nilai.pendaftar_id");

// cek hasil
if(!$all_pendaftar) {
    die('Query Error : '. mysqli_query($koneksi));
}

?>