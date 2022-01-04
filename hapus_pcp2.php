<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_SESSION['errQ'])){
            $errQ = $_SESSION['errQ'];
            echo '<div id="alert-message" class="row jarak-card">
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

    	$id_pcp = mysqli_real_escape_string($config, $_REQUEST['id_pcp']);
    	$query = mysqli_query($config, "SELECT * FROM tbl_pcp2 WHERE id_pcp='$id_pcp'");

    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){

            if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk menghapus data ini");
                        window.location.href="./admin.php?page=input2";
                      </script>';
            } else {

    		  echo '
                <!-- Row form Start -->
				<div class="row jarak-card">
				    <div class="col m12">
                    <div class="card">
                        <div class="card-content">
				        <table>
				            <thead class="red lighten-5 red-text">
				                <div class="confir red-text"><i class="material-icons md-36">error_outline</i>
				                Apakah Anda yakin akan menghapus data ini?</div>
				            </thead>

				            <tbody>
				                <tr>
    			                    <td width="34%">Tanggal Input</td>
    			                    <td width="1%">:</td>
    			                    <td width="65%">'.indoDate($row['tgl_input']).'</td>
    			                </tr>
				                <tr>
				                    <td width="34%">Nomor Register</td>
				                    <td width="1%">:</td>
				                    <td width="65%">'.$row['no_register'].'</td>
				                </tr>
				                <tr>
				                    <td width="34%">Tanggal Proses</td>
				                    <td width="1%">:</td>
				                    <td width="65%">'.indoDate($row['tgl_proses']).'</td>
				                </tr>
    			                <tr>
    			                    <td width="34%">Nama Debitur/Nasabah</td>
    			                    <td width="1%">:</td>
    			                    <td width="65%">'.$row['nama'].'</td>
    			                </tr>
                                <tr>
                                    <td width="34%">Jenis Solusi</td>
                                    <td width="1%">:</td>
                                    <td width="65%">'.$row['solusi'].'</td>
                                </tr>
                                <tr>
                                    <td width="34%">Status</td>
                                    <td width="1%">:</td>
                                    <td width="65%">'.$row['status'].'</td>
                                </tr>
    			            </tbody>
    			   		</table>
                        </div>
                        <div class="card-action">
        	                <a href="?page=input2&act=del&submit=yes&id_pcp='.$row['id_pcp'].'" class="btn-large deep-orange waves-effect waves-light white-text">HAPUS <i class="material-icons">delete</i></a>
        	                <a href="?page=input2" class="btn-large blue waves-effect waves-light white-text">BATAL <i class="material-icons">clear</i></a>
    	                </div>
    	            </div>
                </div>
            </div>
            <!-- Row form END -->';

            	if(isset($_REQUEST['submit'])){
            		$id_pcp = $_REQUEST['id_pcp'];

                    //jika ada file akan mengekseskusi script dibawah ini
                    if(!empty($row['file'])){
                        unlink("upload/surat_masuk/".$row['file']);
                        $query = mysqli_query($config, "DELETE FROM tbl_pcp2 WHERE id_pcp='$id_pcp'");
                        $query2 = mysqli_query($config, "DELETE FROM tbl_disposisi WHERE id_surat='$id_surat'");

                		if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                            header("Location: ./admin.php?page=input2");
                            die();
                		} else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=input2&act=del&id_pcp='.$id_pcp.'";
                                  </script>';
                		}
                	} else {

                        //jika tidak ada file akan mengekseskusi script dibawah ini
                        $query = mysqli_query($config, "DELETE FROM tbl_pcp2 WHERE id_pcp='$id_pcp'");
                        $query2 = mysqli_query($config, "DELETE FROM tbl_disposisi WHERE id_surat='$id_surat'");

                        if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                            header("Location: ./admin.php?page=input2");
                            die();
                        } else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=input2&act=del&id_pcp='.$id_pcp.'";
                                  </script>';
                        }
                    }
                }
    	    }
        }
    }
}
?>
