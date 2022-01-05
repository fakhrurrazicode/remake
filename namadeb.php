<?php
// Cegah direct akses ajax.
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
         ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

    // Set header type konten.
    header("Content-Type: application/json; charset=UTF-8");

    require_once "include/config.php";
    require_once "include/functions.php";

    // Koneksi ke database.
    $conn = mysqli_connect($host, $username, $password, $database);

    // Deklarasi variable keyword kode.
    $namadeb = $_GET["query"];

    // Query ke database.
    $query  = mysqli_query($conn, "SELECT * FROM tbl_k1
        WHERE nama LIKE '%$namadeb%'
        OR cin LIKE '%$namadeb%'
        OR kcu LIKE '%$namadeb%'");

    if (mysqli_num_rows($query) > 0){
        // Format bentuk data untuk autocomplete.
        while ($data = mysqli_fetch_assoc($query)) {
            $output['suggestions'][] = [
                'value' => $data['cin'] . " " . $data['nama'],
                'namadeb'  => $data['nama'],
                'pic1'  => $data['pic1'],
                'pic2'  => $data['pic2'],
            ];
        }
    } else {
        $output['suggestions'][] = [
            'value' => '',
            'namadeb'  => '',
            'pic1'  => '',
            'pic2'  => '',
        ];
    }

    // Encode ke json.
    echo json_encode($output);
}
