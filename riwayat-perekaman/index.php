<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
header("location: ../otentikasi/index.php");
exit();
}

require "../config.php";

$title = "riwayat perekaman - Yakes Medis";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">laporan rekam medis pasien</h1>
    </div>
    

    <table class="table table-responsive table-hover" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>id pasien</th>
                <th>nama</th>
                <th>umur</th>
                <th>jenis kelamin</th>
                <th>telpon</th>
                <th>alamat</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $querypasien = mysqli_query($koneksi, "SELECT * FROM 
            tbl_pasien");
            while($pasien = mysqli_fetch_assoc($querypasien)){ ?>

            <tr>
                <td><?= $no++; ?></td>
                <td > <?= $pasien['id'] ?></td>
                <td> <?= $pasien['nama'] ?></td>
                <td> <?= htgumur( $pasien['tgl_lahir']) ?></td>
                <td> 
                <?php
                if($pasien['gender']=='p'){
                    echo 'pria';
                }else{
                    echo 'pria';
                }


                ?>

                </td>

                <td> <?= $pasien['telpon'] ?></td>
                <td> <?= $pasien['alamat'] ?></td>

                <td class="col-1">
                    <a href="laporan.php?id=<?= $pasien['id'] ?>"class="btn btn-sm btn-outline-primary" title="cetak pdf" target="_blank">
                    <i class="bi bi-printer align-top"></i></a>

                    
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
</main>

<script>
    window.setTimeout(function(){
        $('.updated').fadeOut();
    }, 5000)
</script>

<?php

require "../template/footer.php"

?>
