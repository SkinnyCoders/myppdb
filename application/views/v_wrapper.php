<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo/logo-smk.png'); ?>">

    <!-- Main CDN Styles -->
    <?php $this->load->view('templates/cdn_style.php'); ?>

    <!-- Main CSS -->
    <link href="<?= base_url('assets/css/main.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/home_sidebar.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/home_header.css'); ?>" rel="stylesheet">

    <style>
        .header-halaman{
            font-family: arial;
            font-size: 2rem;
            margin: auto;
            margin-bottom: 20px;
            font-size: bold;
        }
    </style>

</head>
<body id="page-top" onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
    <div id="wrapper">
            <!-- Sidebar Section -->
            <?php
            if ($this->session->has_userdata('peserta_login')){
                    $this->load->view('v_peserta/peserta_sidebar.php');
                } else{
                    $this->load->view('templates/home_sidebar.php');
                }
            ?>

            <div id="content-wrapper" class="d-flex flex-column mt-5 pt-3 px-0 mx-0">
                <div id="content">
                    <!-- Header Section -->
                    <?php
                        if ($this->session->has_userdata('peserta_logged_in')){
                            $this->load->view('v_peserta/peserta_header');
                        } else{
                            $this->load->view('templates/home_header.php');
                        }
                    ?>

                    <!-- Body Section -->
                    <div class="container-fluid mt-3">
                        <div id="loading" class="my-3"></div>
                        <div id="loading-image">
                            <img class="loading-image" src="<?= base_url('assets/img/loading/loading-page.gif'); ?>" />
                        </div>
                        <!-- kontent --> 
                        <div id="ajax_content"></div>
                    </div>

                    <!-- Footer Section -->
                    <footer id="peserta-footer" class="p-0 m-0">
                        <?php $this->load->view('templates/home_footer'); ?>
                    </footer>
                </div>
            </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Main CDN JS -->
    <?php $this->load->view('templates/cdn_script.php'); ?>
    <!-- Main JS  -->
    <script src="<?= base_url('assets/js/main.js'); ?>"></script>

    <script>
        $(document).ready(function(){
            function load_page_details() {
                var url_string = window.location.href;
                var url = new URL(url_string);
                var controller_name = url.searchParams.get("p");

                // var lastSegment = window.location.href.substr(window.location.href.indexOf('/')+1);
                // var arr = lastSegment.split('/');
                // if (arr[3] == '') {
                //     var controller_name = null;
                // } else {
                //     var controller_name = arr[3]+"/"+arr[4];    
                // }
                
                if (controller_name == null) url_ajax = "<?php echo base_url('c_home/home'); ?>";
                else url_ajax = "<?php echo base_url(''); ?>/" + controller_name;
                console.log(url_ajax);
                $.ajax({
                    url: url_ajax,
                    beforeSend: function() {
                        $("#loading").show();
                        $("#loading-image").show();
                    },
                }).done(function(data) {                 // data what is sent back by the php page
                    $('#ajax_content').html(data);       // display data
                    $("#loading-image").hide();
                    $("#loading").hide();
                });
            }

            load_page_details(); //inisiasi fungsi load page

            $('.tombol').click(function(){
                var page = $(this).attr("id");
                window.history.pushState("", "", "<?php echo base_url(); ?>?p=" + page);
                load_page_details();
                $('.tombol').removeClass("active");
                $(this).addClass("active");
            });

        });
    </script>

    <script type="text/javascript">    
    //fungsi untuk menampilkan jam saat ini    
        function tampilkanwaktu(){   
            var waktu = new Date();
            var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
            var sm = waktu.getMinutes() + "";  //memunculkan nilai detik    
            var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
            document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
        }
    </script>

</body>
</html>