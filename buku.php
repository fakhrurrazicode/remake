<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 2 AND $_SESSION['admin'] != 3){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.location.href="./logout.php";
                  </script>';
        } else {

            //proses upload file
            if(isset($_POST['submit'])){

                $file = $_FILES['file']['tmp_name'];

                if($file == ""){
                    $_SESSION['errEmpty'] = 'ERROR! Form File tidak boleh kosong';
                    header("Location: ./admin.php?page=tutup&act=imp");
                    die();
                } else {

                    $x = explode('.', $_FILES['file']['name']);
                    $eks = strtolower(end($x));

                    if($eks == 'csv'){

                        //upload file
                        if(is_uploaded_file($file)){
                            $_SESSION['succUpload'] = 'SUKSES! Data berhasil diimport';
                        } else {
                            $_SESSION['errUpload'] = 'ERROR! Proses upload data gagal';
                            header("Location: ./admin.php?page=tutup&act=imp");                                die();
                        }

                        //membuka file csv
                        $handle = fopen($file, "r");
                        $id_user = $_SESSION['id_user'];

                        //parsing file csv
                        while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){

                            //insert data ke dalam database
                             $query = mysqli_query($config, "insert into tbl_tutup(id_tutup,cin,nama,kanwil,kcu,kcp,produk,jt,to_jt,solusi,pic1,pic2,id_user) values(null,'$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]')");
                        }
                        fclose($handle);
                        header("Location: ./admin.php?page=tutup");
                        die();

                    } else {
                        $_SESSION['errFormat'] = 'ERROR! Format file yang diperbolehkan hanya *.CSV';
                        header("Location: ./admin.php?page=tutup&act=imp");
                        die();
                    }
                }
            }

          echo '
                <!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <div class="z-depth-1">
                            <nav class="secondary-nav">
                                <div class="nav-wrapper blue-grey darken-1">
                                    <div class="col m12">
                                        <ul class="left">
                                            <li class="waves-effect waves-light"><a href="?page=buku" class="judul"><i class="material-icons">bookmark</i> Buku Soldex Individu</a></li>
                                            <li class="waves-effect waves-light"><a href="?page=idv"><i class="material-icons">arrow_back</i> Kembali</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- Secondary Nav END -->
                </div>
                <!-- Row END -->';

                if(isset($_SESSION['errFormat'])){
                    $errFormat = $_SESSION['errFormat'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errFormat.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errFormat']);
                }
                if(isset($_SESSION['errUpload'])){
                    $errUpload = $_SESSION['errUpload'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errUpload.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errUpload']);
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

                echo '
                <!-- Row form Start -->
                <div class="row">
                    <div class="col m12">
                        <div class="card">
                            <div class="card-content">
                                <embed type="application/pdf" src="upload/soldex_idv_2022.pdf" width="100%" height="600px"></embed>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
?>
