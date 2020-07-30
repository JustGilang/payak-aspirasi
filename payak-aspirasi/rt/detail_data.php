<?php
include '../config/config.php';
error_reporting(0);
session_start();	

if($_SESSION['status'] !="login"){
    echo '
        <script>
          alert("Silahkan Login Terlebih Dulu !");
          window.location = "../function/db_logout.php"
        </script>
    ';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
    <script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>
    <title>Document</title>
    <style>
        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0; 
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }
            
            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }
            
            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }
            
            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }
            
            table td::before {
                /*
                * aria-label has no advantage, it won't be read inside a table
                content: attr(aria-label);
                */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
            
            table td:last-child {
                border-bottom: 0;
            }
        }


        /*---- NUMBER OF SLIDE CONFIGURATION ----*/
        .wrapper {
            max-width: 60em;
            margin: 1em auto;
            position: relative;
        }

        input {
            display: none;
        }

        .inner {
            width: 500%;
            line-height: 0;
        }

        article {
            width: 20%;
            float: left;
            position: relative;
        }
        article img {
            width: 100%;
        }

        /*---- SET UP CONTROL ----*/
        .slider-prev-next-control {
            height: 50px;
            position: absolute;
            top: 50%;
            width: 100%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
        }
        .slider-prev-next-control label {
            display: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #fff;
            opacity: 0.7;
        }
        .slider-prev-next-control label:hover {
            opacity: 1;
        }

        .slider-dot-control {
            position: absolute;
            width: 100%;
            bottom: 0;
            text-align: center;
        }
        .slider-dot-control label {
            cursor: pointer;
            border-radius: 5px;
            display: inline-block;
            width: 10px;
            height: 10px;
            background: #bbb;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
        }
        .slider-dot-control label:hover {
            background: #ccc;
            border-color: #777;
        }

        /* Info Box */
        .info {
            position: absolute;
            font-style: italic;
            line-height: 20px;
            opacity: 0;
            color: #000;
            text-align: left;
            -webkit-transition: all 1000ms ease-out 600ms;
            -moz-transition: all 1000ms ease-out 600ms;
            transition: all 1000ms ease-out 600ms;
        }
        .info h3 {
            color: #fcfff4;
            margin: 0 0 5px;
            font-weight: normal;
            font-size: 1.5em;
            font-style: normal;
        }
        .info.top-left {
            top: 30px;
            left: 30px;
        }
        .info.top-right {
            top: 30px;
            right: 30px;
        }
        .info.bottom-left {
            bottom: 30px;
            left: 30px;
        }
        .info.bottom-right {
            bottom: 30px;
            right: 30px;
        }

        /* Slider Styling */
        .slider-wrapper {
            width: 100%;
            overflow: hidden;
            border-radius: 5px;
            box-shadow: 1px 1px 4px #666;
            background: #fff;
            background: #fcfff4;
            -webkit-transform: translateZ(0);
            -moz-transform: translateZ(0);
            -ms-transform: translateZ(0);
            -o-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-transition: all 500ms ease-out;
            -moz-transition: all 500ms ease-out;
            transition: all 500ms ease-out;
        }
        .slider-wrapper .inner {
            -webkit-transform: translateZ(0);
            -moz-transform: translateZ(0);
            -ms-transform: translateZ(0);
            -o-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-transition: all 800ms cubic-bezier(0.77, 0, 0.175, 1);
            -moz-transition: all 800ms cubic-bezier(0.77, 0, 0.175, 1);
            transition: all 800ms cubic-bezier(0.77, 0, 0.175, 1);
        }

        /*---- SET POSITION FOR SLIDE ----*/
        #slide1:checked ~ .slider-prev-next-control label:nth-child(2)::after, #slide2:checked ~ .slider-prev-next-control label:nth-child(3)::after, #slide3:checked ~ .slider-prev-next-control label:nth-child(4)::after, #slide4:checked ~ .slider-prev-next-control label:nth-child(5)::after, #slide5:checked ~ .slider-prev-next-control label:nth-child(1)::after, #slide2:checked ~ .slider-prev-next-control label:nth-child(1)::after, #slide3:checked ~ .slider-prev-next-control label:nth-child(2)::after, #slide4:checked ~ .slider-prev-next-control label:nth-child(3)::after, #slide5:checked ~ .slider-prev-next-control label:nth-child(4)::after, #slide1:checked ~ .slider-prev-next-control label:nth-child(5)::after {
            font-family: FontAwesome;
            font-style: normal;
            font-weight: normal;
            text-decoration: inherit;
            margin: 0;
            line-height: 38px;
            font-size: 3em;
            display: block;
            color: #777;
        }

        #slide1:checked ~ .slider-prev-next-control label:nth-child(2)::after, #slide2:checked ~ .slider-prev-next-control label:nth-child(3)::after, #slide3:checked ~ .slider-prev-next-control label:nth-child(4)::after, #slide4:checked ~ .slider-prev-next-control label:nth-child(5)::after, #slide5:checked ~ .slider-prev-next-control label:nth-child(1)::after {
            content: "\f105";
            padding-left: 15px;
        }

        #slide1:checked ~ .slider-prev-next-control label:nth-child(2), #slide2:checked ~ .slider-prev-next-control label:nth-child(3), #slide3:checked ~ .slider-prev-next-control label:nth-child(4), #slide4:checked ~ .slider-prev-next-control label:nth-child(5), #slide5:checked ~ .slider-prev-next-control label:nth-child(1) {
            display: block;
            float: right;
            margin-right: 5px;
        }

        #slide2:checked ~ .slider-prev-next-control label:nth-child(1), #slide3:checked ~ .slider-prev-next-control label:nth-child(2), #slide4:checked ~ .slider-prev-next-control label:nth-child(3), #slide5:checked ~ .slider-prev-next-control label:nth-child(4), #slide1:checked ~ .slider-prev-next-control label:nth-child(5) {
            display: block;
            float: left;
            margin-left: 5px;
        }

        #slide2:checked ~ .slider-prev-next-control label:nth-child(1)::after, #slide3:checked ~ .slider-prev-next-control label:nth-child(2)::after, #slide4:checked ~ .slider-prev-next-control label:nth-child(3)::after, #slide5:checked ~ .slider-prev-next-control label:nth-child(4)::after, #slide1:checked ~ .slider-prev-next-control label:nth-child(5)::after {
            content: "\f104";
            padding-left: 8px;
        }

        #slide1:checked ~ .slider-dot-control label:nth-child(1), #slide2:checked ~ .slider-dot-control label:nth-child(2), #slide3:checked ~ .slider-dot-control label:nth-child(3), #slide4:checked ~ .slider-dot-control label:nth-child(4), #slide5:checked ~ .slider-dot-control label:nth-child(5) {
            background: #333;
        }

        #slide1:checked ~ .slider-wrapper article:nth-child(1) .info, #slide2:checked ~ .slider-wrapper article:nth-child(2) .info, #slide3:checked ~ .slider-wrapper article:nth-child(3) .info, #slide4:checked ~ .slider-wrapper article:nth-child(4) .info, #slide5:checked ~ .slider-wrapper article:nth-child(5) .info {
            opacity: 1;
        }

        #slide1:checked ~ .slider-wrapper .inner {
            margin-left: 0%;
        }

        #slide2:checked ~ .slider-wrapper .inner {
            margin-left: -100%;
        }

        #slide3:checked ~ .slider-wrapper .inner {
            margin-left: -200%;
        }

        #slide4:checked ~ .slider-wrapper .inner {
            margin-left: -300%;
        }

        #slide5:checked ~ .slider-wrapper .inner {
            margin-left: -400%;
        }

        /*---- TABLET ----*/
        @media only screen and (max-width: 850px) and (min-width: 450px) {
            .slider-wrapper {
                border-radius: 0;
            }
        }
        /*---- MOBILE----*/
        @media only screen and (max-width: 450px) {
            .slider-wrapper {
                border-radius: 0;
            }

            .slider-wrapper .info {
                opacity: 0;
            }
        }
        
        .lightbox {
            background: #fff;
            border: 3px solid rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            opacity: 0;
            padding: 20px;
            visibility: hidden;
            width: 70%;
            position: absolute;
            top: 5rem;
            left: 50%;
            margin-left: -43%;
            transition: all 0.8s ease;
        }

        .lightbox__close {
            background: #fff;
            color: #000;
            display: block;
            font-weight: bold;
            height: 3rem;
            line-height: 3rem;
            text-align: center;
            text-decoration: none;
            width: 3rem;
            border-radius: 100%;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
            position: absolute;
            top: -1.5rem;
            right: -1.5rem;
        }

        .lightbox:target {
            opacity: 1;
            visibility: visible;
        }

        /*---- add button ----*/
        
        .add-button {
            position: absolute;
            right: 100px;
            bottom: -28px;
            width: 56px;
            height: 56px;
            overflow: visible;
            -webkit-transition: transform .4s cubic-bezier(.58,-0.37,.45,1.46),
                color 0s ease .4s,font-size .2s;
            -moz-transition: transform .4s cubic-bezier(.58,-0.37,.45,1.46),
                color 0s ease .4s,font-size .2s;
            transition: transform .4s cubic-bezier(.58,-0.37,.45,1.46),
                color 0s ease .4s,font-size .2s;
            text-align: center;
            line-height: 56px;
            font-size: 28px;
            color: rgba(255,255,255,1);
        }

        .add-button:before {
            position: relative;
            z-index: 100;
            content:"+";
        
        }

        .add-button:hover {
            color: rgba(255,255,255,0);
            transform: rotate(45deg);
        }

        .sub-button {
            position: absolute;
            display: inline-block;
            background-color:#ff4081;
            color: rgba(255,255,255,0);
            width: 28px;
            height: 28px;
            line-height:48px;
            font-family: "FontAwesome";
            font-size: 12px;
            -webkit-transition: top .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                left .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                bottom .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                right .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                width .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                height .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                transform .1s ease 0s,
                border-radius .2s  ease .2s;
            -moz-transition: top .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                left .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                bottom .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                right .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                width .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                height .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                transform .1s ease 0s,
                border-radius .2s  ease .2s;
            transition: top .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                left .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                bottom .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                right .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                width .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                height .2s cubic-bezier(.58,-0.37,.45,1.46) .2s,
                transform .1s ease 0s,
                border-radius .2s  ease .2s;
        }

        .tl {
            top: 0;
            left: 0;
            border-radius: 28px 0 0 0;
        }

        .tr {  
            top: 0;
            right: 0;
            border-radius: 0 28px 0 0;
        }

        .bl {
            bottom: 0;
            left: 0; 
            border-radius: 0 0 0 28px;
        }

        .br { 
            bottom: 0;
            right: 0;
            border-radius: 0 0 28px 0;
        }


        .tl:before {
            content:"";
        }

        .tr:before {
            content:"";
        }

        .bl:before {
            content:"";
        }

        .br:before {
            content:"";
        }


        .add-button:hover .sub-button {
            width: 48px;
            height: 48px;
            transform: rotate(-45deg);
            
            color: rgba(255,255,255,1);
            -webkit-transition: top .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                left .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                bottom .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                right .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                width .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                height .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                color .3s ease .8s,
                transform .3s ease .8s,
                border-radius .4s  ease .6s;
            -moz-transition: top .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                left .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                bottom .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                right .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                width .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                height .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                color .3s ease .8s,
                transform .3s ease .8s,
                border-radius .4s  ease .6s;
            transition: top .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                left .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                bottom .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                right .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                width .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                height .4s cubic-bezier(.58,-0.37,.45,1.46) .4s,
                color .3s ease .8s,
                transform .3s ease .8s,
                border-radius .4s  ease .6s;
        }

        .add-button:hover .tl {
            top: -25px;
            left: -25px;
            border-radius: 28px;
        }

        .add-button:hover .tr {  
            top: -25px;
            right: -25px;
            border-radius: 28px;
        }

        .add-button:hover .bl {
            bottom: -25px;
            left: -25px; 
            border-radius: 28px;
        }

        .add-button:hover .br { 
            bottom: -25px;
            right: -25px;
            border-radius: 28px;
        }
        .input-res
        {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            font: 15px/1 'Open Sans', sans-serif;
            color: #333;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            width: 100%;
            max-width: 500px;
            background-color: #ddd;
            border: none;
            padding: 10px 11px 11px 11px;
            border-radius: 3px;
            box-shadow: none;
            outline: none;
            margin: 0;
            box-sizing: border-box; 
        }
    </style>
