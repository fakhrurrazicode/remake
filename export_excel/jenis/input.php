<?php 

require_once '../vendor/autoload.php';

require_once '../include/config.php';
require_once '../include/functions.php';


$config = conn($host, $username, $password, $database);

$cari = '';

$htmlString = '<table>
                    <thead>
                        <tr>
                            <th>No Register</th>
                            <th>Tgl. Input</th>
                            <th>Tgl. Proses</th>
                            <th>Nama Debitur/Nasabah</th>
                            <th>Jenis Solusi</th>
                            <th>Status</th>
                            <th>CE</th>
                        </tr>
                    </thead>
                    <tbody>';

$sql = "SELECT * FROM tbl_pcp 
        WHERE 
            no_register LIKE '%$cari%' OR 
            nama LIKE '%$cari%' 
        ORDER by id_pcp DESC";


$query = mysqli_query($config, $sql);

if(mysqli_num_rows($query) > 0){
    $no = 1;
    while($row = mysqli_fetch_array($query)){
        $htmlString .= '<tr>
                            <td>'.$row['no_register'].'</td>
                            <td>'.indoDate($row['tgl_input']).'</td>
                            <td>'.indoDate($row['tgl_proses']).'</td>
                            <td>'.$row['nama'].'</td>
                            <td>'.$row['solusi'].'</td>
                            <td>'.$row['status'].'</td>
                            <td>'.$row['ce'].'</td>
                        </tr>';
    }
}


$htmlString .= '</tbody>
                </table>';

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
$spreadsheet = $reader->loadFromString($htmlString);

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode('input.xlsx').'"');
$writer->save('php://output');