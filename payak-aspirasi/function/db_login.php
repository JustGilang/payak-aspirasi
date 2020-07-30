<?php
session_start();
include '../config/config.php';

$id = $_POST['username'];
$pass = $_POST['pass'];
$jabatan = $_POST['jabatan'];

if($jabatan == "kelurahan"){
    $query = mysqli_query($conn, "SELECT id_user FROM data_kelurahan WHERE id_user='$id'");
    $data = mysqli_fetch_array($query);
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['status'] = "login";
    if(isset($_SESSION['id_user'])){
        echo '
            <script>
            alert("Login Sukses!");
            window.location = "../kelurahan/index.php"
            </script>
        ';
    } else {
        echo '
            <script>
            alert("Password Salah !");
            window.location = "../index.php"
            </script>
        ';
    }
} elseif ($jabatan == "rw") {
    $query = mysqli_query($conn, "SELECT id_user FROM data_rw WHERE id_user='$id'");
    $data = mysqli_fetch_array($query);
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['jabatan'] = $data['jabatan'];
    $_SESSION['status'] = "login";
    if(isset($_SESSION['id_user'])){
        echo '
            <script>
            alert("Login Sukses!");
            window.location = "../rw/index.php"
            </script>
        ';
    } else {
        echo '
            <script>
            alert("Password Salah !");
            window.location = "../index.php"
            </script>
        ';
    }
} elseif ($jabatan == "rt") {
    $query = mysqli_query($conn, "SELECT id_user FROM data_rt WHERE id_user='$id'");
    $data = mysqli_fetch_array($query);
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['jabatan'] = $data['jabatan'];
    $_SESSION['status'] = "login";
    if(isset($_SESSION['id_user'])){
        echo '
            <script>
            alert("Login Sukses!");
            window.location = "../rt/index.php"
            </script>
        ';
    } else {
        echo '
            <script>
            alert("Password Salah !");
            window.location = "../index.php"
            </script>
        ';
    }
} elseif ($jabatan == "warga") {
    $query = mysqli_query($conn, "SELECT id_user FROM data_warga WHERE id_user='$id'");
    $data = mysqli_fetch_array($query);
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['jabatan'] = $data['jabatan'];
    $_SESSION['status'] = "login";
    if(isset($_SESSION['id_user'])){
        echo '
            <script>
            alert("Login Sukses!");
            window.location = "../warga/index.php"
            </script>
        ';
    } else {
        echo '
            <script>
            alert("Password Salah !");
            window.location = "../index.php"
            </script>
        ';
    }
} else {
    echo '
        <script>
        alert("Isi Jabatan !");
        window.location = "../index.php"
        </script>
    ';
}
?>