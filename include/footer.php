<?php
    //cek session
    if(!empty($_SESSION['admin'])){
?>

<noscript>
    <meta http-equiv="refresh" content="0;URL='./enable-javascript.html'" />
</noscript>

<!-- Footer START -->
<footer class="page-footer">
    <div class="container">
           <div class="row">
               <br/>
           </div>
    </div>
    <div class="footer-copyright blue-grey darken-1 white-text">
        <div class="container" id="footer">
            <?php
                $query = mysqli_query($config, "SELECT * FROM tbl_instansi");
                while($data = mysqli_fetch_array($query)){
            ?>
                <span class="white-text">&copy; <?php echo date("Y"); ?> <?php echo $data['nama'];?></span>
                
            <?php } ?>
        </div>
    </div>
</footer>
<!-- Footer END -->

<!-- Javascript START -->
<script type="text/javascript" src="asset/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="asset/js/materialize.min.js"></script>
<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
<script type="text/javascript" src="asset/js/jquery.autocomplete.min.js"></script>
<script data-pace-options='{ "ajax": false }' src='asset/js/pace.min.js'></script>
<script type="text/javascript">
$(document).ready(function(){
    //jquery dropdown
    $(".dropdown-button").dropdown({ hover: false });

    //jquery sidenav on mobile
    $('.button-collapse').sideNav({
        menuWidth: 240,
        edge: 'left',
        closeOnClick: true
    });

    //jquery datepicker
    $('#tgl_surat,#batas_waktu,#dari_tanggal,#sampai_tanggal').pickadate({
        selectMonths: true,
        selectYears: 10,
        format: "yyyy-mm-dd"
    });
    
    //jquery datepicker2
    $('#keterangan,#batas_waktu,#dari_tanggal,#sampai_tanggal').pickadate({
        selectMonths: true,
        selectYears: 200,
        format: "yyyy-mm-dd"
    });

    //jquery textarea
    $('#isi_ringkas').val('');
    $('#isi_ringkas').trigger('autoresize');

    //jquery dropdown select dan tooltip
    $('select').material_select();
    $('.tooltipped').tooltip({delay: 10});

    //jquery autocomplete
    $( "#kode" ).autocomplete({
        serviceUrl: "kode.php",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            $( "#kode" ).val(suggestion.kode);
        }
    });
    
    //jquery autocomplete
    $( "#namadeb[data-jenis='k1']").autocomplete({
        serviceUrl: "namadeb.php?jenis=k1",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            // $( "#namadeb" ).val(suggestion.kode);

            $('#pic_info').remove();

            $( "#namadeb" ).val(suggestion.namadeb);
            $('#namadeb').after(`<div id="pic_info" style="margin-left: 45px; margin-bottom: 15px;">
                <p style="margin: 0;">PIC1: ${suggestion.pic1}</p>
                <p style="margin: 0;">PIC2: ${suggestion.pic2}</p>
            </div>`);
        }
    });

    $( "#namadeb[data-jenis='k2']").autocomplete({
        serviceUrl: "namadeb.php?jenis=k2",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            // $( "#namadeb" ).val(suggestion.kode);

            $('#pic_info').remove();

            $( "#namadeb" ).val(suggestion.namadeb);
            $('#namadeb').after(`<div id="pic_info" style="margin-left: 45px; margin-bottom: 15px;">
                <p style="margin: 0;">PIC1: ${suggestion.pic1}</p>
                <p style="margin: 0;">PIC2: ${suggestion.pic2}</p>
            </div>`);
        }
    });
    
    //jquery autocomplete
    $( "#ce" ).autocomplete({
        serviceUrl: "ce5.php",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            $( "#ce" ).val(suggestion.value);
        }
    });
    
    //jquery autocomplete
    $( "#status" ).autocomplete({
        serviceUrl: "status.php",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            $( "#status" ).val(suggestion.value);
        }
    });

    //jquery untuk menampilkan pemberitahuan
    $("#alert-message").alert().delay(5000).fadeOut('slow');

    //jquery modal
    $('.modal-trigger').leanModal();
 });

</script>
<!-- Javascript END -->

<?php
    } else {
        header("Location: ../");
        die();
    }
?>
