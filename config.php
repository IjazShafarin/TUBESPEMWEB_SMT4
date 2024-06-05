<?php

date_default_timezone_set('Asia/Jakarta');

$host   = 'localhost';
$user   = 'root';
$pass   = '';
$dbname =  'db_yakesmedis';

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

// if (!$koneksi) {
//    die('Koneksi gagal');
// } else {
//    echo "Koneksi berhasil";
// }

$main_url  = "http://localhost/yakesmedis-app/";

function uploadGbr($url){
    $namafile = $_FILES['gambar']['name'];
    $ukuran   = $_FILES['gambar']['size'];
    $tmp      = $_FILES['gambar']['tmp_name'];

    $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiFile  = explode('.', $namafile);
    $ekstensiFile  = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        echo "<script>
                alert('Input user gagal, file yang anda upload bukan gambar');
                window.location = '$url';
        </script>";
        die();
    }

    if ($ukuran > 100000) {
        echo "<script>
                alert('Input user gagal, maximal ukuran gambar 1 MB');
                window.location = '$url';
        </script>";
        die();
    }

    
    $namafileBaru = time() . '-' . $namafile;

    move_uploaded_file($tmp, '../asset/gambar/' . $namafileBaru);
    return $namafileBaru;
}

function in_date($tgl){
    $dd  = substr($tgl, 8, 2);
    $mm  = substr($tgl, 5, 2);
    $yy  = substr($tgl, 0, 4);

    return $dd . "-" . $mm . "-" . $yy;
}

function htgumur($tgl_lahir){
    $tgl_lahir = new DateTime($tgl_lahir);
    $hariini = new DateTime("today");
    $umur = $hariini->diff($tgl_lahir)->y;

    return $umur . "tahun";
}

?>