</head>
<body>
    <?php
    switch($_GET['page']){
        case 'dtl_pengumuman':
            $id = $_GET['id'];
            $sql = mysqli_query($conn, "SELECT * FROM data_pengumuman WHERE id_pengumuman = '".$id."'");
            $data = mysqli_fetch_array($sql);
    ?>
    <ons-navigator swipeable id="myNavigator" page="page1.html"></ons-navigator>
    <template id="page1.html" background-color: red;>
        <ons-page id="index">
            <ons-toolbar>
                <div class="left"><a href="index.php"><ons-toolbar-button icon="md-arrow-left"></ons-toolbar-button></a></div>
                <div class="center">Detail Pengumuman</div>
            </ons-toolbar>

            <div style="height: relative; padding: 1px 0 0 0;">
                <div class="card">
                    <h2 class="card__title"><?= $data['subjek']?></h2>
                    <div class="card__content"><?= $data['isi']?></div>
                </div>
            </div>
            <div style="height: relative; padding: 1px 0 0 0;">
                <div class="card">
                    <div class="card__content">Tanggal : <?= $data['tanggal']?></div>
                    <div class="card__content">Waktu : <?= $data['waktu']?></div>
                </div>
            </div>
            <div style="height: relative; padding: 1px 0 0 0;">
                <div class="card">
                    <div class="card__content">Tempat : <?= $data['lokasi']?></div>
                    <div class="card__content">Rt / Rw : <?= $data['rtrw']?></div>
                </div>
            </div>
        </ons-page>
    </template>
    <?php        
        break;

        case 'dtl_aspirasi' :
    ?>
    <ons-navigator swipeable id="myNavigator" page="page1.html"></ons-navigator>
    <template id="page1.html" background-color: red;>
        <ons-page id="index">
            <ons-toolbar>
                <div class="center">Detail Aspirasi</div>
            </ons-toolbar>
            <div style="height: 200px; padding: 1px 0 0 0;">
                <div class="card">
                    <h2 class="card__title">Card Title</h2>
                    <div class="card__content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                </div>
            </div>
        </ons-page>
    </template>
    <?php
        break;
    }
    ?>
    
</body>
</html>
