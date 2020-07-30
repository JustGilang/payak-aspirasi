<?php
include '../config/config.php';

switch($_GET['act']){
    case 'add_pengumuman' :
        $id = $_POST['id'];
        $id_usr = $_POST['id_usr'];
        $subjek = $_POST['subjek'];
        $date = $_POST['date'];
        $waktu = $_POST['waktu'];
        $lokasi = $_POST['lokasi'];
        $rt = $_POST['rt'];
        $rw = $_POST['rw'];
        $isi = $_POST['isi'];

        $sql = mysqli_query($conn, "INSERT INTO data_pengumuman (id_pengumuman, id_user, subjek, tanggal, waktu, lokasi, rt, rw, isi)
        VALUES ('".$id."', '".$id_usr."', '".$subjek."', '".$date."', '".$waktu."', '".$lokasi."', '".$rt."', '".$rw."', '".$isi."')");
        if($sql){
            echo '
            <script>
                alert("Sukses Tambah Data !");
                window.location = "../rt/index.php"
            </script>
            ';
        }
    break;
}
?>