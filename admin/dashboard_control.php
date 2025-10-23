<?php
// tabel pendaftar
$all_pendaftar = mysqli_query($koneksi, "SELECT * FROM pendaftar, nilai WHERE pendaftar.id = nilai.pendaftar_id AND nilai.status = 0");

// cek hasil
if(!$all_pendaftar) {
    die('Query Error : '. mysqli_query($koneksi));
}

// jml pendaftar
$jml_pendaftar = mysqli_query($koneksi, "SELECT * FROM pendaftar, nilai WHERE pendaftar.id = nilai.pendaftar_id");

// cek hasil
if(!$all_pendaftar) {
    die('Query Error : '. mysqli_query($koneksi));
}

// jml lolos
$jml_lolos = mysqli_query($koneksi, "SELECT * FROM pendaftar, nilai WHERE pendaftar.id = nilai.pendaftar_id AND nilai.status = 1");

// cek hasil
if(!$all_pendaftar) {
    die('Query Error : '. mysqli_query($koneksi));
}
?>