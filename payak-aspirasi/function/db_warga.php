<?php
include '../config/config.php';

switch($_GET['act']){
    case 'register' :
        $kode = $_POST['kode'];
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $no_telp = $_POST['no_telp'];
        $rt = $_POST['rt'];
        $rw = $_POST['rw'];
        $pswd = $_POST['pass'];
        $jabatan = 'warga';
        $status = 'aktif';

        $sql = mysqli_query($conn, "INSERT INTO data_warga (id_user, nik, nama, no_telp, rt, rw, pswd, jabatan, stats) VALUES 
        ('$kode', '$nik', '$nama', '$no_telp', '$rt', '$rw', '$pswd', '$jabatan', '$status')");

        if($sql){
            echo '
            <script>
                alert("Sukses Tambah Data !");
                window.location = "../index.php"
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal Tambah Data !");
                window.location = "../index.php"
            </script>
            ';
        }
    break;

    case 'add_aspirasi':
        $id = $_POST['id'];
        $id_user = $_POST['id_user'];
        $tanggal = $_POST['tanggal'];
        $pesan = $_POST['pesan'];
        $rt = $_POST['rt'];
        $rw = $_POST['rw'];
        $subjek = $_POST['subjek'];

        $gambar = '-';
        $status = 'belum terselesaikan';

        $sql = mysqli_query($conn, "INSERT INTO data_pesan (id_pesan, id_warga, tanggal, pesan, subjek, gambar, rt, rw, stats) VALUES
        ('".$id."', '".$id_user."','".$tanggal."','".$pesan."','".$subjek."', '".$gambar."', '".$rt."', '".$rw."', '".$status."')");

        $target_dir = "../aspirasi/";//alamat lokasi folder gmbr akan disimpan
        $target_file = $target_dir . basename($_FILES["file"]["name"]);//detail spesifikasi lokasi dan nama file
        $uploadOk=1;

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                //Proses Files and DB
                //Files Data
                $fil_name=$_FILES["file"]["name"];

                //Inserting Database
                $sql = mysqli_query($conn, "UPDATE data_pesan SET gambar = '$fil_name' WHERE id_pesan='$id'");
                if(!$sql){
                    echo 'mysqli Error!';
                    mysqli_close($conn);
                    exit;
                }

                echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
                header( "refresh:3;url=../warga/index.php" );
                echo 'You\'ll be redirected in about 3 secs. If not, click <a href="../warga/index.php">here</a>.';
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    break;
}
?>