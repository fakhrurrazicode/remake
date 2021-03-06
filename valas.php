<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'add':
                    include "tambah_klasifikasi.php";
                    break;
                case 'edit':
                    include "edit_klasifikasi.php";
                    break;
                case 'del':
                    include "hapus_klasifikasi.php";
                    break;
                case 'imp':
                    include "upload_valas.php";
                    break;
                case 'emp':
                    include "hapusdata_valas.php";
                    break;
            }
        } else {

            $query = mysqli_query($config, "SELECT referensi FROM tbl_sett");
            list($referensi) = mysqli_fetch_array($query);

            //pagging
            $limit = $referensi;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }

                echo '<!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <div class="z-depth-1">
                            <nav class="secondary-nav">
                                <div class="nav-wrapper blue-grey darken-1">
                                    <div class="col m7">
                                        <ul class="left">
                                            <li class="waves-effect waves-light hide-on-small-only"><a href="?page=valas" class="judul"><i class="material-icons">class</i> Data Potensi Valas</a></li>';
                                            if($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2){
                                                echo '
                                                <li class="waves-effect waves-light"><a href="?page=valas&act=imp"><i class="material-icons md-24">file_upload</i> Import Data</a></li>
                                                <li class="waves-effect waves-light"><a href="?page=valas&act=emp"><i class="material-icons md-24">delete</i> Hapus Data</a></li>';
                                            } else {
                                                echo '';
                                            } echo '
                                        </ul>
                                    </div>
                                    <div class="col m5 hide-on-med-and-down">
                                        <form method="post" action="?page=valas">
                                            <div class="input-field round-in-box">
                                                <input id="search" type="search" name="cari" placeholder="Ketik dan tekan enter mencari data..." required>
                                                <label for="search"><i class="material-icons">search</i></label>
                                                <input type="submit" name="submit" class="hidden">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- Secondary Nav END -->
                </div>
                <!-- Row END -->';

                if(isset($_SESSION['succAdd'])){
                    $succAdd = $_SESSION['succAdd'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card green lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succAdd.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['succAdd']);
                }
                if(isset($_SESSION['succEdit'])){
                    $succEdit = $_SESSION['succEdit'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card green lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succEdit.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['succEdit']);
                }
                if(isset($_SESSION['succDel'])){
                    $succDel = $_SESSION['succDel'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card green lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succDel.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['succDel']);
                }
                if(isset($_SESSION['succUpload'])){
                    $succUpload = $_SESSION['succUpload'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card green lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succUpload.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['succUpload']);
                }

                echo '
                <!-- Row form Start -->
                <div class="row jarak-form">';

                if(isset($_REQUEST['submit'])){
                $cari = mysqli_real_escape_string($config, $_REQUEST['cari']);
                    echo '
                    <div class="col s12" style="margin-top: -18px;">
                        <div class="card blue lighten-5">
                            <div class="card-content">
                                <p class="description">Hasil pencarian untuk kata kunci <strong>"'.stripslashes($cari).'"</strong><span class="right"><a href="?page=valas"><i class="material-icons md-36" style="color: #333;">clear</i></a></span></p>
                            </div>
                        </div>
                    </div>

                    <div class="col m12" id="colres">
                        <table class="bordered" id="tbl">
                            <thead class="blue lighten-4" id="head">
                                <tr>
                                    <th width="5%">CIN</th>
                                            <th width="30%">NAMA</th>
                                            <th width="15%">KW</th>
                                            <th width="15%">KCU</th>
                                            <th width="15%">KCP</th>
                                            <th width="15%">SEG</th>
                                            <th width="15%">PIC</th>
                                            <th width="15%">TELEPON</th>
                                            <th width="15%">HP</th>
                                </tr>
                            </thead>
                            <tbody>';

                            //script untuk menampilkan data
                            $query = mysqli_query($config, "SELECT * FROM tbl_valas WHERE cin LIKE '%$cari%' or nama LIKE '%$cari%' or kcp LIKE '%$cari%' or jml LIKE '%$cari%' or flag_deb LIKE '%$cari%' or pic LIKE '%$cari%' ORDER BY id_valas DESC LIMIT 100");
                            if(mysqli_num_rows($query) > 0){
                                while($row = mysqli_fetch_array($query)){
                                echo '
                                    <tr>
                                        <td>'.$row['cin'].'</td>
                                        <td>'.$row['nama'].'</td>
                                        <td>'.$row['kw'].'</td>
                                        <td>'.$row['kcu'].'</td>
                                        <td>'.$row['kcp'].'</td>
                                        <td>'.$row['seg'].'</td>
                                        <td>'.$row['pic'].'</td>
                                        <td>'.$row['tlp'].'</td>
                                        <td>'.$row['hp'].'</td>
                                    </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="9"><center><p class="add">Tidak ada data yang ditemukan</p></center></td></tr>';
                            }
                          echo '</tbody></table><br/><br/>
                            </div>
                        </div>
                        <!-- Row form END -->';

                    } else {

                        echo '<div class="col m12" id="colres">
                                <table class="bordered" id="tbl">
                                    <thead class="blue lighten-4" id="head">
                                        <tr>
                                            <th width="5%">CIN</th>
                                            <th width="30%">NAMA</th>
                                            <th width="15%">KW</th>
                                            <th width="15%">KCU</th>
                                            <th width="15%">KCP</th>
                                            <th width="15%">SEG</th>
                                            <th width="15%">PIC</th>
                                            <th width="15%">TELEPON</th>
                                            <th width="15%">HP</th>

                                                <div id="modal" class="modal">
                                                    <div class="modal-content white">
                                                        <h5>Jumlah data yang ditampilkan per halaman</h5>';
                                                        $query = mysqli_query($config, "SELECT id_sett,referensi FROM tbl_sett");
                                                        list($id_sett,$referensi) = mysqli_fetch_array($query);
                                                        echo '
                                                        <div class="row">
                                                            <form method="post" action="">
                                                                <div class="input-field col s12">
                                                                    <input type="hidden" value="'.$id_sett.'" name="id_sett">
                                                                    <div class="input-field col s1" style="float: left;">
                                                                        <i class="material-icons prefix md-prefix">looks_one</i>
                                                                    </div>
                                                                    <div class="input-field col s11 right" style="margin: -5px 0 20px;">
                                                                        <select class="browser-default validate" name="referensi" required>
                                                                            <option value="'.$referensi.'">'.$referensi.'</option>
                                                                            <option value="5">5</option>
                                                                            <option value="10">10</option>
                                                                            <option value="20">20</option>
                                                                            <option value="50">50</option>
                                                                            <option value="100">100</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer white">
                                                                        <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Simpan</button>';
                                                                        if(isset($_REQUEST['simpan'])){
                                                                            $id_sett = "1";
                                                                            $referensi = $_REQUEST['referensi'];                                                                    $id_user = $_SESSION['id_user'];

                                                                            $query = mysqli_query($config, "UPDATE tbl_sett SET referensi='$referensi',id_user='$id_user' WHERE id_sett='$id_sett'");
                                                                            if($query == true){
                                                                                header("Location: ./admin.php?page=valas");
                                                                                die();
                                                                            }
                                                                        } echo '
                                                                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                        </tr>
                                    </thead>
                                    <tbody>';

                                    //script untuk menampilkan data
                                    $query = mysqli_query($config, "SELECT * FROM tbl_valas ORDER BY id_valas DESC LIMIT $curr, $limit");
                                    if(mysqli_num_rows($query) > 0){
                                        while($row = mysqli_fetch_array($query)){
                                          echo '
                                        <td>'.$row['cin'].'</td>
                                        <td>'.$row['nama'].'</td>
                                        <td>'.$row['kw'].'</td>
                                        <td>'.$row['kcu'].'</td>
                                        <td>'.$row['kcp'].'</td>
                                        <td>'.$row['seg'].'</td>
                                        <td>'.$row['pic'].'</td>
                                        <td>'.$row['tlp'].'</td>
                                        <td>'.$row['hp'].'</td>
                                            </tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="9"><center><p class="add">Tidak ada data yang ditemukan. <u><a href="?page=valas&act=imp">Upload data baru</a></u></p></center></td></tr>';
                                    }
                                  echo '</tbody></table><br/><br/>
                            </div>
                        </div>
                        <!-- Row form END -->';

                        $query = mysqli_query($config, "SELECT * FROM tbl_valas");
                        $cdata = mysqli_num_rows($query);
                        $cpg = ceil($cdata/$limit);

                        echo '<!-- Pagination START -->
                              <ul class="pagination">';

                        if($cdata > $limit ){

                            //first and previous pagging
                            if($pg > 1){
                                $prev = $pg - 1;
                                echo '<li><a href="?page=valas&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                                      <li><a href="?page=valas&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
                            } else {
                                echo '<li class="disabled"><a href="#"><i class="material-icons md-48">first_page</i></a></li>
                                      <li class="disabled"><a href="#"><i class="material-icons md-48">chevron_left</i></a></li>';
                            }

                            for ($i = 1; $i <= $cpg; $i++) {
                                if ((($i >= $pg - 3) && ($i <= $pg + 3)) || ($i == 1) || ($i == $cpg)) {
                                    if ($i == $pg) echo '<li class="active waves-effect waves-dark"><a href="?page=valas&pg='.$i.'"> '.$i.' </a></li>';
                                    else echo '<li class="waves-effect waves-dark"><a href="?page=valas&pg='.$i.'"> '.$i.' </a></li>';
                                }
                            }

                            //last and next pagging
                            if($pg < $cpg){
                                $next = $pg + 1;
                                echo '<li><a href="?page=valas&pg='.$next.'"><i class="material-icons md-48">chevron_right</i></a></li>
                                      <li><a href="?page=valas&pg='.$cpg.'"><i class="material-icons md-48">last_page</i></a></li>';
                            } else {
                                echo '<li class="disabled"><a href="#"><i class="material-icons md-48">chevron_right</i></a></li>
                                      <li class="disabled"><a href="#"><i class="material-icons md-48">last_page</i></a></li>';
                            }
                            echo '
                            </ul>';
                    } else {
                        echo '';
                    }
            }
        }
    }
?>
