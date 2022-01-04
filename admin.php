<?php
    ob_start();
    //cek session
    session_start();

    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
?>
<!--

Name        : SOLINOR
Version     : v1
Description : SOLINOR
Date        : 2021

-->
<!doctype html>
<html lang="en">

<!-- Include Head START -->
<?php include('include/head.php'); ?>
<!-- Include Head END -->

<!-- Body START -->
<body class="bg">

<!-- Header START -->
<header>

<!-- Include Navigation START -->
<?php include('include/menu.php'); ?>
<!-- Include Navigation END -->

</header>
<!-- Header END -->

<!-- Main START -->
<main>

    <!-- container START -->
    <div class="container">

    <?php
        if(isset($_REQUEST['page'])){
            $page = $_REQUEST['page'];
            switch ($page) {
                case 'tsm':
                    include "transaksi_surat_masuk.php";
                    break;
                case 'ctk':
                    include "cetak_disposisi.php";
                    break;
                case 'tsk':
                    include "transaksi_surat_keluar.php";
                    break;
                case 'asm':
                    include "agenda_surat_masuk.php";
                    break;
                case 'ask':
                    include "agenda_surat_keluar.php";
                    break;
                case 'sol':
                    include "solusi.php";
                    break;
                case 'sett':
                    include "pengaturan.php";
                    break;
                case 'pro':
                    include "profil.php";
                    break;
                case 'gsm':
                    include "galeri_sm.php";
                    break;
                case 'gsk':
                    include "galeri_sk.php";
                    break;
                case 'idv':
                    include "individu.php";
                    break;
                case 'org':
                    include "organisasi.php";
                    break;
                case 'ce':
                    include "ce.php";
                    break;
                case 'k1':
                    include "k1.php";
                    break;
                case 'k2':
                    include "k2.php";
                    break;
                case 'inout':
                    include "inout.php";
                    break;
                case 'inout2':
                    include "inout2.php";
                    break;
                case 'base':
                    include "base.php";
                    break;
                case 'base2':
                    include "base2.php";
                    break;
                case 'tutup':
                    include "tutup.php";
                    break;
                case 'tahaka':
                    include "tahaka.php";
                    break;
                case 'input':
                    include "data_pcp.php";
                    break;
                case 'input2':
                    include "data_pcp2.php";
                    break;
                case 'valas':
                    include "valas.php";
                    break;
                case 'buku':
                    include "buku.php";
                    break;
                case 'buku2':
                    include "buku2.php";
                    break;
                case 'buku_ce':
                    include "buku_ce.php";
                    break;
                
            }
        } else {
    ?>
        <!-- Row START -->
        <div class="row">

            <!-- Include Header Instansi START -->
            <?php include('include/header_instansi.php'); ?>
            <!-- Include Header Instansi END -->

            <!-- Welcome Message START -->
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4>Selamat Datang <?php echo $_SESSION['nama']; ?></h4>
                        <p class="description">Anda login sebagai
                        <?php
                            if($_SESSION['admin'] == 1){
                                echo "<strong>Super Admin</strong>. Anda memiliki akses penuh terhadap sistem.";
                            } elseif($_SESSION['admin'] == 2){
                                echo "<strong>Administrator</strong>. Berikut adalah statistik data yang tersimpan dalam sistem.";
                            } else {
                                echo "<strong>Operator</strong>. Berikut adalah statistik data yang tersimpan dalam sistem.";
                            }?></p>
                    </div>
                </div>
            </div>
            <!-- Welcome Message END -->

            <?php
                //menghitung jumlah surat masuk
                $count1 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_surat_masuk"));

                //menghitung jumlah surat masuk
                $count2 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_surat_keluar"));

                //menghitung jumlah surat masuk
                $count3 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_disposisi"));

                //menghitung jumlah klasifikasi
                $count4 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_klasifikasi"));

                //menghitung jumlah pengguna
                $count5 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_user"));
            ?>

            <!-- Info Statistic START -->
            <a href="?page=idv">
                <div class="col s12 m4">
                    <div class="card cyan">
                        <div class="card-content">
                            <span class="card-title white-text"><i class="material-icons md-36">storage</i> Individu</span>
                            <?php echo '<h5 class="white-text link">Soldex Individu</h5>'; ?>
                        </div>
                    </div>
                </div>
            </a>


            <a href="?page=org">
                <div class="col s12 m4">
                    <div class="card deep-orange">
                        <div class="card-content">
                            <span class="card-title white-text"><i class="material-icons md-36">class</i> Organisasi</span>
                            <?php echo '<h5 class="white-text link">Soldex Organisasi</h5>'; ?>
                        </div>
                    </div>
                </div>
            </a>
            
             <a href="?page=ce">
                <div class="col s12 m4">
                    <div class="card cyan">
                        <div class="card-content">
                            <span class="card-title white-text"><i class="material-icons md-36">people</i> CE</span>
                            <?php echo '<h5 class="white-text link">Customer Engagement</h5>'; ?>
                        </div>
                    </div>
                </div>
            </a>

        <?php
            if($_SESSION['id_user'] == 1 || $_SESSION['admin'] == 2){?>
                <a href="?page=sett&sub=usr">
                    <div class="col s12 m4">
                        <div class="card blue accent-2">
                            <div class="card-content">
                                <span class="card-title white-text"><i class="material-icons md-36">people</i> Jumlah Pengguna</span>
                                <?php echo '<h5 class="white-text link">'.$count5.' Pengguna</h5>'; ?>
                            </div>
                        </div>
                    </div>
                </a>
            <!-- Info Statistic START -->
        <?php
            }
        ?>

        </div>
        <!-- Row END -->
    <?php
        }
    ?>
    </div>
    <!-- container END -->

</main>
<!-- Main END -->

<!-- Include Footer START -->
<?php include('include/footer.php'); ?>
<!-- Include Footer END -->

</body>
<!-- Body END -->

</html>

<?php
    }
?>
