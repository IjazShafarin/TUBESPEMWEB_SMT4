<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
    header("location: ../otentikasi/index.php");
    exit();
}

require "../config.php";

$title = "laporan rekam medis - Yakes Medis";

// Memuat autoloader dari Composer
require '../vendor/autoload.php';

// Referensi namespace Dompdf
use Dompdf\Dompdf;

// Membuat instance dari kelas Dompdf
$dompdf = new Dompdf();

$id = $_GET['id'];

$querypasien = mysqli_query($koneksi, "SELECT * FROM tbl_pasien WHERE id = '$id'");
$pasien = mysqli_fetch_assoc($querypasien);

if ($pasien['gender'] == 'p') {
    $gender = 'pria';
} else {
    $gender = 'pria';
}

$content = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .head {
            text-align: center;
            margin-bottom: 40px;
            margin-top: -5px;
        }
        .label-head {
            width: 120px;
            padding-left: 1px;
            padding-bottom: 5px;
            text-align: left;
        }
        .data-left {
            width: 300px;
            padding-left: 1px;
            padding-bottom: 5px;
            text-align: left;
        }
        .data-right {
            width: 130px;
            padding-left: 1px;
            padding-bottom: 5px;
            text-align: left;
        }
        hr {
            margin-bottom: 2px;
            margin-left: -5px;
            width: 700px;
        }
        .table-head {
            text-align: left;
        }
        .data {
            vertical-align: top;
        }
    </style>
</head>
<body>
    <h2 class="head">rekam medis pasien</h2>
    <table>
        <tr>
            <th class="label-head">nama pasien</th>
            <td class="data-left">:' . $pasien['nama'] . '</td>
            <th class="label-head">jenis kelamin</th>
            <td class="data-right">:' . $gender . '</td>
        </tr>
        <tr>
            <th class="label-head">umur</th>
            <td class="data-left">:' . htgumur($pasien['tgl_lahir']) . '</td>
            <th class="label-head">telpon</th>
            <td class="data-right">:' . $pasien['telpon'] . '</td>
        </tr>
        <tr>
            <th class="label-head">alamat</th>
            <td class="data-left" colspan="3">:' . $pasien['alamat'] . '</td>
        </tr>
    </table>

    <table>
    <thead>
    <tr>
        <th colspan="5">
            <hr size="3" />
        </th>
    </tr>
    <tr>
        <th class="table-head" style="width: 90px;">tanggal</th>
        <th class="table-head" style="width: 200px;">keluhan</th>
        <th class="table-head" style="width: 120px;">diagnosa</th>
        <th class="table-head" style="width: 200px;">obat</th>
        <th class="table-head" style="width: 70px;">dokter</th>
    </tr>
    <tr>
        <th colspan="5">
            <hr size="3" />
        </th>
    </tr>
    </thead>
    <tbody>';

$sqlrm = "SELECT * FROM tbl_rekamedis INNER JOIN tbl_user ON tbl_rekamedis.id_dokter = tbl_user.userid WHERE id_pasien = '$id'";
$queryrm = mysqli_query($koneksi, $sqlrm);
while ($rm = mysqli_fetch_assoc($queryrm)) {
    $content .= '
    <tr>
        <td class="data">' . in_date($rm['tgl_rm']) . '</td>
        <td class="data">' . $rm['keluhan'] . '</td>
        <td class="data">' . $rm['diagnosa'] . '</td>
        <td class="data">' . $rm['obat'] . '</td>
        <td class="data">' . $rm['fullname'] . '</td>
    </tr>';
}

$content .= '
    </tbody>
    <tfoot>
    <tr>
        <th colspan="5">
            <hr size="3" />
        </th>
    </tr>
    </tfoot>
    </table>
</body>
</html>';

$dompdf->loadHtml($content);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Merender HTML menjadi PDF
$dompdf->render();

// Menampilkan PDF di browser tanpa mengunduhnya
$dompdf->stream('laporan rekam medis', array('attachment' => false));

?>
