<?php

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
header("location: ../otentikasi/index.php");
exit();
}

require "../config.php";

$title = "Data - Yakes Medis";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = "";
if ($msg == 'deleted') {
    $alert = '<div class="alert alert-succes alert-dismissible fade show" role="alert">
    <strong><i class="bi bi-check-circle align-top "></i> Hapus data rekam medis berhasil..</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if ($msg == 'updated') {
    $alert = '<div class="alert alert-succes alert-dismissible fade show updated" role="alert">
    <strong><i class="bi bi-check-circle align-top "></i> Edit data rekam medis berhasil..</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Rekam Medis</h1>
    </div>
    <?php
    if ($msg !== '') {
       echo $alert; 
    }
    ?>

    <a href="<?= $main_url?>rekamedis/tambah-data.php" class="btn 
    btn-outline-secondary btn-sm mb-3" title="tambah data">
    <i class="bi bi-plus-lg align-top"></i>Data Perekaman</a>


    <table class="table table-responsive table-hover" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl</th>
                <th>Pasien</th>
                <th>Alamat</th>
                <th>Keluhan</th>
                <th>Dokter</th>
                <th>Diagnosa</th>
                <th>Obat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $sqlrm = "SELECT *, tbl_pasien.alamat AS alamatpasien FROM tbl_rekamedis INNER JOIN tbl_pasien ON tbl_rekamedis.
            id_pasien = tbl_pasien.id INNER JOIN tbl_user ON tbl_rekamedis.id_dokter = 
            tbl_user.userid order by tgl_rm desc";
            $queryrm= mysqli_query($koneksi, $sqlrm);
            while($rm = mysqli_fetch_assoc($queryrm)) { ?>

            <tr>
                <td><?= $no++; ?></td>
                <td><?= in_date($rm['tgl_rm']) ?></td>
                <td><?= $rm['nama'] ?></td>
                <td><?= $rm['alamatpasien'] ?></td>
                <td><?= $rm['keluhan'] ?></td>
                <td><?= $rm['fullname'] ?></td>
                <td><?= $rm['diagnosa'] ?></td>
                <td><?= $rm['obat'] ?></td>
                <td>
                    <a href="edit-data.php?id=<?= $rm['no_rm'] ?> "class="btn btn-sm 
                    btn-outline-warning" title="edit data">
                    <i class="bi bi-pen align-top"></i></a>

                    <a href="proses-data.php?id=<?= $rm['no_rm'] ?>&aksi=hapus-data" 
                    onclick="return confirm('Anda yakin menghapus data ini ?')" 
                    class="btn btn-sm btn-outline-danger" title="hapus data">
                    <i class="bi bi-trash align-top"></i></a>
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
