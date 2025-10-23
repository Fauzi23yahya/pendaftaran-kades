<?php

include('config/koneksi.php');
session_start();

if(isset($_POST['btn_registrasi'])) {
    //print_r($_POST);

    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = date("y-m-d", strtotime($_POST['tanggal_lahir']));
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $password = md5( $_POST['password']);
    $ulangi_password = md5($_POST['ulangi_password']);

    if($password != $ulangi_password) {
        echo "Error: Password Tidak Sama";
        echo "<br><br> <button type='button' onclick='histury.back();'> Kembali </button>";
        die;
    }

    //insert tabel users
    $sql_user = "INSERT INTO users (nama, username, password, level) values ('$nama', '$email', '$password', 'user')";
    $result_user = mysqli_query($koneksi, $sql_user);

    if($result_user){
        $users_id = mysqli_insert_id($koneksi);
        }

       //insert tabel pendaftar
       $sql_pendaftar ="INSERT INTO pendaftar (nama, tmpt_lahir, tgl_lahir, jenis_kelamin, agama, alamat, email, telepon, users_id) value('$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$agama', '$alamat', '$email', '$telepon', '$users_id' )";

        $result_pendaftar = mysqli_query($koneksi, $sql_pendaftar);

        if($result_pendaftar){

            $_SESSION['pesan_registrasi'] ="Registrasi Berhasil, Login menggunakan Email dan Password";
            
            header('location:login.php');

        } else {
            //jika query pendaftar gagal
            echo "Error insert pendaftar: ". mysqli_error($koneksi);
            echo "<br><br> <button type='button' onclick='histury.back();'> Kembali </button>";
            die;
        }

    } else {
        //jika query users gagal
        echo "Error insert users: ". mysqli_error($koneksi);
        echo "<br><br> <button type='button' onclick='histury.back();'> Kembali </button>";
        die;
}

?>