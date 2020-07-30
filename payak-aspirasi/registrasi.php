<?php include 'config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *:active {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        -moz-tap-highlight-color: rgba(0, 0, 0, 0);
        tap-highlight-color: rgba(0, 0, 0, 0);
        }

        body {
        font-family: 'Lato', sans-serif;
        color: rgba(0, 0, 0, 0.8);
        max-width: 800px;
        margin: 0 auto;
        padding: 1em;
        min-height: 100vh;
        }

        h1 {
        margin: 1.2em 0;
        text-align: center;
        }

        form p {
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
                flex-direction: column;
        max-width: 480px;
        margin: 0 auto;
        }

        .rm {
        font-size: .7em;
        }

        label {
        font-size: 1.2em;
        padding: 1.2em 1em 0.5em 0;
        }

        label + input:not([type="submit"]) {
        margin-bottom: 1.5em;
        }

        input:not([type="submit"]) {
        font-size: 1em;
        padding: 1em;
        border: 1px solid rgba(0, 0, 0, 0.5);
        outline: none;
        -webkit-transition: color .2s, background .2s;
        transition: color .2s, background .2s;
        }
        input:not([type="submit"]):focus {
        border: 1px solid rgba(0, 0, 0, 0.8);
        background: rgba(0, 0, 0, 0.8);
        color: #fff;
        }

        .quantity {
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
                flex-direction: row;
        -webkit-box-pack: justify;
                justify-content: space-between;
        -webkit-box-align: center;
                align-items: center;
        padding-bottom: 1.3em;
        }

        label[for="qt"] {
        margin-right: 1em;
        -webkit-box-flex: 2;
                flex: 2;
        }

        input[type="number"] {
        margin-bottom: 0 !important;
        -webkit-box-flex: 1;
                flex: 1;
        min-width: 0;
        max-width: 4em;
        }

        input[type="text"] {
        margin-bottom: 0 !important;
        -webkit-box-flex: 1;
                flex: 1;
        width: 250px;
        height: 3px;
        }

        input[type="password"] {
        margin-bottom: 0 !important;
        -webkit-box-flex: 1;
                flex: 1;
        width: 250px;
        }

        input[type="submit"] {
        align-self: flex-end;
        outline: none;
        font-size: 1.2em;
        display: inline-block;
        position: relative;
        padding: .5em .8em;
        border-radius: 3px;
        color: #fff;
        border: none;
        background: #88304e;
        -webkit-transition: color .5s, background .5s;
        transition: color .5s, background .5s;
        }
        input[type="submit"]:hover, input[type="submit"]:active, input[type="submit"]:focus {
        cursor: pointer;
        background: #3d1523;
        color: #fff;
        }
        input[type="submit"]:active, input[type="submit"]:focus {
        top: 2px;
        }

        .input-group {
        position: relative;
        }

        .toggle {
        background: none;
        border: none;
        color: #88304e;
        display: inline-block;
        font-size: .9em;
        font-weight: 600;
        padding: .5em;
        position: absolute;
        right: 0.6em;
        bottom: 2.4em;
        z-index: 1;
        }

        input[id="txtPassword"]:focus + .toggle {
        color: #fff;
        }

    </style>
</head>
<body>
    <h3>Registrasi :</h3>
    <form action="function/db_warga.php?act=register" method="POST">
        
        <?php
        $query = "SELECT max(id_user) as maxKode FROM data_warga";
        $hasil = mysqli_query($conn,$query);
        $data = mysqli_fetch_array($hasil);
        $kode = $data['maxKode'];
        $noUrut = (int) substr($kode, 3, 3);
                
        $noUrut++;
                
        $char = "WR-";
        $kode = $char . sprintf("%03s", $noUrut);
        ?>
        <label for="url"> Kode <span class="rm">(required)</span></label>
        <input id="url" name="kode" type="text" value="<?= $kode?>" readonly /><br><br>

        <label for="url"> NIK <span class="rm">(required)</span></label>
        <input id="url" name="nik" type="text" required /><br><br>

        <label for="url"> Nama <span class="rm">(required)</span></label>
        <input id="url" name="nama" type="text" required /><br><br>

        <label for="url"> Nomor Telepon <span class="rm">(required)</span></label>
        <input id="url" name="no_telp" type="text" required /><br><br>

        <label for="url"> Rt <span class="rm">(required)</span></label>
        <input id="url" name="rt" type="text" required /><br><br>

        <label for="url"> Rw <span class="rm">(required)</span></label>
        <input id="url" name="rw" type="text" required /><br><br>

        <label for="url"> Password <span class="rm">(required)</span></label>
        <input id="txtPassword" name="pass" type="password" required /><br><br>
        
        <input type="submit" value="Send" />
        <a href="index.php"> kembali</a>
    </form>

    <script>
        // Code from https://codepen.io/AllThingsSmitty/pen/KgxmXv/, see http://allthingssmitty.com/2016/10/24/show-my-password-please/ for details
        (function () {
        
        
        var togglePassword = function (e) {
            e.preventDefault();
            let passwordInput = document.getElementById('txtPassword'),
                toggle = document.getElementById('btnToggle');

            if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggle.innerHTML = 'hide';
            } else {
            passwordInput.type = 'password';
            toggle.innerHTML = 'show';
            }

            this.previousElementSibling.focus();

            return false;
        };
        
        let toggle = document.getElementById('btnToggle');
        toggle.addEventListener('mousedown', togglePassword, false);
        
        })();
    </script>
</body>
</html>