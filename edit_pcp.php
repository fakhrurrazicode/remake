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

                $no_register = $_REQUEST['no_register'];
                $tgl_surat = $_REQUEST['tgl_surat'];
                $namadeb = substr($_REQUEST['namadeb'],0,100);
                $nnamadeb = trim($namadeb);
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

                        if(!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $nnamadeb)){
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

                                    if(!preg_match("/^[a-zA-Z0-9., -]*$/", $status)){
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
                                                    if($ukuran < 2300000){

                                                        $id_pcp = $_REQUEST['id_pcp'];
                                                        $query = mysqli_query($config, "SELECT file FROM tbl_pcp WHERE id_pcp='$id_pcp'");
                                                        list($file) = mysqli_fetch_array($query);

                                                        //jika file tidak kosong akan mengeksekusi script dibawah ini
                                                        if(!empty($file)){
                                                            unlink($target_dir.$file);

                                                            move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                            $query = mysqli_query($config, "UPDATE tbl_pcp SET no_register='$no_register',tgl_proses='$tgl_surat',nama='$namadeb',solusi='$kode',status='$status',ce='$ce',id_user='$id_user' WHERE id_pcp='$id_pcp'");

                                                            if($query == true){
                                                                $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                                                header("Location: ./admin.php?page=tsm");
                                                                die();
                                                            } else {
                                                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                                echo '<script language="javascript">window.history.back();</script>';
                                                            }
                                                        } else {

                                                            //jika file kosong akan mengeksekusi script dibawah ini
                                                            move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$nfile);

                                                            $query = mysqli_query($config, "UPDATE tbl_pcp SET no_register='$no_register',tgl_proses='$tgl_surat',nama='$namadeb',solusi='$kode',status='$status',ce='$ce',id_user='$id_user' WHERE id_pcp='$id_pcp'");

                                                            if($query == true){
                                                                $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                                                header("Location: ./admin.php?page=tsm");
                                                                die();
                                                            } else {
                                                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                                echo '<script language="javascript">window.history.back();</script>';
                                                            }
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
                                                $id_pcp = $_REQUEST['id_pcp'];

                                                $query = mysqli_query($config, "UPDATE tbl_pcp SET no_register='$no_register',tgl_proses='$tgl_surat',nama='$namadeb',solusi='$kode',status='$status',ce='$ce',id_user='$id_user' WHERE id_pcp='$id_pcp'");

                                                if($query == true){
                                                    $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
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
    } else {

        $id_pcp = mysqli_real_escape_string($config, $_REQUEST['id_pcp']);
        $query = mysqli_query($config, "SELECT id_pcp, no_register, tgl_proses, nama, solusi, status,ce, id_user FROM tbl_pcp WHERE id_pcp='$id_pcp'");
        list($id_pcp, $no_register, $tgl_surat, $namadeb, $kode, $status, $ce, $id_user) = mysqli_fetch_array($query);

        if($_SESSION['id_user'] != $id_user AND $_SESSION['id_user'] != 1){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk mengedit data ini");
                    window.location.href="./admin.php?page=input";
                  </script>';
        } else {?>

            <!-- Row Start -->
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">edit</i> Edit Data</a></li>
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
                <form class="col s12" method="POST" action="?page=input&act=edit" enctype="multipart/form-data">

                    <!-- Row in form START -->
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="hidden" name="id_pcp" value="<?php echo $id_pcp ;?>">
                            <i class="material-icons prefix md-prefix">looks_one</i>
                            <input id="no_register" type="number" readonly class="validate" value="<?php echo $no_register ;?>" name="no_register" required>
                                <?php
                                    if(isset($_SESSION['eno_register'])){
                                        $eno_register = $_SESSION['eno_register'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$eno_register.'</div>';
                                        unset($_SESSION['eno_register']);
                                    }
                                ?>
                            <label for="no_register">Nomor Register</label>
                        </div>
                        
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="tgl_surat" type="text" name="tgl_surat" class="datepicker" value="<?php echo $tgl_surat ;?>" required>
                                <?php
                                    if(isset($_SESSION['etgl_surat'])){
                                        $etgl_surat = $_SESSION['etgl_surat'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$etgl_surat.'</div>';
                                        unset($_SESSION['etgl_surat']);
                                    }
                                ?>
                            <label for="tgl_surat">Tanggal Proses</label>
                        </div>
                        
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">people</i>
                            <input id="namadeb" type="text" class="validate" name="namadeb" value="<?php echo $namadeb ;?>" required>
                                <?php
                                    if(isset($_SESSION['enamadeb'])){
                                        $enamadeb = $_SESSION['enamadeb'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$enamadeb.'</div>';
                                        unset($_SESSION['enamadeb']);
                                    }
                                ?>
                            <label for="namadeb">Nama Nasabah/Debitur</label>
                        </div>
            
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">bookmark</i>
                            <input id="kode" type="text" class="validate" name="kode" value="<?php echo $kode ;?>" required>
                                <?php
                                    if(isset($_SESSION['ekode'])){
                                        $ekode = $_SESSION['ekode'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$ekode.'</div>';
                                        unset($_SESSION['ekode']);
                                    }
                                ?>
                            <label for="kode">Jenis Solusi</label>
                        </div>
                        
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">bookmark</i>
                            <input id="status" type="text" class="validate" name="status" value="<?php echo $status ;?>" required>
                                <?php
                                    if(isset($_SESSION['estatus'])){
                                        $estatus = $_SESSION['estatus'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$estatus.'</div>';
                                        unset($_SESSION['estatus']);
                                    }
                                ?>
                            <label for="status">Status</label>
                        </div>
                        
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">bookmark</i>
                            <input id="ce" type="text" class="validate" name="ce" value="<?php echo $ce ;?>" required>
                                <?php
                                    if(isset($_SESSION['ece'])){
                                        $ece = $_SESSION['ece'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$ece.'</div>';
                                        unset($_SESSION['ece']);
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
    }
?>
