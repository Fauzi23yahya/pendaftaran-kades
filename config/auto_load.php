<?php

if (session_start() === PHP_SESSION_NONE) {
    session_start();
};

include('koneksi.php');

$base_url = "http://localhost/pendaftaran";

$uri_segment = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
//var_dump($uri_segment);

if(isset($_SESSION['status']) && $_SESSION['status'] == 'login'){
    // lanjut
    
} else {
    $_SESSION['login_error'] = "Silahkan Login untuk Masuk kedalam sistem";
    header('location:'. $base_url . '/login.php');
}

?>