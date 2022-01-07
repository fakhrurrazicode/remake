<?php  

if(!isset($_GET['jenis']) || empty($_GET['jenis'])){
    die('Terjadi kesalahan');
}


$jenis = $_GET['jenis'];

require_once './jenis/'. $jenis .'.php';