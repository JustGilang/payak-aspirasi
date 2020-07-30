<?php

include '../config/config.php';

switch($_GET['act']){

    case 'add_rw' :
        $id = $_POST['id'];
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $no_telp = $_POST['telp'];
        $rt = $_POST['rt'];
        $rw = $_POST['rw'];
        $pswd = $_POST['pass'];
        $jabatan = "rw";
        $status = "aktif";

        $sql = mysqli_query($conn, "INSERT INTO data_rw (id_user, nik, nama, no_telp, rt, rw, pswd, jabatan, stats)
        VALUES ('".$id."','".$nik."','".$nama."','".$no_telp."','".$rt."','".$rw."', '".$pswd."', '".$jabatan."','".$status."')");
        if($sql){
            echo '
            <script>
                alert("Sukses Tambah Data !");
                window.location = "../kelurahan/rw.php"
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal Tambah Data !");
                window.location = "../kelurahan/rw.php"
            </script>
            ';
        }
    break;

    case 'add_rt' :
        $id = $_POST['id'];
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $no_telp = $_POST['telp'];
        $rt = $_POST['rt'];
        $rw = $_POST['rw'];
        $pswd = $_POST['pass'];
        $jabatan = "rw";
        $status = "aktif";

        $sql = mysqli_query($conn, "INSERT INTO data_rt (id_user, nik, nama, no_telp, rt, rw, pswd, jabatan, stats)
        VALUES('".$id."','".$nik."','".$nama."','".$no_telp."','".$rt."','".$rw."', '".$pswd."', '".$jabatan."','".$status."')");
        if($sql){
            echo '
            <script>
                alert("Sukses Tambah Data !");
                window.location = "../kelurahan/rw.php"
            </script>
            ';
        }
    break;

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
                window.location = "../kelurahan/pengumuman.php"
            </script>
            ';
        }
    break;

    case 'edit_rw' :
        $id = $_POST['id'];
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $no_telp = $_POST['telp'];
        $rt = $_POST['rt'];
        $rw = $_POST['rw'];
        $pswd = $_POST['pass'];
        $status = $_POST['status'];

        $sql = mysqli_query($conn, "UPDATE data_rw SET nik='".$nik."', nama='".$nama."', no_telp='".$no_telp."', rt='".$rt."', rw='".$rw."', pswd='".$pass."', stats='".$status."' WHERE id_user='".$id."'");
        if($sql){
            echo '
            <script>
                alert("Sukses Edit Data !");
                window.location = "../kelurahan/rw.php"
            </script>
            ';
        }
    break;

    case 'edit_rt' :
        $id = $_POST['id'];
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $no_telp = $_POST['telp'];
        $rt = $_POST['rt'];
        $rw = $_POST['rw'];
        $pswd = $_POST['pass'];
        $status = $_POST['status'];

        $sql = mysqli_query($conn, "UPDATE data_rt SET nik='".$nik."', nama='".$nama."', no_telp='".$no_telp."', rt='".$rt."', rw='".$rw."', pswd='".$pass."', stats='".$status."' WHERE id_user='".$id."'");
        if($sql){
            echo '
            <script>
                alert("Sukses Edit Data !");
                window.location = "../kelurahan/rw.php"
            </script>
            ';
        }
    break;

    case 'edit_pengumuman' :
        $id = $_POST['id'];
        $subjek = $_POST['subjek'];
        $date = $_POST['date'];
        $waktu = $_POST['waktu'];
        $lokasi = $_POST['lokasi'];
        $rtrw = $_POST['rt/rw'];
        $isi = $_POST['isi'];

        $sql = mysqli_query($conn, "UPDATE data_pengumuman SET subjek='".$subjek."', tanggal='".$date."', waktu='".$waktu."', lokasi='".$lokasi."', rtrw='".$rtrw."', isi='".$isi."' WHERE id_pengumuman='".$id."'");
        if($sql){
            echo '
            <script>
                alert("Sukses Edit Data !");
                window.location = "../kelurahan/pengumuman.php"
            </script>
            ';
        }
    break;

    case 'edit_aspirasi' :
        $id = $_POST['id'];
        $status = $_POST['status'];

        $sql= mysqli_query($conn, "UPDATE data_pesan SET stats='".$status."' WHERE id_pesan='".$id."'");
        if($sql){
            echo '
            <script>
                alert("Sukses Edit Data !");
                window.location = "../kelurahan/index.php"
            </script>
            ';
        }
    break;

    case 'delete_rw' :
        $sql = mysqli_query($conn, "DELETE FROM data_rw WHERE id_user='".$_GET['id']."' ");
		if (isset($sql)) {
			# code...
			header('Location:../kelurahan/rw.php');
		}
    break;

    case 'delete_rt' :
        $sql = mysqli_query($conn, "DELETE FROM data_rt WHERE id_user='".$_GET['id']."' ");
		if (isset($sql)) {
			# code...
			header('Location:../kelurahan/rt.php');
		}
    break;

    case 'delete_pengumuman' :
        $sql = mysqli_query($conn, "DELETE FROM data_pengumuman WHERE id_user='".$_GET['id']."' ");
		if (isset($sql)) {
			# code...
			header('Location:../kelurahan/index.php');
		}
    break;
}
?>