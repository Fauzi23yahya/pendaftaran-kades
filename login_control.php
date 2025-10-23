<?php include('../template/header.php'); ?>
<?php
include('config/koneksi.php');
session_start();

if(isset($_POST['btn_login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql_user = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result_user = mysqli_query($koneksi, $sql_user);

    // 🔹 Tambahkan debug ini:
    if (!$result_user) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($result_user) > 0) {
        while($data_user = mysqli_fetch_array($result_user)){
            $_SESSION['status'] = 'login';
            $_SESSION['id_users'] = $data_user['id'];
            $_SESSION['nama'] = $data_user['nama'];
            $_SESSION['level'] = $data_user['level'];

            if($data_user['level'] == 'user') {
                header('location:kades/dashboard.php');
            } else if($data_user['level'] == 'admin') {
                header('location:admin/dashboard.php');
            }
        }
    } else {
        $_SESSION['login_error'] = "Username atau password anda salah";
        header('location:login.php');
    }

} else {
    header('location:login.php');
}
?>
<?php include('../template/footer.php'); ?>