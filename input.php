<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['submit'])){

            //validasi form kosong
            if($_REQUEST['no_register'] == "" || $_REQUEST['tgl_surat'] == "" || $_REQUEST['namadeb'] == "" || $_REQUEST['kode'] == ""
                || $_REQUEST['status'] == "" || $_REQUEST['ce'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                // var_dump($_REQUEST);
                // // // Form Nama Nasabah/Debitur hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-),kurung() dan garis miring(/)

                $no_register = $_REQUEST['no_register'];
                $tgl_surat = $_REQUEST['tgl_surat'];
                $namadeb = substr($_REQUEST['namadeb'],0,100);
                $nnamadeb = trim($namadeb);

                // var_dump($namadeb);
                // var_dump($nnamadeb);
                // die();
                $kode = substr($_REQUEST['kode'],0,30);
                $nkode = trim($kode);
                $ce = substr($_REQUEST['ce'],0,30);
                $nce = trim($ce);
                $status = substr($_REQUEST['status'],0,30);
                $nstatus = trim($status);
                $id_user = $_SESSION['id_user'];

                //validasi input data
                if(!preg_match("/^[0-9]*$/", $no_register)){
                    $_SESSION['no_register'] = 'Form Nomor Register harus diisi angka!';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)){
                        $_SESSION['no_surat'] = 'Form Nomor Laporan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        // if(!preg_match("/^[0-9.-]*$/", $nnamadeb)){ // kode lama
                        if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $nnamadeb)){
                            $_SESSION['namadeb'] = 'Form Nama Nasabah/Debitur hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-),kurung() dan garis miring(/)';
                            
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $nce)){
                                $_SESSION['ce'] = 'Form CE hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0-9., ]*$/", $nkode)){
                                    $_SESSION['kode'] = 'Form Jenis Solusi hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,)';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    if(!preg_match("/^[a-zA-Z0-9., -]*$/", $nstatus)){
                                        $_SESSION['status'] = 'Form Status hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,) dan minus (-)';

                                        
                                        echo '<script language="javascript">window.history.back();</script>';
                                    } else {

                                        if(!preg_match("/^[0-9.-]*$/", $tgl_surat)){
                                            $_SESSION['tgl_surat'] = 'Form Tanggal Proses hanya boleh mengandung angka dan minus(-)';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        } else {

                                            if(!preg_match("/^[0-9.-]*$/", $keterangan)){
                                                $_SESSION['keterangan'] = 'Form Tanggal Lahir / Pendirian hanya boleh mengandung angka dan minus(-)';
                                                echo '<script language="javascript">window.history.back();</script>';
                                            } else {

                                                $cek = mysqli_query($config, "SELECT * FROM tbl_pcp WHERE no_register='$no_register'");
                                                $result = mysqli_num_rows($cek);
                                                
                                                if($result > 0){
                                                    $_SESSION['errDup'] = 'No Register sudah digunakan, mohon periksa kembali !';
                                                    echo '<script language="javascript">window.history.back();</script>';
                                                    
                                                } else {
                                                    $cek2 = mysqli_query($config, "SELECT * FROM tbl_pcp WHERE no_register='$no_register'");
                                                    $result2 = mysqli_num_rows($cek2);
                                                    
                                                    if($result2 >0){
                                                        $_SESSION['errDup2'] = 'No Register sudah digunakan, No Register terupdate akan terisi otomatis!';
                                                        echo '<script language="javascript">window.history.back();</script>';
                                                    } else {

                                                    $ekstensi = array('jpg','png','jpeg','doc','docx','pdf');
                                                    $file = $_FILES['file']['name'];
                                                    $x = explode('.', $file);
                                                    $eks = strtolower(end($x));
                                                    $ukuran = $_FILES['file']['size'];
                                                    $target_dir = "upload/surat_masuk/";

                                                    if (! is_dir($target_dir)) {
                                                        mkdir($target_dir, 0755, true);
                                                    }

                                                    //jika form file tidak kosong akan mengeksekusi script dibawah ini
                                                    if($file != ""){

                                                        $rand = rand(1,10000);
                                                        $nfile = $rand."-".$file;

                                                        //validasi file
                                                        if(in_array($eks, $ekstensi) == true){
                                                            if($ukuran < 2500000){

                                                                move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                                $query = mysqli_query($config, "INSERT INTO tbl_pcp(no_register,tgl_input,tgl_proses,nama,solusi,status,ce,id_user)
                                                                        VALUES('$no_register',NOW(),'$tgl_surat','$nnamadeb','$nkode','$nstatus','$nce','$id_user')");

                                                                if($query == true){
                                                                    $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                                    header("Location: ./admin.php?page=input");
                                                                    die();
                                                                } else {
                                                                    $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                                    echo '<script language="javascript">window.history.back();</script>';
                                                                }
                                                            } else {
                                                                $_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!';
                                                                echo '<script language="javascript">window.history.back();</script>';
                                                            }
                                                        } else {
                                                            $_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.JPG, *.PNG, *.DOC, *.DOCX atau *.PDF!';
                                                            echo '<script language="javascript">window.history.back();</script>';
                                                        }
                                                    } else {

                                                        //jika form file kosong akan mengeksekusi script dibawah ini
                                                        $query = mysqli_query($config, "INSERT INTO tbl_pcp(no_register,tgl_input,tgl_proses,nama,solusi,status,ce,id_user)
                                                            VALUES('$no_register',NOW(),'$tgl_surat','$nnamadeb','$nkode','$nstatus','$nce','$id_user')");

                                                        if($query == true){
                                                            $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                            header("Location: ./admin.php?page=input");
                                                            die();
                                                        } else {
                                                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                            echo '<script language="javascript">window.history.back();</script>';
                                                        }
                                                    }
                                                }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {?>

            <!-- Row Start -->
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="?page=input&act=add" class="judul"><i class="material-icons">book</i> Input Data Pencapaian</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- Secondary Nav END -->
            </div>
            <!-- Row END -->

            <?php
                if(isset($_SESSION['errQ'])){
                    $errQ = $_SESSION['errQ'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errQ.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errQ']);
                }
                if(isset($_SESSION['errEmpty'])){
                    $errEmpty = $_SESSION['errEmpty'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errEmpty.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errEmpty']);
                }
            ?>

            

            

            <!-- Row form Start -->
            <div class="row jarak-form">

                <!-- Form START -->
                <form class="col s12" method="POST" action="?page=input&act=add" enctype="multipart/form-data">

                    <!-- Row in form START -->
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <?php
                            echo '<input id="no_register" type="number" readonly class="validate" name="no_register" value="';
                                $sql = mysqli_query($config, "SELECT no_register FROM tbl_pcp");
                                $no_register = "1";
                                if (mysqli_num_rows($sql) == 0){
                                    echo $no_register;
                                }

                                $result = mysqli_num_rows($sql);
                                $counter = 0;
                                while(list($no_register) = mysqli_fetch_array($sql)){
                                    if (++$counter == $result) {
                                        $no_register++;
                                        echo $no_register;
                                    }
                                }
                                echo '" required>';

                                if(isset($_SESSION['no_register'])){
                                    $no_register = $_SESSION['no_register'];
                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_register.'</div>';
                                    unset($_SESSION['no_register']);
                                }
                                if(isset($_SESSION['errDup2'])){
                                        $errDup2 = $_SESSION['errDup2'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errDup2.'</div>';
                                        unset($_SESSION['errDup2']);
                                    }
                            ?>
                            <label for="no_register">Nomor Register</label>
                        </div>
                        
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="tgl_surat" type="text" name="tgl_surat" class="datepicker" required>
                                <?php
                                    if(isset($_SESSION['tgl_surat'])){
                                        $tgl_surat = $_SESSION['tgl_surat'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tgl_surat.'</div>';
                                        unset($_SESSION['tgl_surat']);
                                    }
                                ?>
                            <label for="tgl_surat">Tanggal Proses</label>
                        </div>
                        
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">people</i>
                            <input id="namadeb" data-jenis="k1" type="text" class="validate" name="namadeb" required>
                                <?php
                                    if(isset($_SESSION['namadeb'])){
                                        $namadeb = $_SESSION['namadeb'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$namadeb.'</div>';
                                        unset($_SESSION['namadeb']);
                                    }
                                ?>
                            <label for="namadeb">Nama Nasabah / Debitur</label>
                        </div>
                        
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">bookmark</i>
                            <input id="kode" type="text" class="validate" name="kode" required>
                                <?php
                                    if(isset($_SESSION['kode'])){
                                        $kode = $_SESSION['kode'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$kode.'</div>';
                                        unset($_SESSION['kode']);
                                    }
                                ?>
                            <label for="kode">Jenis Solusi</label>
                        </div>
                        
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">bookmark</i>
                            <input id="status" type="text" class="validate" name="status" required>
                                <?php
                                    if(isset($_SESSION['status'])){
                                        $status = $_SESSION['status'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$status.'</div>';
                                        unset($_SESSION['status']);
                                    }
                                ?>
                            <label for="status">Status</label>
                        </div>
                        
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">bookmark</i>
                            <input id="ce" type="text" class="validate" name="ce" required>
                                <?php
                                    if(isset($_SESSION['ce'])){
                                        $ce = $_SESSION['ce'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$ce.'</div>';
                                        unset($_SESSION['ce']);
                                    }
                                ?>
                            <label for="ce">CE</label>
                        </div>
                        
                        
                    </div>
                    <!-- Row in form END -->

                    <div class="row">
                        <div class="col 6">
                            <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        </div>
                        <div class="col 6">
                            <a href="?page=input" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
                        </div>
                    </div>

                </form>
                <!-- Form END -->

            </div>
            <!-- Row form END -->

<?php
        }
    }
?>
