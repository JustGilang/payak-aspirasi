<?php
include '../config/config.php';
//error_reporting(0);
session_start();	
$id = $_SESSION['id_user'];
$query = mysqli_query($conn, "SELECT * FROM data_warga WHERE id_user ='$id'");
$tampil = mysqli_fetch_array($query);

if($_SESSION['status'] !="login"){
    echo '
        <script>
          alert("Silahkan Login Terlebih Dulu !");
          window.location = "../function/db_logout.php"
        </script>
    ';
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
    <script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>
    
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
            background-color: red;
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

        ons-input input {
            width: 270px !important;
            font-size: 15px;
        }
        
        fieldset{
        padding: 30px;
        }

        .__lk-fileInput{
        cursor: pointer;

        input {
            display: none;
        }
        span{
            color: #fff;
            margin: 0 0 10px;
            padding: 5px 10px;
            text-decoration: none;
            background: #418edb;
            border-radius: 2px;
            font: normal 14px/1.412 Helvetica;
            &:hover{
            background: #2683E1;
            }
            &.withFile{
            &:after{
                content: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAMCAYAAABWdVznAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QTA5OEU0M0REOUIwMTFFMzg4Q0VDNDEwMTU1QkU0MUIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QTA5OEU0M0VEOUIwMTFFMzg4Q0VDNDEwMTU1QkU0MUIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpBMDk4RTQzQkQ5QjAxMUUzODhDRUM0MTAxNTVCRTQxQiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpBMDk4RTQzQ0Q5QjAxMUUzODhDRUM0MTAxNTVCRTQxQiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PolX3bIAAADWSURBVHjadNHNCkFBFMDxSYq9UsoCC4/gZqFEiXLZSKy8nJ2Pja6FB1A8i/KRuEjXfzSXY3DqV3Nnzpx7TqOCIMhjgAkSUJYkRugjG1VKFeGiBgdz9RmOObvgWWEWvOOMlqiu1745u2OsN9No42YOLqigbNbhXgMp2WsdW5NwE8kbVMM8e8ASrlaLjsyJWAPG1HfEP77+DOiLlo6m3VdLOXRFK3qOAoo4iAIdZPQFT/R8ktXQFH/VMVXmlfVL7qzkkIs9hujpl16G42D9Y+gVFvD0+iHAAMR9gu9PEii4AAAAAElFTkSuQmCC');
                display: inline-block;
                vertical-align: middle;
                margin-left: 8px;
            }
            }
        }
        }
    </style>
  </head>
  <body>
    <ons-page>
        <ons-tabbar swipeable position="bottom">
            <ons-tab page="index" icon="md-home" active></ons-tab>
            <ons-tab page="aspirasi" icon="md-assignment" active-icon="md-assignment"></ons-tab>
            <ons-tab page="pengumuman" icon="md-notifications" active-icon="md-notifications"></ons-tab>
        </ons-tabbar>
    </ons-page>
      
    <template id="index">
        <ons-page id="Tab1" class="bg">
            <section style="padding: 8px; text-align: right;">
                <a href="../function/db_logout.php" style="text-align: right;"><ons-button modifier="quiet" style="text-align: right;">logout</ons-button></a>
            </section>
            
            <div class="wrapper">
                <input checked type=radio name="slider" id="slide1" />
                <input type=radio name="slider" id="slide2" />
                <input type=radio name="slider" id="slide3" />
                <input type=radio name="slider" id="slide4" />
                <input type=radio name="slider" id="slide5" />
            
                <div class="slider-wrapper">
                    <div class=inner>
                        <article>
                        <img src="slide1.jpg" />
                        </article>
                
                        <article>
                        <img src="slide2.jpg" />
                        </article>
                
                        <article>
                        <img src="slide3.jpg" />
                        </article>
                
                        <article>
                        <img src="slide4.jpg" />
                        </article>
                
                        <article>
                        <img src="slide1.jpg" />
                        </article>
                    </div>
                <!-- .inner -->
                </div>
                <!-- .slider-wrapper -->
            
                <div class="slider-prev-next-control">
                <label for=slide1></label>
                <label for=slide2></label>
                <label for=slide3></label>
                <label for=slide4></label>
                <label for=slide5></label>
                </div>
                <!-- .slider-prev-next-control -->
            
                <div class="slider-dot-control">
                <label for=slide1></label>
                <label for=slide2></label>
                <label for=slide3></label>
                <label for=slide4></label>
                <label for=slide5></label>
                </div>
                <!-- .slider-dot-control -->
            </div>  
            <br><br>
            <p align="center">Welcome Warga !</p>
        </ons-page>
    </template>
      
    <template id="aspirasi">
        <ons-page id="Tab2" class="bg">
            <div class="wrapper">
                <input checked type=radio name="slider" id="slide1" />
                <input type=radio name="slider" id="slide2" />
                <input type=radio name="slider" id="slide3" />
                <input type=radio name="slider" id="slide4" />
                <input type=radio name="slider" id="slide5" />
            
                <div class="slider-wrapper">
                <div class=inner>
                    <article>
                    <img src="slide1.jpg" />
                    </article>
            
                    <article>
                    <img src="slide2.jpg" />
                    </article>
            
                    <article>
                    <img src="slide3.jpg" />
                    </article>
            
                    <article>
                    <img src="slide4.jpg" />
                    </article>
            
                    <article>
                    <img src="slide1.jpg" />
                    </article>
                </div>
                <!-- .inner -->
                </div>
                <!-- .slider-wrapper -->
            
                <div class="slider-prev-next-control">
                <label for=slide1></label>
                <label for=slide2></label>
                <label for=slide3></label>
                <label for=slide4></label>
                <label for=slide5></label>
                </div>
                <!-- .slider-prev-next-control -->
            
                <div class="slider-dot-control">
                <label for=slide1></label>
                <label for=slide2></label>
                <label for=slide3></label>
                <label for=slide4></label>
                <label for=slide5></label>
                </div>
                <!-- .slider-dot-control -->
            </div>  

            <table>
                <thead>
                  <tr>
                    <th scope="col">Pengumuman</th>
                    <th scope="col">RT/RW</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM data_pengumuman WHERE rt='$tampil[rt]' AND rw='$tampil[rw]'");
                    while($data = mysqli_fetch_array($sql)){
                    ?>
                    <tr>
                        <td data-label="Pengumuman"><?= $data['subjek']?></td>
                        <td data-label="Tanggal"><?= $data['tanggal']?></td>
                        <td data-label="">
                            <a href="dtl_pengumuman.php?id=<?= $data['id_pengumuman']?>">
                                <ons-button modifier="material">
                                    <ons-ripple></ons-ripple>
                                    view more
                                </ons-button>
                            </a>
                        </td>
                    </tr> 
                    <?php }?>
                </tbody>
              </table>
        </ons-page>
    </template>

    <template id="pengumuman">
        <ons-page id="Tab3">
            <div class="wrapper">
                <input checked type=radio name="slider" id="slide1" />
                <input type=radio name="slider" id="slide2" />
                <input type=radio name="slider" id="slide3" />
                <input type=radio name="slider" id="slide4" />
                <input type=radio name="slider" id="slide5" />
            
                <div class="slider-wrapper">
                    <div class=inner>
                        <article>
                        <img src="slide1.jpg" />
                        </article>
                
                        <article>
                        <img src="slide2.jpg" />
                        </article>
                
                        <article>
                        <img src="slide3.jpg" />
                        </article>
                
                        <article>
                        <img src="slide4.jpg" />
                        </article>
                
                        <article>
                        <img src="slide1.jpg" />
                        </article>
                    </div>
                    <!-- .inner -->
                </div>
                <!-- .slider-wrapper -->
            
                <div class="slider-prev-next-control">
                    <label for=slide1></label>
                    <label for=slide2></label>
                    <label for=slide3></label>
                    <label for=slide4></label>
                    <label for=slide5></label>
                </div>
                <!-- .slider-prev-next-control -->
            
                <div class="slider-dot-control">
                    <label for=slide1></label>
                    <label for=slide2></label>
                    <label for=slide3></label>
                    <label for=slide4></label>
                    <label for=slide5></label>
                </div>
                <!-- .slider-dot-control -->
            </div>  

            <div style="text-align: left; margin-top: 30px; margin-left: 20px; margin-right: 20px;">
                <form action="../function/db_warga.php?act=add_aspirasi" method="POST" enctype="multipart/form-data">
                    <?php
                    $query = "SELECT max(id_pesan) as maxKode FROM data_pesan";
                    $hasil = mysqli_query($conn,$query);
                    $data = mysqli_fetch_array($hasil);
                    $kode = $data['maxKode'];
                    $noUrut = (int) substr($kode, 3, 3);
                    
                    $noUrut++;
                    
                    $char = "AS-";
                    $kode = $char . sprintf("%03s", $noUrut);
                    ?>

                    <section style="padding: 8px">
                        <select name="subjek" id="" class="text-input input-res" style="width: 100%;">
                            <option value="keluhan">Keluhan</option>
                            <option value="aspirasi">aspirasi</option>
                        </select>
                    </section>

                    <section style="padding: 8px">
                    <input type="text" class="text-input" ng-model="text" style="display: block; width: 100%" name="id" value="<?= $kode;?>" readonly>
                    </section>

                    <section style="padding: 8px">
                    <input type="hidden" class="text-input input-res" ng-model="text" name="id_user" value="<?= $_SESSION['id_user']?>" placeholder="NIK" style="display: block; width: 100%">
                    </section>

                    <section style="padding: 8px">
                    <input type="text" class="text-input input-res" ng-model="text" name="tanggal" value="<?= date('Y-m-d')?>" placeholder="NIK" style="display: block; width: 100%">
                    </section>

                    <section style="padding: 8px">
                    <textarea name="pesan" class="text-input input-res" id="" cols="30" rows="10" placeholder="Isi pesan disini"></textarea>
                    </section>

                    <section style="padding: 8px">
                    <input type="text" class="text-input input-res" ng-model="text" name="rt" placeholder="RT" style="display: block; width: 100%">
                    </section>

                    <section style="padding: 8px">
                    <input type="text" class="text-input input-res" ng-model="text" name="rw" placeholder="RW" style="display: block; width: 100%">
                    </section>

                    <section style="padding: 8px">
                    <input type="file" class="text-input input-res" ng-model="text" name="file" placeholder="" style="display: block; width: 100%">
                    </section>
                    <br>
                    <section style="padding: 0 8px 8px">
                    <button type="submit"><ons-button modifier="large" type="submit">Submit</ons-button></button>
                    </section>
                </form>
            </div>
        </ons-page>
    </template>
  </body>
  <script>
    var login = function() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;

        if (username === 'bob' && password === 'secret') {
            ons.notification.alert('Congratulations!');
        } else {
            ons.notification.alert('Incorrect username or password.');
        }
    };

    $(function(){  
        $('input').change(function(){
            var label = $(this).parent().find('span'); 
            if(typeof(this.files) !='undefined'){ // fucking IE      
            if(this.files.length == 0){
                label.removeClass('withFile').text(label.data('default'));
            }
            else{
                var file = this.files[0]; 
                var name = file.name;
                var size = (file.size / 1048576).toFixed(3); //size in mb 
                label.addClass('withFile').text(name + ' (' + size + 'mb)');
            }
            }
            else{
            var name = this.value.split("\\");
                label.addClass('withFile').text(name[name.length-1]);
            }
            return false;
        });  
    });
  </script>
</html>