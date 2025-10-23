<?php
include('../config/auto_load.php');

if (!isset($_GET['id'])) {
    die("ID pendaftar tidak ditemukan");
}

$id_pendaftar = intval($_GET['id']);

// 🔹 Ambil data pendaftar + data user (nama & level)
$sql_pendaftar = "
    SELECT p.*, u.nama, u.username, u.level
    FROM pendaftar p
    JOIN users u ON p.users_id = u.id
    WHERE p.id = '$id_pendaftar'
";
$result_pendaftar = mysqli_query($koneksi, $sql_pendaftar);
if (!$result_pendaftar) {
    die('Query Error (pendaftar): ' . mysqli_error($koneksi));
}
$data_pendaftar = mysqli_fetch_assoc($result_pendaftar);

// 🔹 Ambil data nilai berdasarkan kolom pendaftar_id
$sql_nilai = "SELECT * FROM nilai WHERE pendaftar_id = '$id_pendaftar'";
$result_nilai = mysqli_query($koneksi, $sql_nilai);
if (!$result_nilai) {
    die('Query Error (nilai): ' . mysqli_error($koneksi));
}
$data_nilai = mysqli_fetch_assoc($result_nilai);

// 🔹 Proses validasi admin (ubah status)
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'lolos') {
        $update = mysqli_query($koneksi, "UPDATE nilai SET status = 1 WHERE pendaftar_id = '$id_pendaftar'");
    } elseif ($action == 'tidak_lolos') {
        $update = mysqli_query($koneksi, "UPDATE nilai SET status = 2 WHERE pendaftar_id = '$id_pendaftar'");
    }

    if (isset($update) && $update) {
        header("Location: detailpendaftar.php?id=$id_pendaftar");
        exit;
    } elseif (isset($update) && !$update) {
        echo "Gagal memperbarui status: " . mysqli_error($koneksi);
    }
}